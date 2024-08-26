<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operations = [
            [
                'type' => 'addition',
                'cost' => 5, 
            ],
            [
                'type' => 'subtraction',
                'cost' => 5,
            ],
            [
                'type' => 'multiplication',
                'cost' => 50,
            ],
            [
                'type' => 'division',
                'cost' => 5,
            ],
            [
                'type' => 'square_root',
                'cost' => 5,
            ],
            [
                'type' => 'random_string',
                'cost' => 10, 
            ],
        ];

        // Insert the data into the operations table
        foreach ($operations as $operation) {
            DB::table('operations')->insert($operation);
        }
    }
}
