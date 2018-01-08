<?php

namespace App\Http\Controllers;

use App\Section;
use App\Group;
use App\Promo;
use Illuminate\Http\Request;

class SectionController extends Controller
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
        $sections = Section::paginate(15);//Get all roles
        return view('sections.index')->with('sections', $sections);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promos = Promo::all();
        foreach ($promos as $promo) {
            $promo->name = $promo->accadimic_year->year.$promo->accadimic_year->grade.' '.$promo->accadimic_year->domain->code.' '.$promo->accadimic_year->filier->code.' '.$promo->accadimic_year->spesialite->code.' '.$promo->university_year->year.'/'.($promo->university_year->year+1).' '.count($promo->students).' etudients'.' . '.count($promo->sections).' sections';
        }
        $promos = $promos->pluck('name','id');
        return view('sections.create',compact('promos'));
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
            'promo'=>'required',
            'sections'=>'required',
            'groups'=>'required',
            ]
        );

        $code = ['A','B','C','D','E','F','G','H',
                'I','J','K','L','M','N','O','P',
                'Q','R','S','T','U','V','W','X',
                'Y','Z'];

        $promo = Promo::findOrFail($request['promo']);//Get role with the given id

        $nbSections = count($promo->sections); //find the number of section if ther is any
        /**
        * start adding section from the number of 
        * section for the code name of the section 
        * to be alphabetecly correct
        */
        for ($i=$nbSections; $i < ($nbSections + $request['sections']); $i++) { 
            $section = new Section();
            $section->code = $code[$i];
            $promo->sections()->save($section);

            for ($j=1; $j < $request['groups']+1; $j++) { 
                $group = new Group();
                $group->code = $j;
                $section->groups()->save($group);
            }
        }

        return redirect()->route('sections.index')
            ->with('flash_message','Sections et groups Ajoute!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Section::findOrFail($id);
        return view('sections.show')->with('section', $section);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section = Section::findOrFail($id);
        $domains = Domain::all()->pluck('name','id');
        return view('sections.edit', compact('section','domains'));
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
        $section = Section::findOrFail($id);//Get role with the given id

        $this->validate($request, [
                'name'=>'required|max:250',
                'domain'=>'required',
                'code'=>'required',
            ]
        );

        $input = $request->only(['name', 'domain' ,'code']); //Retreive the name and the abr fields

        $section->fill($input)->save();

        return redirect()->route('sections.index')
            ->with('flash_message',
             'section '. $section->name.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
        return redirect()->route('sections.index')
            ->with('flash_message','section supprimer!');

    }

    public function getSpesialite(){
        $id = Input::get( 'section' );

        try {
            $section = Section::findOrFail($id);
            if($section->common){
                
                $spesialite = Spesialite::all()->first();
                $section->spesialite->prepend($spesialite);
            }
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The Domain with ID: ' . $id . ' was not found.');
            return;
        }

        $spesialites = $section->spesialite;
        return view('sections.partials.spesialites', compact('spesialites'));
    }
}
