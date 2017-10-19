<?php

namespace App\Http\Controllers;

use App\Unit;
use App\UnitType;
use Illuminate\Http\Request;

class UnitController extends Controller
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
        $units = Unit::paginate(15);//Get all roles
        return view('units.index')->with('units', $units);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = UnitType::all()->pluck('title','id') ;

        return view('units.create',compact('types'));
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
            'code'=>'required|max:250',
            'type'=>'required',
            ]
        );

        $type = $request['type'];
        $unit_type = UnitType::findOrFail($type);

        $code = $request['code'];
        
        $unit = new Unit();
        $unit->code = $code;

        $unit_type->units()->save($unit);

        return redirect()->route('units.index')
            ->with('flash_message','Unit '. $unit->code.' Ajoute!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('units');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = UnitType::all()->pluck('title','id') ;
        $unit = Unit::findOrFail($id);

        return view('units.edit', compact('unit','types'));
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
        $unit = Unit::findOrFail($id);//Get role with the given id

        //Validate name and permissions field
        $this->validate($request, [
            'code'=>'required|max:250',
            'unit_type_id'=>'required',
            ]
        );

        $input = $request->only(['code', 'unit_type_id']); //Retreive the title and the abr fields

        $unit->fill($input)->save();

        return redirect()->route('units.index')
            ->with('flash_message',
             'Unit '. $unit->code.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);

        
        $unit->delete();

        return redirect()->route('units.index')
            ->with('flash_message','Unit supprimer!');

    }
}
