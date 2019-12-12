<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Carbon;
use Validator;
use App\Candidate;
class HiringExternalController extends Controller
{
    public function index()
    {
      $list_division     = DB::table('divisions')->where('divisions.status', '=', 1)->pluck('name', 'id');
      return view('admin.pages.hiring-external.index')->with(compact('list_division'));
    }

    public function filter(Request $request)
    {
      if ($request->input('division_id')) {
        // $getCandidate = Candidate::select([
          
        // ])->where(function ($query) use ($subject_id) {
        //   $query->whereHas('subjectGrades', function($query) use ($subject_id) {
        //     $query->where('grade_id', '=', $subject_id);
        //     $query->where('status_active', '=', 2);
        //   });
        // })
        // ->get();
      } else {
        return redirect()
          ->back()
          ->withInput()
          ->withErrors($validation->errors())
          ->with('error', 'Please select division');
      }
    }
}
