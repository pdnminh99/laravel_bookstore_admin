<?php

namespace Database\Seeders;

use App\Models\AccessRole;
use App\Models\Book;
use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'view profiles']);
        Permission::create(['name' => 'edit profiles']);
        Permission::create(['name' => 'view resources']);
        Permission::create(['name' => 'edit resources']);

        $admin_role = Role::create(['name' => AccessRole::ADMIN]);
        $admin_role->syncPermissions([
            'view profiles',
            'edit profiles',
            'view resources',
            'edit resources'
        ]);

        $editor_role = Role::create(['name' => AccessRole::EDITOR]);
        $editor_role->syncPermissions([
            'view resources',
            'edit resources'
        ]);

        $users = User::factory()
            ->count(3)
            ->create();

        array_map(function (User $user) {
            $user->assignRole(AccessRole::EDITOR);
        }, $users->all());

        Category::factory()
            ->count(5)
            ->create();
        Book::factory()
            ->count(5)
            ->create();
        Order::factory()
            ->count(50)
            ->create();
        Item::factory()
            ->count(100)
            ->create();
    }
}
