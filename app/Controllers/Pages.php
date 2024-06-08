<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\PackageModel;

class Pages extends Controller
{
    public function index()
    {
        return view('welcome_message');
    }

    public function view($page = 'home'){

        $data['title'] = ucfirst($page);
        $package = new PackageModel();
        $data['res'] = $package->where(['compcode'=> session()->get('compcode')])->orderBy('id','ASC')->findAll();
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('pages/'.$page,$data);
        echo view('templates/footer',$data);
    }
}
