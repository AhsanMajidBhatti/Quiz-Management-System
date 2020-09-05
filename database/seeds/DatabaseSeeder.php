<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = "Admin";
        $admin->email = "admin@gmail.com";
        $admin->email_verified_at = NOW();
        $admin->password = bcrypt("password");
        $admin->visible_password = "password";
        $admin->occupation = "Project Manager";
        $admin->address = "Pakistan";
        $admin->phone = "0321-2200339";
        $admin->is_admin = 1;
        $admin->save();
    }
}
