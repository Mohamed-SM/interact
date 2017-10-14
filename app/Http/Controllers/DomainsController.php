<?php

namespace App\Http\Controllers;


use App\Domain;
use App\Filier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class DomainsController extends Controller
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
        $domains = Domain::paginate(15);//Get all roles
        return view('domains.index')->with('domains', $domains);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('domains.create');
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
            'code'=>'required|unique:domains|max:10',
            ]
        );

        $name = $request['name'];
        $code = $request['code'];
        
        $domain = new Domain();
        
        if (isset($request['common'])) {
            $domain->common=1;
        }else{
            $domain->common=0;
        }

        $domain->name = $name;
        $domain->code = $code;

        $domain->save();

        return redirect()->route('domains.index')
            ->with('flash_message','domain '. $domain->name.' Ajoute!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('domains');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $domain = domain::findOrFail($id);

        return view('domains.edit', compact('domain'));
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
        $domain = domain::findOrFail($id);//Get role with the given id

        //Validate name and permissions field
        $this->validate($request, [
            'name'=>'required|max:250',
            'code'=>'required|max:10',
            ]
        );

        $input = $request->only(['name', 'code']); //Retreive the name and the abr fields
        
        if (isset($request['common'])) {
            $domain->common=1;
        }else{
            $domain->common=0;
        }

        $domain->fill($input)->save();

        return redirect()->route('domains.index')
            ->with('flash_message',
             'domain '. $domain->name.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $domain = domain::findOrFail($id);

        
        $domain->delete();

        return redirect()->route('domains.index')
            ->with('flash_message','domain supprimer!');

    }

    public function getFiliers(Request $request){
        $id = Input::get( 'domain' );
        
        try {
            $domain = Domain::findOrFail($id);
            if($domain->common){
                
                $filier = new Filier();
                $filier->name = "Tranc commun";
                $filier->id = "0";
                $domain->filier->prepend($filier);
            }
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The Domain with ID: ' . $id . ' was not found.');
            return;
        }

        $filiers = $domain->filier;

        return view('domains.partials.filiers', compact('filiers'));
    }
}
