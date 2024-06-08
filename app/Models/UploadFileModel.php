<?php namespace App\Models;

use CodeIgniter\Model;

class UploadFileModel extends Model{
	protected $table = 'package_file';
	protected $primaryKey = 'id';
	protected $allowedFields = ['package_code','package_img','package_num','compcode','file_type','file_path','original_name'];
	protected $useTimestamps = false;
	
	public function update_file_num($num , $data){
		return $this->db
			->table('package_file')
			->where(["package_num" => $num,'compcode'=> session()->get('compcode')])
			->set($data)
			->update();
	}
}
