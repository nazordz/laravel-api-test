<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'first_name'  => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
            'birth_date' => 'required',
            'gender' => 'required',
            'password'   => 'required',
        ]);
        $user = $request->all();
        $user['password'] = bcrypt($user['password']);
        return User::create($user);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ['status' => 'success'];
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
        $request->validate([
            'first_name'  => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email',
            'birth_date' => 'required',
            'gender' => 'required',
        ]);
        $user = User::find($id);
        $user->first_name  = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->email      = $request->email;
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::destroy($request->id);
        return ['status' => 'success'];
    }
}
