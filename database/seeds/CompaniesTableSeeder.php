<?php

use Illuminate\Database\Seeder;
use App\Companies;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->delete();
        Companies::create(array(
            'name'     => 'Siscon',
            'logo'     => 'http://sis-con.esy.es/public/img/logos/1/logo.png'
        ));
        Companies::create(array(
            'name'     => 'Planal',
            'logo'     => 'http://sis-con.esy.es/public/img/logos/2/1555769427833.png'
        ));
    }
}
