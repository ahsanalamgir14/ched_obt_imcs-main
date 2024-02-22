<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingCompany;

class ShippingCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingCompany::create([
            'company_name'=>'Carlos A. Gothong Lines (CAGLI)',
            'address'=>'Alfredo Gothong Private Wharf FF Cruz, Pier 7, Reclamation Area,, Mandaue City, Philippines',
            'contact_number'=>'09777777777'
        ]);
    }
}
