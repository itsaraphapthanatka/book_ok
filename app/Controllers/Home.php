<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class Home extends Controller
{
    public function index($page = 'login')
    {
        return view('pages/'.$page);
    }

    public function load_appoint($page = 'load_appoint'){
        $data['title'] = ucfirst($page);
        echo view('templates/'.$page,$data);
    }
    
    public function load_team($page = 'load_team'){
        $data['title'] = ucfirst($page);
        echo view('templates/'.$page,$data);
    }
    
}
