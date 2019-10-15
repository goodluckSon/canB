<?php

namespace App\Http\Controllers\Admin;

use App\Design;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designs = Design::all();
        return response()->json($designs,200);
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
        $request->validate([
            "file"=>['required','file'],
            "device"=>['required','string'],
            "model"=>['required','string'],
            "category"=>['required','string'],
        ]);
        $design = new Design;
        $design->device         =   $request->device;
        $design->model          =   $request->model;
        $design->category       =   $request->category;
        if($request->hasFile('file')){
            $design->file       =   $request->file('file')->store("designs",'public');
        }
        $design->save();
        return response()->json('OK',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function show(Design $design)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function edit(Design $design)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Design $design)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function destroy(Design $design)
    {
        \Storage::disk('public')->delete($design->file);
        $design->delete();
        return response()->json('OK',200);
    }
}
