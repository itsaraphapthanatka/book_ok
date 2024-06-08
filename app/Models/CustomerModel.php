<?php namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model{
    protected $table = 'customer';
    protected $primaryKey = 'id';
    protected $allowedFields = ['customer_name', 'customer_address', 'customer_email', 'customer_mobile', 'customer_tag', 'customer_status', 'create_date' , 'create_user' ,'edit_date', 'edit_user'];
    protected $useTimestamps = false;
    
    public function getCustomer(){
        $db = db_connect();
        $query = $db->query("SELECT customer_name, customer_mobile,	id as RecordID, customer_address, customer_email, customer_tag, customer_status, create_user, 'null' as Actions, COUNT(customer_mobile) FROM customer where compcode = '".session()->get('compcode')."' GROUP BY customer_mobile order by ID ASC");
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