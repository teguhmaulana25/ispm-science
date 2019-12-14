<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Carbon;
use Validator;
use App\Candidate;
use App\Criteria;
use App\Skill;
class HiringController extends Controller
{
    public function index()
    {
      $list_division     = DB::table('divisions')->where('divisions.status', '=', 1)->pluck('name', 'id');
      return view('admin.pages.hiring.index')->with(compact('list_division'));
    }

    public function filter(Request $request)
    {
      if ($request->input('date_range')) {
        $set_start_date 		= explode(' - ',$request->input('date_range'))[0];
        $set_end_date 			= explode(' - ',$request->input('date_range'))[1];
        $start_date 		= Carbon\Carbon::parse($set_start_date)->toDateString();
        $end_date 			= Carbon\Carbon::parse($set_end_date)->toDateString();
        if ($start_date && $end_date) {
          return redirect()
            ->route('hiring.list', ['start_date' => $start_date, 'end_date' => $end_date]);
        } else {
          return redirect()
            ->back()
            ->withInput()
            ->withErrors($validation->errors())
            ->with('error', 'Please select data');
        }
      } else {
        return redirect()
          ->back()
          ->withInput()
          ->withErrors($validation->errors())
          ->with('error', 'Please select data');
      }
    }

    public function list($start_date, $end_date) {
      if ($start_date && $end_date) {
          $getCandidate = Candidate::select([
              'candidates.id',
              'name',
              'birth_place',
              'birth_date',
              'email',
              'phone',
              'interview_date',
              'job_vacancies.title as title_job',
              'job_vacancies.division_id'
            ])
            ->leftJoin('job_vacancies', 'candidates.job_vacancy_id', '=', 'job_vacancies.id')
            ->where('interview_date', '<=', $end_date)
            ->where('interview_date', '>=', $start_date)
            ->get();
          return view('admin.pages.hiring.list')->with(compact('getCandidate'));
      } else {
        return redirect()
        ->route('hiring.index')
        ->with('error', 'Please select data');        
      }
    }

    public function candidate($candidate_id) {
      if ($candidate_id) {
        $checkCandidate = Candidate::where('id', $candidate_id)->count();
        if ($checkCandidate > 0) {
            $data = Candidate::select([
                'candidates.id',
                'job_vacancy_id',
                'name',
                'birth_place',
                'birth_date',
                'email',
                'phone',
                'interview_date',
                'candidates.created_at',
                'job_vacancies.title as title_job',
                'job_vacancies.division_id'
              ])
              ->leftJoin('job_vacancies', 'candidates.job_vacancy_id', '=', 'job_vacancies.id')
              ->where('candidates.id', '=', $candidate_id)
              ->first();
            
            $jobVacancy = DB::table('job_vacancy_details')
              ->where('job_vacancy_id', '=', $data->job_vacancy_id)
              ->get();
            $criteria = [];
            foreach ($jobVacancy as $key => $value) {
              $criteria_detail_id = $value->criteria_detail_id;
              $checkCriteria = Criteria::select([
                  'criterias.id'
                ])
                ->where('criterias.step', '=', 2)
                ->where(function ($query) use ($criteria_detail_id) {
                  $query->whereHas('criteriaDetail', function($query) use ($criteria_detail_id) {
                    $query->where('criteria_details.id', '=', $criteria_detail_id);
                  });
                })
                ->count();
              if ($checkCriteria > 0) {
                $criteria[] = Criteria::select([
                    'criterias.id',
                    'criterias.name',
                    'criterias.percentage',
                    'criterias.type',
                    'criterias.step'
                  ])
                  ->where('criterias.step', '=', 2)
                  ->where(function ($query) use ($criteria_detail_id) {
                    $query->whereHas('criteriaDetail', function($query) use ($criteria_detail_id) {
                      $query->where('criteria_details.id', '=', $criteria_detail_id);
                    });
                  })
                  ->first();
              }
            }

            $jobSkill = DB::table('job_skill_details')
              ->select(['job_vacancies.division_id', 'job_skill_details.id', 'job_skill_details.skill_id'])
              ->leftJoin('job_vacancies', 'job_skill_details.job_vacancy_id', '=', 'job_vacancies.id')
              ->where('job_vacancy_id', '=', $data->job_vacancy_id)
              ->get();

            $skill = [];
            foreach ($jobSkill as $key => $value) {
              $division_id = $value->division_id;
              $checkSkill = Skill::select([
                  'id',
                  'name'
                ])
                ->where('skills.id', '=', $value->skill_id)
                ->count();
              if ($checkSkill > 0) {
                $skill[] = Skill::select([
                    'id',
                    'name'
                  ])
                  ->where('skills.id', '=', $value->skill_id)
                  ->first();
              }
            }

          return view('admin.pages.hiring.candidate')->with(compact('data', 'criteria', 'skill'));
        } else {
          return redirect()
            ->back()
            ->with('error', 'Data candidate not found');
        }
      } else {
        return redirect()
          ->back()
          ->with('error', 'Data candidate not found');
      }
    }
}
