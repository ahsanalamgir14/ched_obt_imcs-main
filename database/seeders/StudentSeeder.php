<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'=>'student',
            'username'=>'student',
            'email'=>'student@zppsu.com',
            'password'=>'DP-eP9QsH',
            // 'password'=>'DP-'.substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,6),
            'role_id'=>10,
            'status'=>'active'
        ]);
        Student::create([
            'user_id'=>$user->id,
            'maritime_program_id'=>1,
            'student_number'=>'2023-12012',
            'sirb_number'=> '',
            'sid_number'=> '',
            'gender'=>'MALE',
            'birthdate'=>date('1998-09-23'),
            'address'=>'Guiwan, Zamboanga City',
            'civil_status'=>'single',
            'citizenship'=>'Filipino',
            'religion'=>'Roman Catholic',
            'height'=>178,
            'weight'=>56,
            'contact_number'=>'09606695349',
        ]);
    }
}
