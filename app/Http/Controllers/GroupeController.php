<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use Illuminate\Http\Request;

class GroupeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groupes = Groupe::all()->toArray();
        return array_reverse($groupes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $groupes = new Groupe([
            'nom_groupe' => $request->input('nom_groupe'),
            ]);
            $groupes->save();
            return response()->json($groupes, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $groupes = Groupe::find($id);
        return response()->json($groupes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,  Request $request)
    {
        $groupes = Groupe::find($id);
        $groupes->update($request->all());
        return response()->json($groupes,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $groupes = Groupe::find($id);
        $groupes->delete();
        return response()->json('Groupe supprimé !');
    }
}
