<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::all();
        return view('donations.index', compact('donations'));
    }

    public function create()
    {
        return view('donations.create');
    }

    public function store(Request $request)
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

        Donation::create($validatedData);

        return redirect()->route('donations.index')->with('success', 'Donation created with success');
    }

    public function show($id)
    {
        $donation = Donation::findOrFail($id);
        return view('donations.show', compact('donation'));
    }

    public function edit($id)
    {
        $donation = Donation::findOrFail($id);
        return view('donations.edit', compact('donation'));
    }

    public function update(Request $request, $id)
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

        return redirect()->route('donations.index')->with('success', 'Donation modified with success');
    }

    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        $donation->delete();

        return redirect()->route('donations.index')->with('success', 'Donation deleted with success');
    }
}