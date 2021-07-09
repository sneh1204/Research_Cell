<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_events extends Core_Controller {

	public function index()
	{
		$data['page'] = 1;
		$data['offset'] = 1;
		$data['totcount'] = $this->Process->getRowCount('events');
		$data['events'] = $this->Process->getPageData('events', $data['page']);
		$data['tabledata'] = $this->Process->getEverythingBySort('ongoing_events', 'date', 'desc');
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view('events', $data);
	}

	public function callback(){
		$this->load->view('callback4');
	}

	public function logout(){
        $this->load->view('logout4');
    }

	public function loginCheck(){
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view("eventLogin", $data);
	}

	public function page($page){
		$data['page'] = $page;
		if(!isset($_GET['offset']))	$data['offset'] = true;
		else $data['offset'] = $_GET['offset'];
		$data['totcount'] = $this->Process->getRowCount('events');
		$data['events'] = $this->Process->getPageData('events', $data['page']);
		$data['tabledata'] = $this->Process->getEverythingBySort('ongoing_events', 'date', 'desc');
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view('events', $data);
	}

	public function addEvent(){
		if(!isset($_SESSION['access_token'])) redirect("Ctrl_events/loginCheck");
        $data['latevents'] = $this->Process->getLatestByType('events');
        $access = ["research@sakec.ac.in", "sneh.jain@sakec.ac.in"]; // make a list in backend later
		if(!in_array($_SESSION['email'], $access)){
			$_SESSION['error'] = "No access";
			unset($_SESSION['access_token']);
			$this->load->view('error', $data);
			return;
		}
		$data['events'] = $this->Process->getEverything('ongoing_events');
		$this->load->view('addEvent', $data);
	}

	public function event($event){
		if($this->Process->columnExists($event, 'events')){
			$data['eno'] = $event;
			$data['event'] = $this->Process->getSingleData('events', $data['eno']);
			$data['latevents'] = $this->Process->getLatestByType('events');
			$this->load->view('event', $data);
		}else{
			$_SESSION['error'] = 'That event doesnt exist!';
			redirect('Ctrl_error');
		}
	}

}