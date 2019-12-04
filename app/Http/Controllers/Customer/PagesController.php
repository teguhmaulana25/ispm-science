<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Division;
use App\JobVacancy;
use App\JobVacancyDetail;
use Carbon\Carbon;
use DB;

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
                    'divisions.name'
                  ]
                )
                ->where('divisions.id', $id)
                ->first();
      // Get All Vacancies
      $vacancies = $this->getAvailableDiv($id, 'row');

      return view('customer.pages.list')
          ->with(compact('data','vacancies'));
    }

    private function getAvailableDiv($get_id, $type) {
      $get_vacancy = JobVacancy::select(
                        [
                          'job_vacancies.id',
                          'job_vacancies.title',
                          'job_vacancies.end_date'
                        ]
                      )
                      ->where('job_vacancies.division_id', $get_id)
                      ->where('job_vacancies.display', 1)
                      ->where('job_vacancies.start_date', '<=', Carbon::now())
                      ->where('job_vacancies.end_date', '>=', Carbon::now())
                      ->get();

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
      if($type == 'count'){
        return count($data_arr);
      }else if($type == 'row'){
        return $data_arr;
      }
    	
    }

    private function getAvailableDivCond($id_vacation, $id_div) {
      $get_vacancy_count = DB::table('job_vacancies')
                            ->where('job_vacancies.division_id', $id_div)
                            ->where('job_vacancies.id', $id_vacation)

                            ->join('job_vacancy_details', 'job_vacancies.id' , '=', 'job_vacancy_details.job_vacancy_id')
                            ->where('job_vacancies.display', 1)
                            ->where('job_vacancy_details.status', 1)
                            ->where('job_vacancies.start_date', '<=', Carbon::now())
                            ->where('job_vacancies.end_date', '>=', Carbon::now())
                            ->count();
      return $get_vacancy_count;
    }
}
