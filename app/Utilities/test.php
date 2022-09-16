<?php

use App\Models\User;

function oneTimeLogin()
{
    auth('web')->login(User::factory()->create());
}
