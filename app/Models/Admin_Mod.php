<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin_Mod extends Model
{
    protected $table = 'user';

    protected $allowedFields = ['id_user','username','password','privilage','divisi'];
}