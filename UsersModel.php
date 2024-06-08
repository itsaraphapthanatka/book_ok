<?php namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_name', 'user_email','user_password','user_created_at', 'mobile','compcode', 'prekey', 'user_status', 'user_img','line_auth'];
    // protected $useTimestamps = true;
    
    public function chkLogin($email){
        return $this->asArray()
                    ->where(['user_email'=> $email,'user_status'=>'active'])
                    ->first();
       
    }

    public function getUsers(){
        return $this->orderBy('id', 'DESC')->findAll();
    }
    
    public function update_profile($id,$data){
        return $this->db
                    ->table('users')
                    ->where(["id" => $id])
                    ->set($data)
                    ->update();
    }
    protected function hashPassword(array $data)
    {
        if (! isset($data['data']['password'])) {
            return $data;
        }
    
        $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        unset($data['data']['password']);
    
        return $data;
    }
}