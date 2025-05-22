<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agenda;
use Carbon\Carbon;

class AgendaSeeder extends Seeder
{

    public function run(): void
    {
        Agenda::create([
            'name'       => 'mario',
            'phone'      => '2722733328',
            'date'       => Carbon::now()->format('Y-m-d'),
        ]);

        Agenda::factory(30)->create();

    }
}
