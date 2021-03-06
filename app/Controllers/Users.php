<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod()== 'post') {
            
            $rules = [
                'email' => 'required|min_length[3]|max_length[70]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => 'Email or password don\'t match',
                ]
            ];

            if (! $this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            }else {
                $model = new UsersModel();

                $user = $model->where('email',$this->request->getVar('email'))
                            ->first();

                
                $this->setUserSession($user);
                // $session->setFlashdata('success','Successful registration');
                return redirect()->to('dashboard');
            }
        }

        echo view('templates/header',$data);
        echo view('login');
        echo view('templates/footer');
    }

    public function setUserSession($user) 
    {
        $data = [
            'id' => $user['id'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'email' => $user['email'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }

    public function register()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod()== 'post') {
            
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[70]',
                'lastname' => 'required|min_length[3]|max_length[70]',
                'email' => 'required|min_length[3]|max_length[70]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]',
            ];

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
            }else {
                $model = new UsersModel();

                $newData = [
                    'firstname' => $this->request->getVar('firstname'),
                    'lastname' => $this->request->getVar('lastname'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                    'role' => $this->request->getVar('role'),

                ];

                $model->save($newData);

                $session = session();
                $session->setFlashdata('success','Successful registration');
                return redirect()->to('login');
            }
        }

        echo view('templates/header',$data);
        echo view('register');
        echo view('templates/footer');
    }

    public function profile()
    {
        $data = [];
        helper(['form']);
        $model = new UsersModel();

        if ($this->request->getMethod()== 'post') {
            
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[70]',
                'lastname' => 'required|min_length[3]|max_length[70]',
            ];

            if($this->request->getPost('password') !== '')
            {
                $rules['password'] = 'required|min_length[8]|max_length[255]';
                $rules['password_confirm'] = 'matches[password]';
            }

            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
            }else {
                
                $newData = [
                    'id' => session()->get('id'),
                    'firstname' => $this->request->getPost('firstname'),
                    'lastname' => $this->request->getPost('lastname'),
                                       
                ];
                if($this->request->getPost('password') !== '')
                {
                    $newData['password'] = $this->request->getPost('password');
                }

                $model->save($newData);


                session()->setFlashdata('success','Successful update');
                return redirect()->to('profile');
            }
        }

        $data['user'] = $model->where('id',session()->get('id'))->first();

        echo view('templates/header',$data);
        echo view('profile');
        echo view('templates/footer');

    }

    public function logout() 
    {
        session()->destroy();
        return redirect()->to('/');
    }
}