<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use App\Models\BuktiPembayaransModel;
use App\Models\DataPesertaModel;
use App\Models\MemberModel;
use Config\Services;

class Team extends BaseController
{
    protected $PesertaModel;
    protected $members;
    protected $BuktiPembayaran;

    public function __construct()
    {
        $this->PesertaModel = new PesertaModel($id);
        $this->members = new MemberModel($id);
        $this->BuktiPembayaran = new BuktiPembayaransModel();
    }

    public function index()
    {
        helper('security');
        $data = [
            'title' => 'Admin 💻🙂📱 Team',
            'letak' => 'Dashboard',
        ];

        return view('admin/team/index', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $peserta = $this->PesertaModel->findAll();
            $members = $this->members->findAll();
            $data = [
                'peserta' => $peserta,
                'members' => $members,
            ];

            $msg = [
                'data' => view('admin/team/datateam', $data)
            ];
            echo json_encode($msg);
        }
    }
    public function viewdata()
    {
        if ($this->request->isAJAX()) {
            $csrfName = csrf_token();
            $csrfHash = csrf_hash();

            $dataa = $this->request->getVar('noidp');

            $members = $this->members->anggota($dataa);
            $data = [
                'anggota' => $members,
                'data' => $dataa
            ];
            $msg = [
                'sukses' => view('admin/team/anggota', $data)
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

            $dataa = $this->request->getVar('noidp');

            $members = $this->BuktiPembayaran->where('competition_team_id', $dataa)->first();
            $data = [
                'image' => $members['image'],
                'competition_team_id' => $members['competition_team_id'],
                'note' => $members['note'],
                'data' => $dataa
            ];
            $msg = [
                'sukses' => view('admin/team/bayar', $data)
            ];

            $msg[$csrfName] = $csrfHash;
            echo json_encode($msg);
        }
    }
    public function formupdatedata()
    {
        if ($this->request->isAJAX()) {
            $csrfName = csrf_token();
            $csrfHash = csrf_hash();

            $noid = htmlspecialchars($this->request->getVar('noid'));

            $editdata = $this->PesertaModel->find($noid);

            $data = [
                'id' => $editdata['id'],
                'name' => $editdata['name'],
                'email' => $editdata['email'],
                'school_name' => $editdata['school_name'],
                'valid_bayar' => $editdata['valid_bayar'],
                'valid_register_data' => $editdata['valid_register_data'],
            ];

            $msg = [
                'sukses' => view('admin/team/editteam', $data)
            ];
            $msg[$csrfName] = $csrfHash;
            echo json_encode($msg);
        }
    }
    public function updatedata()
    {

        if ($this->request->getMethod() == 'post') {
            $id = htmlspecialchars($this->request->getPost('id'));
            $teamid = $id;

            $params = [
                'valid_bayar' => htmlspecialchars($this->request->getPost('valid_bayar')),
                'valid_register_data' => htmlspecialchars($this->request->getPost('valid_register_data'))
            ];
            $update = $this->PesertaModel->update($id, $params);
            if ($update) {
                session()->setFlashdata('success', 'Data berhasil diupdate');
                return redirect()->route('admin/team');
            }
        }
    }
    public function listdata()
    {

        $csrfName = csrf_token();
        $csrfHash = csrf_hash();
        $request = Services::request();
        $regisf = $this->request->getPost('regisf');
        $bayarf = $this->request->getPost('bayarf');
        $datapesertamodel = new DataPesertaModel($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datapesertamodel->get_datatables($regisf, $bayarf);
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $team) {
                if ($team->valid_bayar == '1') {
                    $ket = 'belum membayar';
                } elseif ($team->valid_bayar == '2') {
                    $ket = "menunggu konfirmasi <br><button type=\"button\" class=\"badge badge-primary fas fa-eye\" data-toggle=\"modal\" data-target=\"#anggota\" onclick=\"bayar('$team->id')\"> Bukti</button>";
                } else {
                    $ket = "Sudah Membayar <br><button type=\"button\" class=\"badge badge-primary fas fa-eye\" data-toggle=\"modal\" data-target=\"#anggota\" onclick=\"bayar('$team->id')\"> Bukti</button>";
                }
                if ($team->valid_register_data == '1') {
                    $reg = 'belum valid';
                } elseif ($team->valid_register_data == '2') {
                    $reg = 'menunggu konfirmasi';
                } else {
                    $reg = 'valid';
                }
                $no++;
                $row = [];
                $row[] = $team->id;
                $row[] = $team->email;
                $row[] = $team->school_name;
                $row[] = $team->name;
                $row[] = "<button type=\"button\" class=\"badge badge-primary fas fa-eye\" data-toggle=\"modal\" data-target=\"#anggota\" onclick=\"peserta('$team->id')\"> Lihat</button>";
                $row[] = $ket;
                $row[] = $reg;
                $row[] = "<button type=\"button\" class=\"badge badge-primary fas fa-edit\" data-toggle=\"modal\" data-target=\"#exampleMaodal\" onclick=\"edit('$team->id')\">Edit</button>";
                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                "recordsTotal" => $datapesertamodel->count_all(),
                "recordsFiltered" => $datapesertamodel->count_filtered(),
                "data" => $data
            ];
            $output[$csrfName] = $csrfHash;
            echo json_encode($output);
        }
    }
}
