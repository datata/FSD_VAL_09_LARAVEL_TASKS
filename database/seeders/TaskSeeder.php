<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::alert("Esto es el TaskSeeder");

        DB::table('tasks')->insert(
            [
                [
                    'name' => 'comprar',
                    'description' => 'patatas',
                    'status' => false,
                ],
                [
                    'name' => 'vender',
                    'description' => 'patatas',
                    'status' => false,
                ]
            ]
        );
    }
}
