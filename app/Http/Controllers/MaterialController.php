<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use App\Models\Material;
use App\Models\RecyclingCenter as ModelsRecyclingCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            if (Auth::user()->utype === 'ADMIN') {
                return view('layouts.materials.index', compact('materials'));
            } elseif (Auth::user()->utype === 'USR') {
                return view('layouts.materials.user', compact('materials'));
            } else {
                return redirect()->route('home')->with('error', 'Type d’utilisateur non reconnu.');
            }
        } else {
            return redirect()->route('login')->with('message', 'Veuillez vous connecter pour continuer.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recyclingCenters = ModelsRecyclingCenter::all();
        return view('layouts.materials.create', compact('recyclingCenters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Add validation rules
        $validatedData = $request->validate([
            'material_name' => 'required|string|max:255',
            'description' => 'required|string|max:1000', // Description with a limit of 1000 chars
            'recycling_center_id' => 'required|exists:recycling_centers,id', // Ensure recycling center exists
        ]);

        // Create the material
        $material = Material::create($validatedData);

        // Prepare data for notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'ajouté',
            'item' => 'matériau',
            'name' => $material->material_name,
        ];

        // Trigger notification event
        event(new NewNotification($data));

        return redirect()->route('materials.index')->with('success', 'Matériau créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material = Material::findOrFail($id);
        $recyclingCenters = ModelsRecyclingCenter::all();
        return view('layouts.materials.edit', compact('material', 'recyclingCenters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Add validation rules
        $validatedData = $request->validate([
            'material_name' => 'required|string|max:255',
            'description' => 'required|string|max:1000', // Description with a limit of 1000 chars
            'recycling_center_id' => 'required|exists:recycling_centers,id', // Ensure recycling center exists
        ]);

        // Find the material and update
        $material = Material::findOrFail($id);
        $material->update($validatedData);

        // Prepare data for notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'mis à jour',
            'item' => 'matériau',
            'name' => $material->material_name,
        ];

        // Trigger notification event
        event(new NewNotification($data));

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
        $material = Material::findOrFail($id);
        
        // Prepare data for notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'supprimé',
            'item' => 'matériau',
            'name' => $material->material_name,
        ];

        // Trigger notification event
        event(new NewNotification($data));

        $material->delete();

        return redirect()->route('materials.index')->with('success', 'Matériau supprimé avec succès.');
    }
}
