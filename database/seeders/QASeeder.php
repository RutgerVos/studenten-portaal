<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QA;
use Carbon\Carbon;

class QASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QA::insert([
            'question' => 'Waar kan ik goed stagebedrijven opzoeken?',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        QA::insert([
            'question' => 'Waar kan ik mijn schoolboeken bestellen?',
            'user_id' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        QA::insert([
            'question' => 'Wat vind Da Vinci van het dragen van een pet op school?',
            'user_id' => 3,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
