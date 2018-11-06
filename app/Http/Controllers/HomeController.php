<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;   

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    public function loginpage()
    {

        return view('auth.login');
    }

    public function createuser()
    {

        if(!Gate::allows('isAdmin')){
            abort(404,"Not Allowed!");

        }
        return view('auth.register');

    }
}
