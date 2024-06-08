<?php namespace App\Models;

use Codeigniter\Model;

class MonthModel extends Model{
	protected $table = 'month';
	protected $primaryKey = 'id';
	protected $allowedFields = ['month_name_th', 'month_name_en', 'compcode', 'month_status', 'update_date', 'update_user'];
	protected $useTimestamps = true;
}