<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Ctrl_twork extends Core_Controller {

	public function index()
	{
		$data['latevents'] = $this->Process->getLatestByType('events');
		$data['paper_count'] = $this->Process->getRowCount('fpaper');
		$bookc = $this->Process->getRowCount('fbook');
		$chapc = $this->Process->getRowCount('fchapter');
		$data['book_chap_count'] = $bookc + $chapc;
		$data['copyright_count'] = $this->Process->getRowCount('fcopyright');
		$data['patent_count'] = $this->Process->getRowCount('fpatent');
		$data['tech_count'] = $this->Process->getRowCount('ftech');
		$data['certi_count'] = $this->Process->getRowCount('fcerti');
		$this->load->view('twork', $data);
	}

	public function error($reason){
		$_SESSION['error'] = $reason;
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view('error', $data);
	}

	public function get_client_ip() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	public function getExcelSheet(){
		if(!isset($_SESSION['email'])){
			$this->error("You dont have access to download this resource!");
			return;
		}
		if(!$this->Process->facultyExists($_SESSION['email'])){
			unset($_SESSION['access_token']);
			session_start();
			$this->error("You dont have access to download this resource!");
			return;
		}
		if(!isset($_SESSION['access_token']))  $this->download();
		else{
			unset($_SESSION['access_token']);
			session_destroy();
		}
		if($_SESSION['dtype'] == 'events'){
			echo "<script>window.location.href='".base_url()."illustrations/events/excel/home.xlsx'</script>";
			exit();
		}elseif($_SESSION['dtype'] == 'mous'){
			$data = $this->Process->getEverything('mous');
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
			$drawing->setName('Logo');
			$drawing->setDescription('Logo');
			$drawing->setPath(FCPATH . 'dist/images/header.jpg');
			$drawing->setWorksheet($sheet);
			$drawing->setCoordinates('B1');
			$this->Process->setDownload($_SESSION['email'], $_SESSION['dtype'], $this->get_client_ip(), date('Y-m-d H:i:s'));
			$sheet->setCellValue($cell = 'A11', 'Sr. No.');
			$sheet->getStyle($cell)->getFont()->setBold(true);
			$sheet->setCellValue($cell = 'B11', 'Logo');
			$sheet->getStyle($cell)->getFont()->setBold(true);
			$sheet->setCellValue($cell = 'C11', 'Name');
			$sheet->getStyle($cell)->getFont()->setBold(true);
			$sheet->setCellValue($cell = 'D11', 'Date of Signing');
			$sheet->getStyle($cell)->getFont()->setBold(true);
			$sheet->setCellValue($cell = 'E11', 'Duration');
			$sheet->getStyle($cell)->getFont()->setBold(true);
			$sheet->setCellValue($cell = 'F11', 'Type');
			$sheet->getStyle($cell)->getFont()->setBold(true);
			$sheet->setCellValue($cell = 'G11', 'Scope');
			$sheet->getStyle($cell)->getFont()->setBold(true);
			$sheet->setCellValue($cell = 'H11', 'No. of Projects');
			$sheet->getStyle($cell)->getFont()->setBold(true);
			$sheet->setCellValue($cell = 'I11', 'Students Enrolled');
			$sheet->getStyle($cell)->getFont()->setBold(true);
			$sheet->setCellValue($cell = 'J11', 'Faculties Enrolled');
			$sheet->getStyle($cell)->getFont()->setBold(true);
			$start = 'A';
			$startno = '12';
			$width = 25;
			$height = 25;
			foreach ($data as $key => $value) {
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $key+1);
				$cell = $start++.$startno;
				$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
				$drawing->setName($value->logo);
				$drawing->setDescription($value->logo);
				$drawing->setPath(FCPATH . "illustrations/mous/logos/". $value->logo);
				$drawing->setWorksheet($sheet);
				$drawing->setCoordinates($cell);
				$drawing->setHeight($height);
				$drawing->setWidth($width);
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $value->name);
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $value->date);
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $value->span . " Years");
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $value->type);
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $value->scope);
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $this->Process->getMousProjectCount($value->id));
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $this->Process->getStudentsEntrolledMous($value->id));
				$cell = $start++.$startno;
				$sheet->setCellValue($cell, $this->Process->getFacultiesEntrolledMous($value->id));
				$sheet->getRowDimension($startno++)->setRowHeight($height);
				$start = 'A';
			}
			$sheet->getDefaultColumnDimension()->setWidth($width);
			$writer = new Xlsx($spreadsheet);
			$name = "Research_MoUs.xlsx";
		}else{
			$data = $this->Process->getPublicationDataByFilter('f'.$_SESSION['dtype'], $_SESSION['dyear'], $_SESSION['ddept']);
			if(empty($data)){
				unset($_SESSION['access_token']);
				session_start();
				$this->error("Empty data!");
				return;
			}
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
			$drawing->setName('Logo');
			$drawing->setDescription('Logo');
			$drawing->setPath(FCPATH . 'dist/images/header.jpg');
			$drawing->setWorksheet($sheet);
			$drawing->setCoordinates('B1');
			$this->Process->setDownload($_SESSION['email'], $_SESSION['dtype'], date('Y-m-d H:i:s'), $_SESSION['dyear'], $_SESSION['ddept']);
			$start = 'A';
			$all_keys = array_keys($data);
			$first = array_shift($all_keys);
			$all_keys = array_keys($data[$first]);
			foreach($all_keys as $key){
				$cell = $start++.'10';
				$sheet->setCellValue($cell, ucfirst($key));
				$sheet->getStyle($cell)->getFont()->setBold(true);
			}
			$startno = '11';
			$sheet->getDefaultColumnDimension()->setWidth(25);
			foreach ($data as $key => $value) {
				$start = 'A';
				foreach ($all_keys as $key2) {
					$cell = $start++.$startno;
					$sheet->setCellValue($cell, $value[$key2]);
					$sheet->getStyle($cell)->getAlignment()->setWrapText(true);
				}
				++$startno;
			}
			/* auto width try
			$maxWidth = 20;
			$sheet->calculateColumnWidths();
			foreach ($sheet->getColumnDimensions() as $colDim) {
				$colWidth = $colDim->getWidth();
				if ($colWidth > $maxWidth) {
					$colDim->setAutoSize(false);
					$colDim->setWidth($maxWidth);
				}
			}
			*/
			$writer = new Xlsx($spreadsheet);
			$name = "Research_Work.xlsx";
		}
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$name);
		$writer->save("php://output");
		exit();
	}

	public function downloadMous(){
		$_SESSION['dtype'] = "mous";
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view('tdownload', $data);
	}

	public function downloadEvents(){
		$_SESSION['dtype'] = "events";
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view('tdownload', $data);
	}

	public function download($type, $year, $dept){
		$_SESSION['dtype'] = urldecode($type);
		$_SESSION['dyear'] = urldecode($year);
		$_SESSION['ddept'] = urldecode($dept);
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view('tdownload', $data);
	}

	public function downloadPage(){
		$this->load->view('download', []);
	}

	public function page($page){
		$data['page'] = $page;
		if(!isset($_GET['offset']))	$data['offset'] = true;
		else $data['offset'] = $_GET['offset'];
		$data['totcount'] = $this->Process->getRowCount('tform');
		$data['publications'] = $this->Process->getPageData('tform', $data['page']);
		$data['latevents'] = $this->Process->getLatestByType('events');
		$this->load->view('twork', $data);
	}

	public function faculty($tid){
		if($this->Process->columnExists($tid, 'tform')){
			$data['fid'] = $tid;
			$data['details'] = $this->Process->getSingleData('tform', $tid);
			$data['latevents'] = $this->Process->getLatestByType('events');
			$link = 'https://scholar.google.co.in/citations?user='.$data['details']->scholarid.'&hl=en';
			$crawl = \Sunra\PhpSimple\HtmlDomParser::file_get_html($link, false, null, 0);
			$data['designation'] = $crawl->find(".gsc_prf_il", 0)->innertext;
			$data['domains'] = $this->scrapeDomain($crawl);
			$data['cited'] = $crawl->find('.gsc_rsb_std', 0);
			$data['publications'] = $this->scrapePublications($crawl);
			$this->load->view('faculty', $data);
		}else{
			$_SESSION['error'] = 'That publication doesnt exist!';
			redirect('Ctrl_error');
		}
	}

	public function scrapeDomain($html){
		$domains = [];
		foreach($html->find('.gsc_prf_inta') as $domain){
			$domains[] = $domain->innertext;
		}
		return $domains;
	}

}