<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        echo view('templates/header',$data);
        echo view('login');
        echo view('templates/footer');
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

                $session =session();
                $session->setFlashdata('success','Successful registration');
                return redirect()->to('login');
            }
        }

        echo view('templates/header',$data);
        echo view('register');
        echo view('templates/footer');
    }
}