<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends CI_Controller{

	public $total;
	public $unique;
  
	public function __construct(){
		parent::__construct();
		$data = $this->Counter->getData();
		$this->total = $data->total;
		$this->unique = $data->uniq;
	}
	
 }