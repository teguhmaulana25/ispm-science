<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profile() {
        $data = User::findOrFail(Auth::user()->id);
    
        return view('admin.pages.auth.profile')
            ->with(compact('data'));
    }

    public function profile_update(Request $request) {
        $input  = $request->all();
        $id     = Auth::user()->id;
        $validation = Validator::make($request->all(), User::rule_edit_auth($id) );
        if ($validation->passes())
        {
          $data   = User::findOrFail($id);
          User::where('id', $data->id)
            ->update([
              'name'    => $request->input('name'),
              'email'    => $request->input('email'),
              'updated_by'    => $data->email
            ]);
          return redirect()
            ->route('auth.profile')
            ->with('info', 'Data has been saved.');
    
        }else{
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validation);
        }
    }

    public function change_password() {
        return view('admin.pages.auth.change-password');
    }
    
    public function change_password_update(Request $request) {
        $rules = array(
          'current_password'      => 'required',
          'password'              => 'required|min:6|confirmed|different:current_password',
          'password_confirmation' => 'required|required_with:password'
        );
        $validation = Validator::make($request->all(), $rules);                
        if ($validation->passes()) {  
            if(Hash::check($request->input('current_password'), Auth::user()->password)) {

            $data   = User::findOrFail(Auth::user()->id);
            User::where('id', Auth::user()->id)
                ->update([
                    'password'      => bcrypt($request->input('password')),
                    'updated_by'    => Auth::user()->email
                ]);
                return redirect()
                    ->route('auth.profile')
                    ->with('info', 'Data has been saved.');
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Current password not match.');
            }
    
        } else { 
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validation);
        }
      }
}
