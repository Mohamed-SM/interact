<?php

namespace App\Http\Controllers;

use App\Semester;
use App\AccadimicYear;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $semesters = Semester::paginate(15);
        return view('semesters.index',compact('semesters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years = AccadimicYear::all();
        foreach($years as $year){
            $year->name = $year->grade.$year->year.' '.$year->domain->name.' '.$year->filier->name.' ('.$year->study_year.'/'.($year->study_year+1).')';
        }
        $years = $years->pluck('name','id');
        return view('semesters.create',compact('years'));
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
                'number'=>'required',
                'year'=>'required',
            ]
        );

        $semester = new Semester();
        $semester->number = $request['number'];

        $year = AccadimicYear::findOrFail($request['year']);
        $semester->code = 'S'.$semester->number.$year->grade.$year->year.$year->study_year;
        $year->semesters()->save($semester);


        return redirect()->route('semesters.index')
            ->with('flash_message','Semester '. $semester->number.' '.$year->grade.$year->year.' '.$year->domain->name.' '.$year->filier->name.' ('.$year->study_year.'/'.($year->study_year+1).') Ajoute!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function show(Semester $semester)
    {
        return redirect('semesters');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        $years = AccadimicYear::all();
        foreach($years as $year){
            $year->name = $year->grade.$year->year.' '.$year->domain->name.' '.$year->filier->name.' ('.$year->study_year.'/'.($year->study_year+1).')';
        }
        $years = $years->pluck('name','id');
        return view('semesters.edit', compact('semester','years'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semester $semester)
    {
        //Validate name and permissions field
        $this->validate($request, [
                'number'=>'required',
                'year'=>'required',
            ]
        );

        $semester->number = $request['number'];

        $year = AccadimicYear::findOrFail($request['year']);
        $semester->code = 'S'.$semester->number.$year->grade.$year->year.$year->study_year;
        $year->semesters()->save($semester);


        return redirect()->route('semesters.index')
            ->with('flash_message','Semester '. $semester->number.' '.$year->grade.$year->year.' '.$year->domain->name.' '.$year->filier->name.' ('.$year->study_year.'/'.($year->study_year+1).') updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semester $semester)
    {
        $semester->delete();
        return redirect()->route('semesters.index')
            ->with('flash_message','semester supprimer!');
    }
}
