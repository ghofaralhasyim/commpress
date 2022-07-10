<?php

namespace App\Validation;
use App\Models\UserMod;

class Userrules
{
	 public function validateUser(string $str, string $fields, array $data)
    {
        $model = new UserMod();
        $user = $model->where('email', $data['email'])
            ->first();

        if (!$user) {
            return false;
        }

        return password_verify($data['password'], $user['password']);
    }
}
