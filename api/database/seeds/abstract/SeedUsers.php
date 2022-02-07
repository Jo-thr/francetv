<?php

use App\Models\User;
use App\Models\Token;

class SeedUsers
{
    public static function make($nbUsers = 10, $nbTokens = 500)
    {
        factory(User::class, $nbUsers)
        ->create()
        ->each(function ($user) {
            $user->assignRole('editor');
        });

        factory(Token::class, $nbTokens)->create();
    }
}
