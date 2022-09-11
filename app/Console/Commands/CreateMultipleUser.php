<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateMultipleUser extends Command
{
    protected $signature = 'create:multi-user {--count=} {--Q | verified}';

    protected $description = 'Create multiple user';

    public function handle()
    {
        $count = $this -> option('count');
        $bar   = $this -> output -> createProgressBar($count);
        $bar -> start();

        for($i = 1; $i <= $count; $i++)
        {
            $name     = Str::random(8);
            $email    = $name . '@gmail.com';
            $password = Hash::make(Str::random(12));
            $verified = $this -> option('verified') ? now() : null;

            User::create([
                'name'              => $name,
                'email'             => $email,
                'password'          => $password,
                'email_verified_at' => $verified
            ]);
            $bar -> advance();
        }

        $bar -> finish();
        $this -> info('Create ' . $count . ' Users Successfully.');
    }
}
