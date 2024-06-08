<?php namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Files\File;
use App\Models\UploadFileModel;
use App\Models\PackageModel;

class UploadFile extends BaseController{
    public function __construct() {
        $db = db_connect();
        $this->PackageModel = new PackageModel($db);
    }

    public function uploadFilePackage(){
        
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            // ปรับเส้นทางการเคลื่อนย้ายไฟล์ไปยังโฟลเดอร์ `assets`
            $file->move(ROOTPATH . 'uploads', $newName);
        
            // บันทึกข้อมูลไฟล์ลงในฐานข้อมูล
            $model = new UploadFileModel();
            $model->save([
                'package_code' => $this->request->getPost('pcode'),
                'package_img' => $newName,
                'package_num' => $this->request->getPost('data'),
                'file_type' => $file->getClientMimeType(),
                'file_path' => ROOTPATH . 'uploads' . $newName,
                'compcode' => session()->get('compcode'),
                'original_name' => $file->getClientName(),
            ]);
        
            // return redirect()->to('/upload')->with('message', 'File has been uploaded and saved to database');
        }
    }
    public function loadFilePackage($seg1 = false){
        $data['packagecode'] = $seg1;
        $uploadFile = new uploadFileModel();
        $data['pid'] = $this->PackageModel->asArray()->where(['pcode'=> $seg1,'compcode'=> session()->get('compcode')])->first();
        $data['getFile'] = $uploadFile->where(['package_code' => $seg1])->orderBy('id','asc')->findAll();
        echo view('master/load_package_file',$data);
       
    }
    public function deleteFile($seg1 = false,$seg2 = false){
        $model = new UploadFileModel();
        
         $data['post'] = $model->where('id', $seg1)->delete();
        
         return redirect()->to( base_url('editPackage/'.$seg2) );
    }
}