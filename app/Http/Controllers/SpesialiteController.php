<?php

namespace App\Http\Controllers;

use App\Spesialite;
use App\Filier;
use App\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SpesialiteController extends Controller
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
        $spesialites = Spesialite::paginate(15);
        return view('spesialites.index',compact('spesialites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $domains = Domain::all()->pluck('name','id');
        return view('spesialites.create',compact('domains'));
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
        return view('spesialites.partials.filiers', compact('filiers'));
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
                'name'=>'required|max:250',
                'filier'=>'required',
            ]
        );

        $name = $request['name'];

        $spesialite = new Spesialite();
        $spesialite->name = $name;

        $filier = Filier::findOrFail($request['filier']);
        $filier->spesialite()->save($spesialite);


        return redirect()->route('spesialites.index')
            ->with('flash_message','Spesialite '. $spesialite->name.' Ajoute!');
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
        return view('spesialites.edit', compact('spesialite','domains'));
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

        return redirect()->route('spesialites.index')
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
        return redirect()->route('spesialites.index')
            ->with('flash_message','spesialite supprimer!');
    }
}
