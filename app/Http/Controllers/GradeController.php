<?php

namespace App\Http\Controllers;

use App\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
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
        $grade = Grade::paginate(15);//Get all roles
        return view('grades.index')->with('grades', $grade);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grades.create');
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
            'priority'=>'required|max:10',
            ]
        );

        $title = $request['title'];
        $priority = $request['priority'];
        $grade = new Grade();
        $grade->title = $title;
        $grade->priority = $priority;

        $grade->save();

        return redirect()->route('grades.index')
            ->with('flash_message','Grade '. $grade->title.' Ajoute!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('grades');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grade = Grade::findOrFail($id);

        return view('grades.edit', compact('grade'));
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
        $grade = Grade::findOrFail($id);//Get role with the given id

        //Validate name and permissions field
        $this->validate($request, [
            'title'=>'required|max:250',
            'priority'=>'required|max:10',
            ]
        );

        $input = $request->only(['title', 'priority']); //Retreive the title and the abr fields

        $grade->fill($input)->save();

        return redirect()->route('grades.index')
            ->with('flash_message',
             'Grade '. $grade->title.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);

        
        $grade->delete();

        return redirect()->route('grades.index')
            ->with('flash_message','Grade supprimer!');

    }
}
