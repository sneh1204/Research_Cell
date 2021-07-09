<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_mous extends Core_Controller {

	public function index()
	{
		$data['mous'] = $this->Process->getEverything('mous');
		$data['mous_count'] = $this->Process->getRowCount('mous');
		$data['int_mous_count'] = $this->Process->getInternationalMousCount();
		$data['projects_count'] = $this->Process->getRowCount('ongoing');
		$data['intern_count'] = $this->Process->getAllInternCount();
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view('mous', $data);
	}

	public function getMous($id){
		$count = $this->Process->getMousProjectCount($id);
		$count = ($count == 0) ? "In Process" : $count;
		echo json_encode([$this->Process->getSingleData('mous', $id), $count, ($count == 'In Process') ? "-" : $this->Process->getStudentsEntrolledMous($id), ($count == 'In Process') ? "-" : $this->Process->getFacultiesEntrolledMous($id)]);
	}

}