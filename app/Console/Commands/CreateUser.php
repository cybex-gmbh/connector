<?php

namespace App\Console\Commands;

use App\Models\User;
use Hash;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user
                {protectorPublicKey : The Protector public key for the user.}
                {--name= : The name of the user.}
                {--email= : The e-mail of the user.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user with a secure random password.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $name = $this->option('name');
        $email = $this->option('email');

        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('The provided email is not valid!');
            return Command::INVALID;
        }

        if ($email && User::whereEmail($email)->count()) {
            $this->error('A user with the provided email already exists!');
            return Command::INVALID;
        }

        if ($name && User::whereName($name)->count()) {
            $this->error('A user with the provided name already exists!');
            return Command::INVALID;
        }

        /*
        * Laravel passwords are usually not nullable, so we will need to set something when creating the user.
        * Since we do not want to create a Password for the user, but need to store something secure,
        * we will just generate a string of random bytes.
        */
        $user = User::firstOrCreate(['name' => $name ?? 'Collector', 'email' => $email ?? 'collector@example.com'], ['password' => Hash::make(random_bytes(300))]);

        if (!$user->wasRecentlyCreated) {
            $this->error('Default user "Collector" was already created.');
            return Command::INVALID;
        }

        $this->newLine();
        $this->info(sprintf('Successfully created new user %s: %s (%s)', $user->getKey(), $user->name, $user->email));

        $this->call('protector:token', ['userId' => $user->getKey(), '--publicKey' => $this->argument('protectorPublicKey')]);

        return Command::SUCCESS;
    }
}
