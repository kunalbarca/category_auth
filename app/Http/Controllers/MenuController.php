<?php

namespace App\Http\Controllers;

use App\MapCategories;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = MapCategories::menus();
        //dd($menus);
        return view('frontend.index', ['menus' => $menus]);
    }
}
