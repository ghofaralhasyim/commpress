<?php

namespace App\Models;

use CodeIgniter\Model;

class UserMod extends Model
{
    protected $table = 'member';

    protected $allowedFields = ['id_member','email','role','password','name','last_login','created_at','ktm','id_line','phone','univ','nim','picture'];
}