<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Division;
use App\JobVacancy;
use DB;

class PagesController extends Controller
{
    public function index() {
    	$data_job = Division::select([
                'id','name'
            ])
    		->where('status', 1)
            ->orderBy('id', 'DESC')->get();
        $job_arr = [];
           foreach ($data_job as $r) {
           	$job_arr[] = (object) [
           				'name' => $r->name,
           				'available' => $this->getAvailableDiv($r->id)
        			];
           }

        return view('customer.pages.index')
            ->with(compact('job_arr'));
    }

    private function getAvailableDiv($get_id) {
    	return $count_available = JobVacancy::where('division_id', $get_id)->count();
    }
}
