<?php

namespace App\Http\Controllers;

use App\Promo;
use App\Section;
use App\Group;
use Illuminate\Http\Request;

class PromoController extends Controller
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
        $promos = Promo::paginate(15);
        return view('promos.index')->with('promos', $promos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $acc_years = AccadimicYear::all();
        foreach($acc_years as $year){
            $year->name = $year->grade.$year->year.' '.$year->domain->name.' '.$year->filier->name.' '.$year->spesialite->name;
        }
        $acc_years = $acc_years->pluck('name','id');
        $univ_years = UniversityYear::all();
        foreach($univ_years as $year){
            $year->name = $year->year.'/'.($year->year+1);
        }
        $univ_years = $univ_years->pluck('name','id');
        return view('promos.create',compact('univ_years','acc_years'));
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
            'univ_year'=>'required',
            'acc_year'=>'required',
            ]
        );

        $promo = new Promo();
        $promo->accadimic_year_id = $request['acc_year'];
        $promo->university_year_id = $request['univ_year'];

        $promo->save();

        return redirect()->route('promos.index')
            ->with('flash_message','Promo '.$promo->accadimic_year->year.$promo->accadimic_year->grade.' '.$promo->accadimic_year->domain->code.' '.$promo->accadimic_year->filier->code.' '.$promo->accadimic_year->spesialite->code.' '.$promo->university_year->year.'/'.($promo->university_year->year+1).' Ajoute!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promo = Promo::findOrFail($id);
        return view('promos.show')->with('promo', $promo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acc_years = AccadimicYear::all();
        foreach($acc_years as $year){
            $year->name = $year->grade.$year->year.' '.$year->domain->name.' '.$year->filier->name.' '.$year->spesialite->name;
        }
        $acc_years = $acc_years->pluck('name','id');
        $univ_years = UniversityYear::all();
        foreach($univ_years as $year){
            $year->name = $year->year.'/'.($year->year+1);
        }
        $univ_years = $univ_years->pluck('name','id');
        $promo = Promo::findOrFail($id);

        return view('promos.edit', compact('promo','univ_years','acc_years'));
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
        $promo = Promo::findOrFail($id);//Get role with the given id

        //Validate name and permissions field
        $this->validate($request, [
            'accadimic_year_id'=>'required',
            'university_year_id'=>'required',
            ]
        );

        $input = $request->only(['accadimic_year_id','university_year_id']); //Retreive the title and the abr fields

        $promo->fill($input)->save();

        return redirect()->route('promos.index')
            ->with('flash_message',
             'Promo '. $promo->title.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);

        
        $promo->delete();

        return redirect()->route('promos.index')
            ->with('flash_message','Promo supprimer!');

    }

    public function addsection(Request $request, $id)
    {
        $code = 
        ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $promo = Promo::findOrFail($id);//Get role with the given id

        //Validate name and permissions field
        $this->validate($request, [
            'sections'=>'required',
            'groups'=>'required',
            ]
        );
        for ($i=0; $i < $request['sections']; $i++) { 
            $section = new Section();
            $section->code = $code[$i];
            $promo->sections()->save($section);

            for ($j=0; $j < $request['groups']; $j++) { 
                $group = new Group();
                $group->code = $j;
                $section->groups()->save($group);
            }
        }
        /***
        *
        */
        return redirect('promos')->with('flash_message','Section et groups Ajoutées');
    }
}
