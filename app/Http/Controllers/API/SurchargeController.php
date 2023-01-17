<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreSurchargeRequest;
use App\Http\Requests\UpdateSurchargeRequest;
use App\Models\Surcharge;

class SurchargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreSurchargeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSurchargeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surcharge  $surcharge
     * @return \Illuminate\Http\Response
     */
    public function show(Surcharge $surcharge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surcharge  $surcharge
     * @return \Illuminate\Http\Response
     */
    public function edit(Surcharge $surcharge)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surcharge  $surcharge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surcharge $surcharge)
    {
        //
    }
}
