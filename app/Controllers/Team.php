<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Team extends Controller{

    public function setTeam($page = 'team'){
        $data['title'] = ucfirst($page);
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('team/'.$page,$data);
        echo view('templates/footer',$data);
    }
}
