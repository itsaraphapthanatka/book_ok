<?php namespace App\Models;

use Codeigniter\Model;

class SetMonthModel extends Model{
	protected $table = 'set_time_month';
	protected $primaryKey = 'id';
	protected $allowedFields = ['uid', 'title', 'description', 'days', 'setuptype', 'start', 'stime', 'end', 'etime', 'location', 'color', 'className', 'status', 'limitdate', 'compcode', 'create_date', 'create_user', 'edit_date', 'edit_user',];
	protected $useTimestamps = false;
	
	public function getsetmonth(){
		$builder = $this->table('set_time_month');
		$builder->select('*');
		$builder->orderBy('id', 'DESC');
		$query = $builder->get()->getResult();
		return $query;
	}
	public function setlimit($days,$data){
		return $this->db
						->table('set_time_month')
						->where(["days" => $days])
						->set($data)
						->update();
	}
	public function daysCalendarDelHead($days) {
		return $this->db
					->table('set_time_month')
					->where(["days" => $days])
					->delete();
	}
}