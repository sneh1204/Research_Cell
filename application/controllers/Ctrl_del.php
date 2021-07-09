<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_del extends Admin_Controller {

    function __construct(){
        parent::__construct();
        if(!isset($_SESSION['loggedin']))   redirect('Ctrl_admin/notloggedin');
    }
    
    public function project($id){
        $data['id'] = $id;
        $data['title'] = $this->Process->getDataById($id, 'title', 'projects');
        $this->load->view('admin/del/project', $data);
    }

    public function event($id){
        $data['id'] = $id;
        $data['name'] = $this->Process->getDataById($id, 'name', 'events');
        $this->load->view('admin/del/event', $data);
    }

    public function mous($id){
        $data['id'] = $id;
        $data['name'] = $this->Process->getDataById($id, 'name', 'mous');
        $this->load->view('admin/del/mous', $data);
    }

    public function sform($id){
        $data['id'] = $id;
        $data['name'] = $this->Process->getDataById($id, 'name', 'sform');
        $this->load->view('admin/del/sform', $data);
    }

    public function tform($id){
        $data['id'] = $id;
        $data['name'] = $this->Process->getDataById($id, 'name', 'faculty');
        $this->load->view('admin/del/tform', $data);
    }

}