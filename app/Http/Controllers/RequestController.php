<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\BookingModel;
use App\RequestModel;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\HomeController;

class RequestController extends Controller
{
    public function additionals(Request $request)
    {
        $refnumber = $request->input('refnumber');

        $request = new RequestModel();

      


    }
}
