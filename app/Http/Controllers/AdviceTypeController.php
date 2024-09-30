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
        // Valider les données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Créer un nouveau AdviceType
        AdviceType::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Rediriger vers la liste avec un message de succès
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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);
    
        $adviceType = AdviceType::findOrFail($id);
        $adviceType->name = $request->input('name');
        $adviceType->description = $request->input('description');
        $adviceType->save();
    
        return redirect()->route('admin.adviceType')->with('success', 'Advice Type updated successfully!');
    }
    



}
