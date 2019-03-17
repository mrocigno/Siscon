<?php

use Illuminate\Database\Seeder;
use App\Delivery;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery')->delete();
        Delivery::create(array(
            'company_id'     => 1,
            'name'     => 'Adicionados manualmente',
            'num_services' => 0
        ));
    }
}
