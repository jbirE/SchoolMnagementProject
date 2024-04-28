<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enseignants = Enseignant::all()->toArray();
        return array_reverse($enseignants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function  getEnseignant(){
        return response()->json(Enseignant::all(),200);
    }

    public function store(Request $request)
    {
        $enseignants = new Enseignant([
            'code' => $request->input('code'),
            'nom' => $request->input('nom'),
            'prénom' => $request->input('prénom'),
            'grade' => $request->input('grade'),
            'numBureau' => $request->input('numBureau'),
            'mail' => $request->input('mail'),
            'téléphone' => $request->input('téléphone'),
            'login' => $request->input('login'),
            'password' => $request->input('password'),
            'imageens' => $request->input('imageens')
            ]);
            $enseignants->save();
            return response()->json($enseignants,200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $enseignants= Enseignant::find($id);
        return response()->json($enseignants);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {
        $enseignants = Enseignant::find($id);
        $enseignants->update($request->all());
        return response()->json($enseignants,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request ,$id)
    {
        $enseignants = Enseignant::find($id);
        if(is_null($enseignants)){
            return response()->json(['message'=>'Ensagnait not founf'],404);
        }
        $enseignants->delete();
        return response()->json('Enseignant supprimé !');
    }
}
