<?php

namespace App\Models;

use CodeIgniter\Model;

class WebSettings extends Model
{
    protected $table = 'web_settings';

    protected $allowedFields = ['id_settings','media','updated_at','description','description','title'];
}