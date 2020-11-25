<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;

class PesertaModel extends Model
{
    protected $table        = 'teams';
    protected $primaryKey   = 'id';
    protected $allowedFields = ['name', 'school_name', 'email', 'token', 'valid_bayar', 'valid_register_data', 'note_register_data', 'valid_on_off', 'qualified_final', 'flag', 'login'];
    protected $useTimestamps = true;

    protected $primary = array('id');

    public function team()
    {
        return $this->select('teams.id, teams.name, teams.school_name, teams.valid_register_data, teams.email, teams.valid_bayar')
            ->join('bukti_pembayarans', 'bukti_pembayarans.competition_team_id = teams.id', 'full')
            // ->join('quiz_csos', 'quiz_csos.id = answer_cso_teams.quiz_cso_id and answer_cso_teams.team_id = teams.id ')
            // ->groupby('teams.id')
            ->get()->getResultArray();
    }

    public function verifytoken($id)
    {
        $activate = $this->select('token, flag')
            ->where('token', $id);
        $result = $activate->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRow();
        }
    }
    public function verifytokenp($id)
    {
        $activate = $this->select('token, flag')
            ->where('token', $id);
        $result = $activate->get();
        if (count($result->getResultArray()) == 1) {
            return $result->getRowArray();
        }
    }

    public function updateflag($id)
    {
        return $this->select()
            ->where('token', $id)
            ->update(['flag' => 1]);
    }

    public function verifyemail($email)
    {
        $activate = $this->select('id, name, token, flag')
            ->where('email', $email);
        $result = $activate->get();
        if ($activate->countAll() == 1) {
            return $result->getRowArray();
        }
    }
    public function updateAt($id)
    {
        $activate = $this->select('name, token, flag')
            ->where('token', $id)
            ->update(['update_at' => date('Y-m-d h:i:s')]);
        return $activate;
        // if ($activate->countAll() == 1) {
        //     return $result->getRowArray();
        // }
    }
    public function updatepassword($token, $password)
    {
        $activate = $this->select('name, token, flag')
            ->where('token', $token)
            ->update(['password' => $password]);
        return $activate;
        // if ($activate->countAll() == 1) {
        //     return $result->getRowArray();
        // }
    }
}
