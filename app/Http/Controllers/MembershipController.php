<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Community;
use App\Events\NewNotification; // Ajoutez cette ligne pour les notifications
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    // Display a listing of memberships
    public function index()
    {
        $memberships = Membership::with('community', 'user')->get();
        return view('front_office.memberships.index', compact('memberships'));
    }

    // Show the form for creating a new membership
    public function create()
    {
        $communities = Community::all();
        return view('front_office.memberships.create', compact('communities'));
    }

    // Store a newly created membership in the database
    public function store(Request $request)
    {
        $request->validate([
            'communityId' => 'required|integer|exists:communities,id',
            'joinedAt' => 'required|date',
        ]);

        // Automatically assign the authenticated user's ID
        $membership = Membership::create([
            'userId' => Auth::id(),
            'communityId' => $request->input('communityId'),
            'joinedAt' => $request->input('joinedAt')
        ]);

        // Préparation des données pour la notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'créé',
            'item' => 'adhésion',
            'name' => $membership->community->name, // Nom de la communauté associée
        ];

        event(new NewNotification($data)); // Événement de notification

        return redirect()->route('membership.index')->with('success', 'Membership created successfully.');
    }

    // Show the form for editing a specific membership
    public function edit($id)
    {
        $membership = Membership::findOrFail($id);
        $communities = Community::all();
        return view('front_office.memberships.edit', compact('membership', 'communities'));
    }

    // Update the specified membership in the database
    public function update(Request $request, Membership $membership)
    {
        $request->validate([
            'communityId' => 'required|integer|exists:communities,id',
            'joinedAt' => 'required|date',
        ]);

        // Update membership
        $membership->update([
            'communityId' => $request->input('communityId'),
            'joinedAt' => $request->input('joinedAt')
        ]);

        // Préparation des données pour la notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'mis à jour',
            'item' => 'adhésion',
            'name' => $membership->community->name, // Nom de la communauté associée
        ];

        event(new NewNotification($data)); // Événement de notification

        return redirect()->route('membership.index')->with('success', 'Membership updated successfully.');
    }

    // Remove the specified membership from the database
    public function destroy($id)
    {
        $membership = Membership::findOrFail($id);

        // Préparation des données pour la notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'supprimé',
            'item' => 'adhésion',
            'name' => $membership->community->name, // Nom de la communauté associée
        ];

        event(new NewNotification($data)); // Événement de notification

        $membership->delete();

        return redirect()->route('membership.index')->with('success', 'Membership deleted successfully.');
    }

    // Search functionality for memberships
    public function search(Request $request)
    {
        $query = $request->input('query');
        $memberships = Membership::whereHas('user', function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%');
        })->orWhereHas('community', function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%');
        })->get();

        return view('front_office.memberships.index', compact('memberships'));
    }
}
