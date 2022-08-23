<?php

namespace App\Models;

use CodeIgniter\Model;

class MedsponMod extends Model
{
    protected $table = 'media_sponsor';

    protected $allowedFields = ['id_media_sponsor','name','url','media'];
}