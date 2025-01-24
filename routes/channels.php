<?php
/*
 * Copyright (c) 2025.
 * Develop By: Mando
 */

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
