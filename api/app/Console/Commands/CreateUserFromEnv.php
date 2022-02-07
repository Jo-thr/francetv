<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserFromEnv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ftv:user:dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user based on env variable';

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
        $email = env('DEV_USER');
        $password = env('DEV_PASSWORD');

        $user = new User();
        $user->password = Hash::make($password);
        $user->email = $email;
        $user->firstname = 'admin';
        $user->lastname = 'admin';

        $user->assignRole('superadmin');
        $user->save();

        $this->info('user '.$email.' created !');
        $this->info('head to '.env('APP_URL').'admin');

        return 0;
    }
}
