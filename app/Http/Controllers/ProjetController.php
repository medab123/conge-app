<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    
    public function index(){
		$projets = Projet::with("manager")->get();
		return view("hr.projets.index",compact("projets"));
	}
    public function create(){
        $managers = User::whereHas('roles', function ($query) {
            $query->where('name', '!=', "employer");
        })->pluck('name', 'id')->all();
		//$projet = Projet::find($id);
		return view("hr.projets.create",compact("managers"));
	}
    public function edit($id){
        $managers = User::whereHas('roles', function ($query) {
            $query->where('name', '!=', "employer");
        })->pluck('name', 'id')->all();
		$projet = Projet::find($id);
		return view("hr.projets.create",compact("projet","managers"));
	}
	public function store(Request $request){
		$projet = new Projet();
		$projet->name = $request->input("name");
        $projet->manager_id = $request->input("manager_id");
		$projet->save();
		return redirect()->route("hr.projets.index")->with('success', 'Projet created successfully');
	}
	public function update(Request $request,$id){
		$projet = Projet::find($id);
		$projet->name = $request->input("name");
        $projet->manager_id = $request->input("manager_id");
		$projet->save();
		return redirect()->route("hr.projets.index")->with('success', 'Projet updated successfully');
	}
	public function destroy($id){
		$projet = Projet::find($id);
		$projet->delete();
		return back()->with('success', 'Projet deleted successfully');
	}

}
