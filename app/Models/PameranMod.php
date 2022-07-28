<?php

namespace App\Models;

use CodeIgniter\Model;

class PameranMod extends Model
{
    protected $table = 'pameran';

    protected $allowedFields = ['id_pameran','name','status','description','slug','thumbnail','banner','type_submission'];
}