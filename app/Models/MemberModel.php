<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;

class MemberModel extends Model
{
    protected $table        = 'members';
    protected $primaryKey   = 'id';
    protected $allowedFields = ['team_id', 'full_name', 'handphone', 'line', 'image_student_card', 'gender', 'ketua_tim', 'flag'];
    protected $useTimestamps = true;

    public function anggota($dataa)
    {
        return $this->select()
            ->where('team_id', $dataa)
            ->get()->getResultArray();
    }
}
