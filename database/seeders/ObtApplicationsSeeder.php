<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vessel;
use App\Models\ShippingCompany;

class ObtApplicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vessel = Vessel::find(1);
        $vessel->applications()->create([
            'student_id' => 1,
            'status' => 'PENDING',
        ]);
        
        $shippingCompany = ShippingCompany::find(1);
        $shippingCompany->applications()->create([
            'student_id' => 1,
            'status' => 'PENDING',
        ]);
    }
}
