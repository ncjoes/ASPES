<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create user with and admin and academia roles
        factory(User::class)->create([
            'slug'       => 'john.doe',
            'email'      => 'example@domain.com',
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'password'   => bcrypt('admin-secret'),
        ])->each(function (User $user) {
            $user->roles()->attach([
                Role::findByName(User::ROLE_ADMIN)->id,
                Role::findByName(User::ROLE_ACADEMIA)->id,
            ]);
        });

        //Creates users with password = secret-password
        factory(User::class, 100)->create()
                                ->each(function (User $user) {
                                    $user->roles()->attach(Role::findByName(User::ROLE_ACADEMIA)->id);
                                });
    }
}
