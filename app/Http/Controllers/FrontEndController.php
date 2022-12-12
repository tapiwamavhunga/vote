<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
use Auth;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Message;

class FrontEndController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        return view('welcome');
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect('/home');
        } else {
            return view('register');
        }
    }

    public function list()
    {
        return view('list');
    }

    public function single()
    {
        return view('single');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function contact()
    {
        return view('contact');
    }

    public function test()
    {

    }

    public function logoutcheck()
    {
        $message = 'Please file this form';
        return redirect('/home')->with('jsAlert', $message);
    }
}
