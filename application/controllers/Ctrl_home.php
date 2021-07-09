<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_home extends Core_Controller {

	public function index()
	{
		$data['projects'] = $this->Process->getLatestByType('projects');
		$data['mous_count'] = $this->Process->getRowCount('mous');
		$data['projects_count'] = $this->Process->getRowCount('ongoing');
		$data['events_count'] = $this->Process->getRowCount('events');
		$data['intern_count'] = $this->Process->getAllInternCount();
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view('home', $data);
	}

}
