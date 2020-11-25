<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use App\Models\MailersModel;
use App\Models\MemberModel;
use App\Models\BuktiPembayaransModel;
use App\Models\CompetitionModel;
use Config\Services;

class Cso extends BaseController
{
    protected $MailersModel;
    protected $PesertaModel;
    protected $MemberModel;
    protected $BuktiPembayaransModel;
    protected $CompetitionModel;

    public function __construct()
    {
        $this->MailersModel = new MailersModel();
        $this->PesertaModel = new PesertaModel();
        $this->MemberModel = new MemberModel();
        $this->BuktiPembayaransModel = new BuktiPembayaransModel();
        $this->CompetitionModel = new CompetitionModel();
        $this->email = \Config\Services::email();
    }

    public function index()
    {
        helper('security');

        $countdown = $this->CompetitionModel->where('name', 'Computer Science Olympiad')->first();

        $data = [
            'title' => 'Computer Science Competition Fasilkom Fest 2020',
            'time' => $countdown['date_time_start'],
        ];

        return view('cso', $data);
    }

    public function login()
    {
        if ($this->request->isAJAX()) {
            $csrfName = csrf_token();
            $csrfHash = csrf_hash();

            $msg = [
                'sukses' => view('csologin')
            ];

            $msg[$csrfName] = $csrfHash;
            echo json_encode($msg);
        }
        // $data = [
        //     'title' => 'Computer Science Competition Fasilkom Fest 2020',
        //     'validation' => $this->validator
        // ];

        // return view('csologin', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Computer Science Competition Fasilkom Fest 2020',
            'validation' => $this->validator
        ];

        return view('cso-register', $data);
    }

    public function edit_team()
    {

        if ($this->request->getMethod == 'post') {
            $rules = [
                'namatim' => [
                    'label' => 'namatim',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi',
                    ]
                ],
                'asalsekolah' => [
                    'label' => 'asalsekolah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi',
                    ]
                ],
            ];

            if ($this->validate($rules)) {

                $id = $this->session->get('idpesertacso');

                $data = [
                    'tim' => $this->PesertaModel->find($id),
                ];


                $params = [
                    'name' => htmlspecialchars($this->request->getPost('namatim')),
                    'asalsekolah' => htmlspecialchars($this->request->getPost('asalsekolah')),
                ];

                $updatetim = $this->PesertaModel->update($id, $params);

                if ($updatetim) {
                    session()->setFlashdata('success', 'Update berhasil');
                } else {
                    session()->setFlashdata('error', 'Error');
                }


                return view('', $data);
            }
        }
    }

    public function save()
    // redirect
    {
        helper(['form']);

        $data = [];

        if ($this->request->getMethod() == 'post') {
            // rules validation
            $rules = [
                'namatim' => [
                    'label' => 'namatim',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi',
                    ]
                ],
                'nama' => [
                    'label' => 'nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi',
                    ]
                ],
                'jk' => [
                    'label' => 'jenis kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi',
                    ]
                ],
                'nowhatsapp' => [
                    'label' => 'nowhatsapp',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi',
                    ]
                ],
                'email' => [
                    'label' => 'email',
                    'rules' => 'required|valid_email|is_unique[teams.email]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'valid_email' => 'masukkan input email dengan benar',
                        'is_unique' => 'Email anda sudah terdaftar sebelumnya'
                    ]
                ],
                'asalsekolah' => [
                    'label' => 'asalsekolah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi',
                    ]
                ],
                'fototeam'    => [
                    'rules' => 'uploaded[fototeam]|mime_in[fototeam,image/jpg,image/jpeg,image/png]|is_image[fototeam]|max_size[fototeam,2096]',
                    'errors' => [
                        'uploaded' => 'Pilih Gambar terlebih dahulu',
                        'max_size' => 'Gambar ukuran maksimal 2MB',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => 'Password Minimal 5 karakter'
                    ]
                ],
                'cpassword' => [
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'matches' => 'Password harus sama'
                    ]
                ],
            ];

            if ($this->validate($rules)) {

                $file = $this->request->getFile('fototeam');

                $uploadFile = $this->upload_image($file);


                $token = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()));

                $paramsteam = [
                    'name' => htmlspecialchars($this->request->getPost('namatim')),
                    'email' => htmlspecialchars($this->request->getPost('email')),
                    'asalsekolah' => htmlspecialchars($this->request->getPost('asalsekolah')),
                    'token' => $token,
                    'password' => password_hash(htmlspecialchars($this->request->getPost('nama')), PASSWORD_DEFAULT),
                ];

                $peserta = $this->PesertaModel->insert($paramsteam);

                if ($peserta) {

                    $datapeserta = $this->PesertaModel->where('token', $paramsteam['token'])->first();

                    $paramsmembers = [
                        'team_id' => $datapeserta['id'],
                        'full_nama' => htmlspecialchars($this->request->getPost('nama')),
                        'gender' => htmlspecialchars($this->request->getPost('jk')),
                        'handphone' => htmlspecialchars($this->request->getPost('nowhatsapp')),
                        'foto' => $uploadFile,
                        'ketua_tim' => 1,
                    ];

                    $anggota = $this->MemberModel->insert($paramsmembers);

                    if ($anggota) {

                        $to = htmlspecialchars($this->request->getVar('email'));
                        $subject = 'Hi ' . $this->request->getPost('nama') . 'Silahkan memverifikasi akun anda';
                        $message = '<h3>Halo' . $this->request->getPost('namatim') . "</h3><br><br> telah berhasil terdaftar dalam sistem untuk mengikuti lomba Computer Science Olympiad. Mohon untuk menverivikasi akun email anda<br><br>" .
                            "<a href='" . base_url() . "/cso/register/activate/" . $token . "'>Verifikasi Akun Anda</a><br>" .
                            "atau menyalin link berikut ini : <br>" . "<a href='" . base_url() . "/register/activate/" . $token . "'>" . base_url() . "/register/activate/" . $token . "</a>";

                        $sendemail = $this->MailersModel->sendemail($to);

                        foreach ($sendemail as $emails) {
                            if ($emails['id'] == '') {
                            } else {

                                $team_id = $emails['id'];
                                $params = [
                                    'team_id' => $team_id,
                                    'email' => $to,
                                    'subject' => $subject,
                                    'content' => $message
                                ];
                                $this->MailersModel->insert($params);

                                $this->email->setFrom('jangan balas email ini', 'fasilkomfest');
                                $this->email->setTo($params['email']);

                                $this->email->setSubject($params['subject']);
                                $this->email->setMessage($params['content']);

                                if (!$this->email->send()) {
                                    session()->setFlashdata('error', 'Error');
                                    return redirect(current_url());
                                } else {
                                    session()->setFlashdata('success', 'Akun berhasil dibuat, cek email anda');
                                    return redirect(current_url());
                                }

                                return redirect()->to(site_url('cso'));
                            }
                        }
                    }
                }
            } else {
                $validation = $this->validator;
                return redirect('cso/masuk')->withInput()->with('validation', $validation);
            }
        }
        return view('', $data);
    }

    public function forgot_password()
    // redirect
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => [
                    'label' => 'email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'valid_email' => 'masukkan input email dengan benar'
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $email = $this->request->getVar('email', FILTER_SANITIZE_EMAIL);
                $datauser = $this->PesertaModel->verifyemail($email);
                if (!empty($datauser)) {
                    if ($this->PesertaModel->updateAt($datauser['token'])) {
                        $to = $email;
                        $subject = 'Reset Password';
                        $message = "Klik Link Untuk Resser Password<br><br>" .
                            "<a href='" . base_url() . "/cso/rpass/" . $datauser['token'] . "'>Reset Password</a><br>" .
                            "atau menyalin link berikut ini : <br>" . "<a href='" . base_url() . "/cso/rpass/" . $datauser['token'] . "'>" . base_url() . "/cso/rpass/" . $datauser['token'] . "</a>";

                        $sendemail = $this->MailersModel->sendemail($to);

                        foreach ($sendemail as $emails) {
                            if ($emails['id'] == '') {
                            } else {

                                $team_id = $emails['id'];
                                $params = [
                                    'team_id' => $team_id,
                                    'email' => $to,
                                    'subject' => $subject,
                                    'content' => $message
                                ];
                                $this->MailersModel->insert($params);

                                $this->email->setFrom('jangan balas email ini', 'fasilkomfest');
                                $this->email->setTo($params['email']);

                                $this->email->setSubject($params['subject']);
                                $this->email->setMessage($params['content']);

                                if (!$this->email->send()) {
                                    session()->setFlashdata('error', 'Belum berhasil Mengirim Email');
                                    return redirect();
                                } else {
                                    session()->setFlashdata('success', 'Silahkan cek email anda');
                                    return redirect();
                                }

                                return redirect()->to(site_url('admin/sendemail'));
                            }
                        }
                    }
                } else {
                    session()->setFlashdata('error', 'Alamat Email belum terdaftar');
                    return redirect()->to(current_url());
                }
            }
        }
    }

    public function reset_password($token = null)
    // redirect
    {
        $data = [];

        if (!empty($token)) {
            $userdata = $this->PesertaModel->verifytokenp($token);

            if (!empty($userdata)) {
                if ($this->request->getMethod == 'post') {
                    $rules = [
                        'password' => [
                            'rules' => 'required|min_length[5]',
                            'errors' => [
                                'required' => '{field} harus diisi',
                                'min_length' => 'Password Minimal 5 karakter'
                            ]
                        ],
                        'cpassword' => [
                            'rules' => 'required|matches[password]',
                            'errors' => [
                                'required' => '{field} harus diisi',
                                'matches' => 'Password harus sama'
                            ]
                        ],
                    ];

                    if ($this->validate($rules)) {
                        $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);

                        if ($this->PesertaModel->updatepassword($token, $password)) {
                            session()->setFlashdata('success', 'Password berhasil disimpan');
                            // return redirect()->to(site_url(''));
                        } else {
                            session()->setFlashdata('error', 'Try again');
                            return redirect()->to(current_url());
                        }
                    }
                }
            }
        }
    }

    public function change_password()
    // redirect
    {
        $dataid = $this->PesertaModel->where('id', $this->session->get('idpesertacso'))->first();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'opassword' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => 'Password Minimal 5 karakter'
                    ]
                ],
                'cpassword' => [
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'matches' => 'Password harus sama'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $opassword = $this->request->getVar('opassword');
                $password = $this->request->getVar('password');

                if (password_verify($dataid['password'], $opassword)) {

                    $update = $this->PesertaModel->update($dataid, $password);

                    if ($update) {
                        session()->setFlashdata('success', 'Password berhasil dihapus');
                        return redirect()->route('cso/dashboard');
                    } else {
                        session()->setFlashdata('error', 'Password berhasil dihapus');
                        return redirect()->to(current_url());
                    }
                } else {
                    session()->setFlashdata('error', 'Password lama yang dimasukkan salah');
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
            return view('', $data);
        }
    }

    public function activate($token = null)
    {
        if (!empty($token)) {
            $data = $this->PesertaModel->verifytoken($token);
            if ($data) {
                if ($data->flag == 0) {
                    $flag = $this->PesertaModel->updateflag($token);
                    if ($flag) {
                        session()->setFlashdata('success', 'Akun sukses diaktifkan');
                    }
                } else {
                    session()->setFlashdata('success', 'Akun telah diaktifkan');
                }
            } else {
                session()->setFlashdata('error', 'Maaf Kami tidak bisa mencari akunmu');
            }
        } else {
            session()->setFlashdata('error', 'Belum berhasil Mengirim Email');
        }
        return view('cso-sign-in');
    }

    private function upload_image($file)
    {
        $newName = $file->getRandomName();
        $upload = $file->move(ROOTPATH . 'public/assets/img/photo/peserta/', $newName);
        if ($upload) {
            return $newName;
        } else {
            return false;
        }
    }

    public function bayar()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'fotobayar'    => [
                    'rules' => 'uploaded[fotobayar]|mime_in[fotobayar,image/jpg,image/jpeg,image/png]|is_image[fotobayar]|max_size[fotobayar,2096]',
                    'errors' => [
                        'uploaded' => 'Pilih Gambar terlebih dahulu',
                        'max_size' => 'Gambar ukuran maksimal 2MB',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ],
            ];
            if ($this->validate($rules)) {
                $file = $this->request->getFile('fotobayar');
                $note = htmlspecialchars($this->request->getPost('note'));
                $newName = $file->getRandomName();
                $upload = $file->move(ROOTPATH . 'public/assets/img/photo/', $newName);

                $paramspeserta = [
                    'id' => $this->session->get('idpesertacso'),
                    'valid_bayar' => '2'
                ];
                $paramsbayar = [
                    'competition_team_id' => $this->session->get('idpesertacso'),
                    'image' => $upload,
                    'note' => $note
                ];

                $updatep = $this->PesertaModel->update($paramspeserta['id'], $paramspeserta['valid_bayar']);
                $updatebayar = $this->BuktiPembayaransModel->insert($paramsbayar);

                if ($updatep) {
                    if ($updatebayar) {
                        session()->setFlashdata('success', 'upload berhasil, tunggu konfirmasi melalui email');
                    }
                } else {
                    session()->setFlashdata('error', 'upload gagal');
                }
            }
        }
    }
}
