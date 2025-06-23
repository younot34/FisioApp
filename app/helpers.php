<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('userDashboardRoute')) {
    function userDashboardRoute(): string
    {
        $user = auth()->user();

        return match (true) {
            $user->hasRole('admin') => route('adm.dashboard'),
            $user->hasRole('pendaftaran') => route('front.dashboard'),
            $user->hasRole('user') => route('user.dashboard'),
            $user->hasRole('dokter') => route('dokter.pemeriksaan'),
            $user->hasRole('apotik') => '#',
            default => route('dashboard'),
        };
    }
}
