<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states = State::with('country')->get();
        return view('admin.pages.state.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::pluck('name', 'id')->toArray();
        return view('admin.pages.state.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:countries',
            'country_id' => 'required|exists:countries,id'
        ]);

        $state = State::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'State created successfully',
            'data' => $state
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        $countries = Country::pluck('name', 'id')->toArray();
        return view('admin.pages.state.edit', compact('state', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, State $state)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:countries,name,' . $state->id,
            'country_id' => 'required|exists:countries,id'
        ]);

        $state->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'State updated successfully',
            'data' => $state
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        $state->delete();

        return response()->json([
            'success' => true,
            'message' => 'State deleted successfully'
        ]);
    }
}
