<?php

namespace App\Models;

use CodeIgniter\Model;

class DataOprec_Mod extends Model
{
    protected $table = 'data_oprec';

    protected $allowedFields = ['id','name','divisi','nim'];
}