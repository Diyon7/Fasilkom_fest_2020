<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;

class SoalModel extends Model
{
    protected $table        = 'admins';
    protected $primaryKey   = 'id';
    protected $allowedFields = ['email', 'password', 'name', 'token'];
    protected $useTimestamps = true;
}
