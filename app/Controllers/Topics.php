<?php

namespace App\Controllers;

use App\Models\TopicsModel;

class Topics extends BaseController
{
    public function index()
    {
        $model = model(TopicsModel::class);

        $data = [
            'topics' => $model->getTopics(),
            'title'  => 'Topics Archive',
        ];

        echo view('templates/header', $data);
        echo view('topics/overview', $data);
        echo view('templates/footer', $data);
    }

    public function view($slug = null)
    {
        $model = model(TopicsModel::class);

        $data['topics'] = $model->getTopics($slug);

        if (empty($data['topics'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the topic item: ' . $slug);
        }

        $data['title'] = $data['topics']['title'];

        echo view('templates/header',$data);
        echo view('topics/view',$data);
        echo view('templates/footer', $data);
    }
    
    public function create()
    {
        $model = model(TopicsModel::class);

        if($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body'  => 'required',
        ])){
            $model->save([
                'title' => $this->request->getPost('title'),
                'slug' => url_title($this->request->getPost('title'), '-' ,true),
                'body' => $this->request->getPost('body'),
            ]);

            echo view('topics/success');
        } else {
            echo view('templates/header', ['title' => 'Create Topics item']);
            echo view('topics/create');
            echo view('templates/footer');
        }
    }
}