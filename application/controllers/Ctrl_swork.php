<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_swork extends Core_Controller {

	public function index()
	{
		$data['latevents'] = $this->Process->getLatestByType('events');
		$data['paper_count'] = $this->Process->getStudentPaperCount();
		$bookc = $this->Process->getRowCount('fstudent_book');
		$chapc = $this->Process->getRowCount('fstudent_chapter');
		$data['book_chap_count'] = $bookc + $chapc;
		$data['copyright_count'] = $this->Process->getRowCount('fstudent_copyright');
		$data['patent_count'] = $this->Process->getRowCount('fstudent_patent');
		$data['tech_count'] = $this->Process->getRowCount('fstudent_tech');
		$data['certi_count'] = $this->Process->getRowCount('fstudent_certi');
		$this->load->view('swork', $data);
	}

}