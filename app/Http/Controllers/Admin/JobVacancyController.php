<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use Carbon;
use Validator;
use App\JobVacancy;
use Yajra\Datatables\Datatables;
class JobVacancyController extends Controller
{

    public function index()
    {
      return view('admin.pages.job-vacancies.index');
    }

    public function data()
    {
      $data_master = JobVacancy::select([
        'job_vacancies.id',
        'job_vacancies.title',
        'job_vacancies.start_date',
        'job_vacancies.end_date',
        'job_vacancies.display',
        'job_vacancies.created_at',
        'job_vacancies.updated_at',
        'divisions.name as division_name'
      ])
      ->leftJoin('divisions', 'job_vacancies.division_id', '=', 'divisions.id');

      return Datatables::of($data_master)
        ->editColumn('status', function($data) {
          return display_status($data->display);
        })
        ->editColumn('periode', function($data) {
          return $data->start_date. ' - ' .$data->end_date;
        })
        ->addColumn('action', function($data) {
            return '
              <a href="' . route('job-vacancies.show', $data->id) . '" class="btn btn-info btn-block">
                <span class="fas fa-eye fa-fw"></span> View
              </a>
              <a href="' . route('job-vacancies.edit', $data->id) . '" class="btn btn-warning btn-block">
                <span class="fas fa-edit fa-fw"></span> Edit
              </a>
              <button type="button" data-toggle="modal" data-target="#delete_form' . $data->id . '" class="btn btn-danger btn-block" onclick="deleteModal(' . "'" . route('job-vacancies.destroy', $data->id) . "','" . $data->id . "','" . $data->name . "','" . Session::token() . "'" . ')">
                <span class="fas fa-trash fa-fw"></span> Delete
              </button>
              <div id="area_modal' . $data->id . '"></div>';
        })
        ->make(true);
    }

    public function create()
    {
      $list_division     = DB::table('divisions')->where('divisions.status', '=', 1)->pluck('name', 'id');
      return view('admin.pages.job-vacancies.create')->with(compact('list_division'));
    }

    public function store(Request $request)
    {
      $input = $request->all();
      $rule_message 	= array(
        'division_id.required' => 'The division field is required'
      );
      $set_start_date 		= explode(' - ',$request->input('date_range'))[0];
      $set_end_date 			= explode(' - ',$request->input('date_range'))[1];
      $start_date 		= Carbon\Carbon::parse($set_start_date)->toDateString();
			$end_date 			= Carbon\Carbon::parse($set_end_date)->toDateString();
      $input = array(
        'division_id' => $request->input('division_id'),
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'start_date' => $start_date,
        'end_date' => $end_date,
        'display' => $request->input('display'),
      );
      $validation     = Validator::make($input, JobVacancy::$rules, $rule_message);
      if ($validation->passes()) {
        $checkExist = \App\JobVacancy::where('division_id', $request->input('division_id'))
            ->where('title', '=', $request->input('title'))
            ->where('start_date', '=', $start_date)
            ->where('end_date', '=', $end_date)
            ->count();
        if ($checkExist > 0) {
          return redirect()
            ->back()
            ->withInput()
            ->with('error', $request->input('title') . ' has already been taken.');
        } else {
          $data = JobVacancy::create(
            [
              'user_id' => Auth::user()->id,
              'division_id' => $request->input('division_id'),
              'title' => $request->input('title'),
              'description' => $request->input('description'),
              'start_date' => $start_date,
              'end_date' => $end_date,
              'display' => $request->input('display')
            ]);
          if ($data) {
            return redirect()
              ->route('job-vacancies.create-detail', $data->id)
              ->with('info', $request->input('title') . ' has been created.');
          } else {
            return redirect()
              ->back()
              ->withInput()
              ->withErrors($validation->errors())
              ->with('error', $request->input('title') . ' failed to create.');    
          }
        }
        
      }else {

        return redirect()
          ->back()
          ->withInput()
          ->withErrors($validation->errors());
      }
    }

    public function show($id)
    {
      $data   = JobVacancy::findOrFail($id);
      $jobCriteria = \App\JobVacancyDetail::Select([
          'job_vacancy_details.id',
          'job_vacancy_details.job_vacancy_id',
          'job_vacancy_details.criteria_detail_id',
          'job_vacancy_details.value',
          'criteria_details.name'
        ])
        ->leftJoin('criteria_details', 'job_vacancy_details.criteria_detail_id', '=', 'criteria_details.id')
        ->where('job_vacancy_id', '=', $id)
        ->orderBy('id', 'ASC')
        ->get();
      $jobSkill = \App\JobSkillDetail::where('job_vacancy_id', '=', $id)
        ->orderBy('id', 'ASC')
        ->get();
      return view('admin.pages.job-vacancies.show')
        ->with(compact('data', 'jobCriteria', 'jobSkill'));
    }

    public function edit($id)
    {
      $data   = JobVacancy::findOrFail($id);
      $jobCriteria = \App\JobVacancyDetail::where('job_vacancy_id', '=', $id)
        ->orderBy('id', 'ASC')
        ->get();
      $jobSkill = \App\JobSkillDetail::where('job_vacancy_id', '=', $id)
        ->orderBy('id', 'ASC')
        ->get();
      $list_division     = DB::table('divisions')->where('divisions.status', '=', 1)->pluck('name', 'id');
      $start_date = Carbon\Carbon::parse($data->start_date)->format('m/d/Y h:m A');
      $end_date = Carbon\Carbon::parse($data->end_date)->format('m/d/Y h:m A');
      return view('admin.pages.job-vacancies.edit')
        ->with(compact('data', 'list_division', 'jobCriteria', 'jobSkill', 'start_date', 'end_date'));
    }

    public function update(Request $request, $id)
    {
      $input = $request->all();
      $rule_message 	= array(
        'division_id.required' => 'The division field is required'
      );
      $set_start_date 		= explode(' - ',$request->input('date_range'))[0];
      $set_end_date 			= explode(' - ',$request->input('date_range'))[1];
      $start_date 		= Carbon\Carbon::parse($set_start_date)->toDateString();
			$end_date 			= Carbon\Carbon::parse($set_end_date)->toDateString();
      $input_validate = array(
        'division_id' => $request->input('division_id'),
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'start_date' => $start_date,
        'end_date' => $end_date,
        'display' => $request->input('display'),
      );
      $validation     = Validator::make($input_validate, JobVacancy::rule_edit($id), $rule_message);
      if ($validation->passes()) {
        $checkExist = \App\JobVacancy::where('division_id', $request->input('division_id'))
            ->where('title', '=', $request->input('title'))
            ->where('start_date', '=', $start_date)
            ->where('end_date', '=', $end_date)
            ->where('id', '!=', $id)
            ->count();
        if ($checkExist > 0) {
          return redirect()
            ->back()
            ->withInput()
            ->with('error', $request->input('title') . ' has already been taken.');
        } else {
          if ($input['data']['job_criteria'] && $input['data']['job_skill']) {
            $data = JobVacancy::findOrFail($id);
            $update = JobVacancy::where('id', $data->id)
              ->update([
                'user_id' => Auth::user()->id,
                'division_id' => $request->input('division_id'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'start_date' => $start_date,
                'end_date' => $end_date,
                'display' => $request->input('display')
              ]);
            if ($update) {
              \App\JobVacancyDetail::where('job_vacancy_id', '=', $data->id)->delete();
              \App\JobSkillDetail::where('job_vacancy_id', '=', $data->id)->delete();              
              foreach ($input['data']['job_criteria'] as $key => $value) {
                \App\JobVacancyDetail::create([
                  'job_vacancy_id' => $data->id,
                  'criteria_detail_id' => $value['id'],
                  'value' => $value['value']
                ]);
              }
              foreach ($input['data']['job_skill'] as $key => $value) {
                \App\JobSkillDetail::create([
                  'job_vacancy_id' => $data->id,
                  'skill_id' => $value['id'],
                  'value' => $value['value']
                ]);
              }
              return redirect()
                ->back()
                ->with('info', $request->input('title') . ' has been updated.');
            } else {
              return redirect()
                ->back()
                ->withInput()
                ->withErrors($validation->errors())
                ->with('error', $request->input('title') . ' failed to update.');            
            }
          } else {
            return redirect()
              ->back()
              ->withInput()
              ->withErrors($validation->errors())
              ->with('error', 'Silahkan melengkapi data kriteria dan kemampuan');    
          }
        }


      }else{
        return redirect()
            ->back()
            ->withInput()
            ->withErrors($validation->errors());
      }
    }

    public function destroy($id)
    {
      $data = JobVacancy::findOrFail($id);
      if($data == null) {
        return redirect()
          ->back()
          ->with('error', 'We have no database record with that data.');
      }else if(JobVacancy::destroy($id)) {
        \App\JobVacancyDetail::where('job_vacancy_id', '=', $data->id)->delete();
        \App\JobSkillDetail::where('job_vacancy_id', '=', $data->id)->delete();
        return redirect()
          ->back()
          ->with('info', $data->name . ' has been deleted.');
      }else {
        return redirect()
          ->back()
          ->with('error', 'Couldn\'t delete user.');
      }
    }

    public function create_detail($job_vacancy_id)
    {
      $data   = JobVacancy::findOrFail($job_vacancy_id);
      $jobCriteria = \App\Criteria::orderBy('id', 'ASC')
        ->get();
      $jobSkill = \App\Skill::where('division_id', '=', $data->division_id)
        ->where('status', '=', 1)
        ->orderBy('id', 'ASC')
        ->get();
      return view('admin.pages.job-vacancies.create-detail')
        ->with(compact('data', 'jobCriteria', 'jobSkill'));
    }

    public function store_detail(Request $request, $job_vacancy_id) {
      $input = $request->all();
      if ($input['data']['job_criteria'] && $input['data']['job_skill']) {
        $checkExist = \App\JobVacancyDetail::where('job_vacancy_id', '=', $job_vacancy_id)->count();
        if ($checkExist > 0) {
          return redirect()
          ->route('job-vacancies.show', $job_vacancy_id)
          ->withInput()
          ->with('error', 'Data already exists !!');    
        } else {
          foreach ($input['data']['job_criteria'] as $key => $value) {
            \App\JobVacancyDetail::create([
              'job_vacancy_id' => $job_vacancy_id,
              'criteria_detail_id' => $value['id'],
              'value' => $value['value']
            ]);
          }
          foreach ($input['data']['job_skill'] as $key => $value) {
            \App\JobSkillDetail::create([
              'job_vacancy_id' => $job_vacancy_id,
              'skill_id' => $value['id'],
              'value' => $value['value']
            ]);
          }
          return redirect()
            ->route('job-vacancies.show', $job_vacancy_id)
            ->with('info', 'Data has been created.');
        }
      } else {
        return redirect()
          ->back()
          ->withInput()
          ->with('error', 'Please complete the data !!');    
      }
    }
}
