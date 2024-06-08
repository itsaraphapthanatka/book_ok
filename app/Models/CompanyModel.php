<?php namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model{
	protected $table = 'company';
	protected $primaryKey = 'id';
	protected $allowedFields = ['compcode', 'company_name', 'create_date', 'create_user', 'edit_date', 'edit_user', 'del_date', 'del_user', 'time_deley', 'adv_amount', 'compant_type', 'taxid', 'addr', 'CompanyTaxId', 'line_auth'];
	protected $useTimestamps = false;
	
	
	public function updateCompany($data){
		return $this->db
					->table('company')
					->where(["compcode" => session()->get('compcode')])
					->set($data)
					->update();
	}
}
