<?php

namespace App\Http\Controllers;

use App\UnitType;
use Illuminate\Http\Request;

class UnitTypeController extends Controller
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
        $unit_type = UnitType::paginate(15);//Get all roles
        return view('unit_types.index')->with('unit_types', $unit_type);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unit_types.create');
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
            ]
        );

        $title = $request['title'];
        $unit_type = new UnitType();
        $unit_type->title = $title;

        $unit_type->save();

        return redirect()->route('unit_types.index')
            ->with('flash_message','UnitType '. $unit_type->title.' Ajoute!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('unit_types');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit_type = UnitType::findOrFail($id);

        return view('unit_types.edit', compact('unit_type'));
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
        $unit_type = UnitType::findOrFail($id);//Get role with the given id

        //Validate name and permissions field
        $this->validate($request, [
            'title'=>'required|max:250',
            ]
        );

        $input = $request->only(['title']); //Retreive the title and the abr fields

        $unit_type->fill($input)->save();

        return redirect()->route('unit_types.index')
            ->with('flash_message',
             'UnitType '. $unit_type->title.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit_type = UnitType::findOrFail($id);

        
        $unit_type->delete();

        return redirect()->route('unit_types.index')
            ->with('flash_message','UnitType supprimer!');

    }
}
