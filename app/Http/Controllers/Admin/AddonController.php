<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Addon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->type;
        $addons = Addon::where('file','!=', null);
        if($type){
            $addons->where('type',$type);
        }
        $addons = $addons->get();
        return $addons;
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
            "name"=>['nullable','string'],
            "category"=>['required','string'],
            "type"=>['required','string'],
            "file"=>['required','file'],
        ]);
        $addon = new Addon;
        $addon->name  = $request->name;
        $addon->category  = $request->category;
        $addon->type  = $request->type;
        if($request->hasfile('file')){
            $addon->file  = $request->file('file')->store($addon->type,'public');
        }
        $addon->save();
        return response()->json('OK',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function show(Addon $addon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function edit(Addon $addon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Addon $addon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Addon  $addon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Addon $addon)
    {
        \Storage::disk('public')->delete($addon->file);
        $addon->delete();
        return response()->json('OK',200);
    }
}
