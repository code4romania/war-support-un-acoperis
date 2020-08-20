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
     */
    public function run()
    {
        if (empty(Permission::all()->count())) {
            // @see https://docs.spatie.be/laravel-permission/v3/advanced-usage/cache/#manual-cache-reset
            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

            Permission::create(['name' => 'is administrator']);
            Permission::create(['name' => 'is host']);

            /** @var Role $administrator */
            $administrator = Role::create(['name' => 'administrator']);
            $administrator->givePermissionTo('is administrator');

            /** @var Role $host */
            $host = Role::create(['name' => 'host']);
            $host->givePermissionTo('is host');
        }
    }
}
