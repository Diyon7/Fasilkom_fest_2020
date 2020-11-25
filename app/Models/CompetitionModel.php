<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;

class CompetitionModel extends Model
{
    protected $table        = 'competitions';
    protected $primaryKey   = 'id';
    protected $allowedFields = ['name', 'price_to_compete', 'date_time_start', 'date_time_end'];
    protected $useTimestamps = true;

    public function team()
    {
        return $this->select('teams.id, teams.name, teams.school_name, teams.valid_register_data, teams.email, teams.valid_bayar')
            ->join('bukti_pembayarans', 'bukti_pembayarans.competition_team_id = teams.id', 'full')
            // ->join('quiz_csos', 'quiz_csos.id = answer_cso_teams.quiz_cso_id and answer_cso_teams.team_id = teams.id ')
            // ->groupby('teams.id')
            ->get()->getResultArray();
    }
}

// public function time($start)
// {
// $this-->insert('countdowntime', $start);
// if($this->db->affected_rows()>0){
// return true;
// }else{
// return false;
// }
// }

// public function select_time(){
// $this->db->select('*');
// $this->db->from('countdowntime');
// $query = $this->db->get();
// if($query->num_rows()>0){
// return $query->row();
// }
// }