<?php

namespace App\Http\Controllers;

use App\Module;
use App\Unit;
use Illuminate\Http\Request;

class ModuleController extends Controller
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
        $modules = Module::paginate(15);//Get all roles
        return view('modules.index')->with('modules', $modules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::all()->pluck('code','id') ;

        return view('modules.create',compact('units'));
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
            'title'=>'required|max:250',
            'code'=>'required|max:10',
            'unit'=>'required',
            'credits'=>'required',
            'coefficient'=>'required',
            ]
        );

        $unit = Unit::findOrFail($request['unit']);
        
        $module = new Module();
        $module->title = $request['title'];
        $module->code = $request['code'];
        $module->credits = $request['credits'];
        $module->coefficient = $request['coefficient'];
        $module->time_course = $request['time_course'];
        $module->time_td = $request['time_td'];
        $module->time_tp = $request['time_tp'];
        
        if(isset($request['exame'])) $module->exame = 1;
        else $module->exame = 0;
        
        if(isset($request['controle'])) $module->controle = 1;
        else $module->controle = 0;

        $unit->modules()->save($module);

        return redirect()->route('modules.index')
            ->with('flash_message','Module '. $module->title.' Ajoute!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('modules');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $units = Unit::all()->pluck('code','id') ;
        $module = Module::findOrFail($id);

        return view('modules.edit', compact('module','units'));
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
        $module = Module::findOrFail($id);//Get role with the given id

        //Validate name and permissions field
        $this->validate($request, [
            'title'=>'required|max:250',
            'code'=>'required|max:10',
            'unit_id'=>'required',
            'credits'=>'required',
            'coefficient'=>'required',
            ]
        );

        $input = $request->only([
            'title','code', 'unit_id',
            'credits','coefficient',
            'time_course','time_td','time_tp',
        ]); //Retreive the code and the abr fields

        if(isset($request['exame'])) $module->exame = 1;
        else $module->exame = 0;
        
        if(isset($request['controle'])) $module->controle = 1;
        else $module->controle = 0;
        
        $module->fill($input)->save();

        return redirect()->route('modules.index')
            ->with('flash_message',
             'Module '. $module->code.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $module = Module::findOrFail($id);

        
        $module->delete();

        return redirect()->route('modules.index')
            ->with('flash_message','Module supprimer!');

    }
}
