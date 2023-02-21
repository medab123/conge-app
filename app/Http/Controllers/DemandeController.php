<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use \Auth;
use Carbon\Carbon;

class DemandeController extends Controller
{
    public function index()
    {
        
        $demandes = Demande::where('demandeur_id', Auth::user()->id)->get();
        return view("demandes.index", compact("demandes"));
    }
    public function create(){
        return view("demandes.create");
    }
    public function store(Request $request){

        $demande = new Demande();
        $demande->demandeur_id = Auth::user()->id;
        $demande->status = 0;
        $demande->duration = $this->calc_duration($request->input("date_debut"),$request->input("date_fin"),$request->input("date_debut_type"),$request->input("date_fin_type"));
        $demande->date_debut = $request->input("date_debut");
        $demande->date_debut_type = $request->input("date_debut_type");
        $demande->date_fin = $request->input("date_fin");
        $demande->date_fin_type = $request->input("date_fin_type");
        $demande->raison = $request->input("raison");
        $demande->save();
        return redirect()->back();
    }
    public function calc_duration($dt_start,$dt_fin,$start_type,$fin_type){
        $dureation = Carbon::parse($dt_fin)->diffInDays($dt_start);
        $dureation += 1;
        if($fin_type == "Morning" || $start_type == "Afternoon") $dureation -= 0.5;
        return $dureation;
    }

}