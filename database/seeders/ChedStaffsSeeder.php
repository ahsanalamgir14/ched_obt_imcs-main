<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChedStaffs;
use App\Models\User;

class ChedStaffsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'=>'chedstaff',
            'username'=>'chedstaff',
            'email'=>'chedstaff@ched.com',
            'password'=>'chedstaff',
            'role_id'=>3,
            'status'=>'active'
        ]);
        ChedStaffs::create([
            'user_id'=>$user->id,
            'position'=>'staff',
            'regional_office_assigned'=>'region IX',
            'birthdate'=>date('1998-09-23'),
            'contact_number'=>'09606695349',
            'top_level_access'=>true
        ]);
    }
}
