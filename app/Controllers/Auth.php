<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsersModel;
use App\Models\CompanyModel;

class Auth extends BaseController{
    public function index($page = 'login'){
        helper(['form']);
        if (session()->get('logged_in')) {
            return redirect()->to('/home');
        }
        return view('pages/'.$page);
        // echo password_hash('Mc5s7140',PASSWORD_DEFAULT);
    }
    public function auth(){
        
        $session = session();
        $model = new UsersModel();
        $company = new CompanyModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->chkLogin($email);
        if ($data) {
            $pass = $data['user_password'];
            $authLine = $company->asArray()->where(['compcode' => $data['compcode']])->first();
            $verify_password = password_verify($password,$pass);
            if ($verify_password) {
                $sess_data = [
                    'id' => $data['id'],
                    'user_name' => $data['user_name'],
                    'user_email' => $data['user_email'],
                    'user_img' => $data['user_img'],
                    'mobile' => $data['mobile'],
                    'compcode' => $data['compcode'],
                    'user_role' => $data['user_role'],
                    'line_auth' => $authLine['line_auth'],
                    'logged_in' => TRUE
                ];
                $session->set($sess_data);
                return redirect()->to('/home');
            }else{
                $session->setFlashdata('msg', 'Wrong password');
                echo view('pages/login');
            }
        }else{
            $session->setFlashdata('msg', 'Email not found');
            echo view('pages/login');
        }
    }

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}