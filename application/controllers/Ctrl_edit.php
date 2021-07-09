<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_edit extends Admin_Controller {

    function __construct(){
        parent::__construct();
        if(!isset($_SESSION['loggedin']))   redirect('Ctrl_admin/notloggedin');
    }
    
    public function project($id){
        if($this->Process->columnExists($id, 'projects')){
            $data['project'] = $this->Process->getDataById($id, '*', 'projects')[0];
            $data['parti'] = $this->Process->getDataById($id, '*', 'pro_details');
            $data['mous'] = $this->Process->getEverythingAsArray('mous');
            $this->load->view('admin/edit/project', $data);
        }else{
            $_SESSION['error'] = 'Project doesnt exist to edit!';
            redirect('Ctrl_aerror');
        }
    }

    public function event($id){
        if($this->Process->columnExists($id, 'events')){
            $data['event'] = $this->Process->getDataById($id, '*', 'events')[0];
            $this->load->view('admin/edit/event', $data);
        }else{
            $_SESSION['error'] = 'Event doesnt exist to edit!';
            redirect('Ctrl_aerror');
        }
    }

    public function mous($id){
        if($this->Process->columnExists($id, 'mous')){
            $data['mous'] = $this->Process->getDataById($id, '*', 'mous')[0];
            $this->load->view('admin/edit/mous', $data);
        }else{
            $_SESSION['error'] = 'MOUs doesnt exist to edit!';
            redirect('Ctrl_aerror');
        }
    }

}