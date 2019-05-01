<?php

use Illuminate\Database\Seeder;
use App\Reports;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reports')->delete();
        Reports::create([
            'fields_json' => '[{"name":"ID do servi\u00e7o","value":"{sid}","type":"0","default":true,"show":true},{"name":"Identificador","value":"{identifier}","type":"0","default":true,"show":true},{"name":"Servi\u00e7o","value":"{description}","type":"0","default":true,"show":true},{"name":"Endere\u00e7o","value":"{address}","type":"0","default":true,"show":true}]',
            'service_type_id' => 1,
            'company_id' => 1
        ]);
    }
}
