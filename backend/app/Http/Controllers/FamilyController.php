<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Http\Resources\PersonResource;
use App\Http\Requests\PersonRequest;

class FamilyController extends Controller
{
    public function index()
    {
        try {
            $people = Person::all();
            return response()->json(PersonResource::collection($people));
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function show(Person $person)
    {
        try {
            return response()->json(new PersonResource($person));
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function store(PersonRequest $request) 
    {
        try {
            $person = Person::create($request->validated()); 
            return response()->json(new PersonResource($person), 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function update(PersonRequest $request, Person $person)
    {
        try {
            $person->update($request->validated()); 
            return response()->json(new PersonResource($person));
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function destroy(Person $person)
    {
        try {
            $person->delete();
            return response()->json(null, 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
