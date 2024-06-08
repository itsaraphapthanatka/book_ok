<?php namespace App\Controllers;

use App\Models\DaysModel;
use App\Models\TimeModel;
use CodeIgniter\Controller;

class DaysCurd extends Controller{
    public function __construct() {
		$db = db_connect();
		$this->DaysModel = new DaysModel($db);
        $this->TimeModel = new TimeModel($db);
	}

    public function index(){
        $model = new DaysModel();
        $query = $model->orderBy('id','desc')->findAll();
        return $this->response->setJSON($query);
    }
    public function addDays(){
        $data = [
            'day_code' => 'aa',
            'status' => 'active',
            'update_date' => date('Y-m-d H:i:s'),
            'update_user' => session()->get('user_name'),
        ];
        $this->DaysModel->insert($data);
        return true;
    }
    public function update(){

        $id = $this->request->getVar('id');
        $flag = $this->request->getVar('data');
        if($flag == 'true' ){
            $status = 'active';
        }else{
            $status = 'inactive'; 
        }
        $data = [
            'status' => $status,
            'compcode' => session()->get('compcode'),
            'update_date' => date('Y-m-d H:i:s'),
            'update_user' => session()->get('user_name'),
        ];
        
        $result = $this->DaysModel->daysupdate($id, $data);
		if($result) {
            $get_days =  $this->DaysModel->get_days($id);
            if($get_days->status == "active"){
                $res = "true";
            }else{
                $res = "false";
            }
			$message = "User details are updated successfully.";
		} else {
			$res = "false";
            $message = "Something went wrong";
		}
        $arr = [
            "result" => $res,
            "message" => $message,
        
        ];
        return $this->response->setJSON($arr);
        // $this->DaysModel->where('id', $id);
        // $this->DaysModel->update($data);
        // return 'true';
    }
    public function editrow(){
        $id = $this->request->getVar('id');
        $time = $this->request->getVar('time');
        $etime = $this->request->getVar('etime');
        
        $data = [
            'time' => $time,
            'etime' => $etime,
        ];
        $result = $this->DaysModel->dayseditrow($id, $data);
        if ($result) {
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
    public function delrow(){
        $id = $this->request->getVar('id');
        $time = $this->request->getVar('time');
        $etime = $this->request->getVar('etime');
        
        // $data = [
        //     'time' => $time,
        //     'etime' => $etime,
        // ];
        $result = $this->DaysModel->daysdelrow($id);
        // $result = $this->DaysModel->where('id',$id)->delete($id);
        if ($result) {
            $message = "User details are DELETE successfully.";
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
    public function addrow(){
        $day = $this->request->getVar('day');
        $time = $this->request->getVar('time');
        $etime = $this->request->getVar('etime');
        $chkopen = $this->request->getVar('chk');
        if ($chkopen == "true") {
            $chk = 'active';
        }else{
            $chk = 'inactive';
        }
        $data = [
            'days' => $day,
            'time' => $time,
            'etime' => $etime,
            'status' => $chk,
            'compcode' => session()->get('compcode'),
            'create_date' => date('Y-m-d H:i:s'),
            'create_user' => session()->get('user_name'),
        ];
        $result = $this->TimeModel->insert($data);
        if ($result) {
            $getData = $this->TimeModel->get_timeselect();
            $message = "User details are Add successfully.";
            $arr = [
                "result" => "successed",
                "message" => $message,
                "rowid" => $getData->id,
                "time" => date('H:i',strtotime($getData->time)),
                "etime" => date('H:i',strtotime($getData->etime)),
                'status' => $getData->status,
            
            ];
        }else{
            $message = "Something went wrong";
            $arr = [
                "result" => "error",
                "message" => $message,
                'rowid' => "",
            
            ];
        }
        return $this->response->setJSON($arr);
    }
    
    public function editchkrow(){
        $id = $this->request->getVar('id');
        $flag = $this->request->getVar('flag');
        if($flag == 'true' ){
            $status = 'active';
        }else{
            $status = 'inactive'; 
        }
        $data = [
            'status' => $status,
            'edit_date' => date('Y-m-d H:i:s'),
            'compcode' => session()->get('compcode'),
            'edit_user' => session()->get('user_name'),
        ];
        $result = $this->TimeModel->timechkrow($id, $data);
        if($result) {
            $res = "true";
            
            $message = "User details are updated successfully.";
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

}