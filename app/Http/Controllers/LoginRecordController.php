<?php

namespace App\Http\Controllers;

use App\LoginRecord;
use Illuminate\Http\Request;

class LoginRecordController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LoginRecord::with('user')->get();
    }

    public function loginrecord($id)
    { 
        $users = LoginRecord::latest()
        ->where("user_id", "like", $id)
        ->paginate(10);

        return view('login-report') 
        ->with('users', $users)
        ->with('myid', $id);

    }

    public function logindatesearch($id)
    {  
        $users = LoginRecord::latest()
        ->where("user_id", "like", $id)
        ->whereBetween('login_at', array(request("loadfrom"), request("loadto")))
        ->paginate(10);

        return view('login-report') 
        ->with('users', $users)
        ->with('myid', $id);
        // dd($id);
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
     * @param  \App\LoginRecord  $loginRecord
     * @return \Illuminate\Http\Response
     */
    public function show(LoginRecord $loginRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LoginRecord  $loginRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(LoginRecord $loginRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoginRecord  $loginRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoginRecord $loginRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LoginRecord  $loginRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoginRecord $loginRecord)
    {
        //
    }
}
