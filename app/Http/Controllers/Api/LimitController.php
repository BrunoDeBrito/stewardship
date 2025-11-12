<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\{StoreLimitRequest, UpdateLimitRequest};
use App\Models\Limit;

class LimitController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLimitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Limit $limit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Limit $limit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLimitRequest $request, Limit $limit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Limit $limit)
    {
        //
    }
}
