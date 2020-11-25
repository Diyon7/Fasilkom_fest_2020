<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;

class MailersModel extends Model
{
    protected $table        = 'mailers';
    protected $primaryKey   = 'id';
    protected $allowedFields = ['team_id', 'subject', 'content'];
    protected $useTimestamps = true;


    public function sendemail($email)
    {
        return $this->select('teams.email, teams.id, teams.email, mailers.subject, mailers.content')
            ->join('teams', 'mailers.team_id = teams.id', 'right')
            ->where('teams.email', $email)
            ->get()->getResultArray();
    }
}
