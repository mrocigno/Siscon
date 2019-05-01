<?php

use Illuminate\Database\Seeder;
use App\ServiceType;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_type')->delete();
        ServiceType::create([
            'type' => 'default',
            'company_id' => 1
        ]);
    }
}
