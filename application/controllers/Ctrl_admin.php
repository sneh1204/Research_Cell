<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_admin extends Admin_Controller {

	public function index(){
		if(!isset($_SESSION['loggedin'])){
			$this->load->view('admin/login');
		}else{
			redirect('Ctrl_dashboard');
		}
	}

	public function notLoggedIn(){
		$data['notloggedin'] = true;
		$this->load->view('admin/login', $data);
	}

	public function downloadBackup(){
		$db = $this->Process->getDb();
		$file = "illustrations/" . $db->database . '_'.date("Y-m-d-H-i-s").'.sql';
		$this->backupDatabase($db, $file);
		$zipfile = "backup.zip";
		$this->makeZIP('illustrations', $zipfile);
		unlink($file);
		$this->sendDownloadHeader($zipfile);
	}

	public function sendDownloadHeader($path){
		header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length: ".filesize($path));
        header("Content-Disposition: attachment; filename=\"".basename($path)."\"");
		readfile($path);
		unlink($path);
        exit();
	}

	public function backupDatabase($db, $file){
		$username = $db->username; 
		$password = $db->password; 
		$dbname   = $db->database;
		$command = "mysqldump -u $username -p$password $dbname > $file";
		exec($command);
	}

	public function makeZIP($path, $name){
		// Get real path for our folder
		$rootPath = realpath(FCPATH . $path);

		// Initialize archive object
		$zip = new ZipArchive();
		$zip->open($name, ZipArchive::CREATE | ZipArchive::OVERWRITE);

		// Create recursive directory iterator
		/** @var SplFileInfo[] $files */
		$files = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator($rootPath),
			RecursiveIteratorIterator::LEAVES_ONLY
		);

		foreach ($files as $name => $file)
		{
			// Skip directories (they would be added automatically)
			if (!$file->isDir())
			{
				// Get real and relative path for current file
				$filePath = $file->getRealPath();
				$relativePath = substr($filePath, strlen($rootPath) + 1);

				// Add current file to archive
				$zip->addFile($filePath, $relativePath);
			}
		}

		// Zip archive will be created only after closing object
		$zip->close();
	}

}