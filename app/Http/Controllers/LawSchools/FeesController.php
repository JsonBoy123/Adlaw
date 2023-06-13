<?php

namespace App\Http\Controllers\LawSchools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeesController extends Controller
{
    public function index(){
    	return view('fees.index');
    }
}
