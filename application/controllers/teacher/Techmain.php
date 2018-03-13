<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Techmain extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('teacher/teac_main');
	}

	public function teacherMenu($name)
	{
		$user = $this->teac_main->selectRealname(urldecode($name));
		$data = array(
			'role' => '教师',
			'username' => $name,
			'realname' => $user
			);
		$this->load->view('teacher/teacher_menu',$data);
	}
}
