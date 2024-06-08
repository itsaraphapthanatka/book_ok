<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CustomerModel;

class Customer extends BaseController{
    public function __construct() {
        $db = db_connect();
        $this->CustomerModel = new CustomerModel($db);
    }
   
    public function setupCustomer($page = 'customer'){
        $data['title'] = ucfirst($page);
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('customer/'.$page,$data);
        echo view('templates/footer',$data);
    }
    public function editCustomer($seg1 = false){
        $data['id'] = $seg1;
        $data['res'] = $this->CustomerModel->asArray()->where(['id' => $seg1])->first();
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('customer/editCustomer',$data);
        echo view('templates/footer',$data);
    }
    public function saveCustomer(){
        $add = $this->request->getPost();
        $data = [
            'customer_name' => $add['fname'],
            'customer_address' => $add['address'],
            'customer_email' => $add['email'],
            'customer_mobile' => $add['phone'],
            'customer_tag' => $add['ctag']
        ];
        $result = $this->CustomerModel->update($add['cid'],$data);
        return redirect()->to('/editCustomer/'.$add['cid']);
    }
    
    public function customerfilter(){
        $data['title'] = ucfirst('customerfilter');
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('customer/customerfilter',$data);
        echo view('templates/footer',$data);
    }

}