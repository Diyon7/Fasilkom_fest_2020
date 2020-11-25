<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use App\Models\MailersModel;
use App\Models\CompetitionModel;
use Config\Services;

class Email extends BaseController
{
    protected $MailersModel;
    protected $PesertaModel;
    protected $CompetitiomModel;

    public function __construct()
    {
        $this->PesertaModel = new PesertaModel();
        $this->MailersModel = new MailersModel();
        $this->CompetitionModel = new CompetitionModel();
        $this->email = \Config\Services::email();
    }

    public function index()
    {

        $peserta = $this->PesertaModel->findAll();
        $tvrpeserta = $this->PesertaModel->where('valid_register_data', '3')->countAllResults();
        $tvbpeserta = $this->PesertaModel->where('valid_bayar', '3')->countAllResults();
        $tvrmailers = $this->MailersModel->where('subject', 'Register Success')->countAllResults();
        $tvbmailers = $this->MailersModel->where('subject', 'Pembayaran berhasil')->countAllResults();
        $data = [
            'title' => 'Admin 💻🙂📱 Email',
            'letak' => 'Dashboard',
            'peserta' => $peserta,
            'tvrpeserta' => $tvrpeserta,
            'tvbpeserta' => $tvbpeserta,
            'tvrmailers' => $tvrmailers,
            'tvbmailers' => $tvbmailers
        ];

        return view('admin/email/index', $data);
    }

    public function manual()
    {
        if ($this->request->isAJAX()) {
            $csrfName = csrf_token();
            $csrfHash = csrf_hash();

            $peserta = $this->PesertaModel->findAll();
            $blmkirimreg = $this->MailersModel->findAll();

            $data = [
                'peserta' => $peserta,
            ];
            $msg = [
                'sukses' => view('admin/email/manual', $data)
            ];

            $msg[$csrfName] = $csrfHash;
            echo json_encode($msg);
        }
    }
    public function register()
    {
        if ($this->request->isAJAX()) {
            $csrfName = csrf_token();
            $csrfHash = csrf_hash();

            $peserta = $this->PesertaModel->where('valid_register_data', '3')->get()->getResultArray();
            $data = [
                'peserta' => $peserta,
            ];
            $msg = [
                'sukses' => view('admin/email/register', $data)
            ];

            $msg[$csrfName] = $csrfHash;
            echo json_encode($msg);
        }
    }
    public function bayar()
    {
        if ($this->request->isAJAX()) {
            $csrfName = csrf_token();
            $csrfHash = csrf_hash();

            $pesertab = $this->PesertaModel->where('valid_bayar', '3')->get()->getResultArray();
            $data = [
                'peserta' => $pesertab,
            ];
            $msg = [
                'sukses' => view('admin/email/bayar', $data)
            ];

            $msg[$csrfName] = $csrfHash;
            echo json_encode($msg);
        }
    }

    public function alertemail()
    {
        $time = $this->CompetitionModel->find('date_time_start');
        $peserta = $this->PesertaModel->findAll();

        foreach ($peserta as $nama => $alamat) {
            $this->email->clear();

            $this->email->setFrom('no-reply@fasilkomfest2020.com', 'fasilkomfest');
            $this->email->setTo($nama);

            $this->email->setSubject();
            $this->email->setMessage();
        }
    }

    public function chat()
    {

        $email = htmlspecialchars($this->request->getVar('email', FILTER_SANITIZE_EMAIL));
        $subject = htmlspecialchars($this->request->getPost('subjek'));
        $deskripsi = $this->request->getPost('deskripsi');

        $sendemail = $this->MailersModel->sendemail($email);
        foreach ($sendemail as $emails) {
            if ($emails['id'] == '') {
            } else {

                $team_id = $emails['id'];
                $params = [
                    'team_id' => $team_id,
                    'email' => $email,
                    'subject' => $subject,
                    'content' => $deskripsi
                ];
                $this->MailersModel->insert($params);

                $send = $this->sendemail($params);

                return redirect()->to(site_url('admin/sendemail'));
            }
        }
        session()->setFlashdata('error', 'email belum terdaftar');
        return redirect()->to(site_url('admin/sendemail'));
    }

    private function sendemail($params)
    {
        $this->email->setFrom('jangan balas email ini', 'fasilkomfest');
        $this->email->setTo($params['email']);

        $this->email->setSubject($params['subject']);
        $this->email->setMessage($params['content']);

        if (!$this->email->send()) {
            session()->setFlashdata('error', 'Belum berhasil Mengirim Email');
            return true;
        } else {
            session()->setFlashdata('success', 'Berhasil Mengirim Email');
            return true;
        }
    }
}
