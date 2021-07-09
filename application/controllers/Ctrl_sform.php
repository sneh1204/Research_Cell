<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_sform extends Core_Controller {

	public function index()
	{
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view('sform', $data);
    }

    public function checkJoinDate(){
		if(!$this->Process->studentExists($_SESSION['email'])){
			$this->load->view('studentjoindate', $data);
			return false;
		}
        return true;
    }

    public function addStudentPublication(){
        if(!isset($_SESSION['access_token'])) redirect("Ctrl_sform");
        $data['latevents'] = $this->Process->getLatestByType('events');
        if(!$this->checkJoinDate()) return;
        $data['spapers'] = $this->Process->getStudentPapers($_SESSION['email']);
		$data['dept'] = "0";
		$data['cyear'] = "First Year";
        if($this->Process->studentExists($_SESSION['email'])){
            $result = $this->Process->getStudentInfo($_SESSION['email']);
            $data['dept'] = $result->dept;
            $data['cyear'] = $result->year;
            $data['joindate'] = $result->joindate;
            $data['enddate'] = $result->enddate;
        }
		$this->load->view('addStudentPublication', $data);
    }

    public function addStudentBook(){
        if(!isset($_SESSION['access_token'])) redirect("Ctrl_sform");
        $data['latevents'] = $this->Process->getLatestByType('events');
        if(!$this->checkJoinDate()) return;
        $data['fbooks'] = $this->Process->getStudentBooks($_SESSION['email']);
		$data['dept'] = "0";
		$data['cyear'] = "First Year";
        if($this->Process->studentExists($_SESSION['email'])){
            $result = $this->Process->getStudentInfo($_SESSION['email']);
            $data['dept'] = $result->dept;
            $data['cyear'] = $result->year;
            $data['joindate'] = $result->joindate;
            $data['enddate'] = $result->enddate;
        }
		$this->load->view('addStudentBook', $data);
    }

    public function addStudentChapter(){
        if(!isset($_SESSION['access_token'])) redirect("Ctrl_sform");
        $data['latevents'] = $this->Process->getLatestByType('events');
        if(!$this->checkJoinDate()) return;
        $data['fchaps'] = $this->Process->getStudentChaps($_SESSION['email']);
		$data['dept'] = "0";
		$data['cyear'] = "First Year";
        if($this->Process->studentExists($_SESSION['email'])){
            $result = $this->Process->getStudentInfo($_SESSION['email']);
            $data['dept'] = $result->dept;
            $data['cyear'] = $result->year;
            $data['joindate'] = $result->joindate;
            $data['enddate'] = $result->enddate;
        }
		$this->load->view('addStudentChapter', $data);
    }
    
    public function addStudentPatent(){
        if(!isset($_SESSION['access_token'])) redirect("Ctrl_sform");
        $data['latevents'] = $this->Process->getLatestByType('events');
        if(!$this->checkJoinDate()) return;
        $data['fpatent'] = $this->Process->getStudentPatents($_SESSION['email']);
		$data['dept'] = "0";
		$data['cyear'] = "First Year";
        if($this->Process->studentExists($_SESSION['email'])){
            $result = $this->Process->getStudentInfo($_SESSION['email']);
            $data['dept'] = $result->dept;
            $data['cyear'] = $result->year;
            $data['joindate'] = $result->joindate;
            $data['enddate'] = $result->enddate;
        }
		$this->load->view('addStudentPatent', $data);
    }

    public function addStudentTechArticle(){
        if(!isset($_SESSION['access_token'])) redirect("Ctrl_sform");
        $data['latevents'] = $this->Process->getLatestByType('events');
        if(!$this->checkJoinDate()) return;
        $data['ftech'] = $this->Process->getStudentTechArticles($_SESSION['email']);
		$data['dept'] = "0";
		$data['cyear'] = "First Year";
        if($this->Process->studentExists($_SESSION['email'])){
            $result = $this->Process->getStudentInfo($_SESSION['email']);
            $data['dept'] = $result->dept;
            $data['cyear'] = $result->year;
            $data['joindate'] = $result->joindate;
            $data['enddate'] = $result->enddate;
        }
		$this->load->view('addStudentTechArticle', $data);
    }

    public function addStudentCerti(){
        if(!isset($_SESSION['access_token'])) redirect("Ctrl_sform");
        $data['latevents'] = $this->Process->getLatestByType('events');
        if(!$this->checkJoinDate()) return;
        $data['fcerti'] = $this->Process->getStudentCerti($_SESSION['email']);
		$data['dept'] = "0";
		$data['cyear'] = "First Year";
        if($this->Process->studentExists($_SESSION['email'])){
            $result = $this->Process->getStudentInfo($_SESSION['email']);
            $data['dept'] = $result->dept;
            $data['cyear'] = $result->year;
            $data['joindate'] = $result->joindate;
            $data['enddate'] = $result->enddate;
        }
		$this->load->view('addStudentCertification', $data);
    }

    public function addStudentCopyright(){
        if(!isset($_SESSION['access_token'])) redirect("Ctrl_sform");
        $data['latevents'] = $this->Process->getLatestByType('events');
        if(!$this->checkJoinDate()) return;
        $data['fcopyright'] = $this->Process->getStudentCopyrights($_SESSION['email']);
		$data['dept'] = "0";
		$data['cyear'] = "First Year";
        if($this->Process->studentExists($_SESSION['email'])){
            $result = $this->Process->getStudentInfo($_SESSION['email']);
            $data['dept'] = $result->dept;
            $data['cyear'] = $result->year;
            $data['joindate'] = $result->joindate;
            $data['enddate'] = $result->enddate;
        }
		$this->load->view('addStudentCopyright', $data);
    }

    public function callback(){
        $this->load->view('callback2');
    }

    public function logout(){
        $this->load->view('logout2');
    }

}