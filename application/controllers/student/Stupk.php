<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stupk extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function test()
	{
		$this->load->view('student/pk');
	}

}