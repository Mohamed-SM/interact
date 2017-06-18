<?php

namespace App\Http\Controllers;

use App\Faculte;
use Illuminate\Http\Request;

class FacultesController extends Controller
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
        $facultes = Faculte::paginate(15);//Get all roles
        return view('facultes.index')->with('facultes', $facultes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('facultes.create');
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
            ]
        );

        $title = $request['title'];
        $abreviation = $request['abreviation'];
        $faculte = new Faculte();
        $faculte->title = $title;
        $faculte->abreviation = $abreviation;

        $faculte->save();

        return redirect()->route('facultes.index')
            ->with('flash_message','Faculte '. $faculte->title.' Ajoute!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('facultes');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculte = Faculte::findOrFail($id);

        return view('facultes.edit', compact('faculte'));
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
        $faculte = Faculte::findOrFail($id);//Get role with the given id

        //Validate name and permissions field
        $this->validate($request, [
            'title'=>'required|max:250',
            'abreviation'=>'required|max:10',
            ]
        );

        $input = $request->only(['title', 'abreviation']); //Retreive the title and the abr fields

        $faculte->fill($input)->save();

        return redirect()->route('facultes.index')
            ->with('flash_message',
             'Faculte '. $faculte->title.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faculte = Faculte::findOrFail($id);

        
        $faculte->delete();

        return redirect()->route('facultes.index')
            ->with('flash_message','Faculte supprimer!');

    }
}
