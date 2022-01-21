<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->name = 'Admin';
        $admin->email = 'admin@app.com';
        $admin->password = bcrypt('12345678');
        $admin->is_admin = true;
        $admin->role = 'admin';
        $admin->save();

        $user = new User;
        $user->name = 'user1';
        $user->email = 'user1@app.com';
        $user->password = bcrypt('12345678');
        $user->is_admin = false;
        $user->role = 'user';
        $user->save();
    }
}
