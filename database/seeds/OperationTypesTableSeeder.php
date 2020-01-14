<?php

use App\OperationType;
use Illuminate\Database\Seeder;

class OperationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operationTypes = [
            [
                'name' => 'venta',
            ],
            [
                'name' => 'alquiler',
            ],
        ];

        foreach ($operationTypes as $operationType) {
            OperationType::create($operationType);
        }
    }
}
