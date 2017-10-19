<?php

namespace App\Http\Controllers;

use App\Enseignant;
use App\Grade;
use App\User;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enseignants = Enseignant::paginate(15);//Get all roles
        return view('enseignants.index')->with('enseignants', $enseignants);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::all()->pluck('title','id');
        $users = User::all();
        return view('enseignants.create',compact('grades','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate name and permissions field
        $this->validate($request, [
            'user_id'=>'required',
            'grade_id'=>'required',
            'recruited_at'=>'required',
            ]
        );

        $user = $request['user_id'][0];
        $grade = $request['grade_id'];
        $recruited_at = $request['recruited_at'];
        $enseignant = new Enseignant();
        $enseignant->user_id = $user;
        $enseignant->grade_id = $grade;
        $enseignant->recruited_at = $recruited_at;

        $enseignant->save();

        return redirect()->route('enseignants.index')
            ->with('flash_message','Enseignant '.
                $enseignant->grade->title.' '.
                $enseignant->user->name.$enseignant->user->last_name.
                ' Ajoute!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('enseignants');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $enseignant = Enseignant::findOrFail($id);
        $grades = Grade::all()->pluck('title','id');

        return view('enseignants.edit', compact('enseignant','grades'));
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
        $enseignant = Enseignant::findOrFail($id);//Get role with the given id

        //Validate name and permissions field
        $this->validate($request, [
            'grade_id'=>'required',
            'recruited_at'=>'required',
            ]
        );

        $input = $request->only(['grade_id', 'recruited_at']); //Retreive the title and the abr fields

        $enseignant->fill($input)->save();

        return redirect()->route('enseignants.index')
            ->with('flash_message','Enseignant '.
                $enseignant->grade->title.' '.
                $enseignant->user->name.$enseignant->user->last_name.
                ' Ajoute!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enseignant = Enseignant::findOrFail($id);

        
        $enseignant->delete();

        return redirect()->route('enseignants.index')
            ->with('flash_message','Enseignant supprimer!');

    }
}
