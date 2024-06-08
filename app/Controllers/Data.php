<?php namespace App\Controllers;

use App\Models\AppointmentModel;
use CodeIgniter\Controller;
use App\Models\DaysModel;
use App\Models\UsersModel;
use CodeIgniter\Files\File;
use App\Entities\User;
use App\Models\SetMonthModel;
use App\Models\TimeModel;
use App\Models\CompanyModel;
use App\Models\CustomerModel;
use App\Models\PackageModel;
use App\Models\UploadFileModel;

class Data extends BaseController
{
    public function __construct() {
        $db = db_connect();
        $this->UsersModel = new UsersModel($db);
        $this->SetMonthModel = new SetMonthModel($db);
        $this->TimeModel = new TimeModel($db);
        $this->CompanyModel = new CompanyModel($db);
        $this->AppointmentModel = new AppointmentModel($db);
        $this->CustomerModel = new CustomerModel($db);
        $this->PackageModel = new PackageModel($db);
        $this->UploadFileModel = new UploadFileModel($db);
    }
    public function index(){
        $appoint = new AppointmentModel();
        $query =  $appoint->getAppointments();
        return $this->response->setJSON($query);
    }
    public function getappoint(){
       $appoint = new AppointmentModel();
       $query = $appoint->getappoint();
       return $this->response->setJSON($query);
       
    }
    public function view($id = null){
        $model = new AppointmentModel();
        $data['appointment'] = $model->getAppointments($id);
    } 
    public function saveprofile(){
        $add = $this->request->getPost();
        $img = $this->request->getFile('userfile');
        
        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    // 'max_size[userfile,100]',
                    // 'max_dims[userfile,1024,768]',
                ],
            ],
        ];
        if (! $this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];
        
            $data = [
                'user_name' => $add['fname'],
                'mobile' => $add['phone'],
                'compcode' => 'demo',
            ];
            $this->UsersModel->update_profile($add['userid'],$data);
            return redirect()->to('/user');
        }
        
        $img = $this->request->getFile('userfile');
        
        if (! $img->hasMoved()) {
            $filepath = 'profile/';
            $img->move($filepath);
            // $filepath = WRITEPATH . 'profile/';
        
            $data = ['uploaded_fileinfo' => new File($filepath)];
        
            // return view('upload_success', $data);
            $data = [
                'user_name' => $add['fname'],
                'mobile' => $add['phone'],
                'compcode' => 'demo',
                'user_img' => $img->getName(),
            ];
            $result =  $this->UsersModel->update_profile($add['userid'],$data);
            return redirect()->to('/user');
        }
        $data = ['errors' => 'The file has already been moved.'];
    }
    public function saveCompany(){
        $add = $this->request->getPost();
        
        // return $this->response->setJSON($add);
          $data = array(
              'company_name' => $add['companyname'],
              'compant_type' => $add['companytype'],
              'taxid' => $add['taxid'],
              'addr' => $add['addr'],
              'CompanyTaxId' => $add['CompanyTaxId'],
              'edit_date' => date('Y-m-d H:i:s'),
              'edit_user' => session()->get('user_name')
          );
          $result = $this->CompanyModel->updateCompany($data);
          if ($result) {
             $res = session()->get('compcode');
             $message = "updated successfully";
          }else{
              $res = "false";
              $message = "Something went wrong";
          }
          $arr = [
              "result" => $res,
              "message" => $message,
          
          ];
          return $this->response->setJSON($arr);
    }
    public function changePassword(){
        $id = session()->get('id');
        $newPassword = $this->request->getPost('pass');
        $result = $this->UsersModel->update_profile($id,['user_password' => password_hash($newPassword, PASSWORD_BCRYPT)]);
        if($result){
           $message = "User details are updated successfully.";
           $arr = [
               "result" => "successed",
               "message" => $message,
           ];
        }else{
           $message = "Something went wrong";
           $arr = [
               "result" => "error",
               "message" => $message,
           
           ];
        }
       return $this->response->setJSON($arr);
        
    }
    public function deactivate(){
        $id = $this->request->getPost('id');
        $result = $this->UsersModel->update_profile($id,['user_status' => 'inactive']);
            if($result){
               $message = "User details are updated successfully.";
               $arr = [
                   "result" => "successed",
                   "message" => $message,
               ];
            }else{
               $message = "Something went wrong";
               $arr = [
                   "result" => "error",
                   "message" => $message,
               
               ];
            }
           return $this->response->setJSON($arr);
    }
    public function getsetmonthtime(){
        $SetMonthModel = new SetMonthModel();
        $query = $SetMonthModel->getsetmonth();
        return $this->response->setJSON($query);
    }
    public function setupCalendar(){
        $post = $this->request->getPost();
        // return $this->response->setJSON($post);
        if ($post['calendartype'] == 3) {
            $data = [
                'days' => $post['calendar_event_start_date'],
                'setuptype' => $post['calendartype'],
                'title' => "Setup",
                'description' => "",
                'start' => $post['calendar_event_start_date'],
                'end' => $post['calendar_event_start_date'],
                'location' => "",
                'color' => '#28257F',
                'className' => 'fc-event-success',
                'limitdate' => $post['limitdate'],
                'compcode' => session()->get('compcode'),
                'status' => 'active',
            ];
            $this->SetMonthModel->insert($data);
            for ($i = 0; $i < count($post['kt_docs_repeater_basic']); $i++) {
                if(isset($post['kt_docs_repeater_basic'][$i]['chkopen'][0])){
                    $datai = array(
                        'days' => $post['calendar_event_start_date'],
                        'time' => $post['kt_docs_repeater_basic'][$i]['timestart'],
                        'etime' => $post['kt_docs_repeater_basic'][$i]['tmeend'],
                        'compcode' => session()->get('compcode'),
                        'status' => 'active',
                    );
                }else{
                    $datai = array(
                        'days' => $post['calendar_event_start_date'],
                        'time' => $post['kt_docs_repeater_basic'][$i]['timestart'],
                        'etime' => $post['kt_docs_repeater_basic'][$i]['tmeend'],
                        'compcode' => session()->get('compcode'),
                        'status' => 'inactive',
                    );
                }
                $this->TimeModel->insert($datai);
            }
        }elseif($post['calendartype'] == 2){
           $string =  $post['calendar_event_between_date'];
           $weekStart = new \DateTime(date('Y-m-d',strtotime(substr($string, 0, strpos($string, " to ")))));
           $weekend = new \DateTime(date('Y-m-d',strtotime(substr($string, 14, strpos($string, " to ")))));
            for($i = $weekStart; $i <= $weekend; $i->modify('+1 day')){
               $duplicatedate =  $this->TimeModel->where(["days" => $i->format("Y-m-d")])->get()->getRow();
                if (!$duplicatedate) {
                    echo $i->format("Y-m-d")."<br/>";
                    $data = [
                        'days' => $i->format("Y-m-d"),
                        'setuptype' => $post['calendartype'],
                        'title' => "Setup",
                        'description' => "",
                        'start' => $i->format("Y-m-d"),
                        'end' => $i->format("Y-m-d"),
                        'location' => "",
                        'color' => '#28257F',
                        'className' => 'fc-event-success',
                        'limitdate' => $post['limitdate'],
                        'compcode' => session()->get('compcode'),
                        'status' => 'active',
                    ];
                    $result = $this->SetMonthModel->insert($data);
                    for ($j = 0; $j < count($post['kt_docs_repeater_basic']); $j++) {
                        if(isset($post['kt_docs_repeater_basic'][$j]['chkopen'][0])){
                            $datai = array(
                                'days' => $i->format("Y-m-d"),
                                'time' => $post['kt_docs_repeater_basic'][$j]['timestart'],
                                'etime' => $post['kt_docs_repeater_basic'][$j]['tmeend'],
                                'compcode' => session()->get('compcode'),
                                'status' => 'active',
                            );
                        }else{
                            $datai = array(
                                'days' => $i->format("Y-m-d"),
                                'time' => $post['kt_docs_repeater_basic'][$j]['timestart'],
                                'etime' => $post['kt_docs_repeater_basic'][$j]['tmeend'],
                                'compcode' => session()->get('compcode'),
                                'status' => 'inactive',
                            );
                        }
                        $this->TimeModel->insert($datai);
                    }
                }
            }
           
        }elseif($post['calendartype'] == 1){
            $month = $post['calendarmonth'];
            $year = $post['calendaryear'];
           $enddate =  $this->EOM($month,$year);
           print_r($post);
           echo "<br/>";
            // return $this->response->setJSON($post);
            $strStartDate = $year."-".$month."-01";
            $strEndDate = $year."-".$month."-".$enddate;
            
            $intWorkDay = 0;
            $intHoliday = 0;
            $intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate))/  ( 60 * 60 * 24 )) + 1; 
            while (strtotime($strStartDate) <= strtotime($strEndDate)) {
                     // for ($i = 0; $i < count($post['checkday']); $i++) {    
                  $DayOfWeek = date("w", strtotime($strStartDate));
                  if($DayOfWeek == 1 && $post['checkday'][0]==1) {
                      $intHoliday++;
                      echo "$strStartDate = <b>Work Day</b><br>";
                      $duplicatedate =  $this->TimeModel->where(["days" => $strStartDate])->get()->getRow();
                      if (!$duplicatedate) {
                          $data = [
                              'days' => $strStartDate,
                              'setuptype' => $post['calendartype'],
                              'title' => "Setup",
                              'description' => "",
                              'start' => $strStartDate,
                              'end' => $strStartDate,
                              'location' => "",
                              'color' => '#28257F',
                              'className' => 'fc-event-success',
                              'limitdate' => $post['limitdate'],
                              'compcode' => session()->get('compcode'),
                              'status' => 'active',
                          ];
                          $this->SetMonthModel->insert($data);
                          for ($item = 0; $item < count($post['kt_docs_repeater_basic']); $item++) {
                              if(isset($post['kt_docs_repeater_basic'][$item]['chkopen'][0])){
                                  $datai = array(
                                      'days' => $strStartDate,
                                      'time' => $post['kt_docs_repeater_basic'][$item]['timestart'],
                                      'etime' => $post['kt_docs_repeater_basic'][$item]['tmeend'],
                                      'compcode' => session()->get('compcode'),
                                      'status' => 'active',
                                  );
                              }else{
                                  $datai = array(
                                      'days' => $strStartDate,
                                      'time' => $post['kt_docs_repeater_basic'][$item]['timestart'],
                                      'etime' => $post['kt_docs_repeater_basic'][$item]['tmeend'],
                                      'compcode' => session()->get('compcode'),
                                      'status' => 'inactive',
                                  );
                              }
                              $this->TimeModel->insert($datai);
                          }
                      }
                  }else if($DayOfWeek == 2 && $post['checkday'][1]==1){
                            $intHoliday++;
                            echo "$strStartDate = <b>Work Day</b><br>";
                            $duplicatedate = $this->TimeModel->where(["days" => $strStartDate])->get()->getRow();
                                if (!$duplicatedate) {
                                    $data = [
                                        'days' => $strStartDate,
                                        'setuptype' => $post['calendartype'],
                                        'title' => "Setup",
                                        'description' => "",
                                        'start' => $strStartDate,
                                        'end' => $strStartDate,
                                        'location' => "",
                                        'color' => '#28257F',
                                        'className' => 'fc-event-success',
                                        'limitdate' => $post['limitdate'],
                                        'compcode' => session()->get('compcode'),
                                        'status' => 'active',
                                    ];
                                    $this->SetMonthModel->insert($data);
                                    for ($item = 0; $item < count($post['kt_docs_repeater_basic']); $item++) {
                                        if(isset($post['kt_docs_repeater_basic'][$item]['chkopen'][0])){
                                            $datai = array(
                                                'days' => $strStartDate,
                                                'time' => $post['kt_docs_repeater_basic'][$item]['timestart'],
                                                'etime' => $post['kt_docs_repeater_basic'][$item]['tmeend'],
                                                'compcode' => session()->get('compcode'),
                                                'status' => 'active',
                                            );
                                        }else{
                                            $datai = array(
                                                'days' => $strStartDate,
                                                'time' => $post['kt_docs_repeater_basic'][$item]['timestart'],
                                                'etime' => $post['kt_docs_repeater_basic'][$item]['tmeend'],
                                                'compcode' => session()->get('compcode'),
                                                'status' => 'inactive',
                                            );
                                        }
                                        $this->TimeModel->insert($datai);
                                    }
                                }
                  }else if($DayOfWeek == 3 && $post['checkday'][2]==1){
                          $intHoliday++;
                          echo "$strStartDate = <b>Work Day</b><br>";
                          $duplicatedate = $this->TimeModel->where(["days" => $strStartDate])->get()->getRow();
                            if (!$duplicatedate) {
                                $data = [
                                    'days' => $strStartDate,
                                    'setuptype' => $post['calendartype'],
                                    'title' => "Setup",
                                    'description' => "",
                                    'start' => $strStartDate,
                                    'end' => $strStartDate,
                                    'location' => "",
                                    'color' => '#28257F',
                                    'className' => 'fc-event-success',
                                    'limitdate' => $post['limitdate'],
                                    'compcode' => session()->get('compcode'),
                                    'status' => 'active',
                                ];
                                $this->SetMonthModel->insert($data);
                                for ($item = 0; $item < count($post['kt_docs_repeater_basic']); $item++) {
                                    if(isset($post['kt_docs_repeater_basic'][$item]['chkopen'][0])){
                                        $datai = array(
                                            'days' => $strStartDate,
                                            'time' => $post['kt_docs_repeater_basic'][$item]['timestart'],
                                            'etime' => $post['kt_docs_repeater_basic'][$item]['tmeend'],
                                            'compcode' => session()->get('compcode'),
                                            'status' => 'active',
                                        );
                                    }else{
                                        $datai = array(
                                            'days' => $strStartDate,
                                            'time' => $post['kt_docs_repeater_basic'][$item]['timestart'],
                                            'etime' => $post['kt_docs_repeater_basic'][$item]['tmeend'],
                                            'compcode' => session()->get('compcode'),
                                            'status' => 'inactive',
                                        );
                                    }
                                    $this->TimeModel->insert($datai);
                                }
                            }
                  }else if($DayOfWeek == 4 && $post['checkday'][3]==1){
                            $intHoliday++;
                            echo "$strStartDate = <b>Work Day</b><br>";
                            $duplicatedate = $this->TimeModel->where(["days" => $strStartDate])->get()->getRow();
                            if (!$duplicatedate) {
                                $data = [
                                    'days' => $strStartDate,
                                    'setuptype' => $post['calendartype'],
                                    'title' => "Setup",
                                    'description' => "",
                                    'start' => $strStartDate,
                                    'end' => $strStartDate,
                                    'location' => "",
                                    'color' => '#28257F',
                                    'className' => 'fc-event-success',
                                    'limitdate' => $post['limitdate'],
                                    'compcode' => session()->get('compcode'),
                                    'status' => 'active',
                                ];
                                $this->SetMonthModel->insert($data);
                                for ($item = 0; $item < count($post['kt_docs_repeater_basic']); $item++) {
                                    if(isset($post['kt_docs_repeater_basic'][$item]['chkopen'][0])){
                                        $datai = array(
                                            'days' => $strStartDate,
                                            'time' => $post['kt_docs_repeater_basic'][$item]['timestart'],
                                            'etime' => $post['kt_docs_repeater_basic'][$item]['tmeend'],
                                            'compcode' => session()->get('compcode'),
                                            'status' => 'active',
                                        );
                                    }else{
                                        $datai = array(
                                            'days' => $strStartDate,
                                            'time' => $post['kt_docs_repeater_basic'][$item]['timestart'],
                                            'etime' => $post['kt_docs_repeater_basic'][$item]['tmeend'],
                                            'compcode' => session()->get('compcode'),
                                            'status' => 'inactive',
                                        );
                                    }
                                    $this->TimeModel->insert($datai);
                                }
                            }
                  }else if($DayOfWeek == 5 && $post['checkday'][4]==1){
                            $intHoliday++;
                            echo "$strStartDate = <b>Work Day</b><br>";
                            $duplicatedate = $this->TimeModel->where(["days" => $strStartDate])->get()->getRow();
                            if (!$duplicatedate) {
                                $data = [
                                    'days' => $strStartDate,
                                    'setuptype' => $post['calendartype'],
                                    'title' => "Setup",
                                    'description' => "",
                                    'start' => $strStartDate,
                                    'end' => $strStartDate,
                                    'location' => "",
                                    'color' => '#28257F',
                                    'className' => 'fc-event-success',
                                    'limitdate' => $post['limitdate'],
                                    'compcode' => session()->get('compcode'),
                                    'status' => 'active',
                                ];
                                $this->SetMonthModel->insert($data);
                                for ($item = 0; $item < count($post['kt_docs_repeater_basic']); $item++) {
                                    if(isset($post['kt_docs_repeater_basic'][$item]['chkopen'][0])){
                                        $datai = array(
                                            'days' => $strStartDate,
                                            'time' => $post['kt_docs_repeater_basic'][$item]['timestart'],
                                            'etime' => $post['kt_docs_repeater_basic'][$item]['tmeend'],
                                            'compcode' => session()->get('compcode'),
                                            'status' => 'active',
                                        );
                                    }else{
                                        $datai = array(
                                            'days' => $strStartDate,
                                            'time' => $post['kt_docs_repeater_basic'][$item]['timestart'],
                                            'etime' => $post['kt_docs_repeater_basic'][$item]['tmeend'],
                                            'compcode' => session()->get('compcode'),
                                            'status' => 'inactive',
                                        );
                                    }
                                    $this->TimeModel->insert($datai);
                                }
                            }
                  }else if($DayOfWeek == 6 && $post['checkday'][5]==1){
                            $intHoliday++;
                            echo "$strStartDate = <b>Work Day</b><br>";
                            $duplicatedate = $this->TimeModel->where(["days" => $strStartDate])->get()->getRow();
                            if (!$duplicatedate) {
                                $data = [
                                    'days' => $strStartDate,
                                    'setuptype' => $post['calendartype'],
                                    'title' => "Setup",
                                    'description' => "",
                                    'start' => $strStartDate,
                                    'end' => $strStartDate,
                                    'location' => "",
                                    'color' => '#28257F',
                                    'className' => 'fc-event-success',
                                    'limitdate' => $post['limitdate'],
                                    'compcode' => session()->get('compcode'),
                                    'status' => 'active',
                                ];
                                $this->SetMonthModel->insert($data);
                                for ($item = 0; $item < count($post['kt_docs_repeater_basic']); $item++) {
                                    if(isset($post['kt_docs_repeater_basic'][$item]['chkopen'][0])){
                                        $datai = array(
                                            'days' => $strStartDate,
                                            'time' => $post['kt_docs_repeater_basic'][$item]['timestart'],
                                            'etime' => $post['kt_docs_repeater_basic'][$item]['tmeend'],
                                            'compcode' => session()->get('compcode'),
                                            'status' => 'active',
                                        );
                                    }else{
                                        $datai = array(
                                            'days' => $strStartDate,
                                            'time' => $post['kt_docs_repeater_basic'][$item]['timestart'],
                                            'etime' => $post['kt_docs_repeater_basic'][$item]['tmeend'],
                                            'compcode' => session()->get('compcode'),
                                            'status' => 'inactive',
                                        );
                                    }
                                    $this->TimeModel->insert($datai);
                                }
                            }
                  }else if($DayOfWeek == 0 && $post['checkday'][6]==1){
                            $intHoliday++;
                            echo "$strStartDate = <b>Work Day</b><br>";
                            $duplicatedate = $this->TimeModel->where(["days" => $strStartDate])->get()->getRow();
                            if (!$duplicatedate) {
                                $data = [
                                    'days' => $strStartDate,
                                    'setuptype' => $post['calendartype'],
                                    'title' => "Setup",
                                    'description' => "",
                                    'start' => $strStartDate,
                                    'end' => $strStartDate,
                                    'location' => "",
                                    'color' => '#28257F',
                                    'className' => 'fc-event-success',
                                    'limitdate' => $post['limitdate'],
                                    'compcode' => session()->get('compcode'),
                                    'status' => 'active',
                                ];
                                $this->SetMonthModel->insert($data);
                                for ($item = 0; $item < count($post['kt_docs_repeater_basic']); $item++) {
                                    if(isset($post['kt_docs_repeater_basic'][$item]['chkopen'][0])){
                                        $datai = array(
                                            'days' => $strStartDate,
                                            'time' => $post['kt_docs_repeater_basic'][$item]['timestart'],
                                            'etime' => $post['kt_docs_repeater_basic'][$item]['tmeend'],
                                            'compcode' => session()->get('compcode'),
                                            'status' => 'active',
                                        );
                                    }else{
                                        $datai = array(
                                            'days' => $strStartDate,
                                            'time' => $post['kt_docs_repeater_basic'][$item]['timestart'],
                                            'etime' => $post['kt_docs_repeater_basic'][$item]['tmeend'],
                                            'compcode' => session()->get('compcode'),
                                            'status' => 'inactive',
                                        );
                                    }
                                    $this->TimeModel->insert($datai);
                                }
                            }
                  }else{
                      $intWorkDay++;
                        echo "$strStartDate = <font color=red>Holiday</font><br>";
                  }
                  
                  $DayOfWeek= date("l", strtotime($strStartDate)); // return Sunday, Monday,Tuesday....
              
                  $strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));
              }
            
            // echo "<hr>";
            // echo "<br>Total Day = $intTotalDay";
            // echo "<br>Work Day = $intWorkDay";
            // echo "<br>Holiday = $intHoliday";
        }
        return redirect()->to('/time');
        
    }
    public function editsettime(){
        $post = $this->request->getPost();
        return $this->response->setJSON($post);
    }
    public function updatelimit(){
        $post = $this->request->getPost();
        $data = [
            'limitdate' => $post['limit'],
            'edit_date' => date('Y-m-d H:i:s'),
            'compcode' => session()->get('compcode'),
            'edit_user' => session()->get('user_name'),
        ];
        
        $result = $this->SetMonthModel->setlimit($post['date'], $data);
        
        if($result) {
            $get_days =  $this->SetMonthModel->asArray()->where(['days'=> $post['date'],'compcode'=>session()->get('compcode')])->first();
            if($get_days){
                $res = $get_days['id'];
            }else{
                $res = "false";
            }
            $message = "User Limit are updated successfully.";
        } else {
            $res = "false";
            $message = "Something went wrong";
        }
        $arr = [
            "result" => $res,
            "message" => $message,
        
        ];
        return $this->response->setJSON($arr);
    }
    public function saveTimedelay(){
        $post = $this->request->getPost();
        
        $data = [
            'time_deley' => $post['data'],
            'edit_date' => date('Y-m-d H:i:s'),
            'edit_user' => session()->get('user_name'),
        ];
        $result = $this->CompanyModel->update(['id'=> $post['id'],'compcode' => session()->get('compcode')],$data);
        if ($result) {
           $res = $post['data'];
           $message = "updated successfully";
        }else{
            $res = "false";
            $message = "Something went wrong";
        }
        $arr = [
            "result" => $res,
            "message" => $message,
        
        ];
        return $this->response->setJSON($arr);
    }
    public function saveAvance(){
        $post = $this->request->getPost();
        $data = [
            'adv_amount' => $post['data'],
            'compcode' => session()->get('compcode'),
            'edit_date' => date('Y-m-d H:i:s'),
            'edit_user' => session()->get('user_name'),
        ];
        $result = $this->CompanyModel->update(['id'=> '1'],$data);
        if ($result) {
           $res = $post['data'];
           $message = "updated successfully";
        }else{
            $res = "false";
            $message = "Something went wrong";
        }
        $arr = [
            "result" => $res,
            "message" => $message,
        
        ];
        return $this->response->setJSON($arr);
    }
    public function deletedateCalendar(){
        $date = $this->request->getVar('dstart');
        $result = $this->SetMonthModel->daysCalendarDelHead($date);
        if ($result) {
            $result_detail = $this->TimeModel->daysCalendarDelrow($date);
            if ($result_detail ) {
                $message = "User Date are DELETE successfully.";
                $arr = [
                    "result" => "successed",
                    "message" => $message,
                
                ];
            }else{
                $message = "Something went Delete Detail wrong";
                $arr = [
                    "result" => "error",
                    "message" => $message,
                
                ];
            }
        }else{
            $message = "Something went wrong";
            $arr = [
                "result" => "error",
                "message" => $message,
            
            ];
        }
        return $this->response->setJSON($arr);
        
    }
    public function saveUser(){
        // return $this->response->setJSON($add);
        $add = $this->request->getPost();
        $img = $this->request->getFile('userfile');
        
        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    // 'max_size[userfile,100]',
                    // 'max_dims[userfile,1024,768]',
                ],
            ],
        ];
        if (! $this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];
        
            $data = [
                'user_name' => $add['fname'],
                'user_email' => $add['email'],
                'user_password' => password_hash($add['new_password'],PASSWORD_BCRYPT),
                'prekey' => $add['new_password'],
                'mobile' => $add['phone'],
                // 'compcode' => session()->get('compcode'),
            ];
            $this->UsersModel->update_profile($add['cid'],$data);
            return redirect()->to('/add_user');
        }
        
        $img = $this->request->getFile('userfile');
        
        if (! $img->hasMoved()) {
            $filepath = 'profile/';
            $img->move($filepath);
            // $filepath = WRITEPATH . 'profile/';
        
            $data = ['uploaded_fileinfo' => new File($filepath)];
        
            // return view('upload_success', $data);
            $data = [
                'user_name' => $add['fname'],
                'user_email' => $add['email'],
                'user_password' => password_hash($add['new_password'],PASSWORD_BCRYPT),
                'prekey' => $add['new_password'],
                'mobile' => $add['phone'],
                // 'compcode' => session()->get('compcode'),
                'user_img' => $img->getName(),
            ];
            $result =  $this->UsersModel->update_profile($add['cid'],$data);
            return redirect()->to('/add_user');
        }
        $data = ['errors' => 'The file has already been moved.'];
    }
    public function saveAddUser(){
        // return $this->response->setJSON($add);
        $add = $this->request->getPost();
        $img = $this->request->getFile('userfile');
        
        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    // 'max_size[userfile,100]',
                    // 'max_dims[userfile,1024,768]',
                ],
            ],
        ];
        if (! $this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];
        
            $data = [
                'user_name' => $add['user_name'],
                'user_email' => $add['user_email'],
                'user_password' => password_hash($add['user_pass'],PASSWORD_BCRYPT),
                'prekey' => $add['user_pass'],
                'mobile' => $add['mobile'],
                'compcode' => session()->get('compcode'),
                'user_created_at' => date('Y-m-d H:i:s'),
                'user_status' => 'active',
            ];
            $this->UsersModel->insert($data);
            return redirect()->to('/add_user');
        }
        
        $img = $this->request->getFile('userfile');
        
        if (! $img->hasMoved()) {
            $filepath = 'profile/';
            $img->move($filepath);
            // $filepath = WRITEPATH . 'profile/';
        
            $data = ['uploaded_fileinfo' => new File($filepath)];
        
            // return view('upload_success', $data);
            $data = [
                'user_name' => $add['user_name'],
                'user_email' => $add['user_email'],
                'user_password' => password_hash($add['user_pass'],PASSWORD_BCRYPT),
                'prekey' => $add['user_pass'],
                'mobile' => $add['mobile'],
                'compcode' => session()->get('compcode'),
                'user_status' => 'active',
                'user_created_at' => date('Y-m-d H:i:s'),
                'user_img' => $img->getName(),
            ];
            $result =  $this->UsersModel->insert($data);
            return redirect()->to('/add_user');
        }
        $data = ['errors' => 'The file has already been moved.'];
    }
    public function deleteAppointDate(){
        $today = date('Y-m-d');
        $date = $this->request->getVar('dstart');
        $id = $this->request->getVar('id');
        $title = $this->request->getVar('title');
        $stime = $this->request->getVar('stime');
        $result = $this->AppointmentModel->daysCalendarDeleteAppoint($date,$id);
        if ($result) {
            file_put_contents("appointment.log", "{$today} {$stime} :[DELETE]: Deleted appointments By ".session()->get('user_name')." Date Appoint ".$date." eventName: ".$title."  \n",FILE_APPEND | LOCK_EX);
            $message = "User Date are DELETE successfully.";
            $arr = [
                "result" => "successed",
                "message" => $message,
            
            ];
        }else{
            $message = "Something went wrong";
            $arr = [
                "result" => "error",
                "message" => $message,
            
            ];
        }
        return $this->response->setJSON($arr);
        
    }
    public function deleteuser(){
        $id = $this->request->getPost('id');
        $result = $this->UsersModel->where(['id'=> $id])->delete();
        if ($result) {
            $message = "User Date are DELETE successfully.";
            $arr = [
                "result" => "successed",
                "message" => $message,
            
            ];
        }else{
            $message = "Something went wrong";
            $arr = [
                "result" => "error",
                "message" => $message,
            
            ];
        }
        return $this->response->setJSON($arr);
        
    }
    public function deleteCustomer(){
        $id = $this->request->getPost('id');
        $result = $this->CustomerModel->where(['id'=> $id,'compcode'=> session()->get('compcode')])->delete();
        if ($result) {
            $message = "User Date are DELETE successfully.";
            $arr = [
                "result" => "successed",
                "message" => $message,
            
            ];
        }else{
            $message = "Something went wrong";
            $arr = [
                "result" => "error",
                "message" => $message,
            
            ];
        }
        return $this->response->setJSON($arr);
        
    }
    public function savePackage(){
        
        $img = $this->request->getFile('userfile');
        
        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    // 'max_size[userfile,100]',
                    // 'max_dims[userfile,1024,768]',
                ],
            ],
        ];
        if (! $this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];
        
           $post = $this->request->getPost();
           $data = [
               'pcode' => $post['packagecode'],
               'pname' => $post['packagename'],
               'pstatus' => $post['packagestatus'],
               'compcode' => session()->get('compcode'),
               'create_user' => session()->get('user_name'),
               'create_date' => date('Y-m-d H:i:s'),
           ];
           $result = $this->PackageModel->insert($data);
           if ($post['fakename'] != "") {
               $datafile = [
                   'package_code' => $post['packagecode'],
               ];
               $this->UploadFileModel->update_file_num(['package_num' => $post['fakename']],$datafile);
           }
           return redirect()->to('/package');
        }
        
        $img = $this->request->getFile('userfile');
        
        if (! $img->hasMoved()) {
            $filepath = 'profile/';
            $img->move($filepath);
            // $filepath = WRITEPATH . 'profile/';
        
            $data = ['uploaded_fileinfo' => new File($filepath)];
            $post = $this->request->getPost();
            $data = [
                'pcode' => $post['packagecode'],
                'pname' => $post['packagename'],
                'pstatus' => $post['packagestatus'],
                'compcode' => session()->get('compcode'),
                'create_user' => session()->get('user_name'),
                'create_date' => date('Y-m-d H:i:s'),
                'image' => $img->getName(),
            ];
            $result = $this->PackageModel->insert($data);
            if ($post['fakename'] != "") {
                $datafile = [
                    'package_code' => $post['packagecode'],
                ];
                $this->UploadFileModel->update_file_num(['package_num' => $post['fakename']],$datafile);
            }
            return redirect()->to('/package');
        }
        $data = ['errors' => 'The file has already been moved.'];
        
        
        
        // $post = $this->request->getPost();
        // $data = [
        //     'pcode' => $post['packagecode'],
        //     'pname' => $post['packagename'],
        //     'pstatus' => $post['packagestatus'],
        //     'compcode' => session()->get('compcode'),
        //     'create_user' => session()->get('user_name'),
        //     'create_date' => date('Y-m-d H:i:s'),
        // ];
        // $result = $this->PackageModel->insert($data);
        // return redirect()->to('/package');
    }
    public function updatePackage(){
        $post = $this->request->getPost();
        $img = $this->request->getFile('userfile');
        
        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    // 'max_size[userfile,100]',
                    // 'max_dims[userfile,1024,768]',
                ],
            ],
        ];
        if (! $this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];
        
            $data = [
                'pcode' => $post['pcode'],
                'pname' => $post['pname'],
                'pstatus' => $post['pstatus'],
                'compcode' => session()->get('compcode'),
                'edit_date' => date('Y-m-d H:i:s'),
                'edit_user' => session()->get('user_name'),
            ];
            $result = $this->PackageModel->update(['id'=> $post['pid']],$data);
            return redirect()->to('/package');
        }
        
        $img = $this->request->getFile('userfile');
        
        if (! $img->hasMoved()) {
            $filepath = 'profile/';
            $img->move($filepath);
            // $filepath = WRITEPATH . 'profile/';
        
            $data = ['uploaded_fileinfo' => new File($filepath)];
        
            // return view('upload_success', $data);
            $data = [
                'pcode' => $post['pcode'],
                'pname' => $post['pname'],
                'pstatus' => $post['pstatus'],
                'compcode' => session()->get('compcode'),
                'edit_date' => date('Y-m-d H:i:s'),
                'edit_user' => session()->get('user_name'),
                'image' => $img->getName(),
            ];
            $result = $this->PackageModel->update(['id'=> $post['pid']],$data);
            return redirect()->to('/package');
        }
        $data = ['errors' => 'The file has already been moved.'];
   
    }
    public function delPackage(){
        $id = $this->request->getPost('id');
        $result = $this->PackageModel->where(['pcode'=> $id,'compcode'=> session()->get('compcode')])->delete();
        if ($result) {
            $message = "User Date are DELETE successfully.";
            $arr = [
                "result" => "successed",
                "message" => $message,
            
            ];
        }else{
            $message = "Something went wrong";
            $arr = [
                "result" => "error",
                "message" => $message,
            
            ];
        }
        return $this->response->setJSON($arr);
    }
    protected function  EOM($month,$year){
        if($month=='01' || $month=='03' || $month=='05' || $month=='07' || $month=='08' || $month=='10' || $month=='12'){
            $EOM='31';
        }else if($month=='02'){
            if($year%4==0){
                $EOM='29';
            }else{
                $EOM='28';
            }
        }else{
            $EOM='30';
        }
        return $EOM;
    }
}


// [
//     {
//         id: uid(),
//         title: 'All Day Event',
//         start: YM + '-01',
//         end: YM + '-02',
//         description: 'Toto lorem ipsum dolor sit incid idunt ut',
//         className: "fc-event-danger fc-event-solid-warning",
//         location: 'Federation Square'
//     },
//     {
//         id: uid(),
//         title: 'Reporting',
//         start: YM + '-14T13:30:00',
//         description: 'Lorem ipsum dolor incid idunt ut labore',
//         end: YM + '-14T14:30:00',
//         className: "fc-event-success",
//         location: 'Meeting Room 7.03'
//     },
//     {
//         id: uid(),
//         title: 'Company Trip',
//         start: YM + '-02',
//         description: 'Lorem ipsum dolor sit tempor incid',
//         end: YM + '-03',
//         className: "fc-event-info",
//         location: 'Seoul, Korea'

//     },
//     {
//         id: uid(),
//         title: 'ICT Expo 2021 - Product Release',
//         start: YM + '-03',
//         description: 'Lorem ipsum dolor sit tempor inci',
//         end: YM + '-05',
//         className: "fc-event-light fc-event-solid-info",
//         location: 'Melbourne Exhibition Hall'
//     },
//     {
//         id: uid(),
//         title: 'Dinner',
//         start: YM + '-12',
//         description: 'Lorem ipsum dolor sit amet, conse ctetur',
//         end: YM + '-13',
//         location: 'Squire\'s Loft'
//     },
//     {
//         id: uid(),
//         title: 'Repeating Event',
//         start: YM + '-09T16:00:00',
//         end: YM + '-09T17:00:00',
//         description: 'Lorem ipsum dolor sit ncididunt ut labore',
//         className: "fc-event-danger",
//         location: 'General Area'
//     },
//     {
//         id: uid(),
//         title: 'Repeating Event',
//         description: 'Lorem ipsum dolor sit amet, labore',
//         start: YM + '-16T16:00:00',
//         end: YM + '-16T17:00:00',
//         location: 'General Area'
//     },
//     {
//         id: uid(),
//         title: 'Conference',
//         start: YESTERDAY,
//         end: TOMORROW,
//         description: 'Lorem ipsum dolor eius mod tempor labore',
//         className: "fc-event-info",
//         location: 'Conference Hall A'
//     },
//     {
//         id: uid(),
//         title: 'Meeting',
//         start: TODAY + 'T10:30:00',
//         end: TODAY + 'T12:30:00',
//         description: 'Lorem ipsum dolor eiu idunt ut labore',
//         location: 'Meeting Room 11.06'
//     },
//     {
//         id: uid(),
//         title: 'Lunch',
//         start: TODAY + 'T12:00:00',
//         end: TODAY + 'T14:00:00',
//         className: "fc-event-info",
//         description: 'Lorem ipsum dolor sit amet, ut labore',
//         location: 'Cafeteria'
//     },
//     {
//         id: uid(),
//         title: 'Meeting',
//         start: TODAY + 'T14:30:00',
//         end: TODAY + 'T15:30:00',
//         className: "fc-event-warning",
//         description: 'Lorem ipsum conse ctetur adipi scing',
//         location: 'Meeting Room 11.10'
//     },
//     {
//         id: uid(),
//         title: 'Happy Hour',
//         start: TODAY + 'T17:30:00',
//         end: TODAY + 'T21:30:00',
//         className: "fc-event-info",
//         description: 'Lorem ipsum dolor sit amet, conse ctetur',
//         location: 'The English Pub'
//     },
//     {
//         id: uid(),
//         title: 'Dinner',
//         start: TOMORROW + 'T18:00:00',
//         end: TOMORROW + 'T21:00:00',
//         className: "fc-event-solid-danger fc-event-light",
//         description: 'Lorem ipsum dolor sit ctetur adipi scing',
//         location: 'New York Steakhouse'
//     },
//     {
//         id: uid(),
//         title: 'Birthday Party',
//         start: TOMORROW + 'T12:00:00',
//         end: TOMORROW + 'T14:00:00',
//         className: "fc-event-info",
//         description: 'Lorem ipsum dolor sit amet, scing',
//         location: 'The English Pub'
//     },
//     {
//         id: uid(),
//         title: 'Site visit',
//         start: YM + '-28',
//         end: YM + '-29',
//         className: "fc-event-solid-info fc-event-light",
//         description: 'Lorem ipsum dolor sit amet, labore',
//         location: '271, Spring Street'
//     }
// ]