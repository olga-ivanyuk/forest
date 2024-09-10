<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'user@mail.ru',
                'name' => 'user',
                'password' => Hash::make(123456),
            ],
            [
                'email' => 'post@mail.ru',
                'name' => 'admin_post',
                'password' => Hash::make(123456),
            ],
            [
                'email' => 'comment@gmail.com',
                'name' => 'admin_comment',
                'password' => Hash::make(123456),
            ]
        ];

        foreach ($users as $user) {
            $user = User::query()->firstOrCreate(
                ['email' => $user['email']],
                $user
            );

            $user->profile()->create();
        }

        $this->call([
            RoleSeeder::class,
            PermissionsSeeder::class,
            UserSeeder::class,
            TagSeeder::class,
            CategorySeeder::class,
//            PostSeeder::class,
            CommentSeeder::class,
        ]);

    }
}
