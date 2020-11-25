<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;

class BuktiPembayaransModel extends Model
{
    protected $table        = 'bukti_pembayarans';
    protected $primaryKey   = 'id';
    // protected $allowedFields = ['image', 'competition_team_id', 'note', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
