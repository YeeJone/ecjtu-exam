<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stumain extends CI_Controller
{
	public $user;
	function __construct()
	{
		parent::__construct();
		$this->load->model('student/stu_main');
		//$this->load->view('welcome');
		//模型的文件名及类名都大写，这里小写，路径要写清楚,文件夹的名字小写
	}

	public function index($name)
	{
		$data = array(
			'status' => '1',
			'name' => $name
			);
		$this->load->view('center',$data);
		//$this->load->view('welcome');
	}

	public function studentMenu($name)
	{
		$user = $this->stu_main->selectRealname(urldecode($name));
		$data = array(
			'role' => '学生',
			'username' => $name,
			'realname' => $user
			);
		$this->load->view('student/student_menu',$data);
	}
}
