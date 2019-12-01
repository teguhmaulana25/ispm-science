<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator;
use App\User;
use Yajra\Datatables\Datatables;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.pages.users.index');
    }

    public function data()
    {
      $users = User::select([
        'users.id',
        'users.name',
        'users.username',
        'users.email',
        'users.status',
        'users.updated_by',
        'users.updated_at'
      ])
      ->where('users.id', '!=', Auth::user()->id);

      return Datatables::of($users)
        ->editColumn('updated_by', function($data) {
          return $data->updated_by . '<br>' . $data->updated_at;
        })
        ->editColumn('status', function($users) {
          return AI_status($users->status);
        })
        ->addColumn('action', function($data) {
            return '
              <a href="' . route('users.edit', $data->id) . '" class="btn btn-warning btn-block">
                <span class="fas fa-edit fa-fw"></span> Edit
              </a>
              <button type="button" data-toggle="modal" data-target="#delete_form' . $data->id . '" class="btn btn-danger btn-block" onclick="deleteModal(' . "'" . route('users.destroy', $data->id) . "','" . $data->id . "','" . $data->name . "','" . Session::token() . "'" . ')">
                <span class="fas fa-trash fa-fw"></span> Delete
              </button>
              <div id="area_modal' . $data->id . '"></div>';
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $input = $request->all();
      $validation = Validator::make($input, User::$rules);
      if ($validation->passes()) {
        $data = User::create(
          [
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'status' => $request->input('status'),
            'created_by' => Auth::user()->email,
            'updated_by' => Auth::user()->email
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data   = User::findOrFail($id);
      return view('admin.pages.users.edit')
        ->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $input = $request->all();
      $validation = Validator::make($request->all(), User::rule_edit($id));
      if ($validation->passes()) {
          $data = User::findOrFail($id);
          $update = User::where('id', $data->id)
            ->update([
              'name' => $request->input('name'),
              'username' => $request->input('username'),
              'email' => $request->input('email'),
              'status' => $request->input('status'),
              'updated_by' => Auth::user()->email
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = User::findOrFail($id);
      if($data == null) {
        return redirect()
          ->back()
          ->with('error', 'We have no database record with that data.');
      }else if(User::destroy($id)) {
        return redirect()
          ->back()
          ->with('info', $data->username . ' has been deleted.');
      }else {
        return redirect()
          ->back()
          ->with('error', 'Couldn\'t delete user.');
      }
    }
}
