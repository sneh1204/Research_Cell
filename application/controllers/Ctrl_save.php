<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_save extends Core_Controller {

	public function saveStudent()
	{
        if(empty($_POST))   exit('No direct script access allowed');
		$this->Process->saveStudentDetails($_POST['name'], $_POST['email'], $_POST['branch'], $_POST['year'], $_POST['divi'], $_POST['title'], $_POST['link']);
        $data = ['added' => true];
        $this->load->view('swork', $data);
    }

}