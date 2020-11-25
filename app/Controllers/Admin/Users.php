<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\AdminsModel;
use Config\Services;

class Users extends BaseController
{
    protected $UsersModel;
    protected $AdminsModel;

    public function __construct()
    {
        $this->AdminsModel = new AdminsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Admin 💻🙂📱 Users',
            'letak' => 'Users',
        ];

        return view('admin/users/index', $data);
    }

    public function formadd()
    {
        helper('form');
        if ($this->request->isAJAX()) {
            $csrfName = csrf_token();
            $csrfHash = csrf_hash();

            $msg = [
                'sukses' => view('admin/users/add')
            ];

            $msg[$csrfName] = $csrfHash;
            echo json_encode($msg);
        }
    }

    public function add()
    {
        if ($this->request->isAJAX()) {
            $csrfName = csrf_token();
            $csrfHash = csrf_hash();
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'email' => [
                    'label' => 'email',
                    'rules' => 'required|valid_email|is_unique[admins.email]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'valid_email' => 'masukkan input email dengan benar',
                        'is_unique' => 'email sudah digunakan'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => 'Password Minimal 5 karakter'
                    ]
                ]

            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'email' => $validation->getError('email'),
                        'password' => $validation->getError('password')
                    ]
                ];
                $data[$csrfName] = $csrfHash;
                echo json_encode($data);
            } else {
                $save = [
                    'email' => htmlspecialchars($this->request->getPost('email')),
                    'password' => htmlspecialchars(password_hash($this->request->getPost('password'), PASSWORD_DEFAULT))
                ];

                $insert = $this->AdminsModel->insert($save);

                if ($insert) {
                    session()->setFlashdata('success', 'Admin Berhasil Dibuat');
                    $data[$csrfName] = $csrfHash;
                    echo json_encode($data);
                }
            }
        }
    }

    public function delete()
    {
        if ($this->request->getMethod() == 'post') {
            $id = htmlspecialchars($this->request->getPost('id'));
            $delete = $this->AdminsModel->delete($this->AdminsModel->escapeString($id));
            if ($delete) {
                session()->setFlashdata('success', 'User admin berhasil dihapus');
                return redirect()->route('admin/users');
            } else {
                session()->setFlashdata('danger', 'Tidak dihapus');
                return redirect()->route('admin/users');
            }
        }
    }

    public function listdata()
    {

        $csrfName = csrf_token();
        $csrfHash = csrf_hash();
        $request = Services::request();
        $UsersModel = new UsersModel($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $UsersModel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $team) {

                if ($team->email != 'fasilkomfest2020@fasilkom.ff') {
                    $no++;
                    $row = [];
                    $row[] = $team->id;
                    $row[] = $team->email;
                    $row[] = $team->created_at;
                    $row[] = '<button class="badge badge-danger"><a class="badge-danger fas fa-trash btn-delete" href="javascript:void(0)" data-id="' . $team->id . '">Hapus</a></button>';
                    $data[] = $row;
                }
            }
            $output = [
                "draw" => $request->getPost('draw'),
                "recordsTotal" => $UsersModel->count_all(),
                "recordsFiltered" => $UsersModel->count_filtered(),
                "data" => $data
            ];
            $output[$csrfName] = $csrfHash;
            echo json_encode($output);
        }
    }
}
