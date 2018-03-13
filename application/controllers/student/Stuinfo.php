<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stuinfo extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('student/stu_info');
	}

	public function index($user)
	{
		$result = $this->stu_info->getInfo($user);
		$data = $result[0];
		$this->load->view('student/s_information',$data);
	}

	public function updateInfo($user)
	{
		$data['user'] = $user;
		$this->load->view('student/sp_information',$data);
	}

	public function updateInfo2()
	{
		$data = array(
			'realname' => $this->input->post('user_name'),
			'idcard' => $this->input->post('user_id_number'),
			'sex' => $this->input->post('user_sex'),
			'email' => $this->input->post('user_email'),
			'qq' => $this->input->post('user_qq_numnber'),
			'address' => $this->input->post('user_address'),
			'telephone' => $this->input->post('user_phone'),
			'photo' => $this->input->post('user_picture')
			);
		$userid = $this->input->post('user_id');
		$result = $this->stu_info->updateInfo($userid,$data);
		
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
}
