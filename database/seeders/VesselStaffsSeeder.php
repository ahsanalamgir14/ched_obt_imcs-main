<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VesselStaffs;
use App\Models\User;

class VesselStaffsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'=>'vessel1shipmaster',
            'username'=>'vessel1shipmaster',
            'email'=>'vessel1shipmaster@vessel1.com',
            'password'=>'vessel1shipmaster',
            'role_id'=>5,
            'status'=>'active'
        ]);
        VesselStaffs::create([
            'user_id'=>$user->id,
            'vessel_id'=>1,
            'birthdate'=>date('1998-09-23'),
            'nationality'=>'Filipino',
            'rank'=>'shipmaster',
            'contact_number'=>'09606695349'
        ]);
        $user = User::create([
            'name'=>'vessel1chiefengineer',
            'username'=>'vessel1chiefengineer',
            'email'=>'vessel1chiefengineer@vessel1.com',
            'password'=>'vessel1chiefengineer',
            'role_id'=>6,
            'status'=>'active'
        ]);
        VesselStaffs::create([
            'user_id'=>$user->id,
            'vessel_id'=>1,
            'birthdate'=>date('1998-09-23'),
            'nationality'=>'Filipino',
            'rank'=>'chiefengineer',
            'contact_number'=>'09606695348'
        ]);
        $user = User::create([
            'name'=>'vessel1trainingofficer1',
            'username'=>'vessel1trainingofficer1',
            'email'=>'vessel1trainingofficer1@vessel1.com',
            'password'=>'vessel1trainingofficer1',
            'role_id'=>7,
            'status'=>'active'
        ]);
        VesselStaffs::create([
            'user_id'=>$user->id,
            'vessel_id'=>1,
            'birthdate'=>date('1998-09-23'),
            'nationality'=>'Filipino',
            'rank'=>'trainingofficer1',
            'contact_number'=>'09606695347'
        ]);
        $user = User::create([
            'name'=>'vessel1trainingofficer2',
            'username'=>'vessel1trainingofficer2',
            'email'=>'vessel1trainingofficer2@vessel1.com',
            'password'=>'vessel1trainingofficer2',
            'role_id'=>7,
            'status'=>'active'
        ]);
        VesselStaffs::create([
            'user_id'=>$user->id,
            'vessel_id'=>1,
            'birthdate'=>date('1998-09-23'),
            'nationality'=>'Filipino',
            'rank'=>'trainingofficer2',
            'contact_number'=>'09606695346'
        ]);
    }
}
