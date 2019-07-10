<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class)->create()->each(function ($user) {
            $user->bonus()->save(factory(\App\Models\User\Account\Bonus::class)->make());
            $user->bank()->save(factory(\App\Models\User\Account\Bank::class)->make());
            $user->address()->save(factory(\App\Models\User\Address::class)->make());
        });
    }
}
