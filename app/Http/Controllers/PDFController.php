<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PDFController extends Controller
{
    public function print()
    {
        $pdf = PDF::loadView('pdf');
        return $pdf->stream('doc.pdf');
    }
}
