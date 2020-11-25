<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class DataPesertaModel extends Model
{
    protected $table = "teams";
    protected $primaryKey = "id";
    protected $column_order = array('id', 'email', 'school_name', 'name', 'name', 'valid_bayar', 'valid_register_data', null);
    protected $column_search = array('email', 'school_name', 'name', 'valid_bayar');
    protected $order = array('id' => 'asc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;

        $this->dt = $this->db->table($this->table);
    }
    private function _get_datatables_query()
    {
    }
    function get_datatables($regisf, $bayarf)
    {
        if ($regisf == "") {
            $kondisi_regisf = "";
        } else {
            $kondisi_regisf = "AND valid_register_data = '$regisf'";
        }

        if ($bayarf == "") {
            $kondisi_bayarf = "";
        } else {
            $kondisi_bayarf = "AND valid_bayar = '$bayarf'";
        }

        if ($this->request->getPost('search')['value']) {
            $search = $this->request->getPost('search')['value'];
            $kondisi_search = "email LIKE '%$search%' OR school_name LIKE '%$search%' OR name LIKE '%$search%' $kondisi_regisf $kondisi_bayarf";
        } else {
            $kondisi_search = "id != '' $kondisi_regisf $kondisi_bayarf";
        }

        $this->dt->where($kondisi_search);

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
        // $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }
    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }
}
