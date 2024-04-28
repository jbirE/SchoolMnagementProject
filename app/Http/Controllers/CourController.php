<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use Illuminate\Http\Request;

class CourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $cours = Cour::with(['Enseignant'])->get();
    return $cours;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cours = new Cour([
            'code' => $request->input('code'),
            'enseignant_id' => $request->input('enseignant_id'),
            'imagecour' => $request->input('imagecour'),
            'descriptionSuccincte' => $request->input('descriptionSuccincte'),
            'nombreHeure' => $request->input('nombreHeure'),
            'coefDiplôme' => $request->input('coefDiplôme'),
            'coefExamen' => $request->input('coefExamen'),
            'coefTd' => $request->input('coefTd'),
            ]);
            $cours->save();
            return response()->json($cours, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cours= Cour::find($id);
        return response()->json($cours);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {
        $cours = Cour::find($id);
        $cours->update($request->all());
        return response()->json($cours,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cours = Cour::find($id);
        $cours->delete();
        return response()->json('cour supprimé !');
    }
}
