<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->utype === 'USR') {
            return redirect()->route('layouts.user');
        } elseif (Auth::user()->utype === 'ADMIN') {
            return redirect()->route('layouts.adminLayout');
        }
    
        return redirect()->route('home'); // Redirection par défaut
    }
}
