<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
   
    public function index(){
        
        return view('templates.index');
    }
    public function gallery(){
        return view('templates.gallery');

    }
    public function tarrif(){
        $data = 'data';
        return view('templates.rooms-tariff');
        //passing values to views
        //return view('templates.rooms-tariff')->with('vName',$data);

    }
    public function contact(){
        return view('templates.contact');

    }
    public function roomResult(){
        return view('templates.result');

    }
    public function addReservation_admin(){
        return view('admin.addReservation_admin');

    }
}
