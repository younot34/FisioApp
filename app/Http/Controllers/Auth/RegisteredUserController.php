<?php
/*
 * Copyright (c) 2025.
 * Develop By: Mando
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register', [
            'title' => "Registrasi Pasien | " . config('app.name'),
        ]);
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 6, // Default role ID untuk user
        ]);

        Auth::login($user);

        return redirect(RouteServiceProvider::USER);
    }
}