<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsersModel;
use App\Models\BranchModel;
use App\Models\CustomerModel;
use App\Models\RoomModel;
use App\Models\TimeModel;
use App\Models\DaysModel;
use App\Models\MonthModel;
use App\Models\SetMonthModel;
use App\Models\CompanyModel;
use App\Models\PackageModel;

class Master extends BaseController {
    public function index($page = 'main'){

        $data['title'] = ucfirst($page);
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('master/'.$page,$data);
        echo view('templates/footer',$data);
    }

    public function load_appoint($page = 'main'){
        $data['title'] = ucfirst($page);
        echo view('master/'.$page,$data);
    }

    public function setupCompany($page = 'company'){
        $company = new CompanyModel();
        $data['company'] = $company->asArray()->where(['compcode'=> session()->get('compcode')])->first();
        $data['title'] = ucfirst($page);
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('master/'.$page,$data);
        echo view('templates/footer',$data);
    }

    public function setupBranch($page = 'branch'){
        $data['title'] = ucfirst($page);
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('master/'.$page,$data);
        echo view('templates/footer',$data);
    }
    
    public function setupRoom($page = 'room'){
        $data['title'] = ucfirst($page);
        $branch = new BranchModel();
        $data['branch'] =  $branch->orderBy('id', 'DESC')->findAll();
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('master/'.$page,$data);
        echo view('templates/footer',$data);
    }
    
    public function setupTime($page = 'time'){
        $time = new TimeModel();
        $days = new DaysModel();
        $month = new MonthModel();
        $data['query'] = $time->getTimeConfig();
        $data['days'] = $days->getDaysConfig();
        $data['month'] = $month->findAll();
        $data['title'] = ucfirst($page);
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('master/'.$page,$data);
        echo view('templates/footer',$data);
    }
    
    public function setupWeekTime($page = 'weektime'){
        $data['dateParam'] = date('Y-m-d');
        $time = new TimeModel();
        $days = new DaysModel();
        $month = new MonthModel();
        $data['query'] = $time->getTimeConfig();
        $data['days'] = $days->getDaysConfig();
        $data['month'] = $month->findAll();
        $data['title'] = ucfirst($page);
        $data['queryday'] = $time->getsetimeByDate($data['dateParam']);
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('master/'.$page,$data);
        echo view('templates/footer',$data);
    }
    
    public function delaytime($page = 'delaytime'){
        // $time = new TimeModel();
        // $days = new DaysModel();
        // $month = new MonthModel();
        $company = new CompanyModel();
        // $data['query'] = $time->getTimeConfig();
        // $data['days'] = $days->getDaysConfig();
        // $data['month'] = $month->findAll();
        $data['timedeley'] = $company->asArray()->where(['compcode'=> session()->get('compcode')])->first();
        $data['title'] = ucfirst($page);
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('master/'.$page,$data);
        echo view('templates/footer',$data);
    }
    
    public function advancepay($page = 'advancepay'){
        // $time = new TimeModel();
        // $days = new DaysModel();
        // $month = new MonthModel();
        $company = new CompanyModel();
        // $data['query'] = $time->getTimeConfig();
        // $data['days'] = $days->getDaysConfig();
        // $data['month'] = $month->findAll();
        $data['adv_amount'] = $company->asArray()->where(['compcode'=> session()->get('compcode')])->first();
        $data['title'] = ucfirst($page);
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('master/'.$page,$data);
        echo view('templates/footer',$data);
    }
    
    public function setupPackage($page = 'setupPackage'){
        // $time = new TimeModel();
        // $days = new DaysModel();
        // $month = new MonthModel();
        $company = new CompanyModel();
        // $data['query'] = $time->getTimeConfig();
        // $data['days'] = $days->getDaysConfig();
        // $data['month'] = $month->findAll();
        $data['dateParam'] = date('Y-m-d');
        $time = new TimeModel();
        $days = new DaysModel();
        $month = new MonthModel();
        $data['query'] = $time->getTimeConfig();
        $data['days'] = $days->getDaysConfig();
        $data['month'] = $month->findAll();
        $data['title'] = ucfirst($page);
        // $data['queryday'] = $time->getsetimeByDate($data['dateParam']);
        $data['adv_amount'] = $company->asArray()->where(['compcode'=> session()->get('compcode')])->first();
        $data['title'] = ucfirst($page);
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('master/'.$page,$data);
        echo view('templates/footer',$data);
    }
    
    public function editPackage($seg1 = false){
        $package = new PackageModel();
        $data['pid'] = $seg1;
        $data['res'] = $package->asArray()->where(['id'=> $seg1])->first();
        echo view('templates/header',$data);
        echo view('templates/sidebar',$data);
        echo view('templates/secondary_sidebar',$data);
        echo view('master/editPackage',$data);
        echo view('templates/footer',$data);
    }
    
    public function load_time(){
        $data['dateParam'] = $_GET['startdate'];
        $time = new TimeModel();
        $days = new DaysModel();
        $month = new MonthModel();
        $SetMonthModel = new SetMonthModel();
        $data['query'] = $time->getsetimeByDate($data['dateParam']);
        $data['limitdate'] = $SetMonthModel->asArray()->where(['days'=> $data['dateParam']])->first();
        // $get_days =          $this->SetMonthModel->asArray()->where(['days'=> $post['date']])->first();
        $data['days'] = $days->getDaysConfig();
        $data['month'] = $month->findAll();
        echo view('master/load_time',$data);
    }
    
    public function loadPackageSetTime($seg1 = false){
        $data['packageid'] = $seg1;
        $data['dateParam'] = date('Y-m-d');
        $time = new TimeModel();
        $days = new DaysModel();
        $month = new MonthModel();
        $data['query'] = $time->getTimeConfig();
        $data['days'] = $days->getDaysConfig();
        $data['month'] = $month->findAll();
        echo view('master/loadPackageSetTime',$data);
        
    }

    public function getAllUsers(){
        $users = new UsersModel();
        $query =  $users->getUsers();
        $count =  $users->orderBy('id', 'DESC')->countAllResults();
        $arr = [
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $query

        ];
        return $this->response->setJSON($arr);
    }

    public function getAllBranch(){
        $branch = new BranchModel();
        $query =  $branch->getBranch();
       
        return $this->response->setJSON($query);
    }

    public function getAllRoom(){
        $room = new RoomModel();
        $query =  $room->getRoom();
       
        return $this->response->setJSON($query);
    }
    
    public function getAllCustomer(){
        $customer = new CustomerModel();
        $query =  $customer->getCustomer();
       
        return $this->response->setJSON($query);
    }
    
    public function getAllPackage(){
        $package = new PackageModel();
        $query =  $package->getPackage();
       
        return $this->response->setJSON($query);
    }
}