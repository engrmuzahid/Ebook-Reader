<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::find(1);

        $userAdmin = User::create([
            'first_name' => 'Rick',
            'last_name' => 'William',
            'username' => 'rwilliam1001',
            'email' => 'rwilliam1001@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        $activation = Activation::create($userAdmin);
        Activation::complete($userAdmin, $activation->code);

        $adminRole->users()->attach($userAdmin);
    }
}
