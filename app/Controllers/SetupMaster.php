<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsersModel;

class SetupMaster extends Controller{

    public function my_user($page = 'myuser'){
        $id = session()->get('user_email');
        $data['title'] = ucfirst($page);
        $userModel = new UsersModel();
        $data['userdetail'] = $userModel->chkLogin($id);
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('setupuser/'.$page,$data);
        echo view('templates/footer',$data);
    }

    public function config_user($page = 'configuser'){
        
        $data['title'] = ucfirst($page);
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('setupuser/'.$page,$data);
        echo view('templates/footer',$data);
    }

    public function add_user($page = 'add_user'){
        
        $data['title'] = ucfirst($page);
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('setupuser/'.$page,$data);
        echo view('templates/footer',$data);
    }
    
    public function editUser($seg1 = false){
        $userModel = new UsersModel();
        $data['id'] = $seg1;
        $data['res'] = $userModel->asArray()->where(['id' => $seg1])->first();
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('setupuser/editUser',$data);
        echo view('templates/footer',$data);
    }
    
    public function password_user($page = 'password'){
        
        $data['title'] = ucfirst($page);
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('setupuser/'.$page,$data);
        echo view('templates/footer',$data);
    }
    public function saveUser(){
        $add = $this->request->getPost();
        return $this->response->setJSON($add);
        // $data = [
        //     'customer_name' => $add['fname'],
        //     'customer_address' => $add['address'],
        //     'customer_email' => $add['email'],
        //     'customer_mobile' => $add['phone'],
        //     'customer_tag' => $add['ctag']
        // ];
        // $result = $this->CustomerModel->update($add['cid'],$data);
        // return redirect()->to('/editCustomer/'.$add['cid']);
    }
}