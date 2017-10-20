<?php

namespace App\Http\Controllers;

use App\Canva;
use App\Unit;
use App\Semester;
use Illuminate\Http\Request;

class CanvaController extends Controller
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
        $canvas = Canva::paginate(15);//Get all roles
        return view('canvas.index')->with('canvas', $canvas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $semesters = Semester::all()->pluck('code','id') ;

        return view('canvas.create',compact('semesters'));
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
            'semester_id'=>'required',
            'started_at'=>'required',
            ]
        );

        $semester = Semester::findOrFail($request['semester_id']);
        
        $canva = new Canva();
        $canva->started_at = $request['started_at'];
        
        $semester->canvas()->save($canva);

        return redirect()->route('canvas.index')
            ->with('flash_message','Canva '. $canva->semester->id.' Ajoute!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $canva = Canva::findOrFail($id);

        return view('canvas.show', compact('canva'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $semesters = Semester::all()->pluck('code','id') ;
        $canva = Canva::findOrFail($id);

        return view('canvas.edit', compact('canva','semesters'));
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
        $canva = Canva::findOrFail($id);//Get role with the given id

        //Validate name and permissions field
        $this->validate($request, [
            'semester_id'=>'required',
            'started_at'=>'required',
            ]
        );

        $input = $request->only(['semester_id','started_at',]); //Retreive the code and the abr fields
        
        $canva->fill($input)->save();

        return redirect()->route('canvas.index')
            ->with('flash_message',
             'Canva '. $canva->code.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $canva = Canva::findOrFail($id);

        
        $canva->delete();

        return redirect()->route('canvas.index')
            ->with('flash_message','Canva supprimer!');

    }
}
