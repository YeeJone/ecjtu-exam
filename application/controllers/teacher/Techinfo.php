<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Techinfo extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('teacher/tech_info');
		$this->load->model('teacher/stu_list');
	}

	public function index($user)
	{
		$result = $this->tech_info->getInfo($user);
		$data = $result[0];
		$this->load->view('teacher/t_information',$data);
	}

	public function updateInfo($user)
	{
		$result = $this->tech_info->getInfo($user);
		$data = $result[0];
		$this->load->view('teacher/tp_information', $data);
	}

	public function updateInfo2()
	{
		$data = array(
			'realname' => $this->input->post('user_name'),
			'password' => $this->input->post('user_password'),
			'sex' => $this->input->post('user_sex'),
			'email' => $this->input->post('user_email'),
			'qq' => $this->input->post('user_qq_numnber'),
			'telephone' => $this->input->post('user_phone')
			);

		$userid = $this->input->post('user_id');

		$result = $this->tech_info->updateInfo($userid,$data);

		if ($result) {
			$success = array(
				'status' => '1',
				'msg' => '修改成功' 
				);
			echo json_encode($success);
		}
		else
		{
			$failed = array(
				'status' => '0',
				'msg' => '修改失败'
				);
			echo json_encode($failed);
		}
	}

	public function stuList()
	{
		$this->load->view('teacher/studentList');
	}

	public function showStulist()
	{
		$result = $this->stu_list->getList();
		$info = array(
			'data' => $result
			);
		
		echo json_encode($info);
	}

	public function isActive()
	{
		$id = $this->input->post('id');
		$isActive =  $this->input->post('data_is');
		
		if ($isActive) {
				$result = $this->stu_list->openActive($id);
			}else
			{
				$result = $this->stu_list->closeActive($id);
			}
	}

	public function kickLogin()
	{
		$id = $this->input->post('logoutNumber');
		$result = $this->stu_list->kickLogin($id);
		if ($result) { 
			echo 1;
		}
	}

	public function deleteStu()
	{
		$id = $this->input->post('id');
		$result = $this->stu_list->deleteStu($id);
		if ($result) {
			echo 1;
		}
	}
}
