<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            ['name' => 'Chelsea'],
            ['name' => 'Mancity'],
            ['name' => 'Liverpool'],
            ['name' => 'Tottiham'],
            ['name' => 'Barcelona'],
        ];
        DB::table('contacts')->insert($names);
    }
}
