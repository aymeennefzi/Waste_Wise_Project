<?php

namespace App\Http\Controllers;
use App\Models\AdviceType;  // Assurez-vous que cette ligne est présente

use Illuminate\Http\Request;

class AdviceTypeController extends Controller
{
    public function index()
    {
        $adviceTypes = AdviceType::all();
        
        // Passer la variable $adviceTypes à la vue
        return view('admin.adviceType', compact('adviceTypes'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10|max:500',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.min' => 'Le nom doit contenir au moins 3 caractères.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit contenir au moins 10 caractères.',
            'description.max' => 'La description ne doit pas dépasser 500 caractères.',
        ]);

        AdviceType::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.adviceType')->with('success', 'Advice Type added successfully!');
    }

 

    public function destroy($id)
    {
        // Trouver l'Advice Type par son ID et le supprimer
        $adviceType = AdviceType::findOrFail($id);
        $adviceType->delete();

        // Rediriger avec un message de succès
        return redirect()->route('admin.adviceType')->with('success', 'Advice Type deleted successfully.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10|max:1000',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.min' => 'Le nom doit contenir au moins 3 caractères.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit contenir au moins 10 caractères.',
            'description.max' => 'La description ne doit pas dépasser 1000 caractères.',
        ]);
    
        $adviceType = AdviceType::findOrFail($id);
        $adviceType->name = $request->input('name');
        $adviceType->description = $request->input('description');
        $adviceType->save();
    
        return redirect()->route('admin.adviceType')->with('success', 'Advice Type updated successfully!');
    }
    
    



}