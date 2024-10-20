<?php

namespace App\Http\Controllers;

use App\Http\Livewire\RecyclingCenter;
use App\Models\Material;
use App\Models\RecyclingCenter as ModelsRecyclingCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $materials = Material::with('recyclingCenter')->paginate(10);
    if (Auth::check()) {
        // Vérifier le type d'utilisateur
        if (Auth::user()->utype === 'ADMIN') {
            // Rediriger l'utilisateur vers la vue spécifique des utilisateurs normaux
            return view('layouts.materials.index', compact('materials'));
        } elseif (Auth::user()->utype === 'USR') {
            // Rediriger l'administrateur vers la vue d'administration
            return view('layouts.materials.user', compact('materials'));
        } else {
            // Gestion des types d'utilisateurs non pris en charge
            return redirect()->route('home')->with('error', 'Type d’utilisateur non reconnu.');
        }
    } else {
        // Rediriger vers la page de connexion ou une autre page
        return redirect()->route('login')->with('message', 'Veuillez vous connecter pour continuer.');
    }
}

public function create()
{
    $recyclingCenters = ModelsRecyclingCenter::all(); // Assumez que vous avez un modèle RecyclingCenter
    return view('layouts.materials.create', compact('recyclingCenters'));
}

public function store(Request $request)
{
    $request->validate([
        'material_name' => 'required|string|max:255',
        'description' => 'required|string',
        'recycling_center_id' => 'required|exists:recycling_centers,id',
    ]);

    Material::create($request->all());
    return redirect()->route('materials.index')->with('success', 'Matériau créé avec succès.');
}

public function edit($id)
{
    $material = Material::findOrFail($id);
    $recyclingCenters = ModelsRecyclingCenter::all();
    return view('layouts.materials.edit', compact('material', 'recyclingCenters'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'material_name' => 'required|string|max:255',
        'description' => 'required|string',
        'recycling_center_id' => 'required|exists:recycling_centers,id',
    ]);

    $material = Material::findOrFail($id);
    $material->update($request->all());

    return redirect()->route('materials.index')->with('success', 'Matériau mis à jour avec succès.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
