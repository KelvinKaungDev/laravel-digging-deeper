<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserCommand extends Command
{

    protected $signature = 'create:user {name} {email} {verified} {password?}';

    protected $description = 'Create new user';

    public function handle()
    {
        $name     = $this -> argument('name');
        $email    = $this -> argument('email');
        $verified = $this -> argument('verified') ? now() : null;
        $password = $this -> argument('password') ?? Hash::make(Str::random(8));

        User::create([
            'name'              => $name,
            'email'             => $email,
            'email_verified_at' => $verified,
            'password'          => Hash::make($password),
        ]);

        $this -> info('Create Successfully');
    }
}
