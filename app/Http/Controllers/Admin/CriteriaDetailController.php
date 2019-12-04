<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Validator;
use App\CriteriaDetail;
use Yajra\Datatables\Datatables;
class CriteriaDetailController extends Controller
{

    public function data($criteria_id)
    {
      $users = CriteriaDetail::select([
        'criteria_details.id',
        'criteria_details.criteria_id',
        'criteria_details.name',
        'criteria_details.value',
        'criteria_details.created_at',
        'criteria_details.updated_at'
      ])
      ->where('criteria_details.criteria_id', '=', $criteria_id);

      return Datatables::of($users)
        ->addColumn('action', function($data) {
            return '
              <a href="' . route('criteria-details.edit', [$data->criteria_id, $data->id]) . '" class="btn btn-warning btn-block">
                <span class="fas fa-edit fa-fw"></span> Edit
              </a>
              <button type="button" data-toggle="modal" data-target="#delete_form' . $data->id . '" class="btn btn-danger btn-block" onclick="deleteModal(' . "'" . route('criteria-details.destroy', $data->id) . "','" . $data->id . "','" . $data->name . "','" . Session::token() . "'" . ')">
                <span class="fas fa-trash fa-fw"></span> Delete
              </button>
              <div id="area_modal' . $data->id . '"></div>';
        })
        ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $criteria_id)
    {
      $input = $request->all();
      $validation = Validator::make($input, CriteriaDetail::$rules);
      if ($validation->passes()) {
        $checkDevision = \App\Criteria::where('id', $criteria_id)->count();
        if ($checkDevision) {
          $checkExist = \App\CriteriaDetail::where('criteria_id', $criteria_id)
            ->where('name', '=', $request->input('name'))
            ->count();
          if ($checkExist > 0) {
            return redirect()
              ->back()
              ->withInput()
              ->with('error', $request->input('name') . ' has already been taken.');
          } else {
            $data = CriteriaDetail::create(
              [
                'criteria_id' => $criteria_id,
                'name' => $request->input('name'),
                'value' => $request->input('value')
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data   = \App\Criteria::findOrFail($id);
      return view('admin.pages.criteria-details.show')
        ->with(compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($criteria_id, $id)
    {
      $data   = CriteriaDetail::findOrFail($id);
      return view('admin.pages.criteria-details.edit')
        ->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $criteria_id, $id)
    {
      $input = $request->all();
      $validation = Validator::make($request->all(), CriteriaDetail::rule_edit($id));
      if ($validation->passes()) {
        $checkExist = \App\CriteriaDetail::where('criteria_id', $criteria_id)
            ->where('name', '=', $request->input('name'))
            ->where('id', '!=', $id)
            ->count();
        if ($checkExist > 0) {
          return redirect()
            ->back()
            ->withInput()
            ->with('error', $request->input('name') . ' has already been taken.');
        } else {
          $data = CriteriaDetail::findOrFail($id);
          $update = CriteriaDetail::where('id', $data->id)
            ->update([
              'name' => $request->input('name'),
              'value' => $request->input('value')
            ]);
          if ($update) {
            return redirect()
              ->route('criteria-details.show', $criteria_id)
              ->with('info', $request->input('title') . ' has been updated.');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = CriteriaDetail::findOrFail($id);
      if($data == null) {
        return redirect()
          ->back()
          ->with('error', 'We have no database record with that data.');
      }else if(CriteriaDetail::destroy($id)) {
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
