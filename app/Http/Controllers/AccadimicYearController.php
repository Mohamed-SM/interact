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

    public function getFiliers(){
        $id = Input::get( 'domain' );
        
        try {
            $domain = Domain::findOrFail($id);
            if($domain->common){
                
                $filier = new Filier();
                $filier->name = "Tranc commun";
                $domain->filier->prepend($filier);
            }
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The Domain with ID: ' . $id . ' was not found.');
            return;
        }

        $filiers = $domain->filier;

        return view('domains.partials.filiers', compact('filiers'));
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
                'departement_id' => 'required',
                'spesialite_id' => 'required',
            ]);
        
        $input = $request->only(['year', 'grade' , 'domain_id' , 'filier_id' , 'spesialite_id' , 'departement_id']);

        $acc_year = new AccadimicYear();

        $acc_year->fill($input)->save();
        return redirect()->route('annee_acc.index')
            ->with('flash_message','Année '. $acc_year->year.$acc_year->domaine.$acc_year->grade.' Ajoute!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spesialite  $spesialite
     * @return \Illuminate\Http\Response
     */
    public function show(AccadimicYear $acc_year)
    {
        return redirect('annee_acc');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spesialite  $spesialite
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acc_year = AccadimicYear::findOrFail($id);
        $domains = Domain::all()->pluck('name','id');
        $filiers = $acc_year->domain->filier->pluck('name','id');
        $spesialites = $acc_year->filier->spesialite;
        $spesialite = Spesialite::all()->first();
        $spesialites->prepend($spesialite);
        $spesialites = $spesialites->pluck('name','id');  
        $departements = Departement::all()->pluck('title','id');
        return view('year_acc.edit', compact('acc_year','domains','departements','filiers','spesialites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spesialite  $spesialite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $acc_year = AccadimicYear::findOrFail($id);
        //Validate name and permissions field
        $this->validate($request, [
                'year' => 'required|int',
                'grade' => 'required',
                'domain_id' => 'required',
                'filier_id' => 'required',
                'departement_id' => 'required',
                'spesialite_id' => 'required',
            ]);
        
        $input = $request->only(['year', 'grade' , 'domain_id' , 'filier_id' , 'spesialite_id' , 'departement_id']);

        $acc_year->fill($input)->save();

        return redirect()->route('annee_acc.index')
            ->with('flash_message',
                'year updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spesialite  $spesialite
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $acc_year = AccadimicYear::findOrFail($id);
        $acc_year->delete();
        return redirect()->route('annee_acc.index')
            ->with('flash_message','Année Accadimic supprimer!');
    }
}
