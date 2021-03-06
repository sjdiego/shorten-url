<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateAdminAccount extends Command
{
    protected $signature = 'auth:create-admin {email?}';
    protected $description = 'Creates new admin account';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $email = $this->argument('email') ?? $this->ask('Type new email for admin account');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error(sprintf('%s is not a valid email', $email));
            return 1;
        }

        $password = Str::random(12);

        try {
            User::create([
                'name' => Str::before($email, "@"),
                'email' => $email,
                'password' => Hash::make($password)
            ]);
        } catch (\Exception $e) {
            $this->error('Error adding new account: ' . $e->getMessage());
            return 1;
        }

        $this->info(sprintf('A new user has been created with password %s', $password));
        return 0;
    }
}
