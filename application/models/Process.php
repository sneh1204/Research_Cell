<?php
class Process extends CI_Model{
    public $prefix;
    function __construct(){
        parent::__construct();
        $this->prefix = "rsrch_";
    }
    function getDb(){
        return $this->db;
    }
    function addFaculty($email, $dept, $fname, $scholar = "", $citation = 0, $hindex = 0, $i10index = 0){
        $sql = "INSERT INTO `{$this->prefix}faculty` (`name`, `email`, `dept`, `scholar`, `citation`, `h-index`, `i10-index`) VALUES (?,?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $dept, $scholar, (int) $citation, (int) $hindex, (int) $i10index));
		} catch (Exception $e) {
		
		}
    }
    function setDownload($email, $type, $ip, $date, $year = "", $dept = ""){
        $sql = "INSERT INTO `{$this->prefix}download` (`email`, `type`, `year`, `dept`, `IP`, `time`) VALUES (?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($email, $type, $year, $dept, $ip, $date));
		} catch (Exception $e) {
            
		}
    }
    function deleteStudentCopyright($autoincr){
        $sql = "DELETE FROM `{$this->prefix}fstudent_copyright` WHERE id=?;";
        try{
         $query = $this->db->query($sql, array((int) $autoincr));
        }catch (Exception $e) {
			echo 0;
		}
    }
    function deleteStudentTechArticle($autoincr){
        $sql = "DELETE FROM `{$this->prefix}fstudent_tech` WHERE id=?;";
        try{
         $query = $this->db->query($sql, array((int) $autoincr));
        }catch (Exception $e) {
			echo 0;
		}
    }
    function deleteTechArticle($autoincr){
        $sql = "DELETE FROM `{$this->prefix}ftech` WHERE id=?;";
        try{
         $query = $this->db->query($sql, array((int) $autoincr));
        }catch (Exception $e) {
			echo 0;
		}
    }
    function deleteCopyright($autoincr){
        $sql = "DELETE FROM `{$this->prefix}fcopyright` WHERE id=?;";
        try{
         $query = $this->db->query($sql, array((int) $autoincr));
        }catch (Exception $e) {
			echo 0;
		}
    }
    function deleteStudentChapter($autoincr){
        $img = $this->getDataById($autoincr, 'frontpage', 'fstudent_chapter');
        if($img != "")    unlink('illustrations/booksfront/' . $img);
        $sql = "DELETE FROM `{$this->prefix}fstudent_chapter` WHERE id=?;";
        try{
         $query = $this->db->query($sql, array((int) $autoincr));
        }catch (Exception $e) {
			echo 0;
		}
    }
    function deleteChapter($autoincr){
        $img = $this->getDataById($autoincr, 'frontpage', 'fchapter');
        if($img != "")    unlink('illustrations/booksfront/' . $img);
        $sql = "DELETE FROM `{$this->prefix}fchapter` WHERE id=?;";
        try{
         $query = $this->db->query($sql, array((int) $autoincr));
        }catch (Exception $e) {
			echo 0;
		}
    }
    function getAllProjectsCount($year){
        $count = 0;
        $sql = "SELECT COUNT(*) as tot FROM {$this->prefix}ongoing WHERE year='$year';";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result()[0]->tot;
        }
        return $count;
    }
    function getWithStudentCount(){
        $count = 0;
        $sql = "SELECT COUNT(*) as tot FROM {$this->prefix}fpaper WHERE student='true';";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result()[0]->tot;
        }
        return $count;
    }
    function getAllFacultyEndDate(){
        $sql = "SELECT * FROM {$this->prefix}faculty_dates;";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            $arr = $query->result_array();
            $dataarr = [];
            foreach($arr as $id => $data){
                $dataarr[$data['email']] = $data['leftdate'];
            }
            return $dataarr;
        }else{
            return false;
        }
    }
    function getAllFacultyPapers(){
        $sql = "SELECT * FROM {$this->prefix}fpaper;";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return false;
        }
    }
    function getStudentPaperCount(){
        return $this->getRowCount('fstudent_paper') + $this->getWithStudentCount();
    }
    function merge_array($arr, $arr1){
        $mergearr = [];
        $i = 0;
        foreach($arr as $value){
            $mergearr[$i++] = $value;
        }
        foreach($arr1 as $value){
            $mergearr[$i++] = $value;
        }
        return $mergearr;
    }
    function withStudent($table, $year, $dept){
        if($year != '0' && $dept != '0'){
            $sql = "SELECT * FROM {$this->prefix}{$table} WHERE year=? AND dept=? ORDER BY fname ASC;";
            $query = $this->db->query($sql, array($year, $dept));
            $sql = "SELECT * FROM {$this->prefix}fpaper WHERE year=? AND dept=? AND student='true' ORDER BY fname ASC;";
            $query2 = $this->db->query($sql, array($year, $dept));
        }elseif($year != '0' && $dept == '0'){
            $sql = "SELECT * FROM {$this->prefix}{$table} WHERE year=? ORDER BY fname ASC;";
            $query = $this->db->query($sql, array($year));
            $sql = "SELECT * FROM {$this->prefix}fpaper WHERE year=? AND student='true' ORDER BY fname ASC;";
            $query2 = $this->db->query($sql, array($year));
        }elseif($year == '0' && $dept != '0'){
            $sql = "SELECT * FROM {$this->prefix}{$table} WHERE dept=? ORDER BY fname ASC;";
            $query = $this->db->query($sql, array($dept));
            $sql = "SELECT * FROM {$this->prefix}fpaper WHERE dept=? AND student='true' ORDER BY fname ASC;";
            $query2 = $this->db->query($sql, array($dept));
        }else{
            $sql = "SELECT * FROM {$this->prefix}{$table} ORDER BY fname ASC;";
            $query = $this->db->query($sql);
            $sql = "SELECT * FROM {$this->prefix}fpaper WHERE student='true' ORDER BY fname ASC;";
            $query2 = $this->db->query($sql);
        }
        return $this->merge_array($query->result_array(), $query2->result_array());
    }
    function getPublicationDataByFilter($table, $year, $dept){
        if($table == 'fstudent_paper'){
            return $this->withStudent($table, $year, $dept);
        }
        if($year != '0' && $dept != '0'){
            $sql = "SELECT * FROM {$this->prefix}{$table} WHERE year=? AND dept=? ORDER BY fname ASC;";
            $query = $this->db->query($sql, array($year, $dept));
        }elseif($year != '0' && $dept == '0'){
            $sql = "SELECT * FROM {$this->prefix}{$table} WHERE year=? ORDER BY fname ASC;";
            $query = $this->db->query($sql, array($year));
        }elseif($year == '0' && $dept != '0'){
            $sql = "SELECT * FROM {$this->prefix}{$table} WHERE dept=? ORDER BY fname ASC;";
            $query = $this->db->query($sql, array($dept));
        }else{
            $sql = "SELECT * FROM {$this->prefix}{$table} ORDER BY fname ASC;";
            $query = $this->db->query($sql);
        }
        return $query->result_array();
    }
    function deleteStudentBook($autoincr){
        $img = $this->getDataById($autoincr, 'frontpage', 'fstudent_book');
        if($img != "")    unlink('illustrations/booksfront/' . $img);
        $sql = "DELETE FROM `{$this->prefix}fstudent_book` WHERE id=?;";
        try{
         $query = $this->db->query($sql, array((int) $autoincr));
        }catch (Exception $e) {
			echo 0;
		}
    }
    function deleteBook($autoincr){
        $img = $this->getDataById($autoincr, 'frontpage', 'fbook');
        if($img != "")    unlink('illustrations/booksfront/' . $img);
        $sql = "DELETE FROM `{$this->prefix}fbook` WHERE id=?;";
        try{
         $query = $this->db->query($sql, array((int) $autoincr));
        }catch (Exception $e) {
			echo 0;
		}
    }
    function deleteCerti($autoincr){
        $img = $this->getDataById($autoincr, 'cimage', 'fcerti');
        if($img != "")    unlink('illustrations/certi/' . $img);
        $sql = "DELETE FROM `{$this->prefix}fcerti` WHERE id=?;";
        try{
         $query = $this->db->query($sql, array((int) $autoincr));
        }catch (Exception $e) {
			echo 0;
		}
    }
    function deleteStudentCerti($autoincr){
        $img = $this->getDataById($autoincr, 'cimage', 'fstudent_certi');
        if($img != "")    unlink('illustrations/certi/' . $img);
        $sql = "DELETE FROM `{$this->prefix}fstudent_certi` WHERE id=?;";
        try{
         $query = $this->db->query($sql, array((int) $autoincr));
        }catch (Exception $e) {
			echo 0;
		}
    }
    function deleteStudentPatent($autoincr){
        $sql = "DELETE FROM `{$this->prefix}fstudent_patent` WHERE id=?;";
        try{
         $query = $this->db->query($sql, array((int) $autoincr));
        }catch (Exception $e) {
			echo 0;
		}
    }
    function deletePatent($autoincr){
        $sql = "DELETE FROM `{$this->prefix}fpatent` WHERE id=?;";
        try{
         $query = $this->db->query($sql, array((int) $autoincr));
        }catch (Exception $e) {
			echo 0;
		}
    }
    function deleteStudentPaper($autoincr){
        $sql = "DELETE FROM `{$this->prefix}fstudent_paper` WHERE id=?;";
        try{
         $query = $this->db->query($sql, array((int) $autoincr));
        }catch (Exception $e) {
			echo 0;
		}
    }
    function deletePaper($autoincr){
        $sql = "DELETE FROM `{$this->prefix}fpaper` WHERE id=?;";
        try{
         $query = $this->db->query($sql, array((int) $autoincr));
        }catch (Exception $e) {
			echo 0;
		}
    }
    function addStudentChapter($email, $title, $chapter, $link, $dept, $publisher, $year, $fname){
        $sql = "INSERT INTO `{$this->prefix}fstudent_chapter` (`fname`, `email`, `dept`, `title`, `chapter`, `year`, `publisher`, `frontpage`, `link`) VALUES (?,?,?,?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $dept, $title, $chapter, $year, $publisher, "", $link));
            $sql = "SELECT id FROM `{$this->prefix}fstudent_chapter` ORDER BY id DESC LIMIT 1";
            $query = $this->db->query($sql);
            if($query->num_rows() > 0){
                echo $query->result()[0]->id;
            }else{
                echo 1;
            }
		} catch (Exception $e) {
			echo 0;
		}
    }
    function addChapter($email, $title, $chapter, $link, $dept, $publisher, $year, $fname){
        $sql = "INSERT INTO `{$this->prefix}fchapter` (`fname`, `email`, `dept`, `title`, `chapter`, `year`, `publisher`, `frontpage`, `link`) VALUES (?,?,?,?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $dept, $title, $chapter, $year, $publisher, "", $link));
            $sql = "SELECT id FROM `{$this->prefix}fchapter` ORDER BY id DESC LIMIT 1";
            $query = $this->db->query($sql);
            if($query->num_rows() > 0){
                echo $query->result()[0]->id;
            }else{
                echo 1;
            }
		} catch (Exception $e) {
			echo 0;
		}
    }
    function addStudentBook($email, $title, $role, $link, $dept, $publisher, $year, $fname){
        $sql = "INSERT INTO `{$this->prefix}fstudent_book` (`fname`, `email`, `dept`, `title`, `role`, `year`, `publisher`, `frontpage`, `link`) VALUES (?,?,?,?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $dept, $title, $role, $year, $publisher, "", $link));
            $sql = "SELECT id FROM `{$this->prefix}fstudent_book` ORDER BY id DESC LIMIT 1";
            $query = $this->db->query($sql);
            if($query->num_rows() > 0){
                echo $query->result()[0]->id;
            }else{
                echo 1;
            }
		} catch (Exception $e) {
			echo 0;
		}
    }
    function addCerti($email, $name, $cname, $date, $dept, $detail, $fname){
        $sql = "INSERT INTO `{$this->prefix}fcerti` (`fname`, `email`, `dept`, `name`, `certiname`, `details`, `date`, `cimage`) VALUES (?,?,?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $dept, $name, $cname, $detail, $date, ""));
            $sql = "SELECT id FROM `{$this->prefix}fcerti` ORDER BY id DESC LIMIT 1";
            $query = $this->db->query($sql);
            if($query->num_rows() > 0){
                echo $query->result()[0]->id;
            }else{
                echo 1;
            }
		} catch (Exception $e) {
			echo 0;
		}
    }
    function addStudentCerti($email, $name, $cname, $date, $dept, $detail, $fname){
        $sql = "INSERT INTO `{$this->prefix}fstudent_certi` (`fname`, `email`, `dept`, `name`, `certiname`, `details`, `date`, `cimage`) VALUES (?,?,?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $dept, $name, $cname, $detail, $date, ""));
            $sql = "SELECT id FROM `{$this->prefix}fstudent_certi` ORDER BY id DESC LIMIT 1";
            $query = $this->db->query($sql);
            if($query->num_rows() > 0){
                echo $query->result()[0]->id;
            }else{
                echo 1;
            }
		} catch (Exception $e) {
			echo 0;
		}
    }
    function addBook($email, $title, $role, $link, $dept, $publisher, $year, $fname){
        $sql = "INSERT INTO `{$this->prefix}fbook` (`fname`, `email`, `dept`, `title`, `role`, `year`, `publisher`, `frontpage`, `link`) VALUES (?,?,?,?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $dept, $title, $role, $year, $publisher, "", $link));
            $sql = "SELECT id FROM `{$this->prefix}fbook` ORDER BY id DESC LIMIT 1";
            $query = $this->db->query($sql);
            if($query->num_rows() > 0){
                echo $query->result()[0]->id;
            }else{
                echo 1;
            }
		} catch (Exception $e) {
			echo 0;
		}
    }
    function addStudentCopyright($email, $diary, $title, $class, $applicant, $link, $dept, $year, $fname){
        $sql = "INSERT INTO `{$this->prefix}fstudent_copyright` (`fname`, `email`, `dept`, `diary`, `title`, `class`, `applicant`, `year`, `link`) VALUES (?,?,?,?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $dept, $diary, $title, $class, $applicant, $year, $link));
            $sql = "SELECT id FROM `{$this->prefix}fstudent_copyright` ORDER BY id DESC LIMIT 1";
            $query = $this->db->query($sql);
            if($query->num_rows() > 0){
                echo $query->result()[0]->id;
            }else{
                echo 1;
            }
		} catch (Exception $e) {
			echo 0;
		}
    }
    function addStudentTechArticle($email, $topic, $name, $role, $publisher, $date, $year, $link, $dept, $fname){
        $sql = "INSERT INTO `{$this->prefix}fstudent_tech` (`fname`, `email`, `dept`, `name`, `topic`, `link`, `publisher`, `role`, `year`, `date`) VALUES (?,?,?,?,?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $dept, $name, $topic, $link, $publisher, $role, $year, $date));
            $sql = "SELECT id FROM `{$this->prefix}fstudent_tech` ORDER BY id DESC LIMIT 1";
            $query = $this->db->query($sql);
            if($query->num_rows() > 0){
                echo $query->result()[0]->id;
            }else{
                echo 1;
            }
		} catch (Exception $e) {
			echo 0;
		}
    }
    function addTechArticle($email, $topic, $name, $role, $publisher, $date, $year, $link, $dept, $fname){
        $sql = "INSERT INTO `{$this->prefix}ftech` (`fname`, `email`, `dept`, `name`, `topic`, `link`, `publisher`, `role`, `year`, `date`) VALUES (?,?,?,?,?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $dept, $name, $topic, $link, $publisher, $role, $year, $date));
            $sql = "SELECT id FROM `{$this->prefix}ftech` ORDER BY id DESC LIMIT 1";
            $query = $this->db->query($sql);
            if($query->num_rows() > 0){
                echo $query->result()[0]->id;
            }else{
                echo 1;
            }
		} catch (Exception $e) {
			echo 0;
		}
    }
    function addCopyright($email, $diary, $title, $class, $applicant, $link, $dept, $year, $fname){
        $sql = "INSERT INTO `{$this->prefix}fcopyright` (`fname`, `email`, `dept`, `diary`, `title`, `class`, `applicant`, `year`, `link`) VALUES (?,?,?,?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $dept, $diary, $title, $class, $applicant, $year, $link));
            $sql = "SELECT id FROM `{$this->prefix}fcopyright` ORDER BY id DESC LIMIT 1";
            $query = $this->db->query($sql);
            if($query->num_rows() > 0){
                echo $query->result()[0]->id;
            }else{
                echo 1;
            }
		} catch (Exception $e) {
			echo 0;
		}
    }
    function addStudentPatent($email, $patentid, $title, $applicant, $inventor, $link, $status, $fdate, $pdate, $dept, $fname, $gdate){
        $sql = "INSERT INTO `{$this->prefix}fstudent_patent` (`fname`, `email`, `dept`, `patentid`, `title`, `applicant`, `inventor`, `status`, `fdate`, `pdate`, `gdate`, `link`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $dept, $patentid, $title, $applicant, $inventor, $status, $fdate, $pdate, $gdate, $link));
            $sql = "SELECT id FROM `{$this->prefix}fstudent_patent` ORDER BY id DESC LIMIT 1";
            $query = $this->db->query($sql);
            if($query->num_rows() > 0){
                echo $query->result()[0]->id;
            }else{
                echo 1;
            }
		} catch (Exception $e) {
			echo 0;
		}
    }
    function addPatent($email, $patentid, $title, $applicant, $inventor, $link, $status, $fdate, $pdate, $dept, $fname, $gdate){
        $sql = "INSERT INTO `{$this->prefix}fpatent` (`fname`, `email`, `dept`, `patentid`, `title`, `applicant`, `inventor`, `status`, `fdate`, `pdate`, `gdate`, `link`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $dept, $patentid, $title, $applicant, $inventor, $status, $fdate, $pdate, $gdate, $link));
            $sql = "SELECT id FROM `{$this->prefix}fpatent` ORDER BY id DESC LIMIT 1";
            $query = $this->db->query($sql);
            if($query->num_rows() > 0){
                echo $query->result()[0]->id;
            }else{
                echo 1;
            }
		} catch (Exception $e) {
			echo 0;
		}
    }
    function addEndDate($email, $date){
        $sql = "UPDATE `{$this->prefix}faculty_dates` SET `leftdate`=? WHERE `email`=?";
		try {
            $this->db->query($sql, array($date, $email));
            echo 1;
		} catch (Exception $e) {
            echo 0;
		}
    }
    function addStudentJoinDate($fname, $email, $date){
        $sql = "INSERT INTO `{$this->prefix}student` (`fname`, `email`, `joindate`) VALUES (?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $date));
            echo 1;
		} catch (Exception $e) {
            echo 0;
		}
    }
    function addJoinDate($email, $date){
        $sql = "INSERT INTO `{$this->prefix}faculty_dates` (`email`, `joindate`) VALUES (?,?)";
		try {
            $this->db->query($sql, array($email, $date));
            echo 1;
		} catch (Exception $e) {
            echo 0;
		}
    }
    function addOngoingEvent($name, $date, $description, $year, $type){
        $sql = "INSERT INTO `{$this->prefix}ongoing_events` (`name`, `date`, `details`, `year`, `type`) VALUES (?,?,?,?,?)";
		try {
            $this->db->query($sql, array($name, $date, $description, $year, $type));
            return $this->db->insert_id();
		} catch (Exception $e) {
		}
    }
    function addStudentPaper($email, $authors, $name, $title, $doi, $link, $dept, $type, $year, $fname, $month = ""){
        $sql = "INSERT INTO `{$this->prefix}fstudent_paper` (`fname`, `email`, `authors`, `dept`, `type`, `name`, `title`, `doi`, `year`, `link`, `month`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $authors, $dept, $type, $name, $title, $doi, $year, $link, $month));
            $sql = "SELECT id FROM `{$this->prefix}fstudent_paper` ORDER BY id DESC LIMIT 1";
            $query = $this->db->query($sql);
            if($query->num_rows() > 0){
                echo $query->result()[0]->id;
            }
		} catch (Exception $e) {
		}
    }
    function addPaper($email, $authors, $name, $title, $doi, $link, $dept, $type, $year, $fname, $month = "", $student = "false", $cites = 0, $flag = false){
        $sql = "INSERT INTO `{$this->prefix}fpaper` (`fname`, `email`, `authors`, `dept`, `type`, `name`, `title`, `doi`, `year`, `link`, `cited`, `month`, `student`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
		try {
            $this->db->query($sql, array($fname, $email, $authors, $dept, $type, $name, $title, $doi, $year, $link, (int) $cites, $month, $student));
            if(!$flag){
                $sql = "SELECT id FROM `{$this->prefix}fpaper` ORDER BY id DESC LIMIT 1";
                $query = $this->db->query($sql);
                if($query->num_rows() > 0){
                    echo $query->result()[0]->id;
                }
            }
		} catch (Exception $e) {
		}
    }
    function saveStudentDetails($name, $email, $branch, $year, $divi, $title, $link){
        $sql = "INSERT INTO `{$this->prefix}sform`(`name`, `email`, `branch`, `year`, `divi`, `title`, `link`) VALUES (?,?,?,?,?,?,?)";
		try {
			$this->db->query($sql, array($name, $email, $branch, $year, $divi, $title, $link));
		} catch (Exception $e) {
			echo "Error Occured While inserting";
		}
    }
    function getFacultyPaper(){
        $sql = "SELECT * FROM {$this->prefix}faculty;";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }
    function checkAdminLogin($user, $pass){
        $sql = "SELECT * FROM {$this->prefix}admin WHERE uname=? AND pass=?;";
        $query = $this->db->query($sql, array($user,$pass));
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    function getAllInternCount(){
        $count = 0;
        $sql = "SELECT count(*) as tot from `{$this->prefix}ongoing_details` WHERE role='Student';";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result()[0]->tot;
        }
        return $count;
    }
    function getInternCount($year){
        $count = 0;
        $arr = $this->getEverythingAsArray('ongoing');
        foreach($arr as $value){
            if($value['year'] == $year){
                $id = $value['id'];
                $sql = "SELECT count(*) as tot from `{$this->prefix}ongoing_details` WHERE role='Student' AND id=$id;";
                $query = $this->db->query($sql);
                if($query->num_rows() > 0){
                    $count += $query->result()[0]->tot;
                }
            }
        }
        return $count;
    }
    function getMousProjectCount($id){
        $sql = "SELECT count(*) as tot from `{$this->prefix}projects` WHERE mous=?;";
        $query = $this->db->query($sql, array((int) $id));
        return $query->result()[0]->tot;
    }
    function getInternationalMousCount(){
        $sql = "SELECT count(*) as tot from `{$this->prefix}mous` WHERE scope='International';";
        $query = $this->db->query($sql);
        return $query->result()[0]->tot;
    }
    function getRowCount($type){
        $sql = "SELECT count(*) as tot from `{$this->prefix}$type`";
        $query = $this->db->query($sql);
        return $query->result()[0]->tot;
    }
    function getPageData($type, $page){
        $offset = ($page-1) * 6;
        if($type != 'events'){
            $sql = "SELECT * from `{$this->prefix}$type` LIMIT $offset,6";
        }else{
            $sql = "SELECT * from `{$this->prefix}$type` ORDER BY date DESC LIMIT $offset,6";
        }
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getPageDataByMous($type, $page, $mous){
        $offset = ($page-1) * 6;
        if($mous != "")    $sql = "SELECT * from `{$this->prefix}$type` WHERE mous=$mous LIMIT $offset,6";
        else    $sql = "SELECT * from `{$this->prefix}$type` LIMIT $offset,6";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function editStudent($email, $dept, $fname, $cyear){
        $sql = "UPDATE `{$this->prefix}student` SET dept=?, year=?, fname=? WHERE email=?";
        $query = $this->db->query($sql, array($dept, $cyear, $fname, $email));
    }
    function editFaculty($email, $dept, $scholar){
        $sql = "UPDATE `{$this->prefix}faculty` SET dept=?, scholar=? WHERE email=?";
        $query = $this->db->query($sql, array($dept, $scholar, $email));
    }
    function getFacultyEmail($id){
        $sql = "SELECT email FROM `{$this->prefix}faculty` WHERE id=?;";
        $query = $this->db->query($sql, array((int) $id));
        if($query->num_rows() > 0){
            return $query->result()[0]->email;
        }
    }
    function getStudentInfo($email){
        $sql = "SELECT * FROM `{$this->prefix}student` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return '';
        }
    }
    function getFacultyInfo($email){
        $sql = "SELECT * FROM `{$this->prefix}faculty` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result()[0];
        }else{
            return '';
        }
    }
    function getFacultyJoinDate($email){
        $sql = "SELECT * FROM `{$this->prefix}faculty_dates` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result()[0]->joindate;
        }else{
            return [];
        }
    }
    function getFacultyPatents($email){
        $sql = "SELECT * FROM `{$this->prefix}fpatent` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getStudentPatents($email){
        $sql = "SELECT * FROM `{$this->prefix}fstudent_patent` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getFacultyTechArticle($email){
        $sql = "SELECT * FROM `{$this->prefix}ftech` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getFacultyCerti($email){
        $sql = "SELECT * FROM `{$this->prefix}fcerti` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getFacultyCopyrights($email){
        $sql = "SELECT * FROM `{$this->prefix}fcopyright` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }

    function getStudentCerti($email){
        $sql = "SELECT * FROM `{$this->prefix}fstudent_certi` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getStudentCopyrights($email){
        $sql = "SELECT * FROM `{$this->prefix}fstudent_copyright` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getStudentTechArticles($email){
        $sql = "SELECT * FROM `{$this->prefix}fstudent_tech` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getFacultyChaps($email){
        $sql = "SELECT * FROM `{$this->prefix}fchapter` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getStudentChaps($email){
        $sql = "SELECT * FROM `{$this->prefix}fstudent_chapter` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getFacultyBooks($email){
        $sql = "SELECT * FROM `{$this->prefix}fbook` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getStudentBooks($email){
        $sql = "SELECT * FROM `{$this->prefix}fstudent_book` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getStudentPapers($email){
        $sql = "SELECT * FROM `{$this->prefix}fstudent_paper` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getFacultyPapers($email){
        $sql = "SELECT * FROM `{$this->prefix}fpaper` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getLatestNationalMous($count){
        $sql = "SELECT * from `{$this->prefix}mous` WHERE scope='National' ORDER BY id DESC LIMIT $count";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getLatestInternationalMous($count){
        $sql = "SELECT * from `{$this->prefix}mous` WHERE scope='International' ORDER BY id DESC LIMIT $count";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getLatestByType($type){
        $sql = "SELECT * from `{$this->prefix}$type` ORDER BY id DESC LIMIT 3";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getSingleData($type, $id, $tp = '1'){
        $sql = "SELECT * from `{$this->prefix}$type` WHERE id=?";
        $query = $this->db->query($sql, array((int) $id));
        if($query->num_rows() > 0){
            if($tp == '1')    return $query->result()[0];
            if($tp == 'all')    return $query->result();
        }else{
            return [];
        }
    }
    function getEverythingAsArray($type){
        $sql = "SELECT * FROM `{$this->prefix}$type`;";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result_array();
        }else{
            return [];
        }
    }
    function getEverything($type){
        $sql = "SELECT * FROM `{$this->prefix}$type`;";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getEverythingBySort($type, $sort, $way){
        $sql = "SELECT * FROM `{$this->prefix}$type` ORDER BY $sort $way;";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return [];
        }
    }
    function getPartiNumbers($id){
        $sql = "SELECT pid FROM `{$this->prefix}pro_details` WHERE id=?;";
        $query = $this->db->query($sql, array((int) $id));
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return 0;
        }
    }
    function getPartiDataById($id, $pid){
        $sql = "SELECT pic FROM `{$this->prefix}pro_details` WHERE id=? AND pid=?;";
        $query = $this->db->query($sql, array((int) $id, (int) $pid));
        if($query->num_rows() > 0){
            return $query->result()[0]->pic;
        }else{
            return '';
        }
    }
    function getDataByIdAsArray($id, $column, $type){
        $sql = "SELECT $column FROM {$this->prefix}$type WHERE id=?;";
        $query = $this->db->query($sql, array((int) $id));
        if($query->num_rows() > 0){
            if($column != '*')  return $query->result()[0]->$column;
            else  return $query->result_array();
        }else{
            return '';
        }
    }
    function getDataById($id, $column, $type){
        $sql = "SELECT $column FROM {$this->prefix}$type WHERE id=?;";
        $query = $this->db->query($sql, array((int) $id));
        if($query->num_rows() > 0){
            if($column != '*')  return $query->result()[0]->$column;
            else  return $query->result();
        }else{
            return '';
        }
    }
    function getFacultiesEntrolledMous($id){
        $count = 0;
        $sql = "SELECT * FROM {$this->prefix}projects WHERE mous=$id";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        foreach($result as $data){
            $sql = "SELECT count(*) as tot FROM {$this->prefix}pro_details WHERE id={$data['id']} AND role != 'Student'";
            $query = $this->db->query($sql);
            $count += $query->result()[0]->tot;
        }
        
        return $count;
    }
    function getStudentsEntrolledMous($id){
        $count = 0;
        $sql = "SELECT * FROM {$this->prefix}projects WHERE mous=$id";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        foreach($result as $data){
            $sql = "SELECT count(*) as tot FROM {$this->prefix}pro_details WHERE id={$data['id']} AND role = 'Student'";
            $query = $this->db->query($sql);
            $count += $query->result()[0]->tot;
        }
        
        return $count;
    }
    function confirm($type, $id){
        $ty = ($type == 'student') ? 's' : 't';
        $sql = "UPDATE `{$this->prefix}{$ty}form` SET confirm=1 WHERE id=?";
		try {
			$this->db->query($sql, array((int) $id));
			return true;
		} catch (Exception $e) {
			echo "Error Occured While updating";
		}
    }
    function addStudentChapterFrontPage($bid, $name){
        $sql = "UPDATE `{$this->prefix}fstudent_chapter` SET frontpage=? WHERE id=?";
		try {
			$this->db->query($sql, array($name, (int) $bid));
			return true;
		} catch (Exception $e) {
			echo "Error Occured While updating";
		}
    }
    function addStudentFrontPage($bid, $name){
        $sql = "UPDATE `{$this->prefix}fstudent_book` SET frontpage=? WHERE id=?";
		try {
			$this->db->query($sql, array($name, (int) $bid));
			return true;
		} catch (Exception $e) {
			echo "Error Occured While updating";
		}
    }
    function addChapterFrontPage($bid, $name){
        $sql = "UPDATE `{$this->prefix}fchapter` SET frontpage=? WHERE id=?";
		try {
			$this->db->query($sql, array($name, (int) $bid));
			return true;
		} catch (Exception $e) {
			echo "Error Occured While updating";
		}
    }
    function addCertiImage($bid, $name){
        $sql = "UPDATE `{$this->prefix}fcerti` SET cimage=? WHERE id=?";
		try {
			$this->db->query($sql, array($name, (int) $bid));
			return true;
		} catch (Exception $e) {
			echo "Error Occured While updating";
		}
    }
    function addStudentCertiImage($bid, $name){
        $sql = "UPDATE `{$this->prefix}fstudent_certi` SET cimage=? WHERE id=?";
		try {
			$this->db->query($sql, array($name, (int) $bid));
			return true;
		} catch (Exception $e) {
			echo "Error Occured While updating";
		}
    }
    function addFrontPage($bid, $name){
        $sql = "UPDATE `{$this->prefix}fbook` SET frontpage=? WHERE id=?";
		try {
			$this->db->query($sql, array($name, (int) $bid));
			return true;
		} catch (Exception $e) {
			echo "Error Occured While updating";
		}
    }
    function editStudentJoinDate($email, $date){
        $sql = "UPDATE `{$this->prefix}student` SET joindate=? WHERE email=?";
		try {
            $this->db->query($sql, array($date, $email));
            echo date("d,M Y",strtotime($date));
		} catch (Exception $e) {
			echo "Error Occured While updating";
		}
    }
    function editJoinDate($email, $date){
        $sql = "UPDATE `{$this->prefix}faculty_dates` SET joindate=? WHERE email=?";
		try {
            $this->db->query($sql, array($date, $email));
            echo date("d,M Y",strtotime($date));
		} catch (Exception $e) {
			echo "Error Occured While updating";
		}
    }
    function updateDataById($id, $column, $data, $type){
        $sql = "UPDATE `{$this->prefix}$type` SET $column=? WHERE id=?";
		try {
			$this->db->query($sql, array($data, (int) $id));
			return true;
		} catch (Exception $e) {
			echo "Error Occured While updating";
		}
    }
    function facultyExists($email){
        $sql = "SELECT * FROM `{$this->prefix}faculty` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    function studentExists($email){
        $sql = "SELECT * FROM `{$this->prefix}student` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    function hasJoinDate($email){
        $sql = "SELECT * FROM `{$this->prefix}faculty_dates` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    function columnExists($id, $type){
        $sql = "SELECT * FROM `{$this->prefix}$type` WHERE id=?;";
        $query = $this->db->query($sql, array((int) $id));
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    function addOngoingProject($title, $mous, $idate, $year, $status, $achievements, $edate){
        $sql = "INSERT INTO `{$this->prefix}ongoing`(`title`, `mous`, `idate`, `edate`, `year`, `status`, `achievements`) VALUES (?,?,?,?,?,?,?)";
		try {
			$this->db->query($sql, array($title, $mous, $idate, $edate, $year, $status, $achievements));
			return $this->db->insert_id();
		} catch (Exception $e) {
			echo "Error Occured While inserting";
		}
    }
    function addOngoingDetails($id, $pid, $name, $email, $role, $desc, $branch){
        $sql = "INSERT INTO `{$this->prefix}ongoing_details`(`id`, `pid`, `name`, `email`, `role`, `description`, `branch`) VALUES (?,?,?,?,?,?,?)";
		try {
			$this->db->query($sql, array((int) $id, (int) $pid, $name, $email, $role, $desc, $branch));
		} catch (Exception $e) {
			echo "Error Occured While inserting";
		}
    }
    function addDetails($pid, $name){
        $sql = "UPDATE `{$this->prefix}ongoing` SET details=? WHERE id=?";
		try {
			$this->db->query($sql, array($name, (int) $pid));
			return true;
		} catch (Exception $e) {
			echo "Error Occured While updating";
		}
    }
    function addProject($title, $collab, $obj, $image, $team, $excel, $content, $link, $mous, $type){
        $sql = "INSERT INTO `{$this->prefix}projects`(`title`, `collab`, `objectives`, `image`, `team`, `excel`, `overview`, `link`, `mous`, `type`) VALUES (?,?,?,?,?,?,?,?,?,?)";
		try {
			$this->db->query($sql, array($title, $collab, $obj, $image, $team, $excel, $content, $link, (int) $mous, $type));
			return $this->db->insert_id();
		} catch (Exception $e) {
			echo "Error Occured While inserting";
		}
    }
    function addProjectDetails($pid, $data, $partis, $pics){
        $sql = "INSERT INTO `{$this->prefix}pro_details`(`id`, `pid`, `name`, `role`, `description`, `branch`, `pic`) VALUES (?,?,?,?,?,?,?)";
        $sqlarr = array($pid, 1, $data['p-1'], $data['select_role_1'], $data['select_desc_1'], $data['select_br_1'], $pics[1]);
        for($i=2;$i<=count($partis);$i++){
            if(isset($partis[$i])){
                $sql .= ", (?,?,?,?,?,?,?)";
                array_push($sqlarr, $pid, $i, $data['p-'.$partis[$i]], $data['select_role_'.$partis[$i]], $data['select_desc_'.$partis[$i]], $data['select_br_'.$partis[$i]], $pics[$i]);
            }
        }
		try {
			$this->db->query($sql, $sqlarr);
			return true;
		} catch (Exception $e) {
			echo "Error Occured While inserting";
		}
    }
    function addEvent($name, $date, $link, $image, $collage, $content, $type, $excel = ""){
        $sql = "INSERT INTO `{$this->prefix}events`(`name`, `date`, `details`, `image`, `collage`, `link`, `type`, `excel`) VALUES (?,?,?,?,?,?,?,?)";
		try {
			$this->db->query($sql, array($name, $date, $content, $image, $collage, $link, $type, $excel));
			return true;
		} catch (Exception $e) {
			echo "Error Occured While inserting";
		}
    }
    function addMous($name, $date, $span, $type, $spoc, $scope, $end, $logo, $image){
        $sql = "INSERT INTO `{$this->prefix}mous`(`name`, `date`, `span`, `type`, `spoc`, `scope`, `end`, `logo`, `image`) VALUES (?,?,?,?,?,?,?,?,?)";
		try {
			$this->db->query($sql, array($name, $date, $span, $type, $spoc, $scope, $end, $logo, $image));
			return true;
		} catch (Exception $e) {
			echo "Error Occured While inserting";
		}
    }
    function deleteEvent($id){
        $sql = "DELETE FROM `{$this->prefix}ongoing_events` WHERE id=?;";
        $query = $this->db->query($sql, array((int) $id));
        return true;
    }
    function deleteProject($id){
        $file = $this->getDataById($id, 'details', 'ongoing');
        if($file != "")    unlink('illustrations/projects/details/' . $file);
        $sql = "DELETE FROM `{$this->prefix}ongoing_details` WHERE id=?;";
        $query = $this->db->query($sql, array((int) $id));
        $sql = "DELETE FROM `{$this->prefix}ongoing` WHERE id=?;";
        $query = $this->db->query($sql, array((int) $id));
        return true;
    }
    function delProject($id){
        $img = $this->getDataById($id, 'image', 'projects');
        if($img != "")    unlink('illustrations/projects/' . $img);
        $tm = $this->getDataById($id, 'team', 'projects');
        if($tm != "")    unlink('illustrations/projects/team/' . $tm);
        $ex = $this->getDataById($id, 'excel', 'projects');
        if($ex != "")    unlink('illustrations/projects/excel/' . $ex);
        $pics = $this->getDataById($id, '*', 'pro_details');
        foreach($pics as $data){
            if($data->pic != "")    unlink('illustrations/projects/pics/' . $data->pic);
        }
        $sql = "DELETE FROM `{$this->prefix}pro_details` WHERE id=?;";
        $query = $this->db->query($sql, array((int) $id));
        $sql = "DELETE FROM `{$this->prefix}projects` WHERE id=?;";
        $query = $this->db->query($sql, array((int) $id));
        return true;
    }
    function delEvent($id){
        $img = $this->getDataById($id, 'image', 'events');
        unlink('illustrations/events/' . $img);
        $col = $this->getDataById($id, 'collage', 'events');
        if($col != "")    unlink('illustrations/events/collage/' . $col);
        $ex = $this->getDataById($id, 'excel', 'events');
        if($ex != "")    unlink('illustrations/events/excel/' . $ex);
        $sql = "DELETE FROM `{$this->prefix}events` WHERE id=?;";
        $query = $this->db->query($sql, array((int) $id));
        return true;
    }
    function delTform($id){
        $sql = "DELETE FROM `{$this->prefix}faculty` WHERE id=?;";
        $query = $this->db->query($sql, array((int) $id));
        return true;
    }
    function delFaculty($email){
        $sql = "DELETE FROM `{$this->prefix}faculty` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        return true;
    }
    function delPublications($email){
        $sql = "DELETE FROM `{$this->prefix}fpaper` WHERE email=?;";
        $query = $this->db->query($sql, array($email));
        return true;
    }
    function delSform($id){
        $sql = "DELETE FROM `{$this->prefix}sform` WHERE id=?;";
        $query = $this->db->query($sql, array((int) $id));
        return true;
    }
    function delMous($id){
        $img = $this->getDataById($id, 'image', 'mous');
        unlink('illustrations/mous/' . $img);
        $logo = $this->getDataById($id, 'logo', 'mous');
        unlink('illustrations/mous/logos/' . $logo);
        $sql = "DELETE FROM `{$this->prefix}mous` WHERE id=?;";
        $query = $this->db->query($sql, array((int) $id));
        return true;
    }
    function editProject($id, $title, $collab, $obj, $image, $team, $excel, $content, $link, $mous, $type){
        if($excel != ""){
            $sql = "UPDATE `{$this->prefix}projects` SET excel=? WHERE id=?";
            $tm = $this->getDataById($id, 'excel', 'projects');
            unlink('illustrations/projects/excel/' . $tm);
            try {
                $this->db->query($sql, array($excel, (int) $id));
                return true;
            } catch (Exception $e) {
                echo "Error Occured While inserting";
            }
        }
        if($team == "" and $image == "") $sql = "UPDATE `{$this->prefix}projects` SET title=?, collab=?, objectives=?, overview=?, link=?, mous=?, type=? WHERE id=?";
        if($team == "" and $image != ""){
            $img = $this->getDataById($id, 'image', 'projects');
            unlink('illustrations/projects/' . $img);
            $sql = "UPDATE `{$this->prefix}projects` SET title=?, collab=?, objectives=?, overview=?, link=?, image=?, mous=?, type=? WHERE id=?";
        }
        if($team != "" and $image == ""){
            $tm = $this->getDataById($id, 'team', 'projects');
            unlink('illustrations/projects/team/' . $tm);
            $sql = "UPDATE `{$this->prefix}projects` SET title=?, collab=?, objectives=?, team=?, overview=?, link=?, mous=?, type=? WHERE id=?";
        }
        if($team != "" and $image != ""){
            $img = $this->getDataById($id, 'image', 'projects');
            unlink('illustrations/projects/' . $img);
            $tm = $this->getDataById($id, 'team', 'projects');
            unlink('illustrations/projects/team/' . $tm);
            $sql = "UPDATE `{$this->prefix}projects` SET title=?, collab=?, objectives=?, team=?, image=?, overview=?, link=?, mous=?, type=? WHERE id=?";
        }
		try {
			if($team == "" and $image == "")    $this->db->query($sql, array($title, $collab, $obj, $content, $link, (int) $mous, $type, (int) $id));
			if($team == "" and $image != "")    $this->db->query($sql, array($title, $collab, $obj, $content, $link, $image, (int) $mous, $type, (int) $id));
			if($team != "" and $image == "")    $this->db->query($sql, array($title, $collab, $obj, $team, $content, $link, (int) $mous, $type, (int) $id));
			if($team != "" and $image != "")    $this->db->query($sql, array($title, $collab, $obj, $team, $image, $content, $link, (int) $mous, $type, (int) $id));
			return true;
		} catch (Exception $e) {
			echo "Error Occured While inserting";
		}
    }
    function editProjectDetails($pid, $data, $partis, $pics){
        $sql = "INSERT INTO `{$this->prefix}pro_details`(`id`, `pid`, `name`, `role`, `description`, `branch`, `pic`) VALUES";
        $sql2 = "INSERT INTO `{$this->prefix}pro_details`(`id`, `pid`, `name`, `role`, `description`, `branch`) VALUES";
        $partinos = $this->getPartiNumbers($pid);
        $sqlarr = array();
        $sqlarr2 = array();
        $flag = 0;
        $flag2 = 0;
        if($pics[1] != ""){
            unlink('illustrations/projects/pics/' . $this->getPartiDataById($pid, 1));
            $flag++;
            $sql .= " (?,?,?,?,?,?,?), ";
            array_push($sqlarr, (int) $pid, 1, $data['p-1'], $data['select_role_1'], $data['select_desc_1'], $data['select_br_1'], $pics[1]);
        }else{
            $flag2++;
            $sql2 .= " (?,?,?,?,?,?), ";
            array_push($sqlarr2, (int) $pid, 1, $data['p-1'], $data['select_role_1'], $data['select_desc_1'], $data['select_br_1']);   
        }
        for($i=2;$i<=count($partis);$i++){
            if(isset($partis[$i])){
                if($pics[$partis[$i]] != ""){
                    unlink('illustrations/projects/pics/' . $this->getPartiDataById($pid, $i));
                    $flag++;
                    $sql .= "(?,?,?,?,?,?,?), ";
                    array_push($sqlarr, (int) $pid, $i, $data['p-'.$partis[$i]], $data['select_role_'.$partis[$i]], $data['select_desc_'.$partis[$i]], $data['select_br_'.$partis[$i]], $pics[$partis[$i]]);
                }else{
                    $flag2++;
                    $sql2 .= "(?,?,?,?,?,?), ";
                    array_push($sqlarr2, (int) $pid, $i, $data['p-'.$partis[$i]], $data['select_role_'.$partis[$i]], $data['select_desc_'.$partis[$i]], $data['select_br_'.$partis[$i]]);
                }   
            }
        }
        $sql = substr($sql, 0, -2);
        $sql2 = substr($sql2, 0, -2);
        $sql .= " ON DUPLICATE KEY UPDATE `name`=VALUES(`name`), `role`=VALUES(`role`), `description`=VALUES(`description`), `branch`=VALUES(`branch`), `pic`=VALUES(`pic`);";
        $sql2 .= " ON DUPLICATE KEY UPDATE `name`=VALUES(`name`), `role`=VALUES(`role`), `description`=VALUES(`description`), `branch`=VALUES(`branch`);";
        foreach($partinos as $b => $c){
            if(!array_search($c->pid, $partis)){
                unlink('illustrations/projects/pics/' . $this->getPartiDataById($pid, $c->pid));
                $sql3 = "DELETE FROM `{$this->prefix}pro_details` WHERE id=? AND pid=?;";
                $query = $this->db->query($sql3, array((int) $pid, $c->pid));
            }
        }
        try {
			if($flag > 0)    $this->db->query($sql, $sqlarr);
			if($flag2 > 0)    $this->db->query($sql2, $sqlarr2);
			return true;
		} catch (Exception $e) {
			echo "Error Occured While inserting";
		}
    }
    function editEvent($id, $name, $date, $link, $image, $collage, $content, $type, $excel){
        if($excel != ""){
            $sql = "UPDATE `{$this->prefix}events` SET excel=? WHERE id=?";
            $tm = $this->getDataById($id, 'excel', 'events');
            unlink('illustrations/events/excel/' . $tm);
            try {
                $this->db->query($sql, array($excel, (int) $id));
                return true;
            } catch (Exception $e) {
                echo "Error Occured While inserting";
            }
        }
        if($collage == "" and $image == "") $sql = "UPDATE `{$this->prefix}events` SET name=?, date=?, details=?, link=?, type=? WHERE id=?";
        if($collage == "" and $image != ""){
            $img = $this->getDataById($id, 'image', 'events');
            unlink('illustrations/events/' . $img);
            $sql = "UPDATE `{$this->prefix}events` SET name=?, date=?, details=?, link=?, image=?, type=? WHERE id=?";
        }
        if($collage != "" and $image == ""){
            $col = $this->getDataById($id, 'collage', 'events');
            unlink('illustrations/events/collage/' . $col);
            $sql = "UPDATE `{$this->prefix}events` SET name=?, date=?, details=?, link=?, collage=?, type=? WHERE id=?";
        }
        if($collage != "" and $image != ""){
            $img = $this->getDataById($id, 'image', 'events');
            unlink('illustrations/events/' . $img);
            $col = $this->getDataById($id, 'collage', 'events');
            unlink('illustrations/events/collage/' . $col);
            $sql = "UPDATE `{$this->prefix}events` SET name=?, date=?, details=?, link=?, image=?, collage=?, type=? WHERE id=?";
        }
		try {
			if($collage == "" and $image == "")    $this->db->query($sql, array($name, $date, $content, $link, $type, (int) $id));
			if($collage == "" and $image != "")    $this->db->query($sql, array($name, $date, $content, $link, $image, $type, (int) $id));
			if($collage != "" and $image == "")    $this->db->query($sql, array($name, $date, $content, $link, $collage, $type, (int) $id));
			if($collage != "" and $image != "")    $this->db->query($sql, array($name, $date, $content, $link, $image, $collage, $type, (int) $id));
			return true;
		} catch (Exception $e) {
			echo "Error Occured While inserting";
		}
    }
   
    function editMous($id, $name, $date, $span, $type, $spoc, $scope, $end, $logo, $image){
        if($image != "" && $logo != ""){
            $img = $this->getDataById($id, 'image', 'mous');
            unlink('illustrations/mous/' . $img);
            $logo1 = $this->getDataById($id, 'logo', 'mous');
            unlink('illustrations/mous/logos/' . $logo1);
            $sql = "UPDATE `{$this->prefix}mous` SET name=?, date=?, span=?, type=?, spoc=?, scope=?, end=?, image=?, logo=? WHERE id=?";
        } 
        if($image == "" && $logo != ""){
            $logo1 = $this->getDataById($id, 'logo', 'mous');
            unlink('illustrations/mous/logos/' . $logo1);
            $sql = "UPDATE `{$this->prefix}mous` SET name=?, date=?, span=?, type=?, spoc=?, scope=?, end=?, logo=? WHERE id=?";
        }
        if($image != "" && $logo == ""){
            $img = $this->getDataById($id, 'image', 'mous');
            unlink('illustrations/mous/' . $img);
            $sql = "UPDATE `{$this->prefix}mous` SET name=?, date=?, span=?, type=?, spoc=?, scope=?, end=?, image=? WHERE id=?";
        } 
        if($image == "" && $logo == ""){
            $sql = "UPDATE `{$this->prefix}mous` SET name=?, date=?, span=?, type=?, spoc=?, scope=?, end=? WHERE id=?";
        }
		try {
			if($image != "" && $logo != "")   $this->db->query($sql, array($name, $date, $span, $type, $spoc, $scope, $end, $image, $logo, (int) $id));
			if($image == "" && $logo != "")   $this->db->query($sql, array($name, $date, $span, $type, $spoc, $scope, $end, $logo, (int) $id));
			if($image != "" && $logo == "")   $this->db->query($sql, array($name, $date, $span, $type, $spoc, $scope, $end, $image, (int) $id));
            if($image == "" && $logo == "")   $this->db->query($sql, array($name, $date, $span, $type, $spoc, $scope, $end, (int) $id));
			return true;
		} catch (Exception $e) {
			echo "Error Occured While inserting";
		}
    }
}
?>
