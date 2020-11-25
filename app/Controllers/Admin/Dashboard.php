<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use Config\Services;

class Dashboard extends BaseController
{
    protected $PesertaModel;

    public function __construct()
    {
        $this->PesertaModel = new PesertaModel();
    }

    public function index()
    {
        helper('security');
        $peserta = $this->PesertaModel->countAllResults();
        $valid_bayar = $this->PesertaModel->where('valid_bayar', '3')->countAllResults();
        $valid_register = $this->PesertaModel->where('valid_register_data', '3')->countAllResults();
        $data = [
            'title' => 'Admin 💻🙂📱 Dashboard',
            'letak' => 'Dashboard',
            'peserta' => $peserta,
            'valid_bayar' => $valid_bayar,
            'valid_register' => $valid_register,
        ];

        return view('admin/dashboard/index', $data);
    }
}
