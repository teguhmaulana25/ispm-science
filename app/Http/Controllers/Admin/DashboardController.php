<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $count_candidate  = DB::table('candidates')->count();
        $count_job_vacancy = DB::table('job_vacancies')->where('display', '=', 1)->count();
        $count_division = DB::table('divisions')->count();
        return view('admin.pages.dashboard.index')->with(compact('count_candidate', 'count_job_vacancy', 'count_division'));
    }
}
