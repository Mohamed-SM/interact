<?php

namespace App\Http\Controllers;

use App\Faculte;
use Illuminate\Http\Request;

class FacultesController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faculte  $faculte
     * @return \Illuminate\Http\Response
     */
    public function show(Faculte $faculte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faculte  $faculte
     * @return \Illuminate\Http\Response
     */
    public function edit(Faculte $faculte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faculte  $faculte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faculte $faculte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faculte  $faculte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faculte $faculte)
    {
        //
    }
}
