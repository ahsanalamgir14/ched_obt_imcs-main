<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MaritimeProgram;

class MaritimeProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaritimeProgram::create([
            'mhei_id'=>1,
            'course'=>'BS Marine Technology',
            'description'=>'marine tech',
            'status'=>'OFFERED'
        ]);
    }
}
