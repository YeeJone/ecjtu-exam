<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stuupmp3 extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index($user)
	{
		$data['user'] = $user;
		$this->load->view('student/uploadMp3',$data);
	}
}