<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use \Auth;
class DemandeController extends Controller
{
    public function index(){
        $demandes = Demande::where('demandeur_id',Auth::user()->id)->get();
        return view("demandes.index",compact("demandes"));
    }
    
}
