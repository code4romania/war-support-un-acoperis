<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Class PermissionTableSeeder
 */
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        /** @var array $rolesWithPermission */
        $rolesWithPermission = config('permission.types');

        if (empty($rolesWithPermission)) {
            throw new Exception('Permission types not found in permission config file');
        }

        if (!empty(Permission::all()->count())) {
            throw new Exception('Permission table is not empty');
        }

        foreach ($rolesWithPermission as $role => $permission) {
            Permission::create(['name' => $permission]);
            /** @var Role $dbRole */
            $dbRole = Role::create(['name' => $role]);
            $dbRole->givePermissionTo($permission);
        }
    }
}
