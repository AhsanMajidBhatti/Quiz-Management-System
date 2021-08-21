<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
        $admin->name = "Ahsan Admin";
        $admin->email = "admin@gmail.com";
        $admin->password = bcrypt('password');
        $admin->visible_password = "password";
        $admin->email_verified_at = NOW();
        $admin->occupation = "CEO";
        $admin->address = "Karachi";
        $admin->phone = "05444856";
        $admin->is_admin = 1;
        $admin->save();
    }
}