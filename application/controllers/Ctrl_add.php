<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_add extends Admin_Controller {

    function __construct(){
        parent::__construct();
        if(!isset($_SESSION['loggedin']))   redirect('Ctrl_admin/notloggedin');
    }
    
    public function project($params=''){
        $data = [];
        if($params != "")   $data[$params] = true;
        $data['mous'] = $this->Process->getEverythingAsArray("mous");
        $this->load->view('admin/add/project', $data);
    }

    public function event($params=''){
        $data = [];
        if($params != "")   $data[$params] = true;
        $this->load->view('admin/add/event', $data);
    }

    public function mous($params=''){
        $data = [];
        if($params != "")   $data[$params] = true;
        $this->load->view('admin/add/mous', $data);
    }

    public function inhouse($params=''){
        $data = [];
        if($params != "")   $data[$params] = true;
        $this->load->view('admin/add/inhouse', $data);
    }

    public function company($params=''){
        $data = [];
        if($params != "")   $data[$params] = true;
        $this->load->view('admin/add/company', $data);
    }

    public function faculty($params=''){
        $data = [];
        if($params != "")   $data[$params] = true;
        $this->load->view('admin/add/faculty', $data);
    }

}