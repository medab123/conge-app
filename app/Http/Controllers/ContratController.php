<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use Illuminate\Http\Request;


class ContratController extends Controller
{
    /*public function show($id){
		$contrat = Contrat::find($id);
		return response()->json(["data"=>$contrat]);
	}*/
	public function index(){
		$contrats = Contrat::all();
		return view("contrats.index",compact("contrats"));
	}
    public function create(){
		//$contrat = Contrat::find($id);
		return view("contrats.create");
	}
    public function edit($id){
		$contrat = Contrat::find($id);
		return view("contrats.create",compact("contrat"));
	}
	public function store(Request $request){
		$contrat = new Contrat();
		$contrat->name = $request->input("name");
        $contrat->nb_jours = $request->input("nb_jours");
		$contrat->save();
		return back()->with('success', 'Contrat created successfully');
	}
	public function update(Request $request,$id){
		$contrat = Contrat::find($id);
		$contrat->name = $request->input("name");
        $contrat->nb_jours = $request->input("nb_jours");
		$contrat->save();
		return back()->with('success', 'Contrat updated successfully');
	}
	public function destroy($id){
		$contrat = Contrat::find($id);
		$contrat->delete();
		return back()->with('success', 'Contrat deleted successfully');
	}

}
