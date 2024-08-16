<?php

namespace App\Services;

use App\Models\Profile;

class ProfileService
{
    public static function create(array $data)
    {
        return Profile::query()
            ->create($data);
    }

    public static function update(array $data, $profile)
    {
        $profile->update($data);

        return $profile;
    }
}
