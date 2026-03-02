<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Role
        $admin = Role::create(['name' => 'admin']);
        $staff = Role::create(['name' => 'staff']);

        // 2. Buat Permission (Contoh)
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'manage master data']);

        // 3. Kasih Permission ke Role
        $admin->givePermissionTo(['delete products', 'manage master data']);

        // 4. Assign Role ke User yang sudah ada (Misal ID 1)
        $user = User::find(1);
        if($user) {
            $user->assignRole('admin');
        }
    }
}
