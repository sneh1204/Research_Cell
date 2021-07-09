<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Counter extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->prefix = "rsrch_";
	}
	public function increaseHit()
    {
        $data = $this->getData();
		$data->total += 1;
		if(!$this->isOldVisitor()){
			$time = time() + (5 * 365 * 24 * 60 * 60);
			set_cookie('visited', true, (int) $time);
			$data->uniq += 1;
		}
		$this->updateData($data->total, $data->uniq);
		return $data;
    }
	function updateData($total, $uniq){
        $sql = "UPDATE `{$this->prefix}visits` SET total=?, uniq=?";
		try {
			$this->db->query($sql, array($total, $uniq));
			return true;
		} catch (Exception $e) {
			echo "Error Occured While updating";
		}
    }
	function getData(){
        $sql = "SELECT * from `{$this->prefix}visits`";
        $query = $this->db->query($sql);
        return $query->result()[0];
    }
	public function isOldVisitor(){
		if(get_cookie('visited') == true)	return true;
		else return false;
    }
  }
