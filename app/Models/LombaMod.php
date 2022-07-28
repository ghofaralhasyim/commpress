<?php

namespace App\Models;

use CodeIgniter\Model;

class LombaMod extends Model
{
    protected $table = 'lomba';

    protected $allowedFields = ['id_lomba','name','status','description','slug','media','banner','type_submission'];
}