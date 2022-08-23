<?php

namespace App\Models;

use CodeIgniter\Model;

class SubmissionMod extends Model
{
    protected $table = 'submission';

    protected $allowedFields = ['id_submission','title','id_regist','url','media','caption','created_at','qualified','thumbnail'];
}