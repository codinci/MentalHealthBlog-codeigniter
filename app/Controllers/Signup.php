<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Signup extends BaseController
{
    public function index()
    {
        echo view('pages/signup');
        echo view('templates/footer');    
    }

    public function store()
    {
        $model = model(UsersModel::class);

        if($this->request->getMethod() === 'post' && $this->validate([
            'firstName' => 'required|min_length[2]|max_length[150]',
            'lastName' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[4]',
            'confirmPassword' =>'matches[password]',
            'role' => 'required'
        ])){
            $model->save ([
                'firstName' => $this->request->getPost('firstName'),
                'lastName' => $this->request->getPost('lastName'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
                'role' => $this->request->getPost('role')
            ]);
            return redirect()->to('');
        }else {
            $data['validation'] = $this->validator;
            echo view('templates/header');
            echo view('pages/signup',$data);
            echo view('templates/footer');   
        }
    }
}