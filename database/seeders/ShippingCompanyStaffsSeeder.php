<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingCompanyStaffs;
use App\Models\User;

class ShippingCompanyStaffsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'=>'company1staff',
            'username'=>'company1staff',
            'email'=>'company1staff@company1.com',
            'password'=>'company1staff',
            'role_id'=>4,
            'status'=>'active'
        ]);
        ShippingCompanyStaffs::create([
            'user_id'=>$user->id,
            'shipping_company_id'=>1,
            'birthdate'=>date('1998-09-23'),
            'position'=>'staff',
            'contact_number'=>'09606695349',
            'gender'=>'MALE',
            'top_level_access'=>true
        ]);
    }
}
