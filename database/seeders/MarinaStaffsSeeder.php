<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MarinaStaffs;
use App\Models\User;

class MarinaStaffsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'=>'marinastaff',
            'username'=>'marinastaff',
            'email'=>'marinastaff@marina.com',
            'password'=>'marinastaff',
            'role_id'=>9,
            'status'=>'active'
        ]);
        MarinaStaffs::create([
            'user_id'=>$user->id,
            'birthdate'=>date('1998-09-23'),
            'gender'=>'FEMALE',
            'contact_number'=>'09606695349',
            'position'=>'Staff',
            'top_level_access'=>true
        ]);
    }
}
