<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adinfo extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/ad_info');
	}

	public function changePass()
	{
		$this->load->view('admin/changePass');
	}

	public function passConfirm()
	{
		$oldpass = $this->input->post('password1');
		$newpass = $this->input->post('password2');

		$query = $this->ad_info->passConfirm($oldpass,$newpass);
		if ($query) {
			echo 1;
		}else{
			echo 0;
		}
	}

	public function index($user)
	{
		$result = $this->ad_info->getInfo($user);
		$data = $result[0];
		$this->load->view('admin/a_information',$data);
	}

	public function updateInfo($user)
	{
		$result = $this->ad_info->getInfo($user);
		$data = $result[0];
		$this->load->view('admin/ad_information', $data);
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
		$result = $this->ad_info->updateInfo($userid,$data);

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
