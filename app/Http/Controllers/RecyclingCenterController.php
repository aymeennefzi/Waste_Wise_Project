<?php

namespace App\Http\Controllers;

use App\Models\RecyclingCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecyclingCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupérer toutes les données des centres de recyclage
        $centers = RecyclingCenter::with('materials')->get();    
        // Vérifier que les données sont bien envoyées
        if ($centers->isEmpty()) {
            // Rediriger avec une erreur
            return redirect()->route('recycling_centers.index')->withErrors(['no_centers' => 'Aucun centre de recyclage trouvé.']);
        }
    
        return view('layouts.recycling_centers.index', compact('centers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.recycling_centers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'opening_hours' => 'required|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'website_url' => 'nullable|url|max:255',
            'location' => 'nullable|string|max:255', // Validation pour le lien Google Maps
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Création d'une nouvelle instance du centre de recyclage
        $recyclingCenter = new RecyclingCenter();
        $recyclingCenter->name = $request->name;
        $recyclingCenter->address = $request->address;
        $recyclingCenter->latitude = $request->latitude;
        $recyclingCenter->longitude = $request->longitude;
        $recyclingCenter->opening_hours = $request->opening_hours;
        $recyclingCenter->contact_info = $request->contact_info;
        $recyclingCenter->website_url = $request->website_url;
        $recyclingCenter->location = $request->location; // Enregistrement du lien

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $recyclingCenter->image = $imagePath;
        }

        // Sauvegarde dans la base de données
        $recyclingCenter->save();

        // Redirection avec message de succès
        return redirect()->route('recycling_centers.index')->with('success', 'Centre de recyclage créé avec succès.');
    }

      
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $center = RecyclingCenter::findOrFail($id);
        return view('layouts.recycling_centers.show', compact('center'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $center = RecyclingCenter::findOrFail($id);
        return view('layouts.recycling_centers.edit', compact('center'));
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
        $center = RecyclingCenter::findOrFail($id);

        // Valider les nouvelles données du formulaire
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'opening_hours' => 'required|string',
            'contact_info' => 'nullable|string',
            'website_url' => 'nullable|url',
            'location' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validation de l'image
        ]);

        // Gestion de l'upload de la nouvelle image, si présente
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image s'il y en a une
            if ($center->image) {
                Storage::disk('public')->delete($center->image);
            }
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('uploads/recycling_centers', $fileName, 'public');
            $validated['image'] = $filePath;
        }

        $center->update($validated);
        return redirect()->route('recycling_centers.index')->with('success', 'Centre de recyclage mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $center = RecyclingCenter::findOrFail($id);

        // Supprimer l'image associée s'il y en a une
        if ($center->image) {
            Storage::disk('public')->delete($center->image);
        }

        $center->delete();
        return redirect()->route('recycling_centers.index')->with('success', 'Centre de recyclage supprimé avec succès.');
    }
}
