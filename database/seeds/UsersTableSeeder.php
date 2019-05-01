<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'name'     => 'Matheus Rocigno',
            'email'    => 'rocignom@gmail.com',
            'password' => Hash::make('123'),
            'company_id' => 1,
            'user_type_id' => 1
        ));
        User::create(array(
            'name'     => 'Fernando Albuquerque',
            'email'    => 'fernandoh@planal.com.br',
            'password' => Hash::make('123'),
            'company_id' => 2,
            'user_type_id' => 2
        ));
    }
}
