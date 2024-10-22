<?php

namespace App\Http\Controllers;

use App\Models\WasteTip; // Assurez-vous que cette ligne est présente
use App\Models\AdviceType; // Assurez-vous que cette ligne est présente
use App\Events\PostCreated;
use App\Events\NewNotification; // Ajoutez cette ligne
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Assurez-vous que cette ligne est présente
use Illuminate\Support\Facades\Storage; // Assurez-vous que cette ligne est présente

class WasteTipController extends Controller
{
    public function index()
    {
        $adviceTypes = AdviceType::all();
        $wasteTips = WasteTip::with('adviceType')->get();

        return view('admin.WasteTips', compact('adviceTypes', 'wasteTips'));
    }

    public function index1(Request $request)
    {
        $query = $request->input('query');

        $wasteTips = WasteTip::with('adviceType')
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'LIKE', '%' . $query . '%')
                    ->orWhere('content', 'LIKE', '%' . $query . '%');
            })
            ->paginate(5); // Nombre d'éléments par page

        return view('user.WasteTips', compact('wasteTips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string|min:10',
            'advice_type_id' => 'required|exists:advice_types,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Le titre est obligatoire.',
            'title.min' => 'Le titre doit contenir au moins 3 caractères.',
            'title.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'content.required' => 'Le contenu est obligatoire.',
            'content.min' => 'Le contenu doit contenir au moins 10 caractères.',
            'advice_type_id.required' => 'Le type de conseil est obligatoire.',
            'advice_type_id.exists' => 'Le type de conseil sélectionné n\'existe pas.',
            'image.required' => 'L\'image est obligatoire.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L\'image doit être de type jpeg, png, jpg ou gif.',
            'image.max' => 'L\'image ne doit pas dépasser 2048 Ko (2 Mo).',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/waste_tips', 'public');
        }

        $wasteTip = WasteTip::create([
            'title' => $request->title,
            'content' => $request->content,
            'advice_type_id' => $request->advice_type_id,
            'author' => auth()->user()->id,
            'creation_date' => now(),
            'image' => $imagePath,
        ]);

        event(new PostCreated($wasteTip));

        // Préparation des données pour la notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'ajouté',
            'item' => 'conseil de déchets',
            'name' => $wasteTip->title,
        ];

        event(new NewNotification($data)); // Événement de notification

        return redirect()->route('admin.WasteTips')->with('success', 'Waste Tip ajoutée avec succès !');
    }

    public function update(Request $request, $id)
    {
        // Valider les données du formulaire avec des messages personnalisés
        $request->validate([
            'title' => 'required|string|min:4|max:255', // Ajout de la validation min:4
            'content' => 'required|string|max:1000',
            'advice_type_id' => 'required|exists:advice_types,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Le titre est requis.',
            'title.string' => 'Le titre doit être une chaîne de caractères.',
            'title.min' => 'Le titre doit contenir au moins 4 caractères.', // Message d'erreur pour min
            'title.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'content.required' => 'Le contenu est requis.',
            'content.string' => 'Le contenu doit être une chaîne de caractères.',
            'content.max' => 'Le contenu ne doit pas dépasser 1000 caractères.',
            'advice_type_id.required' => 'Le type de conseil est requis.',
            'advice_type_id.exists' => 'Le type de conseil sélectionné est invalide.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'Les formats d’image autorisés sont jpeg, png, jpg, gif.',
            'image.max' => 'L’image ne doit pas dépasser 2 Mo.',
        ]);

        // Trouver le WasteTip par son ID
        $wasteTip = WasteTip::findOrFail($id);

        // Mettre à jour les champs
        $wasteTip->title = $request->input('title');
        $wasteTip->content = $request->input('content');
        $wasteTip->advice_type_id = $request->input('advice_type_id');

        // Gérer le téléchargement d'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($wasteTip->image) {
                \Storage::disk('public')->delete($wasteTip->image);
            }
            // Stocker la nouvelle image et mettre à jour le chemin
            $imagePath = $request->file('image')->store('images/waste_tips', 'public');
            $wasteTip->image = $imagePath;
        }

        // Sauvegarder les modifications dans la base de données
        $wasteTip->save();

        // Préparation des données pour la notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'mis à jour',
            'item' => 'conseil de déchets',
            'name' => $wasteTip->title,
        ];

        event(new NewNotification($data)); // Événement de notification

        // Rediriger avec un message de succès
        return redirect()->route('admin.WasteTips')->with('success', 'Waste Tip mise à jour avec succès !');
    }

    public function show($id)
    {
        // Afficher le WasteTip par son ID (à compléter selon vos besoins)
    }

    public function destroy($id)
    {
        $wasteTip = WasteTip::findOrFail($id);
        
        // Supprimer l'image si elle existe
        if ($wasteTip->image) {
            Storage::disk('public')->delete($wasteTip->image);
        }

        // Préparation des données pour la notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'supprimé',
            'item' => 'conseil de déchets',
            'name' => $wasteTip->title,
        ];

        event(new NewNotification($data)); // Événement de notification

        $wasteTip->delete();

        return redirect()->route('admin.WasteTips')->with('success', 'Waste Tip supprimée avec succès !');
    }
}
