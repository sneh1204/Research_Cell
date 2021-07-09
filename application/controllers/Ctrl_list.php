<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_list extends Admin_Controller {

    function __construct(){
        parent::__construct();
        if(!isset($_SESSION['loggedin']))   redirect('Ctrl_admin/notloggedin');
    }
    
    public function project($params = ''){
        if($params != '')   $data[$params] = true;
        $data['projects'] = $this->Process->getEverything('projects');
        $this->load->view('admin/list/project', $data);
    }

    public function event($params = ''){
        if($params != '')   $data[$params] = true;
        $data['events'] = $this->Process->getEverything('events');
        $this->load->view('admin/list/event', $data);
    }

    public function mous($params = ''){
        if($params != '')   $data[$params] = true;
        $data['mous'] = $this->Process->getEverything('mous');
        $this->load->view('admin/list/mous', $data);
    }

    function student($params = ''){
        if($params != '')   $data[$params] = true;
        $data['studentwork'] = $this->Process->getPublications('student');
        $this->load->view('admin/work/student', $data);
    }

    function confirm($type, $id){
        if($this->Process->columnExists($id, 'sform')){
            $this->Process->confirm($type, $id);
            $data['confirmed'] = $id;
            $result = $this->Process->getPublications('student');
            $data['studentwork'] = $result;
            $this->load->view('admin/work/student', $data);
        }else{
            $_SESSION['error'] = 'Publication doesnt exist to confirm!';
            redirect('Ctrl_aerror');
        }
    }

    function faculty($params = ''){
        if($params != '')   $data[$params] = true;
        $data['facultywork'] = $this->Process->getFacultyPaper();
        $data['enddate'] = $this->Process->getAllFacultyEndDate();
        $this->load->view('admin/work/faculty', $data);
    }

}