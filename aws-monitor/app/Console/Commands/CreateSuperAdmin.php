<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'super:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a super admin for aws monitor';

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
        $name = readline("Name (Full Name): ");
        $email = readline("Email (abc@abc.abc): ");
        $phone = readline("Phone: (0700-123456): ");
        $password = readline("Password: ");
        $confirm_password = readline("Confirm Password: ");

        if (strlen($name) > 0) {
            if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
                if (preg_match("/^[0-9]{4}-[0-9]{6}\z/", $phone)) {
                    if (strcmp($password, $confirm_password) == 0) {
                        $user = User::create(
                            [
                                'name' => $name,
                                'email' => $email,
                                'phone' => $phone,
                                'password' => Hash::make($password),
                            ]
                        );
                        $user->assignRole('super-admin');
                        return 0;
                    } else {
                        print("Password and confirm password are not the same");
                    }
                } else {
                    print("Valid phone number required");
                }
            } else {
                print('Valid email required');
            }
        } else {
            print('Name is required');
        }
        return 1;
    }
}
