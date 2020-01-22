<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Validator;
use App\Skill;
use Yajra\Datatables\Datatables;
use DB;
class SkillController extends Controller
{

    public function index()
    {
      return view('admin.pages.skills.index');
    }

    public function data($division_id)
    {
      $data_master = Skill::select([
        'skills.id',
        'skills.division_id',
        'skills.name',
        'skills.status',
        'skills.created_at',
        'skills.updated_at',
      ])
      ->where('skills.division_id', '=', $division_id);

      return Datatables::of($data_master)
        ->editColumn('status', function($data) {
          return AI_status($data->status);
        })
        ->addColumn('action', function($data) {
            return '
              <a href="' . route('skills.edit', [$data->division_id, $data->id]) . '" class="btn btn-warning btn-block">
                <span class="fas fa-edit fa-fw"></span> Edit
              </a>
              <button type="button" data-toggle="modal" data-target="#delete_form' . $data->id . '" class="btn btn-danger btn-block" onclick="deleteModal(' . "'" . route('skills.destroy', $data->id) . "','" . $data->id . "','" . $data->name . "','" . Session::token() . "'" . ')">
                <span class="fas fa-trash fa-fw"></span> Delete
              </button>
              <div id="area_modal' . $data->id . '"></div>';
        })
        ->make(true);
    }

    public function create()
    {
      $list_division     = DB::table('divisions')->where('divisions.status', '=', 1)->pluck('name', 'id');
      return view('admin.pages.skills.create')->with(compact('list_division'));
    }

    public function store(Request $request, $division_id)
    {
      $input = $request->all();
      $validation = Validator::make($input, Skill::$rules);
      if ($validation->passes()) {
        $checkDevision = \App\Division::where('id', $division_id)->count();
        if ($checkDevision) {
          $checkExist = \App\Skill::where('division_id', $division_id)
            ->where('name', '=', $request->input('name'))
            ->count();
          if ($checkExist > 0) {
            return redirect()
              ->back()
              ->withInput()
              ->with('error', $request->input('name') . ' has already been taken.');
          } else {
            $data = Skill::create(
              [
                'division_id' => $division_id,
                'name' => $request->input('name'),
                'status' => $request->input('status')
              ]);
            if ($data) {
              return redirect()
                ->back()
                ->with('info', $request->input('name') . ' has been created.');
            } else {
              return redirect()
                ->back()
                ->withInput()
                ->withErrors($validation->errors())
                ->with('error', $request->input('name') . ' failed to create.');    
            }
          }
        } else {
          return redirect()
            ->back()
            ->withInput()
            ->with('error', 'We have no database record with that data.');
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
      $data   = \App\Division::findOrFail($id);
      return view('admin.pages.skills.show')
        ->with(compact('data'));
    }

    public function edit($division_id, $id)
    {
      $data   = Skill::findOrFail($id);
      return view('admin.pages.skills.edit')
        ->with(compact('data'));
    }

    public function update(Request $request, $division_id, $id)
    {
      $input = $request->all();
      $validation = Validator::make($request->all(), Skill::rule_edit($id));
      if ($validation->passes()) {
        $checkExist = \App\Skill::where('division_id', $division_id)
            ->where('name', '=', $request->input('name'))
            ->where('id', '!=', $id)
            ->count();
        if ($checkExist > 0) {
          return redirect()
            ->back()
            ->withInput()
            ->with('error', $request->input('name') . ' has already been taken.');
        } else {
          $data = Skill::findOrFail($id);
          $update = Skill::where('id', $data->id)
            ->update([
              'name' => $request->input('name'),
              'status' => $request->input('status')
            ]);
          if ($update) {
            return redirect()
              ->route('skills.show', $division_id)
              ->with('info', $request->input('name') . ' has been updated.');
          } else {
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validation->errors())
            ->with('error', $request->input('name') . ' failed to update.');            
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
      $data = Skill::findOrFail($id);
      if($data == null) {
        return redirect()
          ->back()
          ->with('error', 'We have no database record with that data.');
      }else if(Skill::destroy($id)) {
        return redirect()
          ->back()
          ->with('info', $data->name . ' has been deleted.');
      }else {
        return redirect()
          ->back()
          ->with('error', 'Couldn\'t delete user.');
      }
    }
}
