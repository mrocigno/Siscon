<?php

use Illuminate\Database\Seeder;

class PoloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('polos')->delete();
    }
}
