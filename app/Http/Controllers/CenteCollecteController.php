<?php

namespace App\Http\Controllers;
use App\Models\CentreCollecte;  // Assurez-vous que cette ligne est présente

use Illuminate\Http\Request;

class CenteCollecteController extends Controller
{
    public function index()
{
    // Récupérer tous les centres de collecte
    $centreCollectes = CentreCollecte::all();

    // Retourner la vue avec les centres de collecte
    return view('admin.CentreCollecte', compact('centreCollectes'));
}

   public function create()
   {
       return view('admin.CentreCollecte.create'); // chemin mis à jour
   }

   public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'capacite' => 'required|integer',
        ]);

        CentreCollecte::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'capacite' => $request->capacite,
        ]);

        return redirect()->route('admin.collectionCenter')->with('success', 'Centre de Collecte ajouté avec succès!');
    }

    public function destroy($id)
    {
        $centreCollecte = CentreCollecte::findOrFail($id);
        $centreCollecte->delete();
    
        return redirect()->route('admin.collectionCenter')->with('success', 'Centre de Collecte supprimé avec succès.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'capacite' => 'required|integer',
        ]);

        $centreCollecte = CentreCollecte::findOrFail($id);
        $centreCollecte->nom = $request->input('nom');
        $centreCollecte->adresse = $request->input('adresse');
        $centreCollecte->capacite = $request->input('capacite');
        $centreCollecte->save();

        return redirect()->route('admin.collectionCenter')->with('success', 'Centre de Collecte mis à jour avec succès!');
    }

    
}
