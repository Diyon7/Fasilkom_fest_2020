<?php

namespace App\Controllers;

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
        $data = [
            'title' => 'Fasilkom Fest 2020',
            'peserta' => $peserta,
        ];

        return view('index', $data);
    }

    public function coba()
    {
        return view('coba/index');
    }
}
