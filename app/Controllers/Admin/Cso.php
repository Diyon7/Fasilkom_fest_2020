<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\PesertaModel;
use Config\Services;

class Cso extends BaseController
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
            'title' => 'Computer Science Competition',
            'letak' => 'Dashboard',
        ];

        return view('cso', $data);
    }

    public function add()
    {
        helper(['form']);

        $data = [
            'title' => 'Admin 💻🙂📱 Tambah Soal',
            'letak' => 'Tambah Soal',
            'validation' => \Config\Services::validation()
        ];
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
                'nowhatsapp' => [
                    'label' => 'nowhatsapp',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi',
                    ]
                ],
                'email' => [
                    'label' => 'email',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi',
                    ]
                ],
                // 'email' => [
                //     'label' => 'email',
                //     'rules' => 'required|valid_email|is_unique[teams.email]',
                //     'errors' => [
                //         'required' => '{field} harus diisi',
                //         'valid_email' => 'masukkan input email dengan benar',
                //         'is_unique' => 'Anda sudah mendaftar sebelumnya'
                //     ]
                // ],
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
            ];

            if ($this->validate($rules)) {

                $file = $this->request->getFile('fototeam');

                $uploadFile = $this->upload_image($file);

                $params = [
                    'namatim' => htmlspecialchars($this->request->getPost('namatim')),
                    'nama' => htmlspecialchars($this->request->getPost('nama')),
                    'nowhatsapp' => htmlspecialchars($this->request->getPost('nowhatsapp')),
                    'email' => htmlspecialchars($this->request->getPost('email')),
                    'email' => htmlspecialchars($this->request->getPost('email')),
                    'asalsekolah' => htmlspecialchars($this->request->getPost('asalsekolah')),
                    'foto' => $uploadFile,
                    'password' => htmlspecialchars(password_hash($this->request->getPost('nama'), PASSWORD_DEFAULT)),
                ];
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('', $data);
    }

    public function edit()
    {
        helper(['form']);
        $id = htmlspecialchars($this->request->uri->getSegment(4));
        $soal = $this->SoalModel->find($id);
        $data = [
            'title' => 'Admin 💻🙂📱 Tambah Soal',
            'letak' => 'Edit Soal',
            'soal' => $soal,
            'validation' => \Config\Services::validation()
        ];
        if ($this->request->getMethod() == 'post') {
            if ($_FILES['image']['name'] == "") {
                $rules = [
                    'question'        => 'required',
                    'choice_1'        => 'required',
                    'choice_2'        => 'required',
                    'choice_3'        => 'required',
                    'choice_4'        => 'required',
                    'choice_5'        => 'required',
                    'answer'        => 'required'
                ];
            } else {
                $rules = [
                    'question'        => 'required',
                    'choice_1'        => 'required',
                    'choice_2'        => 'required',
                    'choice_3'        => 'required',
                    'choice_4'        => 'required',
                    'choice_5'        => 'required',
                    'image'    => [
                        'uploaded[image]',
                        'mime_in[image,image/jpg,image/jpeg,image/png]',
                        'max_size[image,2096]'
                    ],
                    'answer'        => 'required'
                ];
            }
            if ($this->validate($rules)) {
                if ($_FILES['image']['name'] == '') {
                    $params = [
                        'question'             => htmlspecialchars($this->request->getPost('question')),
                        'multiple_choice_1'            => htmlspecialchars($this->request->getPost('choice_1')),
                        'multiple_choice_2'            => htmlspecialchars($this->request->getPost('choice_2')),
                        'multiple_choice_3'            => htmlspecialchars($this->request->getPost('choice_3')),
                        'multiple_choice_4'            => htmlspecialchars($this->request->getPost('choice_4')),
                        'multiple_choice_5'            => htmlspecialchars($this->request->getPost('choice_5')),
                        'answer_key'            => htmlspecialchars($this->request->getPost('answer'))
                    ];
                } else {
                    $getsoal = $this->SoalModel->find($id);
                    if ($getsoal) {
                        $deletefile = unlink('./assets/image/' . $getsoal['image']);
                        if ($deletefile) {
                            $file = $this->request->getFile('image');
                            $uploadFile = $this->upload_image($file);
                        }
                    }
                    $params = [
                        'question'             => htmlspecialchars($this->request->getPost('question')),
                        'image'        => $uploadFile,
                        'multiple_choice_1'            => htmlspecialchars($this->request->getPost('choice_1')),
                        'multiple_choice_2'            => htmlspecialchars($this->request->getPost('choice_2')),
                        'multiple_choice_3'            => htmlspecialchars($this->request->getPost('choice_3')),
                        'multiple_choice_4'            => htmlspecialchars($this->request->getPost('choice_4')),
                        'multiple_choice_5'            => htmlspecialchars($this->request->getPost('choice_5')),
                        'answer_key'            => htmlspecialchars($this->request->getPost('answer'))
                    ];
                }
                $update = $this->SoalModel->update($id, $params);
                if ($update) {
                    session()->setFlashdata('success', 'Data berhasil diupdate');
                    return redirect()->route('admin');
                } else {
                    session()->setFlashdata('danger', 'Data gagal diupdate');
                    return redirect()->route('admin/soal/edit')->withInput();
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('Admin/dashboard/edit', $data);
    }

    public function delete()
    {
        $id = htmlspecialchars($this->request->uri->getSegment(4));
        $getsoal = $this->SoalModel->find($id);

        if ($getsoal) {
            $deletefile = unlink('./assets/image/' . $getsoal['image']);
            if ($deletefile) {
                $delete = $this->SoalModel->delete($id);
                if ($delete) {
                    session()->setFlashdata('success', 'Data berhasil dihapus');
                    return redirect()->route('admin');
                } else {
                    session()->setFlashdata('danger', 'Data gagal dihapus');
                    return redirect()->route('admin');
                }
            } else {
                session()->setFlashdata('danger', 'Data gagal dihapus');
                return redirect()->route('admin');
            }
        } else {
            session()->setFlashdata('danger', 'Data gagal dihapus');
            return redirect()->route('admin');
        }
    }

    private function upload_image($file)
    {
        $newName = $file->getRandomName();
        $upload = $file->move(ROOTPATH . 'public/assets/image', $newName);
        if ($upload) {
            return $newName;
        } else {
            return false;
        }
    }
}
