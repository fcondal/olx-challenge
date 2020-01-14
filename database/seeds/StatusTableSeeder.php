<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'name' => 'available',
            ],
            [
                'name' => 'rented',
            ],
            [
                'name' => 'closed',
            ],

        ];

        foreach ($status as $statusItem) {
            Status::create($statusItem);
        }
    }
}
