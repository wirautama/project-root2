<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class AuthController extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {

        return view('auth/login');
    }

    public function login()
    {
        $model = new UserModel();


        $email = request()->getPost('email');
        $password = request()->getPost('password');
        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi',
                    'valid_email' => 'Email yang anda masukkan tidak valid'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password wajib diisi',
                    'min_lenght' => 'Panjang  harus lebih dari 6 karakter'
                ]
            ]
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $dataUser = $model->where(['email' => $email])->first();
        if ($dataUser) {
            if (password_verify($password, $dataUser['password'])) {
                session()->set([
                    'email' => $email,
                    'isLoggedIn' => true
                ]);
                return redirect()->to(base_url('/'));
            } else {
                session()->setFlashdata(['pesan' => 'Login Gagal, Username atau password salah']);
                return redirect()->to(base_url('/login'));
            }
        } else {
            session()->setFlashdata(['pesan' => 'Login Gagal, Username atau password salah']);
            return redirect()->to(base_url('/login'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    public function register()
    {
        return view('auth/register');
    }

    public function signin()
    {
        $userModel = new UserModel();

        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi',
                    'valid_email' => 'Email yang anda masukkan tidak valid'
                ]
            ],
            'name' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama wajib diisi',
                    'min_length' => 'Panjang harus lebih dari 3 karakter'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password wajib diisi',
                    'min_lenght' => 'Panjang harus lebih dari 6 karakter'
                ]
            ],
            'retype_password' => [
                'label' => 'Ulangi Password',
                'rules' => 'required|min_length[6]|matches[password]',
                'errors' => [
                    'required' => 'Password wajib diisi',
                    'min_lenght' => 'Panjang  harus lebih dari 6 karakter',
                    'matches' => 'Konfirmasi password tidak sesuai dengan password sebelumnya'
                ]
            ],
            'profile_image' => [
                'label' => 'Foto Profil',
                'rules' => 'is_image[profile_image]|max_size[profile_image, 1024]|mime_in[profile_image,image/jpg,image/jpeg,image/png,image/svg]',
                'errors' => [
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'max_size' => 'Ukuran gambar terlalu besar, Max 1024 MB',
                    'mime_in' => 'File yang anda pilih bukan ekstensi dari gambar'
                ]
            ]
        ];
        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'Registrasi Gagal, Periksa form input kembali');
            return redirect()->back()->withInput();
        }
        $profileImage = $this->request->getFile('profile_image');
        if ($profileImage->isValid() && !$profileImage->hasMoved()) {
            $newName = $profileImage->getRandomName();
            $profileImage->move(ROOTPATH . 'public/img', $newName);
        }

        $userModel->save([
            'email' => request()->getPost('email'),
            'name' => request()->getPost('name'),
            'password' => password_hash(request()->getPost('password'), PASSWORD_DEFAULT),
            'profile_image' => $newName
        ]);
        session()->setFlashdata('success', 'Registrasi Berhasil, Silahkan Login');
        return redirect()->to(base_url('/login'));
    }

    public function forgot()
    {

        return view('auth/forgot');
    }

    public function forgotPassword()
    {
        // $data = [];
        helper('string');
        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email wajib diisi',
                    'valid_email' => 'Email yang anda masukkan tidak valid'
                ]
            ],
        ];
        if ($this->validate($rules)) {
            $token = bin2hex(random_bytes(10));
            $userModel = new UserModel();

            $userData = $userModel->where('email', $this->request->getPost('email'))->first();

            $data = [
                'email' => $this->request->getPost('email'),
                'reset_token' => $token,
                'reset_at' => Time::now()
            ];

            $userModel->update($userData['id'], $data);
            $to = $data['email'];
            $subject = 'Reset Password Link';
            $token_no = $token;
            $message = 'Hi ' . $userData['name'] . '<br></br>'
                . 'Your reset password request has been received, Please click'
                . 'the below link to reset your password. <br></br>'
                . '<a href="' . base_url() . $token_no . '">Click here to reset password</a><br></br>'
                . 'Thanks<br>Project Root';
            $email = \Config\Services::email();
            $email->setTo($to);
            $email->setFrom('info@project-root');
            $email->setSubject($subject);
            $email->setMessage($message);
            if ($email->send()) {
                session()->setTempdata('success', 'Reset Password link sent to your registration email');
                return redirect()->to(base_url('/forgot'));
            } else {
                $data = $email->printDebugger(['headers']);
                print_r($data);
            }
            return $this->response->redirect(base_url('/reset-password'));
        }
        return view('auth/forgot');
    }

    public function resetPassword()
    {
        $rules = [
            'email' => 'required|valid_email',
            'reset_token' => 'required|min_length[10]',
            'password' => 'required|min_length[6]',
            'retype_password' => 'required|matches[password]'
        ];
        if ($this->validate($rules)) {
            $userModel = new UserModel();
            $email = request()->getPost('email');
            $token = request()->getPost('reset_token');
            $password = request()->getPost('password');
            $userData = $userModel->where('reset_token', $token)->where('email', $email)->first();

            if (!empty($userData)) {
                $data = [
                    'email' => request()->getPost('email'),
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'reset_token' => $token,
                    'updated_at' => Time::now()
                ];
                $userModel->update($userData['id'], $data);

                return $this->response->redirect(base_url('/login'));
            } else {
                echo "No Data Found";
            }
            session()->setFlashdata('success', 'Password Berhasil Direset, Silahkan Login Kembali');
            return $this->response->redirect(base_url('/login'));
        }
        session()->setFlashdata('success', 'Silahkan update password anda');
        return view('auth/reset');
    }
}
