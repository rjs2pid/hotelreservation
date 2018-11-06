<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class PromoController extends Controller
{
    public function showPromos()
    {
        $promos = DB::select("SELECT * FROM promo");
        return view('admin.promoTable')->with('promos',$promos);

    }

    public function ManagePromo($id)
    {
        $promos = DB::select("SELECT * FROM promo where promo_code = '".$id."' ");
        return view('admin.promoTable')->with('promos',$promos);

    }
    public function DeletePromo($id)
    {
        $promos = DB::select("DELETE FROM promo where promo_code = '".$id."' ");
        return view('admin.promoTable')->with('promos',$promos);

    }
}
