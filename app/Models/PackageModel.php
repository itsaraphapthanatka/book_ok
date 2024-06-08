<?php namespace App\Models;

use CodeIgniter\Model;

class PackageModel extends Model{
    protected $table = 'package';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pcode', 'pname', 'pstatus', 'create_date' , 'create_user' ,'edit_date', 'edit_user', 'del_user', 'del_date', 'compcode', 'image'];
    protected $useTimestamps = false;
    
    public function getPackage(){
        $db = db_connect();
        $query = $db->query("SELECT pcode, pname,id as RecordID, pstatus, create_user, image, 'null' as Actions FROM package where compcode = '".session()->get('compcode')."' order by id ASC");
        // $query = $db->query("SELECT customer_name, customer_mobile,	id as RecordID, customer_address, customer_email, customer_tag, customer_status, create_user, 'null' as Actions FROM customer order by RecordID ASC");
        $row = $query->getResult();
        $count = $query->getNumRows();
        // $count =  $queryCount->getResult();v

       return $arr = [
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $row

        ];
    }
}