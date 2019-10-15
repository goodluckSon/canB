<?php

namespace App\Http\Controllers;

use App\Flake;
use Illuminate\Http\Request;

class FlakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flakes = auth()->user()->flakes;
        return $flakes;
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
        $flake = new Flake;
        $flake->user_id = auth()->user()->id;
        $flake->data = $request->except('_token');
        $flake->save();
        return $flake;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Flake  $flake
     * @return \Illuminate\Http\Response
     */
    public function show(Flake $flake)
    {
        return response()->json($flake,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Flake  $flake
     * @return \Illuminate\Http\Response
     */
    public function edit(Flake $flake)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Flake  $flake
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flake $flake)
    {
        $flake->data = $request->except('id');
        $flake->save();
        return $flake;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flake  $flake
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flake $flake)
    {
        $flake->delete();
        return response()->json("ok",200);
    }
}
