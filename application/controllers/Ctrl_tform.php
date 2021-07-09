<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_tform extends Core_Controller {

	public function index()
	{
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view('tform', $data);
    }

    public function checkJoinDate($data){
        $data['isAdmin'] = false;
        $admins = ["defaultrnd.it@sakec.ac.in" => "Information Technology", "defaultrnd.comp@sakec.ac.in" => "Computer Engineering", "defaultrnd.extc@sakec.ac.in" => "Electronics and Telecommunications", "defaultrnd.etrx@sakec.ac.in" => "Electronics Engineering", "defaultrnd.engsci@sakec.ac.in" => "Human Science"];
        if(!isset($admins[$_SESSION['email']])){
            if(!$this->Process->hasJoinDate($_SESSION['email'])){
                $this->load->view('joindate', $data);
                return false;
            }else{
                $data['joindate'] = $this->Process->getFacultyJoinDate($_SESSION['email']);
            }
        }else   $data['isAdmin'] = $admins[$_SESSION['email']];
        return $data;
    }

    public function addPublication(){
        if(!isset($_SESSION['access_token'])) redirect("Ctrl_tform");
        $data['latevents'] = $this->Process->getLatestByType('events');
        if(!$this->Process->facultyExists($_SESSION['email'])){
            $_SESSION['error'] = "No access! Please contact Research-Cell to give you access.";
			unset($_SESSION['access_token']);
            $this->load->view('error', $data);
            return;
        }
        if(!$data = $this->checkJoinDate($data)) return;
        $data['fpapers'] = $this->Process->getFacultyPapers($_SESSION['email']);
        $data['fdept'] = "0";
        $data['fscholar'] = "";
        if($this->Process->facultyExists($_SESSION['email'])){
            $result = $this->Process->getFacultyInfo($_SESSION['email']);
            $data['fdept'] = $result->dept;
            $data['fscholar'] = $result->scholar;
            //$this->syncGoogleScholar($data['fscholar'], $data['fdept']); DO NOT UNCOMMENT UNLESS YOU KNOW WHAT YOU DOING
        }
		$this->load->view('addPublication', $data);
    }

    public function scrapePublications($html){
		$publications = [];
		$i = 0;
		foreach($html->find('.gsc_a_tr') as $domain){
			$publications[$i]['title'] = $domain->find('.gsc_a_at', 0)->innertext;
			$publications[$i]['authors'] = $domain->find('.gs_gray', 0)->innertext;
			$publications[$i]['cites'] = $domain->find('.gsc_a_ac', 0)->innertext;
			$link = $domain->find('.gsc_a_ac', 0)->href;
			if($link == "")	$link = "#";
			$publications[$i]['link'] = $link;
			$publications[$i]['name'] = $domain->find('.gs_gray', 1)->innertext;
			$publications[$i++]['year'] = $domain->find('.gsc_a_hc', 0)->innertext;
        }
		return $publications;
	}

    public function crawlScholarData($link){
        $html = \Sunra\PhpSimple\HtmlDomParser::file_get_html($link, false, null, 0);
        if(empty($html))    return "";
        return $this->scrapePublications($html);
    }

    public function syncGoogleScholar(String $url, String $dept){
        $result = $this->crawlScholarData($url);
        if($result == "")   return;
        $email = $_SESSION['email'];
        $this->Process->delPublications($email);
        $str = null;
        foreach($result as $id => $data){
            $name = html_entity_decode(strip_tags($data['name']));
            $title = html_entity_decode(strip_tags($data['title']));
            $year = $data['year'];
            if($year != ""){
                $sub = (int) substr($year, -2);
                $year = $year . "-" . ++$sub;
            }
            $this->Process->addPaper($email, $data['authors'], $name, $title, "", $data['link'], $dept, "", $year, $_SESSION['name'], "", "false", $data['cites'], true);
        }
    }

    public function addBook(){
        if(!isset($_SESSION['access_token'])) redirect("Ctrl_tform");
        $data['latevents'] = $this->Process->getLatestByType('events');
        if(!$this->Process->facultyExists($_SESSION['email'])){
            $_SESSION['error'] = "No access! Please contact Research-Cell to give you access.";
			unset($_SESSION['access_token']);
            $this->load->view('error', $data);
            return;
        }
        if(!$data = $this->checkJoinDate($data)) return;
        $data['fbooks'] = $this->Process->getFacultyBooks($_SESSION['email']);
        $data['fdept'] = "0";
        $data['fscholar'] = "";
        if($this->Process->facultyExists($_SESSION['email'])){
            $result = $this->Process->getFacultyInfo($_SESSION['email']);
            $data['fdept'] = $result->dept;
            $data['fscholar'] = $result->scholar;
        }
		$this->load->view('addBook', $data);
    }

    public function addChapter(){
        if(!isset($_SESSION['access_token'])) redirect("Ctrl_tform");
        $data['latevents'] = $this->Process->getLatestByType('events');
        if(!$this->Process->facultyExists($_SESSION['email'])){
            $_SESSION['error'] = "No access! Please contact Research-Cell to give you access.";
			unset($_SESSION['access_token']);
            $this->load->view('error', $data);
            return;
        }
        if(!$data = $this->checkJoinDate($data)) return;
        $data['fchaps'] = $this->Process->getFacultyChaps($_SESSION['email']);
        $data['fdept'] = "0";
        $data['fscholar'] = "";
        if($this->Process->facultyExists($_SESSION['email'])){
            $result = $this->Process->getFacultyInfo($_SESSION['email']);
            $data['fdept'] = $result->dept;
            $data['fscholar'] = $result->scholar;
        }   
		$this->load->view('addChapter', $data);
    }

    public function addCopyright(){
        if(!isset($_SESSION['access_token'])) redirect("Ctrl_tform");
        $data['latevents'] = $this->Process->getLatestByType('events');
        if(!$this->Process->facultyExists($_SESSION['email'])){
            $_SESSION['error'] = "No access! Please contact Research-Cell to give you access.";
			unset($_SESSION['access_token']);
            $this->load->view('error', $data);
            return;
        }
        if(!$data = $this->checkJoinDate($data)) return;
        $data['fcopyright'] = $this->Process->getFacultyCopyrights($_SESSION['email']);
        $data['fdept'] = "0";
        $data['fscholar'] = "";
        if($this->Process->facultyExists($_SESSION['email'])){
            $result = $this->Process->getFacultyInfo($_SESSION['email']);
            $data['fdept'] = $result->dept;
            $data['fscholar'] = $result->scholar;
        }  
		$this->load->view('addCopyright', $data);
    }

    public function addTechArticle(){
        if(!isset($_SESSION['access_token'])) redirect("Ctrl_tform");
        $data['latevents'] = $this->Process->getLatestByType('events');
        if(!$this->Process->facultyExists($_SESSION['email'])){
            $_SESSION['error'] = "No access! Please contact Research-Cell to give you access.";
			unset($_SESSION['access_token']);
            $this->load->view('error', $data);
            return;
        }
        if(!$data = $this->checkJoinDate($data)) return;
        $data['ftech'] = $this->Process->getFacultyTechArticle($_SESSION['email']);
        $data['fdept'] = "0";
        $data['fscholar'] = "";
        if($this->Process->facultyExists($_SESSION['email'])){
            $result = $this->Process->getFacultyInfo($_SESSION['email']);
            $data['fdept'] = $result->dept;
            $data['fscholar'] = $result->scholar;
        }  
		$this->load->view('addTechArticle', $data);
    }

    public function addCerti(){
        if(!isset($_SESSION['access_token'])) redirect("Ctrl_tform");
        $data['latevents'] = $this->Process->getLatestByType('events');
        if(!$this->Process->facultyExists($_SESSION['email'])){
            $_SESSION['error'] = "No access! Please contact Research-Cell to give you access.";
			unset($_SESSION['access_token']);
            $this->load->view('error', $data);
            return;
        }
        if(!$data = $this->checkJoinDate($data)) return;
        $data['fcerti'] = $this->Process->getFacultyCerti($_SESSION['email']);
        $data['fdept'] = "0";
        $data['fscholar'] = "";
        if($this->Process->facultyExists($_SESSION['email'])){
            $result = $this->Process->getFacultyInfo($_SESSION['email']);
            $data['fdept'] = $result->dept;
            $data['fscholar'] = $result->scholar;
        }  
		$this->load->view('addCertification', $data);
    }

    public function addPatent(){
        if(!isset($_SESSION['access_token'])) redirect("Ctrl_tform");
        $data['latevents'] = $this->Process->getLatestByType('events');
        if(!$this->Process->facultyExists($_SESSION['email'])){
            $_SESSION['error'] = "No access! Please contact Research-Cell to give you access.";
			unset($_SESSION['access_token']);
            $this->load->view('error', $data);
            return;
        }
        if(!$data = $this->checkJoinDate($data)) return;
        $data['fpatent'] = $this->Process->getFacultyPatents($_SESSION['email']);
        $data['fdept'] = "0";
        $data['fscholar'] = "";
        if($this->Process->facultyExists($_SESSION['email'])){
            $result = $this->Process->getFacultyInfo($_SESSION['email']);
            $data['fdept'] = $result->dept;
            $data['fscholar'] = $result->scholar;
        }
		$this->load->view('addPatent', $data);
    }

    public function callback(){
        $this->load->view('callback');
    }

    public function logout(){
        $this->load->view('logout');
    }

}