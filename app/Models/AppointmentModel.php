<?php 
namespace App\Models;
use CodeIgniter\Model;

class AppointmentModel extends Model {
    protected $table = 'appointments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['uid','title', 'description', 'start', 'end','location','mobile','color','className','stime','etime','package','shotday', 'compcode'];
    protected $useTimestamps = false;

    public function getAppointments($id = false){
        if ($id === false) {
            return $this->where(['compcode'=> session()->get('compcode')])->orderBy('id', 'DESC')->findAll();
        }
        return $this->asArray()
                    ->where(['id' => $id,'compcode'=>session()->get('compcode')])
                    ->first();
    }
    public function getappoint(){
        $builder = $this->table('appointments');
        $builder->select('*,start as astart,end as aend,concat(start,"T",stime) as start,concat(end,"T",etime) as end,appointments.id as id ,package.id as pid');
        $builder->join('package', 'appointments.package = package.pcode','left');
        $builder->where('appointments.compcode',session()->get('compcode'));
        $builder->orderBy('appointments.id', 'DESC');
        $query = $builder->get()->getResult();
        return $query;
    }
    public function appoint_update($id, $data) {
        return $this->db
                    ->table('appointments')
                    ->where(["id" => $id,'compcode'=>session()->get('compcode')])
                    ->set($data)
                    ->update();
    }
    public function daysCalendarDeleteAppoint($days,$id) {
        return $this->db
                    ->table('appointments')
                    ->where(["start" => $days,"id" => $id,'compcode'=>session()->get('compcode')])
                    ->delete();
    }
}
