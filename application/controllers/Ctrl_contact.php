<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_contact extends Core_Controller {

	public function index()
	{
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view('contact', $data);
	}

}