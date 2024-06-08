<?php namespace App\Models;

use CodeIgniter\Model;

class DaysModel extends Model{
	protected $table = 'days';
	protected $primaryKey = 'id';
	protected $allowedFields = ['day_code', 'day', 'compcode', 'status', 'update_date', 'update_user'];
	protected $useTimestamps = true;
	
	public function getDaysConfig(){
		$builder = $this->table('days');
		$builder->select('*');
		$builder->where('compcode',session()->get('compcode'));
		$query = $builder->get()->getResult();
		return $query;
	}
	
	public function get_days($id) {
	return $this->db
					->table('days')
					->where(["id" => $id,'compcode'=> session()->get('compcode')])
					->get()
					->getRow();
	}
	public function daysupdate($id, $data) {
		return $this->db
					->table('days')
					->where(["id" => $id,'compcode'=> session()->get('compcode')])
					->set($data)
					->update();
	}
	public function dayseditrow($id, $data) {
		return $this->db
					->table('set_time')
					->where(["id" => $id,'compcode'=> session()->get('compcode')])
					->set($data)
					->update();
	}
	public function daysdelrow($id) {
		return $this->db
					->table('set_time')
					->where(["id" => $id,'compcode'=> session()->get('compcode')])
					->delete();
	}
}