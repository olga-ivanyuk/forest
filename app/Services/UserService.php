<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public static function create(array $data)
    {
        $user = User::query()->create($data);

        if (isset($data['role'])) {
            $user->roles()->attach($data['role']);
        }

        return $user;

//        return User::query()
//            ->create($data);
    }

    public static function update(array $data, User $user): User
    {
        $user->update($data);

        return $user;
    }
}
