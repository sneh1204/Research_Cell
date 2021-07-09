<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_pfunctions extends Admin_Controller {

    public function getAllFacultyPapers(){
        $result = $this->Process->getAllFacultyPapers();
        echo json_encode($result);
    }

    public function getPublicationDataByFilter(){
        if($this->input->post()){
            $type = $this->input->post("type");
            $year = $this->input->post("year");
            $dept = $this->input->post("dept");
            $result = $this->Process->getPublicationDataByFilter("f".$type,$year,$dept); // table name ex: fpaper
            echo json_encode($result);
        }
    }

}
