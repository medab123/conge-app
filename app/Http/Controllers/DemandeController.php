<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\User;
use Illuminate\Http\Request;
use \Auth;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;


class DemandeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:demande-list|demande-create|demande-edit|demande-delete', ['only' => ['index']]);
        $this->middleware('permission:demande-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:demande-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:demande-delete', ['only' => ['destroy']]);
        $this->middleware('permission:demande-rejete', ['only' => ['rejete','hrListDemande']]);
        $this->middleware('permission:demande-validat', ['only' => ['validat','hrListDemande']]);
    }
    public function index()
    {
        $demandes = Demande::where('demandeur_id', Auth::user()->id)->get();
        return view("demandes.index", compact("demandes"));
    }
    public function hrListDemande()
    {
        $demandes = Demande::join("users","users.id","demandes.demandeur_id")->select("demandes.*","users.name")->where('manager_id', Auth::user()->id)->get();
        return view("hr.demandes.index", compact("demandes"));
    }
    public function validat($id)
    {
        $demande = Demande::find($id);
        $demande->status = 2;
        $demande->save();
        return back();
    }
    public function rejete($id)
    {
        $demande = Demande::find($id);
        $demande->status = 3;
        $demande->save();
    }
    public function create()
    {
        return view("demandes.create");
    }
    public function store(Request $request)
    {

        $demande = new Demande();
        $demande->demandeur_id = Auth::user()->id;
        $demande->status = 0;
        $demande->duration = $this->calc_duration($request->input("date_debut"), $request->input("date_fin"), $request->input("date_debut_type"), $request->input("date_fin_type"));
        $demande->date_debut = $request->input("date_debut");
        $demande->date_debut_type = $request->input("date_debut_type");
        $demande->date_fin = $request->input("date_fin");
        $demande->date_fin_type = $request->input("date_fin_type");
        $demande->raison = $request->input("raison");
        $demande->save();
        return redirect()->back();
    }
    public function calc_duration($dt_start, $dt_fin, $start_type, $fin_type)
    {
        $dureation = Carbon::parse($dt_fin)->diffInDays($dt_start);
        $dureation += 1;
        if ($fin_type == "Morning" || $start_type == "Afternoon")
            $dureation -= 0.5;
        return $dureation;
    }
    public function destroy($id)
    {
        Demande::find($id)->delete();
        return back()->with('success', 'demande deleted successfully');
    }

}