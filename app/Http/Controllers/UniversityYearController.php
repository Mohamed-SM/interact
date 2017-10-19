<?php

namespace App\Http\Controllers;

use App\UniversityYear;
use Illuminate\Http\Request;

class UniversityYearController extends Controller
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
        $university_year = UniversityYear::paginate(15);//Get all roles
        return view('university_years.index')->with('university_years', $university_year);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('university_years.create');
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
            'year'=>'required',
            ]
        );

        $year = $request['year'];
        $university_year = new UniversityYear();
        $university_year->year = $year;

        $university_year->save();

        return redirect()->route('university_years.index')
            ->with('flash_message','UniversityYear '.
                $university_year->year.'/'.
                ($university_year->year+1).
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
        return redirect('university_years');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $university_year = UniversityYear::findOrFail($id);

        return view('university_years.edit', compact('university_year'));
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
        $university_year = UniversityYear::findOrFail($id);//Get role with the given id

        //Validate name and permissions field
        $this->validate($request, [
            'year'=>'required|max:250',
            ]
        );

        $input = $request->only(['year']); //Retreive the year and the abr fields

        $university_year->fill($input)->save();

        return redirect()->route('university_years.index')
            ->with('flash_message',
             'UniversityYear '.
                $university_year->year.'/'.
                ($university_year->year+1).
                ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $university_year = UniversityYear::findOrFail($id);

        
        $university_year->delete();

        return redirect()->route('university_years.index')
            ->with('flash_message','UniversityYear supprimer!');

    }
}
