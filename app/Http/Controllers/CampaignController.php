<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::withCount('donations')->get();
        return view('admin.campaigns.index', compact('campaigns'));
    }
    public function userIndex()
    {
        $campaigns = Campaign::all();
        return view('user.campaigns.index', compact('campaigns'));
    }
    
    public function create()
    {
        return view('admin.campaigns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // Adjust as needed
        ]);
        $campaign = new Campaign();
        $campaign->name = $request->name;
        $campaign->description = $request->description;
        $campaign->image = $request->image;

        if ($request->hasFile('image')) {
            // Générer un nom de fichier unique
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            // Enregistrer l'image dans le dossier 'uploads/campaign' dans 'storage/app/public'
            $filePath = $request->file('image')->storeAs('uploads/campaign', $fileName, 'public');
            // Mettre à jour l'URL de l'image dans l'objet $campaign
            $campaign->image = $filePath;
        }
       

       
        $campaign->save();

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign created successfully');
    }

    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // Adjust as needed
        ]);

        $campaign = Campaign::findOrFail($id);
        $campaign->name = $request->name;
        $campaign->description = $request->description;
        $campaign->image = $request->image;

    
        if ($request->hasFile('image')) {
            // Générer un nom de fichier unique
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            // Enregistrer l'image dans le dossier 'uploads/campaign' dans 'storage/app/public'
            $filePath = $request->file('image')->storeAs('uploads/campaign', $fileName, 'public');
            // Mettre à jour l'URL de l'image dans l'objet $campaign
            $campaign->image = $filePath;
        }

       
      

        $campaign->save();

        return redirect()->route('campaigns.index')->with('success', 'Campaign updated successfully');
    }

    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();
        return redirect()->route('campaigns.index')->with('success', 'Campaign deleted successfully');
    }
}

