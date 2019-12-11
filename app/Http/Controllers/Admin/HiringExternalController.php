<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class HiringExternalController extends Controller
{
    public function index()
    {
      $list_division     = DB::table('divisions')->where('divisions.status', '=', 1)->pluck('name', 'id');
      return view('admin.pages.hiring-external.index')->with(compact('list_division'));
    }

    public function filter(Request $request)
    {
    }
}
