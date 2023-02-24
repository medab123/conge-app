<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(){
		$positions = Position::all();
		return view("hr.positions.index",compact("positions"));
	}
    public function create(){
		//$position = Position::find($id);
		return view("hr.positions.create");
	}
    public function edit($id){
		$position = Position::find($id);
		return view("hr.positions.create",compact("position"));
	}
	public function store(Request $request){
		$position = new Position();
		$position->name = $request->input("name");
		$position->save();
		return redirect()->route("hr.positions.index")->with('success', 'Position created successfully');
	}
	public function update(Request $request,$id){
		$position = Position::find($id);
		$position->name = $request->input("name");
		$position->save();
		return redirect()->route("hr.positions.index")->with('success', 'Position updated successfully');
	}
	public function destroy($id){
		$position = Position::find($id);
		$position->delete();
		return back()->with('success', 'Position deleted successfully');
	}
}
