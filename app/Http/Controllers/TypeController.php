<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
	function __construct()
    {
        $this->middleware('permission:type-list|type-create|type-edit|type-delete|type-activate|type-deactivate', ['only' => ['index']]);
        $this->middleware('permission:type-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:type-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:type-delete', ['only' => ['destroy']]);
        $this->middleware('permission:type-activate', ['only' => ['activate']]);
        $this->middleware('permission:type-deactivate', ['only' => ['deactivate']]);
    }
    public function index(){
		$types = Type::all();
		return view("hr.types.index",compact("types"));
	}
    public function create(){
		//$type = Type::find($id);
		return view("hr.types.create");
	}
    public function edit($id){
		$type = Type::find($id);
		return view("hr.types.create",compact("type"));
	}
	public function store(Request $request){
		$type = new Type();
		$type->name = $request->input("name");
		$type->save();
		return redirect()->route("hr.types.index")->with('success', 'Type créé avec succès');
	}
	public function update(Request $request,$id){
		$type = Type::find($id);
		$type->name = $request->input("name");
		$type->save();
		return redirect()->route("hr.types.index")->with('success', 'Type modifié  avec succès');
	}
	public function destroy($id){
		$type = Type::find($id);
		$type->delete();
		return back()->with('success', 'Type deleted avec success');
	}
	public function activate($id){
		$type = Type::find($id);
		$type->active = true;
		$type->save();
		//return back()->with('success', 'Type activer avec succès');
		return response()->json(['success'=>'Type activer avec succès']);
	}
	public function deactivate($id){
		$type = Type::find($id);
		$type->active = false;
		$type->save();
		return response()->json(['success'=>'Type desactiver avec succès']);
	}
	
}
