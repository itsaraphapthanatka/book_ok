<?php namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model{
    protected $table = 'room';
    protected $allowedfields = ['room_name', 'room_status','compcode','create_user','create_date'];

    // public function chkLogin($email){
        
    //     return $this->asArray()
    //                 ->where('user_email',$email)
    //                 ->first();
       
    // }

    public function getRoom(){
        $builder = $this->table('room');
        $builder->select('* , room.id as roomID');
        $builder->join('branch', 'room.branch_code = branch.branch_code');
        $builder->where('compcode',session()->get('compcode'));
        $query = $builder->get()->getResult();
        
        $count =  $this->orderBy('id', 'DESC')->countAllResults();

       return $arr = [
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $query

        ];
    }
}