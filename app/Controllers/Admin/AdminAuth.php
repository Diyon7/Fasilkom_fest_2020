<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminsModel;

class AdminAuth extends BaseController
{

    public function index()
    {
        helper(['form', 'url']);
        $AdminModel = new AdminsModel();

        $data = [
            'title' => 'Admin :) Login',
        ];

        if ($this->request->getMethod() == 'post') {
            // rules validation
            $rules = [
                // 'email' => 'required|valid_email',
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'valid_email' => 'masukkan input email dengan benar'
                    ]
                ],
                'password' => 'required|min_length[3]'
            ];

            if ($this->validate($rules)) {
                $email = htmlspecialchars($this->request->getPost('email'));
                $password = htmlspecialchars($this->request->getPost('password'));

                // Ambil Data dari DB
                $user = $AdminModel->where('email', $AdminModel->escapeString($email))->first();

                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        $userSession = [
                            'emaila' => $user['email'],
                        ];

                        session()->set($userSession);


                        return redirect('admin');
                    } else {
                        session()->setFlashdata('danger', 'Email atau Password salah');

                        return redirect()->to(current_url());
                    }
                } else {
                    session()->setFlashdata('danger', 'Maaf Email dan Password yang kamu masukkan tidak terdaftar');

                    return redirect()->to(current_url());
                }
            } else {
                // $validation = \Config\Services::validation();
                // $data['validation'] = $validation;
                $data['validation'] = $this->validator;
            }
        }

        return view('Admin/Auth/Index', $data);
    }
    public function logout()
    {
        session()->destroy();

        return redirect()->route('admin/login');
    }
}
