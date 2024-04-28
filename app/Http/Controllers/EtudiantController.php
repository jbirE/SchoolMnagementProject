<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $etudiants = Etudiant::with(['groupe', 'diplome'])->get();
    return $etudiants;
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $etudiants = new Etudiant([
            'id_etudiant' => $request->input('id_etudiant'),
            'Nom' => $request->input('Nom'),
            'Prenom' => $request->input('Prenom'),
            'DateNaissance' => $request->input('DateNaissance'),
            'groupe_id' => $request->input('groupe_id'),
            'diplome_id' => $request->input('diplome_id'),
            'adressePersonnelle' => $request->input('adressePersonnelle'),
            'mail' => $request->input('mail'),
            'téléphone' => $request->input('téléphone'),
            'login' => $request->input('login'),
            'password' => $request->input('password'),
            'imageetud' => $request->input('imageetud')
            ]);
            $etudiants->save();
            return response()->json($etudiants,200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $etudiant= Etudiant::find($id);
        return response()->json($etudiant);
        }
    

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {
        $etudiant = Etudiant::find($id);
        $etudiant->update($request->all());
        return response()->json($etudiant,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $etudiant = Etudiant::find($id);
        $etudiant->delete();
        return response()->json('Etudiant supprimé !');
    }
}
