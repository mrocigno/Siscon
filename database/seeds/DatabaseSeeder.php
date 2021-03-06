<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UserTypeSeeder');
        $this->call('UsersTableSeeder');
        $this->call('CompaniesTableSeeder');
        $this->call('ServiceTypeSeeder');
        $this->call('DeliverySeeder');
        $this->call('StatusSeeder');
        $this->call('ReportSeeder');

        Model::reguard();
    }
}
