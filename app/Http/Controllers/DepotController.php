<?php

namespace App\Http\Controllers;

use App\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
class DepotController extends Controller
{
    public function DownloadRapport($etudiant)
    {
        $etudiant_rapport = Etudiant::find($etudiant);
        //Test d'existance de l'etudiant
        if(is_null($etudiant_rapport))
        {
            return response()->json(["message" => 'Etudiant not found'],404);
        }

        $nom = preg_replace('/\s+/', '', $etudiant_rapport->NOM);
        $prenom = preg_replace('/\s+/', '', $etudiant_rapport->PRENOM);

        $path = public_path('/rapports/'.$nom.'_'.$prenom.'.pdf');

        //Test de dépot de rapport
        $isExists = file_exists($path);

        if(!$isExists && $etudiant_rapport->DEPOSE)
        {
            return response()->json(["message" => 'Record not found'],404);
        }

        return response()->download(public_path('/rapports/'.$nom.'_'.$prenom.'.pdf'),'RAPPORT_'.$nom.'_'.$prenom.'.pdf');
    }

    public function UploadRapport(Request $request)
    {
        $authenticated_user = Auth::user();
        $user = User::find($authenticated_user->login);
        $etudiant = Etudiant::find($user->login);

        if($etudiant == null)
        {
            return response()->json(["message" => 'Etudiant not found'],404);
        }

        $nom = preg_replace('/\s+/', '', $etudiant->NOM);
        $prenom = preg_replace('/\s+/', '', $etudiant->PRENOM);
        $filename = $nom.'_'.$prenom.'.pdf';
        $path = $request->file('rapport')->move(public_path("/rapports/"),$filename);


        return response()->json(['message' => 'Rapport déposé'],200);
    }
}
