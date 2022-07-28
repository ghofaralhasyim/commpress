<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaMod extends Model
{
    protected $table = 'media_content';

    protected $allowedFields = ['id_content','id_media','status','description','slug','thumbnail','url','content_type','updated_at','created_at','image','title'];
}