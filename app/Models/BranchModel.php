<?php namespace App\Models;

use CodeIgniter\Model;

class BranchModel extends Model{
    protected $table = 'branch';
    protected $allowedfields = ['branch_name', 'branch_status','compcode','create_user','create_date'];

    // public function chkLogin($email){
        
    //     return $this->asArray()
    //                 ->where('user_email',$email)
    //                 ->first();
       
    // }

    public function getBranch(){
        $query =  $this->orderBy('id', 'DESC')->findAll();
        $count =  $this->orderBy('id', 'DESC')->countAllResults();

       return $arr = [
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $query

        ];
    }
}