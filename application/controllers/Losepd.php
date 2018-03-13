<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Losepd extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('find_pass');
	}

	public function index()
	{
		$this->load->view('lose_pd');
	}

	public function checkInfo()
	{
		$role = $this->input->post('user_role');

		if($role == '学生')
		{
			$data = array(
				'studentname' => $this->input->post('user_name'),
				'realname' => $this->input->post('user_truename'),
				'telephone' => $this->input->post('user_phone')
				);

		}elseif($role = '教师')
		{
			$data = array(
				'teachername' => $this->input->post('user_name'),
				'realname' => $this->input->post('user_truename'),
				'telephone' => $this->input->post('user_phone')
				);

		}elseif($role = '管理员') {
			$data = array(
				'adminname' => $this->input->post('user_name'),
				'realname' => $this->input->post('user_truename'),
				'telephone' => $this->input->post('user_phone')
				);

		}

		$pass = $this->find_pass->findPass($role,$data);

		if ($pass) {
			$success = array(
				'status' => '1',
				'pass' => $pass
				);
			echo json_encode($success);
		}
		else
		{
			$failed = array(
				'status' => '0',
				'msg' => '信息输入有问题'
				);
			echo json_encode($failed);
		}
	}
}
