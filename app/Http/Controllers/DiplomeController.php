<?php

namespace App\Http\Controllers;

use App\Models\Diplome;
use Illuminate\Http\Request;

class DiplomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diplomes = Diplome::all()->toArray();
        return array_reverse($diplomes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $diplomes = new Diplome([
            'nom_diplome' => $request->input('nom_diplome'),
            ]);
            $diplomes->save();
            return response()->json($diplomes, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $diplomes = Diplome::find($id);
        return response()->json($diplomes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,  Request $request)
    {
        $diplomes = Diplome::find($id);
        $diplomes->update($request->all());
        return response()->json($diplomes,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $diplomes = Diplome::find($id);
        $diplomes->delete();
        return response()->json('Diplome supprimé !');
    }
}
