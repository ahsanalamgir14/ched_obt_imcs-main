<?php

namespace Database\Seeders\App;

use App\Models\Core\Auth\Permission;
use App\Models\Core\Auth\Role;
use App\Models\Core\Auth\User;
use Illuminate\Database\Seeder;
use App\Models\App\User\SocialLink;

class UserDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            // [
            //     'name' => 'Manager',
            //     'type_id' => 1,
            //     'created_by' => 1
            // ],
            // [
            //     'name' => 'Moderator',
            //     'type_id' => 1,
            //     'created_by' => 1
            // ],
            // [
            //     'name' => 'ADMINISTRATOR',
            //     'description' => 'System Administrator',
            //     'type_id' => 1,
            //     'created_by' => 1,
            //     'status' => 'ENABLED'
            // ],
            [
                'name' => 'MHEI STAFF',
                'description' => 'Maritime Higher Education Institutions',
                'type_id' => 1,
                'created_by' => 1,
                'status' => 'ENABLED'
            ],
            [
                'name' => 'CHED STAFF',
                'description' => 'Commission on Higher Education',
                'type_id' => 1,
                'created_by' => 1,
                'status' => 'ENABLED'
            ],
            [
                'name' => 'SHIPPING COMPANY STAFF',
                'description' => 'Shipping Company Staff to manage the company vessels',
                'type_id' => 1,
                'created_by' => 1,
                'status' => 'ENABLED'
            ],
            [
                'name' => 'SHIP MASTER',
                'description' => 'Vessel\'s Ship Master',
                'type_id' => 1,
                'created_by' => 1,
                'status' => 'ENABLED'
            ],
            [
                'name' => 'SHIP CHIEF ENGINEER',
                'description' => 'Vessel\'s Chief Engineer',
                'type_id' => 1,
                'created_by' => 1,
                'status' => 'ENABLED'
            ],
            [
                'name' => 'SHIP TRAINING OFFICER',
                'description' => 'Vessel\'s Training Officer',
                'type_id' => 1,
                'created_by' => 1,
                'status' => 'ENABLED'
            ],
            [
                'name' => 'PCG STAFF',
                'description' => 'Philippine Coast Guard',
                'type_id' => 1,
                'created_by' => 1,
                'status' => 'ENABLED'
            ],
            [
                'name' => 'MARINA STAFF',
                'description' => 'Marina',
                'type_id' => 1,
                'created_by' => 1,
                'status' => 'ENABLED'
            ],
            [
                'name' => 'STUDENT',
                'description' => 'Student',
                'type_id' => 1,
                'created_by' => 1,
                'status' => 'ENABLED'
            ]
        ]);

        $permissions = Permission::pluck('id')->toArray();
        $socialLinks = SocialLink::pluck('id')->toArray();

        Role::where('id', '!=', 1)->get()->each(function (Role $role) use ($permissions) {
            $role->permissions()->attach($permissions);
        });

        User::find(1)->assignSocialLinks($socialLinks);

        User::factory(20)->create()->each(function (User $user) use ($socialLinks) {
            $user->assignRole(Role::inRandomOrder()->first());
            $user->assignSocialLinks($socialLinks);
        });
    }
}
