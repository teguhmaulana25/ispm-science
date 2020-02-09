<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Carbon;
use Validator;
use App\Candidate;

use App\Mail\ActionEmail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendMail;
class OnboardingController extends Controller
{
  public function index()
  {
    $list_division     = DB::table('divisions')->where('divisions.status', '=', 1)->pluck('name', 'id');
    return view('admin.pages.onboardings.index')->with(compact('list_division'));
  }

  public function filter(Request $request)
  {
    $input 	= $request->all();
    if (!empty($input['division']) && !empty($input['job_vacancy']) ) {
      $division = $input['division'];
      $job_vacancy 	= $input['job_vacancy'];
      return redirect()
        ->route('onboarding.view', [
          'start_date' => $division,
          'end_date' => $job_vacancy
        ]);      
    } else {
      return redirect()
        ->back()
        ->with('error', 'Please check the data.');
    }
  }

  public function jobVacancy(Request $request) {
      if ($request->ajax()) {
        $division = $request->input('division');
        $count_jobVacancy= \App\JobVacancy::select([
            'id',
            'title',
          ])
          ->where('division_id', $division)
          ->count();
        if($count_jobVacancy > 0) {
          $jobVacancy = \App\JobVacancy::select([
              'id',
              'title',
            ])
            ->where('division_id', $division)
            ->get();
  
          $data = [];
          foreach ($jobVacancy as $key => $value) {
            $data[$key]['id'] = $value->id;
            $data[$key]['text'] = $value->title;
          }
          return response()->json([
            'message' => 'Job Vacancy available',
            'success' => true,
            'data'    => $data
          ], 200);
        }else {
          return response()->json([
            'message' => 'Jov Vacancy not available',
            'success' => false,
          ], 200);
        }
  
      }else {
        abort(404, 'Page Not Found');
      }
  }

  public function view($division, $job_vacancy)
	{
    $data = \App\Candidate::select([
      'candidates.id',
      'candidates.name',
      'candidates.birth_place',
      'candidates.birth_date',
      'candidates.email',
      'candidates.phone',
      'candidates.created_at',
      'candidates.job_vacancy_id',
      'job_vacancies.division_id',
      'job_vacancies.user_id',
      'job_vacancies.title',
    ])
    ->join('job_vacancies', 'candidates.job_vacancy_id', '=', 'job_vacancies.id')
    ->where('job_vacancies.division_id', '=', $division)
    ->where('candidates.job_vacancy_id', '=', $job_vacancy)
    // ->where('candidates.cronbach_alpha_id', '=', null)
    // ->where('candidates.id', '=', 3)
    ->get();
    $output = [];
    $master = [];
    $data_candidate = [];
    $status_value = [];
    foreach ($data as $key_candidate => $value_candidate) {
      $step_one = DB::table('candidate_details')
        ->select([
          'candidate_details.id',
          'candidate_details.criteria_detail_id',
          'candidate_details.answer',
          'criterias.id as criteria_id',
          'criterias.percentage',
          'criterias.type',
          'criterias.step',
        ])
        ->where('candidate_details.candidate_id', '=', $value_candidate->id)
        ->join('criteria_details', 'candidate_details.criteria_detail_id', '=', 'criteria_details.id')
        ->join('criterias', 'criteria_details.criteria_id', '=', 'criterias.id')
        ->where('criterias.step', '=', 1)
        ->get();

      $step_one_value = 0;
      foreach ($step_one as $key_step_one => $value_step_one) {
        $get_criteria_detail = DB::table('criteria_details')
          ->where('criteria_details.criteria_id', '=', $value_step_one->criteria_id)
          ->pluck('name', 'id');
        $criteria_detail_array = [];
        foreach ($get_criteria_detail as $key => $value) {
          $criteria_detail_array[] = $key;
        }
        $get_master = DB::table('job_vacancy_details')
          ->select([
            'job_vacancy_details.id',
            'job_vacancy_details.criteria_detail_id',
            'job_vacancy_details.value'
          ])
          ->join('criteria_details', 'job_vacancy_details.criteria_detail_id', '=', 'criteria_details.id')
          ->join('criterias', 'criteria_details.criteria_id', '=', 'criterias.id')
          ->where('job_vacancy_details.job_vacancy_id', '=', $value_candidate->job_vacancy_id)
          ->where('criterias.id', '=', $value_step_one->criteria_id)
          ->whereIn('job_vacancy_details.criteria_detail_id', $criteria_detail_array)
          ->first();
      
        $key_master = $get_master->value;
        $key_percentage = $value_step_one->percentage;
        $key_percentage_data = $key_percentage / 100;

        if ($value_step_one->type == 1) { // if type benefit
          $key_benefit_cost = $value_step_one->answer / $key_master;
          $key_value = $key_benefit_cost * $key_percentage_data;
          $step_one_value += $key_value; 
        } else { // if type cost
          $key_benefit_cost = $key_master / $value_step_one->answer;
          $key_value = $key_benefit_cost * $key_percentage_data;
          $step_one_value -= $key_value; 
        }
      }

      $step_two = DB::table('candidate_details')
        ->select([
          'candidate_details.id',
          'candidate_details.criteria_detail_id',
          'candidate_details.answer',
          'criterias.id as criteria_id',
          'criterias.percentage',
          'criterias.type',
          'criterias.step',
        ])
        ->where('candidate_details.candidate_id', '=', $value_candidate->id)
        ->join('criteria_details', 'candidate_details.criteria_detail_id', '=', 'criteria_details.id')
        ->join('criterias', 'criteria_details.criteria_id', '=', 'criterias.id')
        ->where('criterias.step', '=', 2)
        ->get();

      $step_two_value = 0;
      if (count($step_two) > 0) {
        foreach ($step_two as $key_step_two => $value_step_two) {
          $get_criteria_detail = DB::table('criteria_details')
            ->where('criteria_details.criteria_id', '=', $value_step_two->criteria_id)
            ->pluck('name', 'id');
          $criteria_detail_array = [];
          foreach ($get_criteria_detail as $key => $value) {
            $criteria_detail_array[] = $key;
          }
          
          $get_master = DB::table('job_vacancy_details')
            ->select([
              'job_vacancy_details.id',
              'job_vacancy_details.criteria_detail_id',
              'job_vacancy_details.value'
            ])
            ->join('criteria_details', 'job_vacancy_details.criteria_detail_id', '=', 'criteria_details.id')
            ->join('criterias', 'criteria_details.criteria_id', '=', 'criterias.id')
            ->where('job_vacancy_details.job_vacancy_id', '=', $value_candidate->job_vacancy_id)
            ->where('criterias.id', '=', $value_step_two->criteria_id)
            ->whereIn('job_vacancy_details.criteria_detail_id', $criteria_detail_array)
            ->first();
        
          $key_master = $get_master->value;
          $key_percentage = $value_step_two->percentage;
          $key_percentage_data = $key_percentage / 100;
  
          if ($value_step_two->type == 1) { // if type benefit
            $key_benefit_cost = $value_step_two->answer / $key_master;
            $key_value = $key_benefit_cost * $key_percentage_data;
            $step_two_value += $key_value; 
          } else { // if type cost
            $key_benefit_cost = $key_master / $value_step_two->answer;
            $key_value = $key_benefit_cost * $key_percentage_data;
            $step_two_value -= $key_value; 
          }

        }

        $get_master = DB::table('job_skill_details')
        ->where('job_skill_details.job_vacancy_id', '=', $job_vacancy)
        ->sum('value');
        $get_candidate_skill = DB::table('candidate_skills')
          ->where('candidate_skills.candidate_id', '=', $value_candidate->id)
          ->sum('answer');

        $total_skill = $get_candidate_skill / $get_master;
        $total_value = $step_one_value + $step_two_value + $total_skill;

        $status_value[] = [
          'status_value' => round($total_value / 3, 2),
          'status_id' => $this->getCronbach(round($total_value / 3, 2), 1)['id'],
          'status_description' => $this->getCronbach(round($total_value / 3, 2), 1)['label'],
          'candidate' => $value_candidate
        ];
      }

    } // end foreach

    if ($status_value) {
      $data_candidate = collect($status_value)->sortByDesc('status_value');
    }    

    return view('admin.pages.onboardings.view')->with(compact('data_candidate', 'division', 'job_vacancy'));
  }

  public function update(Request $request, $division, $job_vacancy) {
    $input = $request->all();
    if ($input['data']) {
      foreach ($input['data']['DataCandidate'] as $key => $value) {
        \App\Candidate::where('id', $value['candidate'])
        ->update([
            'cronbach_alpha_id' => $value['candidate_status']
        ]);

        Mail::to($this->getCandidate($value['candidate'])->email)->queue(new ActionEmail(
                [
                    'type' => 'onboarding_email',
                    'name' => $this->getCandidate($value['candidate'])->name,
                    'date' => \Carbon\Carbon::parse($input['information_date'])->format('l, j F Y \\a\\t h:i A'),
                ]));
      }
      return redirect()
        ->back()
        ->with('info', 'Candidate successfully notified by email');
    } else {
      return redirect()
        ->back()
        ->with('error', 'Please check your input');      
    }
  }

  public function viewCandidate($division, $job_vacancy, $candidate)
  {
    // $candidate   = \App\Candidate::findOrFail($candidate);
    $candidate = \App\Candidate::select([
      'candidates.*',
      'job_vacancies.title as title_job',
      'job_vacancies.division_id'
    ])
    ->leftJoin('job_vacancies', 'candidates.job_vacancy_id', '=', 'job_vacancies.id')
    ->where('candidates.id', '=', $candidate)
    ->first();
    $jobVacancy = DB::table('job_vacancy_details')
      ->where('job_vacancy_id', '=', $candidate->job_vacancy_id)
      ->get();
    $criteria = [];
    foreach ($jobVacancy as $key => $value) {
      $criteria_detail_id = $value->criteria_detail_id;
      $checkCriteria = \App\Criteria::select([
          'criterias.id'
        ])
        // ->where('criterias.step', '=', 2)
        ->where(function ($query) use ($criteria_detail_id) {
          $query->whereHas('criteriaDetail', function($query) use ($criteria_detail_id) {
            $query->where('criteria_details.id', '=', $criteria_detail_id);
          });
        })
        ->count();
      if ($checkCriteria > 0) {
          $criteria[] = \App\Criteria::select([
            'criterias.id',
            'criterias.name',
            'criterias.percentage',
            'criterias.type',
            'criterias.step'
          ])
          // ->where('criterias.step', '=', 2)
          ->where(function ($query) use ($criteria_detail_id) {
            $query->whereHas('criteriaDetail', function($query) use ($criteria_detail_id) {
              $query->where('criteria_details.id', '=', $criteria_detail_id);
            });
          })
          ->orderBy('criterias.id', 'ASC')
          ->first();
      }
    }

    $jobSkill = DB::table('job_skill_details')
      ->select(['job_vacancies.division_id', 'job_skill_details.id', 'job_skill_details.skill_id'])
      ->leftJoin('job_vacancies', 'job_skill_details.job_vacancy_id', '=', 'job_vacancies.id')
      ->where('job_vacancy_id', '=', $candidate->job_vacancy_id)
      ->get();

    $skill = [];
    foreach ($jobSkill as $key => $value) {
      $division_id = $value->division_id;
      $checkSkill = \App\Skill::select([
          'id',
          'name'
        ])
        ->where('skills.id', '=', $value->skill_id)
        ->count();
      if ($checkSkill > 0) {
        $skill[] = \App\Skill::select([
            'id',
            'name'
          ])
          ->where('skills.id', '=', $value->skill_id)
          ->first();
      }
    }
    return view('admin.pages.onboardings.viewCandidate')
      ->with(compact('criteria','skill', 'division', 'job_vacancy', 'candidate'));
  }

  public function getCronbach($value, $type) { // 1 : label 2 : id
    $data   = DB::table('cronbach_alphas')
            ->select(
                [
                    'cronbach_alphas.id',
                    'cronbach_alphas.label',
                    'cronbach_alphas.min',
                    'cronbach_alphas.max'
                ])
            ->get();
    $rt_val = [
      'id' => 0,
      'label' => '-'
    ];
    if($type == 1) { // Return label
        foreach ($data as  $v) {
            if( ($value >= $v->min) && ($value < $v->max) ){
                $rt_val = [
                  'id' => $v->id,
                  'label' => $v->label
                ];
            }
        }
    }else{ // Return id
        $cdnt = $this->getCandidate($value);
        foreach ($data as $v) {
            if( ($cdnt->value >= $v->min) && ($cdnt->value < $v->max) ){
                $rt_val = $v->id;
            }
        }
    }
    return $rt_val;
  }

  public function getCandidate($id) {
    $cdnt = DB::table('candidates')
                ->where('candidates.id', $id) // $value : id
                ->first();
    return $cdnt;
  }
}
