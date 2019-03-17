<?php

use Illuminate\Database\Seeder;
use App\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserType::create([
            'name' => 'Administrador geral',
            'company_id' => 1
        ]);

        UserType::create([
            'name' => 'Administrador',
            'company_id' => 0
        ]);

        UserType::create([
            'name' => 'Usuário interno',
            'company_id' => 0
        ]);

        UserType::create([
            'name' => 'Usuário externo',
            'company_id' => 0
        ]);
    }
}
