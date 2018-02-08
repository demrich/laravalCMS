<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'User')->first();
        $role_author = Role::where('name', 'Author')->first();
        $role_admin = Role::where('name', 'Admin')->first();

        $admin = new User();
        $admin->first_name = 'Dave';
        $admin->email = 'demrich@me.com';
        $admin->password = bcrypt('pass');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $author = new User();
        $author->first_name = 'auth';
        $author->email = 'auth@me.com';
        $author->password = bcrypt('pass');
        $author->save();
        $author->roles()->attach($role_author);

        $user = new User();
        $user->first_name = 'normie';
        $user->email = 'normie@me.com';
        $user->password = bcrypt('pass');
        $user->save();
        $user->roles()->attach($role_user);

    }
}
