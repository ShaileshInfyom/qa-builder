<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DefaultUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return  void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $inputUser = [
            'username' => $faker->word,
            'name' => $faker->word,
            'is_active' => $faker->boolean(true),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
            'email' => 'zane_jakubowski@yahoo.com',
            'password' => Hash::make('7FvACPTtd9QgBua'),
            'email_verified_at' => Carbon::now(),
            'user_type' => User::TYPE_USER
        ];

        $userUser  = User::create($inputUser);
        $roleUser  = Role::whereName('User')->first();
        $userUser->assignRole($roleUser);

        $inputAdmin = [
            'username' => $faker->word,
            'name' => $faker->word,
            'is_active' => $faker->boolean(true),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
            'email' => 'emilio88@gmail.com',
            'password' => Hash::make('VbGk16C6mVaQjml'),
            'email_verified_at' => Carbon::now(),
            'user_type' => User::TYPE_ADMIN
        ];

        $userAdmin  = User::create($inputAdmin);
        $roleAdmin  = Role::whereName('Admin')->first();
        $userAdmin->assignRole($roleAdmin);

        $roleSystemUser  = Role::whereName(User::DEFAULT_ROLE)->first();
        $inputSystemUser = [
            'name' => $faker->word,
            'is_active' => $faker->boolean(true),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime(),
            'username' => 'phyllis.shields',
            'email' => 'kole.greenholt@corkery.com',
            'password' => Hash::make('mtPfm)(2'),
            'email_verified_at' => Carbon::now(),
            'user_type' => User::TYPE_ADMIN
        ];

        $systemUser = User::create($inputSystemUser);
        $systemUser->assignRole($roleSystemUser);

        $permissions = Permission::all();
        $roleSystemUser->givePermissionTo($permissions);
    }
}
