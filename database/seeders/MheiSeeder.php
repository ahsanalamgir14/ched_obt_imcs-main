<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mhei;

class MheiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mhei::create([
            'school_name'=>'Zamboanga Peninsula Polytechnic State University',
            'school_type'=>'PUBLIC',
            'region'=>'Region IX',
            'address'=>'Baliwasan, Zamboanga City',
            'status'=>'ENABLED',
        ]);
    }
}
