<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use App\Models\RecyclingCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecyclingCenterController extends Controller
{
    public function index()
    {
        $centers = RecyclingCenter::with('materials')->get();

        if (Auth::check()) {
            if (Auth::user()->utype === 'USR') {
                return view('layouts.recycling_centers.user', compact('centers'));
            } elseif (Auth::user()->utype === 'ADMIN') {
                return view('layouts.recycling_centers.index', compact('centers'));
            } else {
                return redirect()->route('home')->with('error', 'Type d’utilisateur non reconnu.');
            }
        } else {
            return redirect()->route('login')->with('message', 'Veuillez vous connecter pour continuer.');
        }

        if ($centers->isEmpty()) {
            return redirect()->route('recycling_centers.index')->withErrors(['no_centers' => 'Aucun centre de recyclage trouvé.']);
        }
    }

    public function create()
    {
        return view('layouts.recycling_centers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'opening_hours' => 'required|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'website_url' => 'nullable|url|max:255',
            'location' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $recyclingCenter = new RecyclingCenter();
        $recyclingCenter->fill($request->all());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $recyclingCenter->image = $imagePath;
        }

        $recyclingCenter->save();

        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'ajouté',
            'item' => 'recycle center',
            'name' => $recyclingCenter->name,
          
        ];

        event(new NewNotification($data));

        return redirect()->route('recycling_centers.index')->with('success', 'Centre de recyclage créé avec succès.');
    }

    public function show($id)
    {
        $center = RecyclingCenter::findOrFail($id);
        return view('layouts.recycling_centers.show', compact('center'));
    }

    public function edit($id)
    {
        $center = RecyclingCenter::findOrFail($id);
        return view('layouts.recycling_centers.edit', compact('center'));
    }

    public function update(Request $request, $id)
    {
        $center = RecyclingCenter::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'opening_hours' => 'required|string',
            'contact_info' => 'nullable|string',
            'website_url' => 'nullable|url',
            'location' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($center->image) {
                Storage::disk('public')->delete($center->image);
            }
            $filePath = $request->file('image')->store('uploads/recycling_centers', 'public');
            $validated['image'] = $filePath;
        }

        $center->update($validated);

        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'mis à jour',
            'item' => 'recycle center',
       
           
        ];

        event(new NewNotification($data));

        return redirect()->route('recycling_centers.index')->with('success', 'Centre de recyclage mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $center = RecyclingCenter::findOrFail($id);

        if ($center->image) {
            Storage::disk('public')->delete($center->image);
        }

        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'supprimé',
            'item' => 'recycle center',
           
          
        ];

        event(new NewNotification($data));

        $center->delete();

        return redirect()->route('recycling_centers.index')->with('success', 'Centre de recyclage supprimé avec succès.');
    }
}
