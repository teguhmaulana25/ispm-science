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
class OnboardingController extends Controller
{
    public function index()
    {
      $list_division     = DB::table('divisions')->where('divisions.status', '=', 1)->pluck('name', 'id');
      return view('admin.pages.onboardings.index')->with(compact('list_division'));
    }

    public function filter(Request $request)
    {
      if ($request->input('division_id')) {
          return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Please select data');
      } else {
        return redirect()
          ->back()
          ->withInput()
          ->with('error', 'Please select data');
      }
    }
}
