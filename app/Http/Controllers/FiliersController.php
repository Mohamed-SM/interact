<?php

namespace App\Http\Controllers;

use App\Filier;
use App\Domain;
use Illuminate\Http\Request;

class FiliersController extends Controller
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
        $filiers = Filier::paginate(15);//Get all roles
        return view('filiers.index')->with('filiers', $filiers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $domains = Domain::all()->pluck('name','id');
        return view('filiers.create',compact('domains'));
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
            'domain'=>'required',
            ]
        );

        $name = $request['name'];

        $filier = new Filier();
        $filier->name = $name;

        $domain = Domain::findOrFail($request['domain']);
        $domain->filier()->save($filier);
        

        return redirect()->route('filiers.index')
            ->with('flash_message','Filier '. $filier->name.' Ajoute!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('filiers');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filier = Filier::findOrFail($id);
        $domains = Domain::all()->pluck('name','id');
        return view('filiers.edit', compact('filier','domains'));
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
        $filier = Filier::findOrFail($id);//Get role with the given id

        $this->validate($request, [
                'name'=>'required|max:250',
                'domain'=>'required',
            ]
        );

        $input = $request->only(['name', 'domain']); //Retreive the name and the abr fields

        $filier->fill($input)->save();

        return redirect()->route('filiers.index')
            ->with('flash_message',
             'filier '. $filier->name.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filier = Filier::findOrFail($id);
        $filier->delete();
        return redirect()->route('filiers.index')
            ->with('flash_message','filier supprimer!');

    }
}
