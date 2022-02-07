<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ftv:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new admin user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Add a new admin user");
        $firstname = $this->ask("Your firstname");
        $lastname = $this->ask("Your lastname");
        $email = $this->ask("Your email");
        $password = $this->secret("Your password");

        $user = new \App\Models\User();
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->password = Hash::make($password);

        $user->assignRole('superadmin');

        $user->save();

        $this->info('done !');
        return 0;
    }
}
