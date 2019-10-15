<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = auth()->user()->locations;
        return response()->json($address,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            "phone"=>['required'],
            "zipcode"=>['required'],
            "building"=>['required'],
            "landmark"=>['nullable'],
            "address"=>['required'],
        ]);
        $address = Address::create([
            "phone"=>$request->phone,
            "zipcode"=>$request->zipcode,
            "building"=>$request->building,
            "landmark"=>$request->landmark,
            "address"=>$request->address,
            "user_id"=>$user->id,
        ]);
        return response()->json($address,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = Address::findorfail($id);
        return response()->json($address,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $address = Address::findorfail($id);
        $user = auth()->user();

        $request->validate([
            "phone"=>['required'],
            "zipcode"=>['required'],
            "building"=>['required'],
            "landmark"=>['nullable'],
            "address"=>['required'],
        ]);
        $address->update(["phone"=>$request->phone,"zipcode"=>$request->zipcode,"building"=>$request->building,"landmark"=>$request->landmark,"address"=>$request->address,]);
        return response()->json($address,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
    }
}
