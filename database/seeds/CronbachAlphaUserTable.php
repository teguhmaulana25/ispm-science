<?php

use Illuminate\Database\Seeder;

class CronbachAlphaUserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'label' => 'Unacceptable',
                'min' => '0',
                'max' => '0.5',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'label' => 'Poor',
                'min' => '0.5',
                'max' => '0.6',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'label' => 'Questionable',
                'min' => '0.6',
                'max' => '0.7',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'label' => 'Acceptable',
                'min' => '0.7',
                'max' => '0.8',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'label' => 'Good',
                'min' => '0.8',
                'max' => '0.9',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'label' => 'Excellent',
                'min' => '0.9',
                'max' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];
        DB::table('cronbach_alphas')->insert($data);
    }
}
