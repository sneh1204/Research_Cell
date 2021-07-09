<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Core_Controller extends CI_Controller{

	public $total;
	public $unique;
  
	public function __construct(){
		parent::__construct();
		$allevents = $this->Process->getEverything('events');
		foreach($allevents as $id => $data){
			$datetime = new DateTime($data->date);
			$now = new DateTime();
			if($datetime < $now) {
				if($data->type != 'completed')	$this->Process->updateDataById($data->id, 'type', 'completed', 'events');
			}else{
				if($data->type != 'upcoming')	$this->Process->updateDataById($data->id, 'type', 'upcoming', 'events');
			}
		}
		$allongoing = $this->Process->getEverything('ongoing_events');
		foreach($allongoing as $id => $data){
			$datetime = new DateTime($data->date);
			$now = new DateTime();
			if($datetime < $now) {
				if($data->type != 'completed')	$this->Process->updateDataById($data->id, 'type', 'completed', 'ongoing_events');
			}else{
				if($data->type != 'upcoming')	$this->Process->updateDataById($data->id, 'type', 'upcoming', 'ongoing_events');
			}
		}
		$data = $this->Counter->increaseHit();
		$this->total = $data->total;
		$this->unique = $data->uniq;
	}
	
 }