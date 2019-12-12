<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Validator;
use App\Criteria;
use Yajra\Datatables\Datatables;
class CriteriaController extends Controller
{
    public function index()
    {
      return view('admin.pages.criterias.index');
    }

    public function data()
    {
      $data_master = Criteria::select([
        'criterias.id',
        'criterias.name',
        'criterias.percentage',
        'criterias.type',
        'criterias.step',
        'criterias.status',
        'criterias.created_at',
        'criterias.updated_at'
      ]);

      return Datatables::of($data_master)
        ->editColumn('status', function($data) {
          return AI_status($data->status);
        })
        ->addColumn('action', function($data) {
            return '
              <a href="' . route('criterias.show', $data->id) . '" class="btn btn-info btn-block">
                <span class="fas fa-eye fa-fw"></span> View
              </a>
              <a href="' . route('criterias.edit', $data->id) . '" class="btn btn-warning btn-block">
                <span class="fas fa-edit fa-fw"></span> Edit
              </a>
              <button type="button" data-toggle="modal" data-target="#delete_form' . $data->id . '" class="btn btn-danger btn-block" onclick="deleteModal(' . "'" . route('criterias.destroy', $data->id) . "','" . $data->id . "','" . $data->name . "','" . Session::token() . "'" . ')">
                <span class="fas fa-trash fa-fw"></span> Delete
              </button>
              <div id="area_modal' . $data->id . '"></div>';
        })
        ->make(true);
    }

    public function create()
    {
      return view('admin.pages.criterias.create');
    }

    public function store(Request $request)
    {
      $input = $request->all();
      $validation = Validator::make($input, Criteria::$rules);
      if ($validation->passes()) {
        $data = Criteria::create(
          [
            'name' => $request->input('name'),
            'percentage' => $request->input('percentage'),
            'type' => $request->input('type'),
            'step' => $request->input('step'),
            'status' => $request->input('status')
          ]);
        if ($data) {
          return redirect()
            ->route('criteria-details.show', $data->id)
            ->with('info', $request->input('name') . ' has been created.');
        } else {
          return redirect()
            ->back()
            ->withInput()
            ->withErrors($validation->errors())
            ->with('error', $request->input('name') . ' failed to create.');    
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
      $data   = Criteria::findOrFail($id);
      $criteriaDetail = \App\CriteriaDetail::where('criteria_id', '=', $id)
        ->orderBy('id', 'DESC')
        ->get();
      return view('admin.pages.criterias.show')
        ->with(compact('data', 'criteriaDetail'));
    }

    public function edit($id)
    {
      $data   = Criteria::findOrFail($id);
      return view('admin.pages.criterias.edit')
        ->with(compact('data'));
    }

    public function update(Request $request, $id)
    {
      $input = $request->all();
      $validation = Validator::make($request->all(), Criteria::rule_edit($id));
      if ($validation->passes()) {
          $data = Criteria::findOrFail($id);
          $update = Criteria::where('id', $data->id)
            ->update([
              'name' => $request->input('name'),
              'percentage' => $request->input('percentage'),
              'type' => $request->input('type'),
              'step' => $request->input('step'),
              'status' => $request->input('status')
            ]);
          if ($update) {
            return redirect()
            ->back()
            ->with('info', $request->input('name') . ' has been updated.');
          } else {
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validation->errors())
            ->with('error', $request->input('name') . ' failed to update.');            
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
      $data = Criteria::findOrFail($id);
      if($data == null) {
        return redirect()
          ->back()
          ->with('error', 'We have no database record with that data.');
      }else if(Criteria::destroy($id)) {
        \App\CriteriaDetail::where('division_id', '=', $data->id)->delete();
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
