<?php

use App\Kind;
use Illuminate\Database\Seeder;

class KindsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kinds = [
            [
                'name' => 'casa',
            ],
            [
                'name' => 'departamento',
            ],
            [
                'name' => 'PH',
            ],
            [
                'name' => 'local',
            ],
            [
                'name' => 'campo',
            ],
            [
                'name' => 'quinta',
            ],

        ];

        foreach ($kinds as $kind) {
            Kind::create($kind);
        }
    }
}
