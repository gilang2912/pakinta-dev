<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthtenticatedController extends Controller
{
    public function login()
    {
        return Inertia::render('auth/Login');
    }
}
