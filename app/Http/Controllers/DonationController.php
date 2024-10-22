<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Enums\DonationStatus;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function adminIndex()
    {
        $donations = Donation::with('campaign')->get();
        return view('admin.donations.index', compact('donations'));
    }

    public function userIndex()
    {
        $donations = Donation::where('userId', Auth::id())->get(); // Adjust as needed
        return view('user.donations.index', compact('donations'));
    }

    public function edit($id)
    {
        $donation = Donation::findOrFail($id);
        return view('admin.donations.edit', compact('donation')); // Admin edit view
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'donorName' => 'required|string|max:100',
            'cause' => 'required|string|max:1000',
            'status' => 'required|string|in:' . implode(',', array_column(DonationStatus::cases(), 'value')),
        ], [
            'amount.required' => 'Le champ Montant est obligatoire.',
            'donorName.required' => 'Le champ Nom du Donateur est obligatoire.',
            'cause.required' => 'Le champ Cause est obligatoire.',
            'status.required' => 'Le champ Statut est obligatoire.',
        ]);

        $donation = Donation::findOrFail($id);
        $donation->update($validatedData);

        // Data for notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'mis à jour',
            'item' => 'donation',
            'name' => $donation->donorName,
        ];
        event(new NewNotification($data));

        return redirect()->route('donations.admin.index')->with('success', 'Donation modified successfully');
    }

    // User create and edit methods
    public function userCreate()
    {
        return view('user.donations.create'); // User create view
    }

    public function userStore(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'donorName' => 'required|string|max:100',
            'cause' => 'required|string|max:1000',
            'campaign_id' => 'required|exists:campaigns,id',
        ], [
            'amount.required' => 'Le champ Montant est obligatoire.',
            'donorName.required' => 'Le champ Nom du Donateur est obligatoire.',
            'cause.required' => 'Le champ Cause est obligatoire.',
            'campaign_id.required' => 'Le champ Campagne est obligatoire.',
            'campaign_id.exists' => 'La campagne sélectionnée n\'est pas valide.',
        ]);

        $validatedData['userId'] = Auth::id(); // Set the user ID
        $validatedData['status'] = DonationStatus::PENDING; // Set default status
        $donation = Donation::create($validatedData);

        // Data for notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'ajouté',
            'item' => 'donation',
            'name' => $donation->donorName,
        ];
        event(new NewNotification($data));

        return redirect()->route('donations.user.index')->with('success', 'Donation created successfully');
    }

    public function userEdit($id)
    {
        $donation = Donation::findOrFail($id);
        return view('user.donations.edit', compact('donation')); // User edit view
    }

    public function userUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'donorName' => 'required|string|max:100',
            'cause' => 'required|string|max:1000',
        ], [
            'amount.required' => 'Le champ Montant est obligatoire.',
            'donorName.required' => 'Le champ Nom du Donateur est obligatoire.',
            'cause.required' => 'Le champ Cause est obligatoire.',
        ]);

        $donation = Donation::findOrFail($id);
        $donation->update($validatedData);

        // Data for notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'mis à jour',
            'item' => 'donation',
            'name' => $donation->donorName,
        ];
        event(new NewNotification($data));

        return redirect()->route('donations.user.index')->with('success', 'Donation modified successfully');
    }

    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        
        // Data for notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'supprimé',
            'item' => 'donation',
            'name' => $donation->donorName,
        ];
        event(new NewNotification($data));

        $donation->delete();

        return redirect()->route('donations.admin.index')->with('success', 'Donation deleted with success');
    }

    public function cancel($id)
    {
        $donation = Donation::findOrFail($id);
        $donation->status = DonationStatus::CANCELLED;
        $donation->save();

        // Data for notification
        $data = [
            'user_name' => Auth::user()->name,
            'action' => 'annulé',
            'item' => 'donation',
            'name' => $donation->donorName,
        ];
        event(new NewNotification($data));

        return redirect()->route('donations.user.index')->with('success', 'Donation cancelled successfully');
    }
}
