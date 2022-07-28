<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrationMod extends Model
{
    protected $table = 'registration';

    protected $allowedFields = ['id_regist','nim','id_user','id_pameran','id_lomba','payment','status','ktm','id_member'];
}