<?php

namespace App\Http\Controllers;

use App\Student;
use App\Promo;
use App\User;
use Illuminate\Http\Request;

class StudentController extends Controller
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
        $students = Student::paginate(15);//Get all roles
        return view('students.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promos = Promo::all();
        foreach($promos as $promo){
            $promo->title = $promo->accadimic_year->grade.$promo->accadimic_year->year.' '.$promo->accadimic_year->domain->name.' '.$promo->accadimic_year->filier->name.' '.$promo->accadimic_year->spesialite->name.' ('.$promo->university_year->year.'/'.($promo->university_year->year+1).')';
        }
        $promos = $promos->pluck('title','id');
        $users = User::whereNotIn('id', Student::get()->pluck('user_id'))->get();
        return view('students.create',compact('promos','users'));
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
            'promo_id'=>'required',
            'users'=>'required',
            ]
        );

        $user_ids = $request['users'];
        $promo_id = $request['promo_id'];
        foreach($user_ids as $user_id){
            $student = new Student();
            $student->user_id = $user_id;
            $student->promo_id = $promo_id;
            $student->save();    
        }
        $promo = Promo::findOrFail($promo_id);
        return redirect()->route('students.index')
            ->with('flash_message','Etudiants de promo '.$promo->accadimic_year->grade.$promo->accadimic_year->year.' '.$promo->accadimic_year->domain->name.' '.$promo->accadimic_year->filier->name.' '.$promo->accadimic_year->spesialite->name.' ('.$promo->university_year->year.'/'.($promo->university_year->year+1).')'.
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
        return redirect('students');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $promos = Promo::all();
        foreach($promos as $promo){
            $promo->title = $promo->accadimic_year->grade.$promo->accadimic_year->year.' '.$promo->accadimic_year->domain->name.' '.$promo->accadimic_year->filier->name.' '.$promo->accadimic_year->spesialite->name.' ('.$promo->university_year->year.'/'.($promo->university_year->year+1).')';
        }
        $promos = $promos->pluck('title','id');

        return view('students.edit', compact('student','promos'));
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
        $student = Student::findOrFail($id);//Get role with the given id

        //Validate name and permissions field
        $this->validate($request, [
            'promo_id'=>'required',
            ]
        );

        $input = $request->only(['promo_id']); //Retreive the title and the abr fields

        $student->fill($input)->save();

        return redirect()->route('students.index')
            ->with('flash_message','Student '.
                $student->user->name.$student->user->last_name.
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
        $student = Student::findOrFail($id);

        
        $student->delete();

        return redirect()->route('students.index')
            ->with('flash_message','Student supprimer!');

    }
}
