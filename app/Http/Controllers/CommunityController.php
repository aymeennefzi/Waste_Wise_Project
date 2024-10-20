<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community; // Import the Community model
use App\Models\TaskC; // Importer le modèle Task


class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communities = Community::all(); // Retrieve all communities from the database
        return view('communities.index', compact('communities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
             return view('communities.create'); // Return the view for creating a new community

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        // Create a new Community object
        $community = new Community();
        $community->name = $request->input('name');
        $community->description = $request->input('description');

        // Handle the image file upload
        if ($request->hasFile('image_url')) {
            // Generate a unique filename for the image
            $fileName = time() . '_' . $request->file('image_url')->getClientOriginalName();
            // Save the image to the 'uploads/community' folder in the 'storage/app/public' directory
            $filePath = $request->file('image_url')->storeAs('uploads/community', $fileName, 'public');
            // Update the image URL in the community object
            $community->image_url = $filePath;
        }

        // Save the community to the database
        $community->save();

        // Redirect to the communities index page with a success message
        return redirect()->route('communities.index')->with('success', 'Community created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $community = Community::with('tasksc')->findOrFail($id);
        return view('communities.show', compact('community'));//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $community = Community::findOrFail($id); // Récupère la communauté par ID
        return view('communities.edit', compact('community')); // Renvoie la vue avec la communauté
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
        $community = Community::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
        ]);

        // Mise à jour des informations de la communauté
        $community->name = $validated['name'];
        $community->description = $validated['description'];


        // Gestion de l'image si une nouvelle est uploadée
        if ($request->hasFile('image_url')) {
            $fileName = time() . '_' . $request->file('image_url')->getClientOriginalName();
            $filePath = $request->file('image_url')->storeAs('uploads/community', $fileName, 'public');
            $community->image_url = $filePath; // Mettez à jour le chemin de l'image dans la base de données
        }

        // Sauvegarder les changements
        $community->save();


        // Redirection avec un message de succès
        return redirect()->route('communities.show', $community->id)->with('success', 'Communauté mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $community = Community::findOrFail($id);
    $community->delete();

    // Redirection après suppression
    return redirect()->route('communities.index')->with('success', 'Communauté supprimée avec succès');

    }
    public function userIndex()
{
    $communities = Community::all(); // Retrieve all communities
    return view('communities.user', compact('communities')); // Return user view with communities
}
public function showDetails($id)
{
    $community = Community::with('tasksc')->findOrFail($id);
    return view('communities.details', compact('community'));
}

}
