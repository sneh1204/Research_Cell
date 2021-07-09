<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_publications extends Admin_Controller {

    public function addFacultyJoinDate(){
        if($this->input->post()){
            $date = $this->input->post('date');
            echo $this->Process->addJoinDate($_SESSION['email'], date("Y-m-d",strtotime($date)));
        }
    }

    public function addStudentJoinDate(){
        if($this->input->post()){
            $date = $this->input->post('date');
            echo $this->Process->addStudentJoinDate($_SESSION['name'], $_SESSION['email'], date("Y-m-d",strtotime($date)));
        }
    }

    public function addDetails(){
        $id = $this->input->post("autoincr");
        if(isset($_FILES['details']['name']) and $_FILES['details']['name'] != ""){
            $target_file = basename($_FILES["details"]["name"]);
            $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $dir = "illustrations/";
            if(!is_dir($dir))   mkdir($dir);
            $dir = "illustrations/projects/";
            if(!is_dir($dir))   mkdir($dir);
            $dir = "illustrations/projects/details/";
            if(!is_dir($dir))   mkdir($dir);
            while(true){
                $tmp_file = uniqid('details_', true) . '.'.$FileType;
                if(!file_exists($dir . $tmp_file)) break;
            }
            if(move_uploaded_file($_FILES["details"]["tmp_name"], $dir . $tmp_file)){
                $this->Process->addDetails($id, $tmp_file);
            }
        }
    }

    public function addProject(){
        unset($_POST[0]);
        $data = json_decode(array_keys($_POST)[0], true);
        $id = $this->Process->addOngoingProject($data['title'], $data['mous'], $data['idate'], $data['year'], $data['status'], $data['achievements'], $data['edate']);
        for($i=1; $i <= $data['partis']; $i++){
            $this->Process->addOngoingDetails($id, $i, $data['p-'.$i], $data['p-email'.$i], $data['p-role'.$i], $data['p-desc'.$i], $data['p-branch'.$i]);
        }
        echo $id;
    }

    public function editStudentJoinDate(){
        if($this->input->post()){
            $date = $this->input->post('jdate');
            echo $this->Process->editStudentJoinDate($_SESSION['email'], date("Y-m-d",strtotime($date)));
        }
    }

    public function editFacultyJoinDate(){
        if($this->input->post()){
            $date = $this->input->post('jdate');
            echo $this->Process->editJoinDate($_SESSION['email'], date("Y-m-d",strtotime($date)));
        }
    }

    public function addFacultyEndDate(){
        if($this->input->post()){
            $date = $this->input->post('edate');
            $email = $this->input->post('email');
            echo $this->Process->addEndDate($email, date("Y-m-d",strtotime($date)));
        }
    }

    public function addStudentPaper(){
        if($this->input->post()){
            $var1 = $this->input->post('email');
            $var2 = $this->input->post('authors');
            $var3 = $this->input->post('journal');
            $var4 = $this->input->post('title');
            $var5 = $this->input->post('doi');
            $var6 = $this->input->post('link');
            $var7 = $this->input->post('dept');
            $var8 = $this->input->post('type');
            $var9 = $this->input->post('year');
            $var10 = $this->input->post('fname');
            $var11 = $this->input->post('cyear');
            $var12 = $this->input->post('month');
            if($this->Process->studentExists($var1)){
                $this->Process->editStudent($var1, $var7, $var10, $var11);
            }
            echo $this->Process->addStudentPaper($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $var10, $var12);
        }
    }

    public function addEvent(){
        if($this->input->post()){
            $var1 = $this->input->post('name');
            $var2 = $this->input->post('date');
            $var3 = $this->input->post('description');
            $var4 = $this->input->post('year');
            $var5 = $this->input->post('type');
            echo $this->Process->addOngoingEvent($var1, $var2, $var3, $var4, $var5);
        }
    }

    public function addPaper(){
        if($this->input->post()){
            $var1 = $this->input->post('email');
            $var2 = $this->input->post('authors');
            $var3 = $this->input->post('journal');
            $var4 = $this->input->post('title');
            $var5 = $this->input->post('doi');
            $var6 = $this->input->post('link');
            $var7 = $this->input->post('dept');
            $var8 = $this->input->post('type');
            $var9 = $this->input->post('year');
            $var10 = $this->input->post('fname');
            $var11 = $this->input->post('scholar');
            $var12 = $this->input->post('month');
            $var13 = $this->input->post('student');
            if(!$this->Process->facultyExists($var1)){
                $this->Process->addFaculty($var1, $var7, $var10, $var11);
            }else{
                $this->Process->editFaculty($var1, $var7, $var11);
            }
            echo $this->Process->addPaper($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $var10, $var12, $var13);
        }
    }

    public function addStudentCopyright(){
        if($this->input->post()){
            $var1 = $this->input->post('email');
            $var2 = $this->input->post('diary');
            $var3 = $this->input->post('title');
            $var4 = $this->input->post('class');
            $var5 = $this->input->post('applicant');
            $var6 = $this->input->post('link');
            $var7 = $this->input->post('dept');
            $var8 = $this->input->post('year');
            $var9 = $this->input->post('fname');
            $var10 = $this->input->post('cyear');
            if($this->Process->studentExists($var1)){
                $this->Process->editStudent($var1, $var7, $var9, $var10);
            }
            echo $this->Process->addStudentCopyright($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9);
        }
    }

    public function addStudentTechArticle(){
        if($this->input->post()){
            $var1 = $this->input->post('email');
            $var2 = $this->input->post('topic');
            $var3 = $this->input->post('name');
            $var4 = $this->input->post('role');
            $var5 = $this->input->post('publisher');
            $var6 = $this->input->post('date');
            $var7 = $this->input->post('year');
            $var8 = $this->input->post('link');
            $var9 = $this->input->post('dept');
            $var10 = $this->input->post('fname');
            $var11 = $this->input->post('cyear');
            if(!$this->Process->studentExists($var1)){
                $this->Process->editStudent($var1, $var9, $var10, $var11);
            }
            echo $this->Process->addStudentTechArticle($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $var10);
        }
    }

    public function addCopyright(){
        if($this->input->post()){
            $var1 = $this->input->post('email');
            $var2 = $this->input->post('diary');
            $var3 = $this->input->post('title');
            $var4 = $this->input->post('class');
            $var5 = $this->input->post('applicant');
            $var6 = $this->input->post('link');
            $var7 = $this->input->post('dept');
            $var8 = $this->input->post('year');
            $var9 = $this->input->post('fname');
            $var10 = $this->input->post('scholar');
            if(!$this->Process->facultyExists($var1)){
                $this->Process->addFaculty($var1, $var7, $var9, $var10);
            }else{
                $this->Process->editFaculty($var1, $var7, $var10);
            }
            echo $this->Process->addCopyright($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9);
        }
    }

    public function addCerti(){
        if($this->input->post()){
            $var1 = $this->input->post('email');
            $var2 = $this->input->post('name');
            $var3 = $this->input->post('cname');
            $var4 = $this->input->post('date');
            $var5 = $this->input->post('dept');
            $var6 = $this->input->post('detail');
            $var7 = $this->input->post('fname');
            $var8 = $this->input->post('scholar');
            if(!$this->Process->facultyExists($var1)){
                $this->Process->addFaculty($var1, $var5, $var7, $var8);
            }else{
                $this->Process->editFaculty($var1, $var5, $var8);
            }
            echo $this->Process->addCerti($var1, $var2, $var3, $var4, $var5, $var6, $var7);
        }
    }

    public function addStudentCerti(){
        if($this->input->post()){
            $var1 = $this->input->post('email');
            $var2 = $this->input->post('name');
            $var3 = $this->input->post('cname');
            $var4 = $this->input->post('date');
            $var5 = $this->input->post('dept');
            $var6 = $this->input->post('detail');
            $var7 = $this->input->post('fname');
            $var8 = $this->input->post('cyear');
            if($this->Process->studentExists($var1)){
                $this->Process->editStudent($var1, $var5, $var7, $var8);
            }
            echo $this->Process->addStudentCerti($var1, $var2, $var3, $var4, $var5, $var6, $var7);
        }
    }

    public function addStudentPatent(){
        if($this->input->post()){
            $var1 = $this->input->post('email');
            $var2 = $this->input->post('patentid');
            $var3 = $this->input->post('title');
            $var4 = $this->input->post('applicant');
            $var5 = $this->input->post('inventor');
            $var6 = $this->input->post('link');
            $var7 = $this->input->post('status');
            $var8 = $this->input->post('fdate');
            $var9 = $this->input->post('pdate');
            $var10 = $this->input->post('dept');
            $var11 = $this->input->post('fname');
            $var12 = $this->input->post('cyear');
            $var13 = $this->input->post('gdate');
            if($this->Process->studentExists($var1)){
                $this->Process->editStudent($var1, $var10, $var11, $var12);
            }
            echo $this->Process->addStudentPatent($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $var10, $var11, $var13);
        }
    }

    public function addPatent(){
        if($this->input->post()){
            $var1 = $this->input->post('email');
            $var2 = $this->input->post('patentid');
            $var3 = $this->input->post('title');
            $var4 = $this->input->post('applicant');
            $var5 = $this->input->post('inventor');
            $var6 = $this->input->post('link');
            $var7 = $this->input->post('status');
            $var8 = $this->input->post('fdate');
            $var9 = $this->input->post('pdate');
            $var10 = $this->input->post('dept');
            $var11 = $this->input->post('fname');
            $var12 = $this->input->post('scholar');
            $var13 = $this->input->post('gdate');
            if(!$this->Process->facultyExists($var1)){
                $this->Process->addFaculty($var1, $var10, $var11, $var12);
            }else{
                $this->Process->editFaculty($var1, $var10, $var12);
            }
            echo $this->Process->addPatent($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $var10, $var11, $var13);
        }
    }

    public function addStudentChapterFrontPage(){
        $id = $this->input->post("autoincr");
        if(isset($_FILES['front']['name']) and $_FILES['front']['name'] != ""){
            $target_file = basename($_FILES["front"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $dir = "illustrations/";
            if(!is_dir($dir))   mkdir($dir);
            $dir = "illustrations/booksfront/";
            if(!is_dir($dir))   mkdir($dir);
            while(true){
                $tmp_file = uniqid('front_', true) . '.'.$imageFileType ;
                if(!file_exists($dir . $tmp_file)) break;
            }
            if(move_uploaded_file($_FILES["front"]["tmp_name"], $dir . $tmp_file)){
                $this->Process->addStudentChapterFrontPage($id, $tmp_file);
                echo json_encode([$id, $tmp_file]);
                return;
            }
        }
        echo 0;
    }

    public function addStudentFrontPage(){
        $id = $this->input->post("autoincr");
        if(isset($_FILES['front']['name']) and $_FILES['front']['name'] != ""){
            $target_file = basename($_FILES["front"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $dir = "illustrations/";
            if(!is_dir($dir))   mkdir($dir);
            $dir = "illustrations/booksfront/";
            if(!is_dir($dir))   mkdir($dir);
            while(true){
                $tmp_file = uniqid('front_', true) . '.'.$imageFileType ;
                if(!file_exists($dir . $tmp_file)) break;
            }
            if(move_uploaded_file($_FILES["front"]["tmp_name"], $dir . $tmp_file)){
                $this->Process->addStudentFrontPage($id, $tmp_file);
                echo json_encode([$id, $tmp_file]);
                return;
            }
        }
        echo 0;
    }

    public function addChapterFrontPage(){
        $id = $this->input->post("autoincr");
        if(isset($_FILES['front']['name']) and $_FILES['front']['name'] != ""){
            $target_file = basename($_FILES["front"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $dir = "illustrations/";
            if(!is_dir($dir))   mkdir($dir);
            $dir = "illustrations/booksfront/";
            if(!is_dir($dir))   mkdir($dir);
            while(true){
                $tmp_file = uniqid('front_', true) . '.'.$imageFileType ;
                if(!file_exists($dir . $tmp_file)) break;
            }
            if(move_uploaded_file($_FILES["front"]["tmp_name"], $dir . $tmp_file)){
                $this->Process->addChapterFrontPage($id, $tmp_file);
                echo json_encode([$id, $tmp_file]);
                return;
            }
        }
        echo 0;
    }

    public function addStudentCertiImage(){
        $id = $this->input->post("autoincr");
        if(isset($_FILES['cimage']['name']) and $_FILES['cimage']['name'] != ""){
            $target_file = basename($_FILES["cimage"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $dir = "illustrations/";
            if(!is_dir($dir))   mkdir($dir);
            $dir = "illustrations/certi/";
            if(!is_dir($dir))   mkdir($dir);
            while(true){
                $tmp_file = uniqid('certi_', true) . '.'.$imageFileType ;
                if(!file_exists($dir . $tmp_file)) break;
            }
            if(move_uploaded_file($_FILES["cimage"]["tmp_name"], $dir . $tmp_file)){
                $this->Process->addStudentCertiImage($id, $tmp_file);
                echo json_encode([$id, $tmp_file]);
                return;
            }
        }
        echo 0;
    }

    public function addCertiImage(){
        $id = $this->input->post("autoincr");
        if(isset($_FILES['cimage']['name']) and $_FILES['cimage']['name'] != ""){
            $target_file = basename($_FILES["cimage"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $dir = "illustrations/";
            if(!is_dir($dir))   mkdir($dir);
            $dir = "illustrations/certi/";
            if(!is_dir($dir))   mkdir($dir);
            while(true){
                $tmp_file = uniqid('certi_', true) . '.'.$imageFileType ;
                if(!file_exists($dir . $tmp_file)) break;
            }
            if(move_uploaded_file($_FILES["cimage"]["tmp_name"], $dir . $tmp_file)){
                $this->Process->addCertiImage($id, $tmp_file);
                echo json_encode([$id, $tmp_file]);
                return;
            }
        }
        echo 0;
    }

    public function addFrontPage(){
        $id = $this->input->post("autoincr");
        if(isset($_FILES['front']['name']) and $_FILES['front']['name'] != ""){
            $target_file = basename($_FILES["front"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $dir = "illustrations/";
            if(!is_dir($dir))   mkdir($dir);
            $dir = "illustrations/booksfront/";
            if(!is_dir($dir))   mkdir($dir);
            while(true){
                $tmp_file = uniqid('front_', true) . '.'.$imageFileType ;
                if(!file_exists($dir . $tmp_file)) break;
            }
            if(move_uploaded_file($_FILES["front"]["tmp_name"], $dir . $tmp_file)){
                $this->Process->addFrontPage($id, $tmp_file);
                echo json_encode([$id, $tmp_file]);
                return;
            }
        }
        echo 0;
    }

    public function addStudentChapter(){
        if($this->input->post()){
            $var1 = $this->input->post('email');
            $var2 = $this->input->post('title');
            $var3 = $this->input->post('chapter');
            $var4 = $this->input->post('link');
            $var5 = $this->input->post('dept');
            $var6 = $this->input->post('publisher');
            $var7 = $this->input->post('year');
            $var8 = $this->input->post('fname');
            $var9 = $this->input->post('cyear');
            if($this->Process->studentExists($var1)){
                $this->Process->editStudent($var1, $var5, $var8, $var9);
            }
            echo $this->Process->addStudentChapter($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8);
        }
    }

    public function addTechArticle(){
        if($this->input->post()){
            $var1 = $this->input->post('email');
            $var2 = $this->input->post('topic');
            $var3 = $this->input->post('name');
            $var4 = $this->input->post('role');
            $var5 = $this->input->post('publisher');
            $var6 = $this->input->post('date');
            $var7 = $this->input->post('year');
            $var8 = $this->input->post('link');
            $var9 = $this->input->post('dept');
            $var10 = $this->input->post('fname');
            $var11 = $this->input->post('scholar');
            if(!$this->Process->facultyExists($var1)){
                $this->Process->addFaculty($var1, $var9, $var10, $var11);
            }else{
                $this->Process->editFaculty($var1, $var9, $var11);
            }
            echo $this->Process->addTechArticle($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $var10);
        }
    }

    public function addChapter(){
        if($this->input->post()){
            $var1 = $this->input->post('email');
            $var2 = $this->input->post('title');
            $var3 = $this->input->post('chapter');
            $var4 = $this->input->post('link');
            $var5 = $this->input->post('dept');
            $var6 = $this->input->post('publisher');
            $var7 = $this->input->post('year');
            $var8 = $this->input->post('fname');
            $var9 = $this->input->post('scholar');
            if(!$this->Process->facultyExists($var1)){
                $this->Process->addFaculty($var1, $var5, $var8, $var9);
            }else{
                $this->Process->editFaculty($var1, $var5, $var9);
            }
            echo $this->Process->addChapter($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8);
        }
    }

    public function addStudentBook(){
        if($this->input->post()){
            $var1 = $this->input->post('email');
            $var2 = $this->input->post('title');
            $var3 = $this->input->post('role');
            $var4 = $this->input->post('link');
            $var5 = $this->input->post('dept');
            $var6 = $this->input->post('publisher');
            $var7 = $this->input->post('year');
            $var8 = $this->input->post('fname');
            $var9 = $this->input->post('cyear');
            if($this->Process->studentExists($var1)){
                $this->Process->editStudent($var1, $var5, $var8, $var9);
            }
            echo $this->Process->addStudentBook($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8);
        }
    }

    public function addBook(){
        if($this->input->post()){
            $var1 = $this->input->post('email');
            $var2 = $this->input->post('title');
            $var3 = $this->input->post('role');
            $var4 = $this->input->post('link');
            $var5 = $this->input->post('dept');
            $var6 = $this->input->post('publisher');
            $var7 = $this->input->post('year');
            $var8 = $this->input->post('fname');
            $var9 = $this->input->post('scholar');
            if(!$this->Process->facultyExists($var1)){
                $this->Process->addFaculty($var1, $var5, $var8, $var9);
            }else{
                $this->Process->editFaculty($var1, $var5, $var9);
            }
            echo $this->Process->addBook($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8);
        }
    }

    public function deleteEvent(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'ongoing_events')){
                echo $this->Process->deleteEvent($var1);
            }else echo 0;
        }
    }

    public function editProject(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'ongoing')){
                $pro = $this->Process->getDataByIdAsArray($var1, "*", "ongoing");
                $details = $this->Process->getDataByIdAsArray($var1, "*", "ongoing_details");
                $this->Process->deleteProject($var1);
                echo json_encode(array_merge($pro, ["partis" => $details])); 
            }else echo 0;
        }
    }

    public function deleteProject(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'ongoing')){
                echo $this->Process->deleteProject($var1);
            }else echo 0;
        }
    }

    public function deleteStudentPaper(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'fstudent_paper')){
                echo $this->Process->deleteStudentPaper($var1);
            }else echo 0;
        }
    }

    public function deleteStudentBook(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'fstudent_book')){
                echo $this->Process->deleteStudentBook($var1);
            }else echo 0;
        }
    }

    public function deleteStudentPatent(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'fstudent_patent')){
                echo $this->Process->deleteStudentPatent($var1);
            }else echo 0;
        }
    }

    public function deleteStudentCopyright(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'fstudent_copyright')){
                echo $this->Process->deleteStudentCopyright($var1);
            }else echo 0;
        }
    }

    public function deleteStudentTechArticle(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'fstudent_tech')){
                echo $this->Process->deleteStudentTechArticle($var1);
            }else echo 0;
        }
    }

    public function deleteStudentChapter(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'fstudent_chapter')){
                echo $this->Process->deleteStudentChapter($var1);
            }else echo 0;
        }
    }

    public function deletePaper(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'fpaper')){
                echo $this->Process->deletePaper($var1);
            }else echo 0;
        }
    }

    public function deleteCerti(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'fcerti')){
                echo $this->Process->deleteCerti($var1);
            }else echo 0;
        }
    }

    public function deleteStudentCerti(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'fstudent_certi')){
                echo $this->Process->deleteStudentCerti($var1);
            }else echo 0;
        }
    }

    public function deleteBook(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'fbook')){
                echo $this->Process->deleteBook($var1);
            }else echo 0;
        }
    }

    public function deletePatent(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'fpatent')){
                echo $this->Process->deletePatent($var1);
            }else echo 0;
        }
    }

    public function deleteTechArticle(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'ftech')){
                echo $this->Process->deleteTechArticle($var1);
            }else echo 0;
        }
    }

    public function deleteCopyright(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'fcopyright')){
                echo $this->Process->deleteCopyright($var1);
            }else echo 0;
        }
    }

    public function deleteChapter(){
        if($this->input->post()){
            $var1 = $this->input->post('autoincr');
            if($this->Process->columnExists($var1, 'fchapter')){
                echo $this->Process->deleteChapter($var1);
            }else echo 0;
        }
    }

}
