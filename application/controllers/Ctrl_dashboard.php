<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_dashboard extends Admin_Controller {

    function __construct(){
        parent::__construct();
        if(!isset($_SESSION['loggedin']))   redirect('Ctrl_admin/notloggedin');
    }

	public function index(){
        $this->load->view('admin/dashboard');
    }

}