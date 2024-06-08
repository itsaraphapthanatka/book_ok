<?php namespace App\Models;

use CodeIgniter\Model;

class TimeModel extends Model{
	protected $table = 'set_time';
	protected $primaryKey = 'id';
	protected $allowedFields = ['days', 'time', 'etime', 'compcode', 'status', 'create_date', 'create_user', 'edit_date', 'edit_user'];
	// protected $useTimestamps = true;
	
	
	public function getTimeConfig(){
			$builder = $this->table('set_time');
			$builder->select('*');
			$builder->where('compcode',session()->get('compcode'));
			$query = $builder->get()->getResult();
			return $query;
	}
	
	public function timechkrow($id,$data){
		return $this->db
		->table('set_time')
		->where(["id" => $id,'compcode' => session()->get('compcode')])
		->set($data)
		->update();
	}
	public function getsetimeByDate($days){
		$builder = $this->table('set_time');
		$builder->select('*');
		$builder->where(['days' => $days,'compcode' => session()->get('compcode')]);
		$query = $builder->get()->getResult();
		return $query;
	}
	public function get_timeselect() {
	return $this->db
					->table('set_time')
					->orderBy('id', 'DESC')
					->get()
					->getRow();
	}
	public function daysCalendarDelrow($days) {
		return $this->db
					->table('set_time')
					->where(["days" => $days])
					->delete();
	}
	
	
}
