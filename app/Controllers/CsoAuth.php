<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesertaModel;


class CsoAuth extends BaseController
{

    public function index()
    {
        if ($this->request->isAJAX()) {
            $csrfName = csrf_token();
            $csrfHash = csrf_hash();
            $validation = \Config\Services::validation();

            $PesertaModel = new PesertaModel();


            $data = [
                'title' => 'Admin :) Login',
            ];

            // rules validation
            $rules = [
                'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'valid_email' => 'masukkan input email dengan benar'
                    ]
                ],
                'password' => 'required'
            ];

            if ($this->validate($rules)) {
                $data = [
                    'error' => [
                        'email' => $validation->getError('email'),
                        'password' => $validation->getError('password')
                    ]
                ];
                dd($data);
                $data[$csrfName] = $csrfHash;
                echo json_encode($data);

                $email = htmlspecialchars($this->request->getPost('email'), FILTER_SANITIZE_EMAIL);
                $password = htmlspecialchars($this->request->getPost('password'));

                // Ambil Data dari DB
                $user = $PesertaModel->where('email', $PesertaModel->escapeString($email))->first();

                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        if ($user['flag'] == 1) {
                            $userSession = [
                                'emailpesertacso' => $user['email'],
                                'idpesertacso' => $user['id'],
                            ];

                            session()->set($userSession);


                            return redirect('admin');
                        } else {
                            session()->setFlashdata('danger', 'Silahkan aktifkan akun anda dengan menekan Verifikasi Akun Anda di email yang telah kami kirim');
                            $validation = $this->validator;
                            return redirect('cso/masuk')->withInput()->with('validation', $validation);
                            // return redirect('admin/login')->withInput();
                        }
                    } else {
                        session()->setFlashdata('danger', 'Email atau Password salah');

                        $validation = $this->validator;
                        // return redirect('cso/masuk')->withInput()->with('validation', $validation);
                        // return redirect('cso');
                    }
                } else {
                    session()->setFlashdata('danger', 'Maaf Email dan Password yang kamu masukkan tidak terdaftar');

                    $validation = $this->validator;
                    // return redirect('cso/masuk')->withInput()->with('validation', $validation);
                }
            } else {
                $data['validation'] = $this->validator;
            }
            $data[$csrfName] = $csrfHash;
            echo json_encode($data);
        }
    }


    public function logout()
    {
        session()->destroy();

        return redirect()->route('admin/login');
    }
}
