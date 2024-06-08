<?php namespace App\Controllers;
use App\Models\AppointmentModel;
use CodeIgniter\Files\File;
use CodeIgniter\Controller;

class Appointment extends BaseController {
    public function __construct() {
        $db = db_connect();
        $this->AppointmentModel = new AppointmentModel($db);
    }

    public function index(){
        $appoint = new AppointmentModel();
        $query =  $appoint->orderBy('id','ASC')->findAll();
        return $this->response->setJSON($query);

    }

    public function insert(){
        // return $this->request->getVar('title');
        $days = ['su','mo','tu','we','th','fr','sa'];
        $day = date('w',strtotime($this->request->getVar('dstart')));
        $today = date('Y-m-d H:i:s');
        $sdate = $this->request->getVar('dstart');
        $title = $this->request->getVar('title');
        $stime = $this->request->getVar('stime');
        $mobile = $this->request->getVar('mobile');
        $data = [
            'uid' => $this->request->getVar('uid'),
            'title' => $title,
            'description' => $this->request->getVar('description'),
            'mobile' => $mobile,
            'start' => $sdate,
            'stime' =>  $stime,
            'end' => $this->request->getVar('enddate'),
            'etime' => $this->request->getVar('etime'),
            'location' => $this->request->getVar('location'),
            'color' => '#28257F',
            'className' => 'fc-event-info',
            'package' => $this->request->getVar('package'),
            'shotday' => $days[$day],
            'compcode' => session()->get('compcode'),
        ];
        $result = $this->AppointmentModel->insert($data);
        file_put_contents("appointment.log", "{$today} :[ADD]: Insert appointments By ".session()->get('user_name')." Date Appoint ".$this->request->getVar('dstart')." eventName: ".$this->request->getVar('title')."  \n",FILE_APPEND | LOCK_EX);
        $this->sendLineMessage($title,$sdate,$stime,$mobile);
        return $this->response->setJSON($data);
    }
    public function update(){
        $id = $this->request->getVar('uid');
        // return $this->request->getVar('title');
        $today = date('Y-m-d H:i:s');
        $data = [
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'mobile' => $this->request->getVar('mobile'),
            'start' => $this->request->getVar('dstart'),
            'stime' =>  $this->request->getVar('stime'),
            'end' => $this->request->getVar('enddate'),
            'etime' => $this->request->getVar('etime'),
            'location' => $this->request->getVar('location'),
            'package' => $this->request->getVar('package'),
        ];
        $result = $this->AppointmentModel->appoint_update($id,$data);
        file_put_contents("appointment.log", "{$today} :[ADD]: Insert appointments By ".session()->get('user_name')." Date Appoint ".$this->request->getVar('dstart')." eventName: ".$this->request->getVar('title')."  \n",FILE_APPEND | LOCK_EX);
        return $this->response->setJSON($id);
    }
    
    private function sendLineMessage($title,$sdate,$stime,$mobile){
          $curl = curl_init();
          
          curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://lineoa-appoint.appreview.co.th/pushmessage.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
              "id": "Uab21834db3808efbbe30c30ea954c231",
              "type": "flex",
              "name": "'.$title.'",
              "date": "'.$sdate.'",
              "time": "'.$stime.'",
              "price": "9000",
              "mobile": "'.$mobile.'"
          }',
            CURLOPT_HTTPHEADER => array(
              'Authorization: '.session()->get('line_auth'),
              'Content-Type: application/json'
            ),
          ));
          
              if(curl_exec($curl) === false)
              {
                  // echo 'Curl error: ' . curl_error($ch);
                  $date = date("Y-m-d H:i:s");
                  // file_put_contents("line.log", "{$date} :[ERROR]: send message to ".$fullname." : ".$name." : ".$userid." : ".$date." : ".$time." : ".$mobile." line OA Unsuccessfully\n",FILE_APPEND | LOCK_EX);
              }
              else
              {
                  // echo 'Operation completed without any errors';
                  $date = date("Y-m-d H:i:s");
                  // file_put_contents("line.log", "{$date} :[PASS]: send message to ".$fullname." : ".$name." : ".$userid." : ".$date." : ".$time." : ".$mobile." line OA Successfully\n",FILE_APPEND | LOCK_EX);
              }
          curl_close($curl);
    
       }
}