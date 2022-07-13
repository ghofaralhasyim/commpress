<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberMod extends Model
{
    protected $table = 'member';

    protected $allowedFields = ['id_member','email','password','name','last_login','created_at'];
}