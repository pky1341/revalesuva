<?php

namespace Database\Seeders;



use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'view weight',
            'create weight',
            'edit weight',
            'delete weight',
            'view technical_support',
            'create technical_support',
            'edit technical_support',
            'delete technical_support',
            'view inquiry_service',
            'create inquiry_service',
            'edit inquiry_service',
            'delete inquiry_service',
            'view circumference',
            'create circumference',
            'edit circumference',
            'delete circumference',
            'view blood_test',
            'create blood_test',
            'edit blood_test',
            'delete blood_test',
            'view before_picture',
            'create before_picture',
            'edit before_picture',
            'delete before_picture'
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrcreate(['name' => $permission]);
        }
        
        // Create the roles
        $role = Role::updateOrcreate(['name' => 'super_admin']);

        // Give permissions to 'super_admin'
        $role->givePermissionTo(Permission::all());
        
        
        // Optionally, assign the super_admin role to a user
        $admin = User::where('email', 'admin@admin.com')->first();
        if ($admin) {
            $admin->assignRole('super_admin');
        }
    }
}
