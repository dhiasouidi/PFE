<?php

namespace App\Http\Controllers;

use App\DemandeDeStage;
use App\Etudiant;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PDFController extends Controller
{
    public function printdemande($id)
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
    public function printlettre($id)
    {
        $demande = DemandeDeStage::find($id);
        $etudiant = Etudiant::where('CIN_PASSEPORT',$demande->ETUDIANT_DEMANDE)->first();
        $data=[
            'etudiant'=>$etudiant,
        ];
        $pdf = PDF::loadView('lettre',compact('data'));
        return $pdf->stream('doc.pdf');
    }
    public function printconvention($id)
    {
        $demande = DemandeDeStage::find($id);
        $etudiant = Etudiant::where('CIN_PASSEPORT',$demande->ETUDIANT_DEMANDE)->first();
        $data=[
            'etudiant'=>$etudiant,
            'demande' =>$demande,

        ];
        $pdf = PDF::loadView('convention',compact('data'));
        return $pdf->stream('doc.pdf');
    }
    public function printjournal($id)
    {
        $demande = DemandeDeStage::find($id);
        $etudiant = Etudiant::where('CIN_PASSEPORT',$demande->ETUDIANT_DEMANDE)->first();
        $data=[
            'etudiant'=>$etudiant,
            'demande' =>$demande,

        ];
        $pdf = PDF::loadView('journal',compact('data'));
        return $pdf->stream('doc.pdf');
    }
}
