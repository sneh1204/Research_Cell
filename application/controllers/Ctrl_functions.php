<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_functions extends Admin_Controller {

    public function logoutAdmin(){
        if(isset($_GET['logout'])){
            unset($_SESSION['loggedin']);
            $data['loggedout'] = true;
            $this->load->view('admin/login', $data);
        }
    }

	public function checkAdminLogin()
	{
        if($this->Process->checkAdminLogin($_POST['username'], $_POST['pass'])){
            $_SESSION['loggedin']= true;
            redirect("Ctrl_dashboard");
        }else{
            $data['wrongpass'] = true;
            $this->load->view('admin/login', $data);
        }
    }
    
    public function addProject(){
        $obj = "";
        $pid = 0;
        $i = 1;
        $picarr=[];
        if(isset($_POST['submit'])){
            foreach($_POST as $key => $data){
                $exp = explode('-', $key);
                if($exp[0] == 'obj' && $data != ""){
                    $obj .= $data . '-$$-';
                }
                if($exp[0] == 'p' && $data != ""){
                    if($_POST['select_br_'.$exp[1]] != '0' && $_POST['select_role_'.$exp[1]] != '0' && $_POST['select_desc_'.$exp[1]] != '0'){
                        $partis[$i++] = $exp[1];
                        if(isset($_FILES['timage-'.$exp[1]]['name']) and $_FILES['timage-'.$exp[1]]['name'] != ""){
                            $target_file = basename($_FILES["timage-".$exp[1]]["name"]);
                            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                            $dir = "illustrations/";
                            if(!is_dir($dir))   mkdir($dir);
                            $dir = "illustrations/projects/";
                            if(!is_dir($dir))   mkdir($dir);
                            $dir = "illustrations/projects/pics/";
                            if(!is_dir($dir))   mkdir($dir);
                            while(true){
                                $tmp_file = uniqid('pic_', true) . '.'.$imageFileType ;
                                if(!file_exists($dir . $tmp_file)) break;
                            }
                            if(move_uploaded_file($_FILES["timage-".$exp[1]]["tmp_name"], $dir . $tmp_file)){
                                $picarr[$exp[1]] = $tmp_file;
                            }
                        }else   $picarr[$exp[1]] = "";
                    }
                    else continue;
                }
            }
            $obj = substr($obj, 0, -4);
            $content = $this->dataready($_POST['content']);
            $tmp_file = "";
            $tmp_file2 = "";
            $tmp_file3 = "";
            if(isset($_FILES['pimage']['name']) and $_FILES['pimage']['name'] != ""){
                $target_file = basename($_FILES["pimage"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $dir = "illustrations/";
                if(!is_dir($dir))   mkdir($dir);
                $dir = "illustrations/projects/";
                if(!is_dir($dir))   mkdir($dir);
				while(true){
					$tmp_file = uniqid('img_', true) . '.'.$imageFileType ;
					if(!file_exists($dir . $tmp_file)) break;
                }
                move_uploaded_file($_FILES["pimage"]["tmp_name"], $dir . $tmp_file);
            }
            if(isset($_FILES['pexcel']['name']) and $_FILES['pexcel']['name'] != ""){
                $target_file = basename($_FILES["pexcel"]["name"]);
                $excelFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $dir = "illustrations/";
                if(!is_dir($dir))   mkdir($dir);
                $dir = "illustrations/projects/";
                if(!is_dir($dir))   mkdir($dir);
                $dir = "illustrations/projects/excel/";
                if(!is_dir($dir))   mkdir($dir);
				while(true){
					$tmp_file3 = uniqid('excel_', true) . '.'.$excelFileType ;
					if(!file_exists($dir . $tmp_file3)) break;
                }
                move_uploaded_file($_FILES["pexcel"]["tmp_name"], $dir . $tmp_file3);
            }
            if(isset($_FILES['ptimage']['name']) and $_FILES['ptimage']['name'] != ""){
                $target_file = basename($_FILES["ptimage"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $dir = "illustrations/";
                if(!is_dir($dir))   mkdir($dir);
                $dir = "illustrations/projects/";
                if(!is_dir($dir))   mkdir($dir);
                $dir = "illustrations/projects/team/";
                if(!is_dir($dir))   mkdir($dir);
				while(true){
					$tmp_file2 = uniqid('team_', true) . '.'.$imageFileType ;
					if(!file_exists($dir . $tmp_file2)) break;
                }
                move_uploaded_file($_FILES["ptimage"]["tmp_name"], $dir . $tmp_file2);
            }
            $pid = $this->Process->addProject($_POST['ptitle'], $_POST['pcollab'], $obj, $tmp_file, $tmp_file2, $tmp_file3, $content, $_POST['plink'], $_POST['mous'], $_POST['select_type']);
            if($pid != 0 && count($partis) > 0)   $this->Process->addProjectDetails($pid, $_POST, $partis, $picarr);
            else    redirect('Ctrl_aerror');
            redirect('Ctrl_add/project/added');
        }
    }

    public function editProject(){
        $obj = "";
        $i = 1;
        $picarr=[];
        if(isset($_POST['submit'])){
            if($this->Process->columnExists($_POST['pid'], 'projects')){
                foreach($_POST as $key => $data){
                    $exp = explode('-', $key);
                    if($exp[0] == 'obj' && $data != ""){
                        $obj .= $data . '-$$-';
                    }
                    if($exp[0] == 'p' && $data != ""){
                        if($_POST['select_br_'.$exp[1]] != '0' && $_POST['select_role_'.$exp[1]] != '0' && $_POST['select_desc_'.$exp[1]] != '0'){
                            $partis[$i++] = $exp[1];
                            if(isset($_FILES['timage-'.$exp[1]]['name']) and $_FILES['timage-'.$exp[1]]['name'] != ""){
                                $target_file = basename($_FILES["timage-".$exp[1]]["name"]);
                                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                                $dir = "illustrations/";
                                if(!is_dir($dir))   mkdir($dir);
                                $dir = "illustrations/projects/";
                                if(!is_dir($dir))   mkdir($dir);
                                $dir = "illustrations/projects/pics/";
                                if(!is_dir($dir))   mkdir($dir);
                                while(true){
                                    $tmp_file = uniqid('pic_', true) . '.'.$imageFileType ;
                                    if(!file_exists($dir . $tmp_file)) break;
                                }
                                if(move_uploaded_file($_FILES["timage-".$exp[1]]["tmp_name"], $dir . $tmp_file)){
                                    $picarr[$exp[1]] = $tmp_file;
                                }
                            }else   $picarr[$exp[1]] = "";
                        }
                        else continue;
                    }
                }
                $obj = substr($obj, 0, -4);
                $content = $this->dataready($_POST['content']);
                $tmp_file = "";
                $tmp_file2 = "";
                $tmp_file3 = "";
                if(isset($_FILES['pimage']['name']) and $_FILES['pimage']['name'] != ""){
                    $target_file = basename($_FILES["pimage"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $dir = "illustrations/";
                    if(!is_dir($dir))   mkdir($dir);
                    $dir = "illustrations/projects/";
                    if(!is_dir($dir))   mkdir($dir);
                    while(true){
                        $tmp_file = uniqid('img_', true) . '.'.$imageFileType ;
                        if(!file_exists($dir . $tmp_file)) break;
                    }
                    move_uploaded_file($_FILES["pimage"]["tmp_name"], $dir . $tmp_file);
                }
                if(isset($_FILES['ptimage']['name']) and $_FILES['ptimage']['name'] != ""){
                    $target_file = basename($_FILES["ptimage"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $dir = "illustrations/";
                    if(!is_dir($dir))   mkdir($dir);
                    $dir = "illustrations/projects/";
                    if(!is_dir($dir))   mkdir($dir);
                    $dir = "illustrations/projects/team/";
                    if(!is_dir($dir))   mkdir($dir);
                    while(true){
                        $tmp_file2 = uniqid('team_', true) . '.'.$imageFileType ;
                        if(!file_exists($dir . $tmp_file2)) break;
                    }
                    move_uploaded_file($_FILES["ptimage"]["tmp_name"], $dir . $tmp_file2);
                }
                if(isset($_FILES['pexcel']['name']) and $_FILES['pexcel']['name'] != ""){
                    $target_file = basename($_FILES["pexcel"]["name"]);
                    $excelFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $dir = "illustrations/";
                    if(!is_dir($dir))   mkdir($dir);
                    $dir = "illustrations/projects/";
                    if(!is_dir($dir))   mkdir($dir);
                    $dir = "illustrations/projects/excel/";
                    if(!is_dir($dir))   mkdir($dir);
                    while(true){
                        $tmp_file3 = uniqid('excel_', true) . '.'.$excelFileType ;
                        if(!file_exists($dir . $tmp_file3)) break;
                    }
                    move_uploaded_file($_FILES["pexcel"]["tmp_name"], $dir . $tmp_file3);
                }
                $this->Process->editProject($_POST['pid'], $_POST['ptitle'], $_POST['pcollab'], $obj, $tmp_file, $tmp_file2, $tmp_file3, $content, $_POST['plink'], $_POST['mous'], $_POST['select_type']);
                if($_POST['pid'] != 0 && count($partis) > 0)   $this->Process->editProjectDetails($_POST['pid'], $_POST, $partis, $picarr);
                else    redirect('Ctrl_aerror');
                redirect('Ctrl_list/project/edited');
            }else{
                $_SESSION['error'] = 'Project doesnt exist to edit!';
                redirect('Ctrl_aerror');
            }
        }
    }

    public function delProject($id){
        if($this->Process->columnExists($id, 'projects')){
            $this->Process->delProject($id);
        }else echo 0;
    }

    public function crawlGoogle(){
        $num = 10;
        $name = $_POST["value"];
        $name = str_replace(" ", "+", $name);
        $body = file_get_contents("https://www.googleapis.com/customsearch/v1?key=AIzaSyCyy3-qNmQf8GB79p1glKnQPzz7Dcw7-ug&cx=005423323922878821177:8pma0dnzbqr&num=".$num."&q=".$name);
        $json = json_decode($body);
        $array = [];
        if (isset($json->items)){
            foreach ($json->items as $item){
                if(strpos($item->link, "user=") !== false){
                    $array[] = $item->link;
                }
            }
        }
        echo json_encode($array);
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
        $stats['citation'] = $html->find('.gsc_rsb_std', 0)->innertext;
        $stats['hindex'] = $html->find('.gsc_rsb_std', 2)->innertext;
        $stats['i10index'] = $html->find('.gsc_rsb_std', 5)->innertext;
		return [$publications, $stats];
	}

    public function crawlScholar(){
        $result = [];
        $link = $_POST['link'];
        $data1 = \Sunra\PhpSimple\HtmlDomParser::file_get_html($link, false, null, 0);
        $result[0] = $data1->find("#gsc_prf_in", 0)->innertext;
        $result[1] = $data1->find("#gsc_prf_ivh", 0)->innertext;
        echo json_encode($result);
    }

    public function crawlScholarData($link){
        $html = \Sunra\PhpSimple\HtmlDomParser::file_get_html($link, false, null, 0);
        return $this->scrapePublications($html);
    }

    public function addFaculty(){
        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['dept'])){
            if(!$this->Process->facultyExists($_POST['email'])){
                $this->Process->addFaculty($_POST['email'], $_POST['dept'], $_POST['name']);
                echo 1;
            }else echo 0;
        }else{
            $_SESSION['error'] = 'Error!';
            redirect('Ctrl_aerror');
        }
    }

    public function updateEventExcel(){
        if(isset($_FILES['event']['name'])){
            $target_file = basename($_FILES["event"]["name"]);
            $filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if($filetype != 'xlsx'){
                echo "Only excel is accepted";
            }else{
                $dir = "illustrations/";
                if(!is_dir($dir))   mkdir($dir);
                $dir = "illustrations/events/";
                if(!is_dir($dir))   mkdir($dir);
                $dir = "illustrations/events/excel/";
                if(!is_dir($dir))   mkdir($dir);
                $tmp_file = "home" . '.' . $filetype ;
                if(file_exists($dir . $tmp_file)){
                    unlink($dir . $tmp_file);
                }
                move_uploaded_file($_FILES["event"]["tmp_name"], $dir . $tmp_file);
                echo "File uploaded successfully!";
            }
        }
    }

    public function addFacultyPublication(){
        if(isset($_POST['sid']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['dept'])){
            if(!$this->Process->facultyExists($_POST['email'])){
                $link = "https://scholar.google.com/citations?user=".$_POST['sid'];
                $result = $this->crawlScholarData($link);
                $stats = $result[1];
                $result = $result[0];
                $this->Process->addFaculty($_POST['email'], $_POST['dept'], $_POST['name'], $link, $stats['citation'], $stats['hindex'], $stats['i10index']);
                $str = null;
                foreach($result as $id => $data){
                    $name = html_entity_decode(strip_tags($data['name']));
                    $title = html_entity_decode(strip_tags($data['title']));
                    $year = $data['year'];
                    if($year != ""){
                        $sub = (int) substr($year, -2);
                        $year = $year . "-" . ++$sub;
                    }
                    $this->Process->addPaper($_POST['email'], $data['authors'], $name, $title, "", $data['link'], $_POST["dept"], "", $year, $_POST['name'], "", "false", $data['cites'], true);
                }
                echo 1;
            }else echo 0;
        }else{
            $_SESSION['error'] = 'Error!';
            redirect('Ctrl_aerror');
        }
    }

    public function addEvent(){
        if(isset($_POST['submit'])){
            $content = $this->dataready($_POST['content']);
            $tmp_file="";
            $tmp_file2="";
            if(isset($_FILES['eimage']['name']) and $_FILES['eimage']['name'] != ""){
                $target_file = basename($_FILES["eimage"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $dir = "illustrations/";
                if(!is_dir($dir))   mkdir($dir);
                $dir = "illustrations/events/";
                if(!is_dir($dir))   mkdir($dir);
				while(true){
					$tmp_file = uniqid('img_', true) . '.'.$imageFileType ;
					if(!file_exists($dir . $tmp_file)) break;
                }
                move_uploaded_file($_FILES["eimage"]["tmp_name"], $dir . $tmp_file);
            }
            if(isset($_FILES['ecimage']['name']) and $_FILES['ecimage']['name'] != ""){
                $target_file = basename($_FILES["ecimage"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $dir = "illustrations/";
                if(!is_dir($dir))   mkdir($dir);
                $dir = "illustrations/events/";
                if(!is_dir($dir))   mkdir($dir);
                $dir = "illustrations/events/collage/";
                if(!is_dir($dir))   mkdir($dir);
				while(true){
					$tmp_file2 = uniqid('col_', true) . '.'.$imageFileType ;
					if(!file_exists($dir . $tmp_file2)) break;
                }
                move_uploaded_file($_FILES["ecimage"]["tmp_name"], $dir . $tmp_file2);
            }
            if(isset($_FILES['eexcel']['name']) and $_FILES['eexcel']['name'] != ""){
                $target_file = basename($_FILES["eexcel"]["name"]);
                $excelFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $dir = "illustrations/";
                if(!is_dir($dir))   mkdir($dir);
                $dir = "illustrations/events/";
                if(!is_dir($dir))   mkdir($dir);
                $dir = "illustrations/events/excel/";
                if(!is_dir($dir))   mkdir($dir);
				while(true){
					$tmp_file3 = uniqid('excel_', true) . '.'.$excelFileType ;
					if(!file_exists($dir . $tmp_file3)) break;
                }
                move_uploaded_file($_FILES["eexcel"]["tmp_name"], $dir . $tmp_file3);
            }
            $edate=strtotime($_POST['edate']); 
            $edate=date("Y-m-d",$edate);
            $this->Process->addEvent($_POST['ename'], $edate, $_POST['elink'], $tmp_file, $tmp_file2, $content, $_POST['etype'], $tmp_file3);
            redirect('Ctrl_add/event/added');
        }
    }

    public function editEvent(){
        if(isset($_POST['submit'])){
            if($this->Process->columnExists($_POST['eid'], 'events')){
                $content = $this->dataready($_POST['content']);
                $edate=strtotime($_POST['edate']); 
                $edate=date("Y-m-d",$edate);
                $tmp_file = "";
                $tmp_file2 = "";
                if(isset($_FILES['eimage']['name']) and $_FILES['eimage']['name'] != ""){
                    $target_file = basename($_FILES["eimage"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $dir = "illustrations/";
                    if(!is_dir($dir))   mkdir($dir);
                    $dir = "illustrations/events/";
                    if(!is_dir($dir))   mkdir($dir);
                    while(true){
                        $tmp_file = uniqid('img_', true) . '.'.$imageFileType ;
                        if(!file_exists($dir . $tmp_file)) break;
                    }
                    move_uploaded_file($_FILES["eimage"]["tmp_name"], $dir . $tmp_file);
                }
                if(isset($_FILES['ecimage']['name']) and $_FILES['ecimage']['name'] != ""){
                    $target_file = basename($_FILES["ecimage"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $dir = "illustrations/";
                    if(!is_dir($dir))   mkdir($dir);
                    $dir = "illustrations/events/";
                    if(!is_dir($dir))   mkdir($dir);
                    $dir = "illustrations/events/collage/";
                    if(!is_dir($dir))   mkdir($dir);
                    while(true){
                        $tmp_file2 = uniqid('col_', true) . '.'.$imageFileType ;
                        if(!file_exists($dir . $tmp_file2)) break;
                    }
                    move_uploaded_file($_FILES["ecimage"]["tmp_name"], $dir . $tmp_file2);
                }
                if(isset($_FILES['eexcel']['name']) and $_FILES['eexcel']['name'] != ""){
                    $target_file = basename($_FILES["eexcel"]["name"]);
                    $excelFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $dir = "illustrations/";
                    if(!is_dir($dir))   mkdir($dir);
                    $dir = "illustrations/events/";
                    if(!is_dir($dir))   mkdir($dir);
                    $dir = "illustrations/events/excel/";
                    if(!is_dir($dir))   mkdir($dir);
                    while(true){
                        $tmp_file3 = uniqid('excel_', true) . '.'.$excelFileType ;
                        if(!file_exists($dir . $tmp_file3)) break;
                    }
                    move_uploaded_file($_FILES["eexcel"]["tmp_name"], $dir . $tmp_file3);
                }
                $this->Process->editEvent($_POST['eid'], $_POST['ename'], $edate, $_POST['elink'], $tmp_file, $tmp_file2, $content, $_POST['etype'], $tmp_file3);
                redirect('Ctrl_list/event/edited');
            }else{
                $_SESSION['error'] = 'Event doesnt exist to edit!';
                redirect('Ctrl_aerror');
            }
        }
    }

    public function delEvent($id){
        if($this->Process->columnExists($id, 'events')){
            $this->Process->delEvent($id);
        }else echo 0;
    }

    public function addMous(){
        if(isset($_POST['submit'])){
            $tmp_file = "";
            $tmp_logo = "";
            if(isset($_FILES['mimage']['name']) and $_FILES['mimage']['name'] != ""){
                $target_file = basename($_FILES["mimage"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $dir = "illustrations/";
                if(!is_dir($dir))   mkdir($dir);
                $dir = "illustrations/mous/";
                if(!is_dir($dir))   mkdir($dir);
                while(true){
                    $tmp_file = uniqid('img_', true) . '.'.$imageFileType ;
                    if(!file_exists($dir . $tmp_file)) break;
                }
                move_uploaded_file($_FILES["mimage"]["tmp_name"], $dir . $tmp_file);
            }
            if(isset($_FILES['mlogo']['name']) and $_FILES['mlogo']['name'] != ""){
                $target_file = basename($_FILES["mlogo"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $dir = "illustrations/mous/logos/";
                if(!is_dir($dir))   mkdir($dir);
                while(true){
                    $tmp_logo = uniqid('logo_', true) . '.'.$imageFileType ;
                    if(!file_exists($dir . $tmp_logo)) break;
                }
                move_uploaded_file($_FILES["mlogo"]["tmp_name"], $dir . $tmp_logo);  
            }
            $date = date("Y-m-d",strtotime($_POST['date']));
            $end = date('Y-m-d', strtotime('+'.$_POST['span'].' years'));
            $this->Process->addMous($_POST['mname'], $date, $_POST['span'], $_POST['type'], $_POST['spoc'], $_POST['scope'], $end, $tmp_logo, $tmp_file);
            redirect('Ctrl_add/mous/added');
        }
    }

    public function editMous(){
        if(isset($_POST['submit'])){
            if($this->Process->columnExists($_POST['mid'], 'mous')){
                $tmp_file = "";
                $tmp_logo = "";
                if(isset($_FILES['mimage']['name']) and $_FILES['mimage']['name'] != ""){
                    $target_file = basename($_FILES["mimage"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $dir = "illustrations/";
                    if(!is_dir($dir))   mkdir($dir);
                    $dir = "illustrations/mous/";
                    if(!is_dir($dir))   mkdir($dir);
                    while(true){
                        $tmp_file = uniqid('img_', true) . '.'.$imageFileType;
                        if(!file_exists($dir . $tmp_file)) break;
                    }
                    move_uploaded_file($_FILES["mimage"]["tmp_name"], $dir . $tmp_file);
                }
                if(isset($_FILES['mlogo']['name']) and $_FILES['mlogo']['name'] != ""){
                    $target_file = basename($_FILES["mlogo"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $dir = "illustrations/";
                    if(!is_dir($dir))   mkdir($dir);
                    $dir = "illustrations/mous/";
                    if(!is_dir($dir))   mkdir($dir);
                    $dir = "illustrations/mous/logos/";
                    if(!is_dir($dir))   mkdir($dir);
                    while(true){
                        $tmp_logo = uniqid('logo_', true) . '.'.$imageFileType;
                        if(!file_exists($dir . $tmp_logo)) break;
                    }
                    move_uploaded_file($_FILES["mlogo"]["tmp_name"], $dir . $tmp_logo);
                }
                $date = date("Y-m-d",strtotime($_POST['date']));
                $end = date('Y-m-d', strtotime('+'.$_POST['span'].' years'));
                $this->Process->editMous($_POST['mid'], $_POST['mname'], $date, $_POST['span'], $_POST['type'], $_POST['spoc'], $_POST['scope'], $end, $tmp_logo, $tmp_file);
                redirect('Ctrl_list/mous/edited');
            }else{
                $_SESSION['error'] = 'MoUs doesnt exist to edit!';
                redirect('Ctrl_aerror');
            }
        }
    }

    public function delMous($id){
        if($this->Process->columnExists($id, 'mous')){
            $this->Process->delMous($id);
        }else echo 0;
    }

    public function delSform($id){
        if($this->Process->columnExists($id, 'sform')){
            $this->Process->delSform($id);
        }else echo 0;
    }

    public function delTform($id){
        if($this->Process->columnExists($id, 'faculty')){
            $email = $this->Process->getFacultyEmail($id);
            $this->Process->delFaculty($email);
            $this->Process->delPublications($email);
        }else echo 0;
    }

    public function dataready($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
