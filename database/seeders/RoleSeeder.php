<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'super_admin',
            'admin_posts',
            'admin_comments',
            'admin_users',
        ];

        foreach ($roles as $role) {
            Role::query()
                ->firstOrCreate(['name' => $role]);
        }

        $super_admin = User::query()->where('email', 'user@mail.ru')->first();
        $admin_posts = User::query()->where('email', 'post@mail.ru')->first();
        $admin_comments = User::query()->where('email', 'comment@gmail.com')->first();
        $role1 = Role::query()->where('name', Role::ROLE_SUPER_ADMIN)->first();
        $role2 = Role::query()->where('name', Role::ROLE_ADMIN_POSTS)->first();
        $role3 = Role::query()->where('name', Role::ROLE_ADMIN_COMMENTS)->first();

        $super_admin->roles()->sync([$role1->id]);
        $admin_posts->roles()->sync([$role2->id]);
        $admin_comments->roles()->sync([$role3->id]);
    }
}
