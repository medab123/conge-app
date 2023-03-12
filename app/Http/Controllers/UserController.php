<?php

namespace App\Http\Controllers;

//use App\Models\Contrat;
use App\Models\Position;
use App\Models\Projet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       /* $managers = User::whereHas('roles', function ($query) {
            $query->where('name', '!=', "employer");
        })->pluck('name', 'id')->all();*/
        $roles = Role::pluck('name', 'name')->all();
        $positions = Position::pluck("name", "id")->all();
        //$contrats = Contrat::pluck("name", "id")->all();
        $projets = Projet::pluck("name","id")->all();
        return view('users.create', compact('roles', /*"managers",*/ "positions", /*"contrats",*/"projets"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'roles' => 'required',
            'name' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'cin' => 'required|string|max:255',
            'date_birth' => 'required|date',
            'cnss' => 'required|string|max:255',
            'contrat_date' => 'required|date',
            //'contrat_id' => 'required|exists:contrats,id',
            'position_id' => 'required|exists:positions,id',
            'projet_id' => 'required|exists:projets,id',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            //'manager_id' => 'nullable|exists:users,id'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->back()->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projets = Projet::all();
        /*$managers = User::whereHas('roles', function ($query) {
            $query->where('name', '!=', "employer");
        })->pluck('name', 'id')->all();*/
        $positions = Position::pluck("name", "id")->all();
       //$contrats = Contrat::pluck("name", "id")->all();
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole', /*"managers",*/"positions", /*"contrats",*/"projets"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'roles' => 'required',
            'name' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'cin' => 'required|string|max:255',
            'date_birth' => 'required|date',
            'cnss' => 'required|string|max:255',
            'contrat_date' => 'required|date',
            //'contrat_id' => 'required|exists:contrats,id',
            'position_id' => 'required|exists:positions,id',
            'projet_id' => 'required|exists:projets,id',
            'email' => 'required|email|unique:users,email,' . $id,
            //'manager_id' => 'nullable|exists:users,id'
        ]);
       
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }



    public function getEmployes()
    {
        $employes = User::with("projet")->/*with("contrat")->*/get();
        return view("hr.employes.index", compact("employes"));
    }
    
}