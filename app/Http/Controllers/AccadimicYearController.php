<?php

namespace App\Http\Controllers;

use App\AccadimicYear;
use App\Departement;
use App\Domain;
use App\Filier;
use App\Spesialite;
use Illuminate\Http\Request;

class AccadimicYearController extends Controller
{
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
        $acc_years = AccadimicYear::paginate(15);
        return view('year_acc.index',compact('acc_years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $domains = Domain::all()->pluck('name','id');
        $departements = Departement::all()->pluck('title','id');
        return view('year_acc.create',compact('domains','departements'));
    }

    public function Filiers(){
        $id = Input::get( 'domain' );
        $domain = null;
        try {
            $domain = Domain::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The Domain with ID: ' . $id . ' was not found.');
            return;
        }

        $filiers = $domain->filier;
        return view('year_acc.partials.filiers', compact('filiers'));
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
                'year' => 'required|int',
                'grade' => 'required',
                'domain_id' => 'required',
                'filier_id' => 'required',
                'spesialite_id' => 'required',
                'departement_id' => 'required',
                'study_year' => 'required',
            ]
        );

        $acc_year = new AccadimicYear();

        $input = $request->only(['year', 'grade' , 'domain_id' , 'filier_id' , 'spesialite_id' , 'departement_id' , 'study_year']);

        $acc_year->fill($input)->save();

        return redirect()->route('annee_acc.index')
            ->with('flash_message','Année '. $acc_year->year.$acc_year->domaine().$acc_year->grade.' Ajoute!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spesialite  $spesialite
     * @return \Illuminate\Http\Response
     */
    public function show(Spesialite $spesialite)
    {
        return redirect('spesialites');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spesialite  $spesialite
     * @return \Illuminate\Http\Response
     */
    public function edit(Spesialite $spesialite)
    {
        $domains = Domain::all()->pluck('name','id');
        return view('year_acc.edit', compact('spesialite','domains'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spesialite  $spesialite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spesialite $spesialite)
    {
        //Validate name and permissions field
        $this->validate($request, [
                'name'=>'required|max:250',
                'filier_id'=>'required',
            ]
        );

        $input = $request->only(['name', 'filier_id']); //Retreive the name and the abr fields

        $spesialite->fill($input)->save();

        return redirect()->route('year_acc.index')
            ->with('flash_message',
                'filier '. $spesialite->name.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spesialite  $spesialite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spesialite $spesialite)
    {
        $spesialite->delete();
        return redirect()->route('year_acc.index')
            ->with('flash_message','spesialite supprimer!');
    }
}
