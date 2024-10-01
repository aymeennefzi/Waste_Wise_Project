<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str; // Ajoutez ceci

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'profile_photo_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validation pour l'image
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Gestion de l'upload de l'image
    if ($request->hasFile('profile_photo_path')) {
        $file = $request->file('profile_photo_path');
        $filename = time() . '.' . $file->getClientOriginalExtension(); // Générer un nom unique
        $file->move(public_path('profile_photos'), $filename); // Déplacer l'image dans le dossier
        $user->profile_photo_path = 'profile_photos/' . $filename; // Enregistrer le chemin dans la base de données
        $user->save(); // Sauvegarder l'utilisateur
    }

    event(new Registered($user));

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
}

}
