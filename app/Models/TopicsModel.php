<?php

namespace App\Models;

use CodeIgniter\Model;

class TopicsModel extends Model
{
    protected $table = 'topics';
    protected $allowedFields = ['title', 'slug', 'body'];

    public function getTopics($slug = false)
    {
        if($slug === false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}