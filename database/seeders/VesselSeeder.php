<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vessel;

class VesselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vessel::create([
            'shipping_company_id'=>1,
            'imo_number'=>'9035644',
            'registry_number'=> '341128001',
            'vessel_name'=> 'Dapitan Bay 1',
            'vessel_type'=> 'Vehicles Carrier',
            'grt'=> 7073,
            'kw'=> 6825,
            'flag'=> 'Philippines',
            'route'=> 'n/a',
        ]);
    }
}
