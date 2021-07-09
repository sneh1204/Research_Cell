<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Ctrl_projects extends Core_Controller {

	public function index()
	{
		$data['page'] = 1;
		$data['offset'] = 1;
		$data['totcount'] = $this->Process->getRowCount('projects');
		if(isset($_GET['mous']) && $_GET['mous'] != ""){
			$data['projects'] = $this->Process->getPageDataByMous('projects', $data['page'], $_GET['mous']);
		}else{
			$data['projects'] = $this->Process->getPageData('projects', $data['page']);
		}
		$data['tabledata'] = $this->Process->getEverythingBySort('ongoing', 'idate', 'desc');
		$data['tabledatadetails'] = $this->Process->getEverything('ongoing_details');
		$data['mous'] = $this->Process->getEverything('mous');
		$data['mous_count'] = $this->Process->getRowCount('mous');
		$data['int_mous_count'] = $this->Process->getInternationalMousCount();
		if(isset($_GET['projects'])){
			$next = $_GET['projects'] + 1;
			$year = "20" . $_GET['projects'] . "-" . $next;
			$data['intern_count'] = $this->Process->getInternCount($year);
			$data['projects_count'] = $this->Process->getAllProjectsCount($year);
		}else{
			$data['intern_count'] = $this->Process->getAllInternCount();
			$data['projects_count'] = $this->Process->getRowCount('ongoing');
		}
		
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view('projects', $data);
	}

	public function page($page){
		$data['page'] = $page;
		if(!isset($_GET['offset']))	$data['offset'] = true;
		else $data['offset'] = $_GET['offset'];
		$data['totcount'] = $this->Process->getRowCount('projects');
		if(isset($_GET['mous'])){
			$data['projects'] = $this->Process->getPageDataByMous('projects', $data['page'], $_GET['mous']);
		}else{
			$data['projects'] = $this->Process->getPageData('projects', $data['page']);
		}
		$data['mous_count'] = $this->Process->getRowCount('mous');
		$data['int_mous_count'] = $this->Process->getInternationalMousCount();
		$data['projects_count'] = $this->Process->getRowCount('projects');
		$data['intern_count'] = $this->Process->getAllInternCount();
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view('projects', $data);
	}

	public function downloadExcel($year){
		$data['tabledata'] = $this->Process->getEverythingBySort('ongoing', 'idate', 'desc');
		$data['tabledatadetails'] = $this->Process->getEverything('ongoing_details');
		$data['mous'] = $this->Process->getEverything('mous');
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
		$drawing->setName('Logo');
		$drawing->setDescription('Logo');
		$drawing->setPath(FCPATH . 'dist/images/header.jpg');
		$drawing->setWorksheet($sheet);
		$drawing->setCoordinates('B1');
		$sheet->setCellValue($cell = 'A11', 'Sr No.');
		$sheet->getStyle($cell)->getFont()->setBold(true);
		$sheet->setCellValue($cell = 'B11', 'Title');
		$sheet->getStyle($cell)->getFont()->setBold(true);
		$sheet->setCellValue($cell = 'C11', 'In Collaboration With');
		$sheet->getStyle($cell)->getFont()->setBold(true);
		$sheet->mergeCells('D11:G11');
		$sheet->setCellValue($cell = 'D11', 'Participants');
		$sheet->getStyle($cell)->getFont()->setBold(true);
		$sheet->setCellValue($cell = 'H11', 'Status');
		$sheet->getStyle($cell)->getFont()->setBold(true);
		$sheet->setCellValue($cell = 'I11', 'Start Date');
		$sheet->getStyle($cell)->getFont()->setBold(true);
		$sheet->setCellValue($cell = 'J11', 'Achievements/Remarks');
		$sheet->getStyle($cell)->getFont()->setBold(true);
		$sheet->setCellValue($cell = 'K11', 'End Date');
		$sheet->getStyle($cell)->getFont()->setBold(true);
		$sheet->setCellValue($cell = 'L11', 'Year');
		$sheet->getStyle($cell)->getFont()->setBold(true);
		$start = 'A';
		$startno = '12';
		$offset = '12';
		$width = 25;
		$height = 25;
		foreach ($data['tabledata'] as $key => $value) {
			if($value->year == $year){
				$pcount = $this->getPartiCount($value->id, $data['tabledatadetails']);
				$newno = $startno + $pcount - 1;
				$test = 'A';
				$sheet->mergeCells($test.$startno . ':' . $test++.$newno);
				$sheet->mergeCells($test.$startno . ':' . $test++.$newno);
				$sheet->mergeCells($test.$startno . ':' . $test++.$newno);
				$test = 'H';
				$sheet->mergeCells($test.$startno . ':' . $test++.$newno);
				$sheet->mergeCells($test.$startno . ':' . $test++.$newno);
				$sheet->mergeCells($test.$startno . ':' . $test++.$newno);
				$sheet->mergeCells($test.$startno . ':' . $test++.$newno);
				$sheet->mergeCells($test.$startno . ':' . $test++.$newno);
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $key+1);
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $value->title);
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $this->getMousName($value->mous, $data['mous']));
				for($i = 1; $i <= $pcount; $i++){
					$cell = $start++.$startno;
					$sheet->setCellValue($cell, $this->getPartiData($value->id, $data['tabledatadetails'], 'name', $i));
					$cell = $start++.$startno;
					$sheet->setCellValue($cell, $this->getPartiData($value->id, $data['tabledatadetails'], 'role', $i));
					$cell = $start++.$startno;
					$sheet->setCellValue($cell, $this->getPartiData($value->id, $data['tabledatadetails'], 'description', $i));
					$cell = $start++.$startno;
					$sheet->setCellValue($cell, $this->getPartiData($value->id, $data['tabledatadetails'], 'branch', $i));
					$start = 'D';
					$startno++;
				}
				$start = 'H';
				$startno = $offset;
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $value->status);
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $value->idate);
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $value->achievements);
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, ($value->edate == '0000-00-00') ? "-" : $value->edate);
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $value->year);
				$start = 'A';
				$offset = $startno + $pcount;
				$startno = $startno + $pcount;
			}
		}
		$sheet->getDefaultColumnDimension()->setWidth($width);

		$writer = new Xlsx($spreadsheet);
		$name = "Research_Projects.xlsx";
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$name);
		$writer->save("php://output");
		exit();
	}

	public function getPartiCount($id, $data){
		$count = 0;
		foreach($data as $value){
			if($value->id == $id){
				$count++;
			}
		}
		return $count;
	}

	public function getPartiData($id, $data, $type, $pid){
		foreach($data as $value){
			if($value->id == $id && $value->pid == $pid){
				return $value->$type;
			}
		}
		return '';
	}

	public function getMousName($id, $mous){
		if(!is_numeric($id))  return $id;
		$id = (int) $id;
		foreach($mous as $value){
		  if($value->id == $id){
			return $value->name;
		  }
		}
		return "";
	}

	public function callback(){
		$this->load->view('callback3');
	}

	public function logout(){
        $this->load->view('logout3');
    }

	public function loginCheck(){
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view("projectlogin", $data);
	}

	public function addProject(){
		if(!isset($_SESSION['access_token'])) redirect("Ctrl_projects/loginCheck");
        $data['latevents'] = $this->Process->getLatestByType('events');
        $access = ["research@sakec.ac.in", "sneh.jain@sakec.ac.in"]; // make a list in backend later
		if(!in_array($_SESSION['email'], $access)){
			$_SESSION['error'] = "No access";
			unset($_SESSION['access_token']);
			$this->load->view('error', $data);
			return;
		}
		$data['mous'] = $this->Process->getEverythingAsArray('mous');
		$data['projects'] = $this->Process->getEverything('ongoing');
		$data['pro_details'] = $this->Process->getEverything('ongoing_details');
		$this->load->view('addProject', $data);
	}

	public function project($project){
		if($this->Process->columnExists($project, 'projects')){
			$data['pno'] = $project;
			$data['project'] = $this->Process->getSingleData('projects', $data['pno']);
			$data['pro_details'] = $this->Process->getSingleData('pro_details', $data['pno'], 'all');
			$data['latevents'] = $this->Process->getLatestByType('events');
			$this->load->view('project', $data);
		}else{
			$_SESSION['error'] = 'That project doesnt exist!';
			redirect('Ctrl_error');
		}
	}

}