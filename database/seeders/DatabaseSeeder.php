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
        $user = new User();
        $user->first_name = 'Naufal';
        $user->last_name = 'Naufal';
        $user->email = 'nazor.dz@gmail.com';
        $user->gender = 'MAN';
        $user->birth_date = '1999-09-16';
        $user->password = bcrypt('root');
        $user->save();
        User::factory(10)->create();
    }
}
