<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'title'=>'ADMINISTRATOR',
            'description'=>'System Administrator',
            'status'=>'ENABLED'
        ]);
        Role::create([
            'title'=>'MHEI STAFF',
            'description'=>'Maritime Higher Education Institutions',
            'status'=>'ENABLED'
        ]);
        Role::create([
            'title'=>'CHED STAFF',
            'description'=>'Commission on Higher Education',
            'status'=>'ENABLED'
        ]);
        Role::create([
            'title'=>'SHIPPING COMPANY STAFF',
            'description'=>'Shipping Company Staff to manage the company vessels',
            'status'=>'ENABLED'
        ]);
        Role::create([
            'title'=>'SHIP MASTER',
            'description'=>'Vessel\'s Ship Master',
            'status'=>'ENABLED'
        ]);
        Role::create([
            'title'=>'SHIP CHIEF ENGINEER',
            'description'=>'Vessel\'s Chief Engineer',
            'status'=>'ENABLED'
        ]);
        Role::create([
            'title'=>'SHIP TRAINING OFFICER',
            'description'=>'Vessel\'s Training Officer',
            'status'=>'ENABLED'
        ]);
        Role::create([
            'title'=>'PCG STAFF',
            'description'=>'Philippine Coast Guard',
            'status'=>'ENABLED'
        ]);
        Role::create([
            'title'=>'MARINA STAFF',
            'description'=>'Marina',
            'status'=>'ENABLED'
        ]);
        Role::create([
            'title'=>'STUDENT',
            'description'=>'Student',
            'status'=>'ENABLED'
        ]);
    }
}
