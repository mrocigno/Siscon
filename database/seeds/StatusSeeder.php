<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('status')->delete();
        Status::create([
            'status' => 'Executado',
            'description' => 'Serviço foi executado e finalizado com sucesso'
        ]);
        Status::create([
            'status' => 'Não executado',
            'description' => 'Serviço foi executado mas não foi finalizado, geralmente acompanha um motivo por não ter sido finalizado sem ser repassado'
        ]);
        Status::create([
            'status' => 'Repassse',
            'description' => 'Serviço foi marcado para ser repassado, ele voltará a lista de "Distribuição de serviços"'
        ]);
        Status::create([
            'status' => 'Entregue',
            'description' => 'Serviço já está programado para ser executado'
        ]);
    }
}
