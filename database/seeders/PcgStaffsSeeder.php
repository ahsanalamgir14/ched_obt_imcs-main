<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PcgStaffs;
use App\Models\User;

class PcgStaffsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'=>'pcgtaff',
            'username'=>'pcgtaff',
            'email'=>'pcgtaff@ched.com',
            'password'=>'pcgtaff',
            'role_id'=>8,
            'status'=>'active'
        ]);
        PcgStaffs::create([
            'user_id'=>$user->id,
            'rank'=>'staff',
            'unit_assigned'=>'region IX',
            'unit_address'=>'region IX',
            'birthdate'=>date('1998-09-23'),
            'contact_number'=>'09606695349',
            'top_level_access'=>true
        ]);
    }
}
