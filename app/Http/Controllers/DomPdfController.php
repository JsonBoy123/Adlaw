<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
class DomPdfController extends Controller
{
    public function index(){
    	$pdf = \App::make('dompdf.wrapper');
     	$pdf->loadHTML();
     	return $pdf->stream();
    }
}
