<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MheiStaffs;

class MheiStaffsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'=>'zppsustaff',
            'username'=>'zppsustaff',
            'email'=>'zppsustaff@zppsu.com',
            'password'=>'zppsustaff',
            'role_id'=>2,
            'status'=>'active'
        ]);
        MheiStaffs::create([
            'user_id'=>$user->id,
            'mhei_id'=>1,
            'birthdate'=>date('1998-09-23'),
            'gender'=>'FEMALE',
            'contact_number'=>'09606695349',
            'position'=>'Staff',
            'educational_background'=>'BS COMSCI',
            'top_level_access'=>true
        ]);
    }
}
