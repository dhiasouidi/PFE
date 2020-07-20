<?php

namespace App\Http\Controllers;

use App\DemandeDeStage;
use App\Etudiant;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PDFController extends Controller
{
    public function print($id)
    {
        $demande = DemandeDeStage::find($id);
        $etudiant = Etudiant::where('CIN_PASSEPORT',$demande->ETUDIANT_DEMANDE)->first();
        $data=[
            'etudiant'=>$etudiant,
            'demande' =>$demande,

        ];
        $pdf = PDF::loadView('demande',compact('data'));
        return $pdf->stream('doc.pdf');
    }
}
