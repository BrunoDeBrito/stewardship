<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\Api\StoreFamilyInvitationRequest;
use App\Http\Requests\Api\UpdateFamilyInvitationRequest;
use App\Models\FamilyInvitation;

class FamilyInvitationController extends Controller
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
    public function store(StoreFamilyInvitationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FamilyInvitation $familyInvitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FamilyInvitation $familyInvitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFamilyInvitationRequest $request, FamilyInvitation $familyInvitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FamilyInvitation $familyInvitation)
    {
        //
    }
}
