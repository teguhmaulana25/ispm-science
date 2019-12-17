<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;
use App\Division;
use App\JobVacancy;
use App\JobVacancyDetail;
use App\CriteriaDetail;
use App\JobSkillDetail;
use App\Candidate;
use App\CandidateDetail;
use App\CandidateSkill;
use Carbon\Carbon;
use DB;

use App\Mail\ActionEmail;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function index() {
      $data_job = Division::select(['id','name'])
                    ->where('status', 1)
                    ->orderBy('id', 'DESC')->get();

      $job_arr = [];
         foreach ($data_job as $r) {
          $job_arr[] = (object) [
                'id' => $r->id,
                'name' => $r->name,
                'available' => $this->getAvailableDiv($r->id, 'count')
            ];
         }
      return view('customer.pages.index')
          ->with(compact('job_arr'));
    }

    public function list($id) {
      // Get Division
      $data = Division::select(
                  [
                    'divisions.id',
                    'divisions.name'
                  ]
                )
                ->where('divisions.id', $id)
                ->first();
      if(empty($data)) {
         return abort(404);
      }
      // Get All Vacancies
      $vacancies = $this->getAvailableDiv($id, 'row');

      return view('customer.pages.list')
          ->with(compact('data','vacancies'));
    }

    public function detail($id_div, $id_vacancies) {
      // Check
      if($this->getAvailableDivCond($id_vacancies, $id_div) == 0) {
         return abort(404);
      }
      $data = $this->getAvailableDiv($id_div, 'first', $id_vacancies);

      $dataCrypt = (object) [
                    'id_division' => $id_div,
                    'id_vacancy' => $id_vacancies,
                    'title' => $data['title']
                  ];
      $secret_key_job = Crypt::encrypt($dataCrypt);
      
      return view('customer.pages.detail')
          ->with(compact('data','id_div','secret_key_job'));
    }
    public function apply($key) {
      try {
          $decrypted = decrypt($key);
      } catch (DecryptException $e) {
          return abort(404);
      }
      $data = Crypt::decrypt($key);
      // Check
      if($this->getAvailableDivCond($data->id_vacancy, $data->id_division) == 0) {
         return abort(404);
      }
      $get_vacancy = JobVacancyDetail::select(
                        [
                          'job_vacancy_details.job_vacancy_id',
                          'job_vacancy_details.criteria_detail_id',
                          'criterias.step'
                        ]
                      )
                      ->join('criteria_details', 'job_vacancy_details.criteria_detail_id' , '=', 'criteria_details.id')
                      ->join('criterias', 'criteria_details.criteria_id' , '=', 'criterias.id')
                      ->where('criterias.status', 1)
                      ->where('criterias.step', '1')
                      ->where('job_vacancy_details.job_vacancy_id', $data->id_vacancy)
                      ->get();

      $arr_criteria = [];
      foreach ($get_vacancy as $key => $r) {
        $arr_criteria[$key] = [
                            'criteria_id' => $this->getCriterias($r->criteria_detail_id)->id,
                            'criteria_status' => $r->step,
                            'criteria_name' => $this->getCriterias($r->criteria_detail_id)->name,
                            'criteria_data' => $this->getCriteriaDetails($this->getCriterias($r->criteria_detail_id)->id)
                            //$this->getCriteriaDetails($this->getCriterias($r->criteria_detail_id)->id, $r->job_vacancy_id)
                          ];
      }
      // Remove duplicate
      if(!empty($arr_criteria)){
        $arr_x = $this->super_unique($arr_criteria,'criteria_id');
        $arr_criteria = $arr_x;
      }

      $arr_skill =  [
                      'skills' => $this->getSkill($data->id_vacancy, $data->id_division)
                    ];

      return view('customer.pages.apply')
          ->with(compact('data','arr_criteria','arr_skill'));
    }

    private function super_unique($array,$key)
    {
       $temp_array = [];
       foreach ($array as &$v) {
           if (!isset($temp_array[$v[$key]]))
           $temp_array[$v[$key]] =& $v;
       }
       $array = array_values($temp_array);
       return $array;

    }

    private function getAvailableDiv($get_id, $type, $get_id_vc = null) {
      $get_vacancy = JobVacancy::select(
                        [
                          'job_vacancies.id',
                          'job_vacancies.title',
                          'job_vacancies.description',
                          'job_vacancies.start_date',
                          'job_vacancies.end_date'
                        ]
                      )
                      ->where('job_vacancies.division_id', $get_id)
                      ->where('job_vacancies.display', 1)
                      ->where('job_vacancies.start_date', '<=', Carbon::now())
                      ->where('job_vacancies.end_date', '>=', Carbon::now());

      if($type == 'first') {
        $get_vacancy = $get_vacancy->where('job_vacancies.id', $get_id_vc)->first();
        if(!empty($get_vacancy)) {
          $data_arr = [
                        'id' => $get_vacancy->id,
                        'title' => $get_vacancy->title,
                        'description' => $get_vacancy->description,
                        'start_date' => $get_vacancy->start_date,
                        'end_date' => $get_vacancy->end_date
                      ];
        }
      }else{
        $get_vacancy = $get_vacancy->get();
        $data_count = count($get_vacancy);

        $data_arr = [];
        if($data_count > 0) {
          foreach ($get_vacancy as $key => $v) {
              $data_arr[$key] = [
                              'id' => $v->id,
                              'title' => $v->title,
                              'end_date' => $v->end_date
                            ];
              if($this->getAvailableDivCond($v->id, $get_id) == 0) {
                unset($data_arr[$key]);
              }
          }
        }
      }
      
      if($type == 'count'){
        return count($data_arr);
      }else if($type == 'row'){
        return $data_arr;
      }else if($type == 'first'){
        return $data_arr;
      }
      
    }
    private function getAvailableDivCond($id_vacation, $id_div) {
      $get_vacancy_count = DB::table('job_vacancies')
                            ->where('job_vacancies.division_id', $id_div)
                            ->where('job_vacancies.id', $id_vacation)

                            ->join('job_vacancy_details', 'job_vacancies.id' , '=', 'job_vacancy_details.job_vacancy_id')
                            ->where('job_vacancies.display', 1)
                            ->where('job_vacancies.start_date', '<=', Carbon::now())
                            ->where('job_vacancies.end_date', '>=', Carbon::now())
                            ->count();
      return $get_vacancy_count;
    }
    private function getCriterias($id_criteria_detail) {
      $getCriteria_ = JobVacancyDetail::select(
                  [
                    'criterias.id',
                    'criterias.name'
                  ]
                )
                ->join('criteria_details', 'job_vacancy_details.criteria_detail_id' , '=', 'criteria_details.id')
                ->join('criterias', 'criteria_details.criteria_id' , '=', 'criterias.id')
                ->where('criterias.status', 1)
                ->where('criterias.step', 1)
                ->where('criteria_details.id', $id_criteria_detail)
                ->first();

      return $getCriteria_;
    }
    private function getCriteriaDetails($id_criteria) {
      $getCriteriaDetail_ = CriteriaDetail::select(
                  [
                    'criteria_details.id',
                    'criteria_details.name',
                    'criteria_details.value'
                  ]
                )
                ->join('criterias', 'criteria_details.criteria_id' , '=', 'criterias.id')
                ->where('criterias.step', 1)
                ->where('criterias.id', $id_criteria)
                ->where('criteria_details.criteria_id', $id_criteria)
                ->get();
      $arr_data = [];
      foreach ($getCriteriaDetail_ as $v) {
        $arr_data[] = [
                        'id' => $v->id,
                        'name' => $v->name,
                        'value' => $v->value,
                      ];
      }
      return $arr_data;
    }
    private function getSkill($id_vacation, $id_div) {
      $getSkill_ = JobSkillDetail::select(
                  [
                    'skills.id',
                    'skills.name',
                    'job_skill_details.value'
                  ]
                )
                ->join('skills', 'job_skill_details.skill_id' , '=', 'skills.id')
                ->where('skills.division_id', $id_div)
                ->where('job_skill_details.job_vacancy_id', $id_vacation)
                ->get();
      $arr_data = [];
      foreach ($getSkill_ as $v) {
        $arr_data[] = [
                        'id' => $v->id,
                        'name' => $v->name,
                        'value' => $v->value,
                      ];
      }
      return $arr_data;
    }

    public function store(Request $request)
    {
      $input = $request->all();
      $checkAvaiable = Candidate::where('candidates.job_vacancy_id', $request->input('job_vacancy_id'))
                          ->where('candidates.email', $request->input('email'))
                          ->count();
      if($checkAvaiable > 0) {
         return redirect()->route('apply_vacancy_error');
      }
      $data = Candidate::create(
        [
          'job_vacancy_id' => $request->input('job_vacancy_id'),
          'name' => $request->input('name'),
          'birth_place' => $request->input('birth_place'),
          'birth_date' => $request->input('birth_date'),
          'email' => $request->input('email'),
          'phone' => $request->input('phone'),
          'address' => $request->input('address')
      ]);
      if ($data) {
          // Send Email
          $varEMail = [
                        'type' => 'apply_finish',
                        'name' => $request->input('name'),
                        'vacancy_name' => $request->input('vacancy_name')
                      ];
          // Mail::to($request->input('email'))->send(new ActionEmail($varEMail));
          for ($idx = 1; $idx <= $request->input('count_criteria'); $idx++) {
              CandidateDetail::create([
                'candidate_id' => $data->id,
                'criteria_detail_id' => explode("_", $request->input('question_criteria_'.$idx)[0])[0],
                'answer' => explode("_", $request->input('question_criteria_'.$idx)[0])[1]
              ]);
          }
          if(!empty($request->input('question_skills'))){
            foreach ($request->input('question_skills') as $arrSkill) {
              CandidateSkill::create([
                  'candidate_id' => $data->id,
                  'skill_id' => explode("_", $arrSkill)[0],
                  'answer' => explode("_", $arrSkill)[1]
                ]);
            }
          }
          return redirect()->route('apply_vacancy_finish');
      }else{
          return redirect()
              ->back()
              ->withInput();
      }
    }

    public function finish() {
      return view('customer.pages.finish');
    }
    public function error_vacancy() {
      return view('customer.pages.error');
    }
}
