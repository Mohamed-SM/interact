<?php

namespace App\Http\Controllers;

use App\Departement;
use App\Faculte;
use Illuminate\Http\Request;

class DepartementsController extends Controller
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
        $departements = Departement::paginate(15);//Get all roles
        return view('departements.index')->with('departements', $departements);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facultes = Faculte::all()->pluck('title','id') ;

        return view('departements.create',compact('facultes'));
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
            'title'=>'required|max:250',
            'abreviation'=>'required|unique:facultes|max:10',
            'faculte_id'=>'required',
            ]
        );

        $faculte_id = $request['faculte_id'];
        $faculte = Faculte::findOrFail($faculte_id);

        $title = $request['title'];
        $abreviation = $request['abreviation'];
        
        $departement = new Departement();
        $departement->title = $title;
        $departement->abreviation = $abreviation;

        $faculte->departements()->save($departement);

        return redirect()->route('departements.index')
            ->with('flash_message','Departement '. $faculte->title.' Ajoute!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('departements');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facultes = Faculte::all()->pluck('title','id') ;
        $departement = Departement::findOrFail($id);

        return view('departements.edit', compact('departement','facultes'));
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
        $departement = Departement::findOrFail($id);//Get role with the given id

        //Validate name and permissions field
        $this->validate($request, [
            'title'=>'required|max:250',
            'abreviation'=>'required|max:10',
            'faculte_id'=>'required',
            ]
        );

        $input = $request->only(['title', 'abreviation','faculte_id']); //Retreive the title and the abr fields

        $departement->fill($input)->save();

        return redirect()->route('departements.index')
            ->with('flash_message',
             'Departement '. $departement->title.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departement = Departement::findOrFail($id);

        
        $departement->delete();

        return redirect()->route('departements.index')
            ->with('flash_message','Departement supprimer!');

    }
}
