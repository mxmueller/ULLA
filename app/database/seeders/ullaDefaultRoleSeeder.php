<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class ullaDefaultRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff = Role::create([
            'name' => 'staff',
            'display_name' => 'Default User', // optional
            'description' => 'The default user or staff user can create requests, assign them to an executive user and has access to his user dashboard. The staff user role is assigned by default when a user registers.', // optional
        ]);

        $executive = Role::create([
            'name' => 'executive',
            'display_name' => 'Executive User', // optional
            'description' => 'The executive user has all the rights of the staff user and also has the ability to deny or allow requests assigned to him. This role is usually assigned to superiors, department heads and management.', // optional
        ]);

        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin User', // optional
            'description' => 'The Admin user is only available for administrative purposes. He can assign user roles and delete users from the database.', // optional
        ]);

        $accounting = Role::create([
            'name' => 'accounting',
            'display_name' => 'Accounting User', // optional
            'description' => 'The accounting has all the rights of the staff user, but not those of the executive group. This role is intended for the administration of a company to view the vacation requests that all employees have submitted and that have been granted.', // optional
        ]);

    }
}
