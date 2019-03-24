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
        ]);//1
        Status::create([
            'status' => 'Não executado',
            'description' => 'Serviço foi executado mas não foi finalizado, geralmente acompanha um motivo por não ter sido finalizado sem ser repassado'
        ]);//2
        Status::create([
            'status' => 'Repassse',
            'description' => 'Serviço foi marcado para ser repassado, ele voltará a lista de "Distribuição de serviços"'
        ]);//3
        Status::create([
            'status' => 'Entregue',
            'description' => 'Serviço já está programado para ser executado'
        ]);//4
        Status::create([
            'status' => 'Repassado',
            'description' => 'Serviço foi repassado, este status é um pseudo executado'
        ]);//5
        Status::create([
            'status' => 'Pronto',
            'description' => 'Serviço pronto para ser distribuido'
        ]);//6
        Status::create([
            'status' => 'Sem coordenadas',
            'description' => 'Serviço pronto para ser distribuido, porém está sem coordenadas'
        ]);//7
    }
}
