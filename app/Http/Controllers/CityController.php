<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::with('state.country')->get();
        return view('admin.pages.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::pluck('name', 'id')->toArray();
        $states = State::pluck('name', 'id')->toArray();
        return view('admin.pages.city.create', compact('countries', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:cities',
            'state_id' => 'required|exists:states,id'
        ]);

        $city = City::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'City created successfully',
            'data' => $city
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
    public function edit(City $city)
    {
        $countries = Country::pluck('name', 'id')->toArray();
        $states = State::pluck('name', 'id')->toArray();
        return view('admin.pages.city.edit', compact('city', 'countries', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:cities,name,' . $city->id,
            'state_id' => 'required|exists:states,id'
        ]);

        $city->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'City updated successfully',
            'data' => $city
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();

        return response()->json([
            'success' => true,
            'message' => 'City deleted successfully'
        ]);
    }
}
