<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adteach extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/ad_tech');
		// $this->load->model('teacher/stu_list');
	}

	public function addTech()
	{
		$this->load->view('admin/addteacher');
	}

 	public function techList()
	{
		$this->load->view('admin/teacherList');
	}

	public function addTechInfo()
	{
		$data = array(
			'adminname' => $this->input->post('user_id'),
			'password' => $this->input->post('user_password'),
			'realname' => $this->input->post('user_name'),
			'sex' => $this->input->post('user_sex'),
			'createtime' => date("Y-m-d h:i:s"),
			'email' => $this->input->post('user_email'),
			'qq' => $this->input->post('user_qq_numnber'),
			'telephone' => $this->input->post('user_phone'),
			'isactive' => 1,
			'role_id' => 2,
			'college_id' => $this->input->post('user_school')
		);

		$insert = $this->ad_tech->insertInfo($data);

		if ($insert) {
			$info = array(
				'status' => 1, 
				'msg' => '插入成功'
				);
			echo json_encode($info);
		}else{
			$info = array(
				'status' => 0, 
				'msg' => '插入失败'
				);
			echo json_encode($info);
		}
	}

	public function techShowList()
	{
		$result = $this->ad_tech->getList();
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
			$result = $this->ad_tech->openActive($id);
		}else
		{
			$result = $this->ad_tech->closeActive($id);
		}
	}

	public function searchClass($techid)
	{
		$result = $this->ad_tech->searchClass($techid);
		var_dump($result);
	}
}
