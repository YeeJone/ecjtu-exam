<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Techclass extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('teacher/class_info');
	}

	public function showClass()
	{
		$this->load->view('teacher/classList');
	}

	public function addClass($teachername)
	{
		$college = $this->class_info->getCollege();
		$realname = $this->class_info->getTechName($teachername);
		$data = array(
			'id' => $teachername,
			'teachername' => $realname,
			'college' => $college
		);

		$this->load->view('teacher/addclass', $data);
	}

	public function insertClass()
	{
		$data = array(
			'teacher_id' => $this->input->post('class_teachername'),
			'classnumber' => $this->input->post('class_classnum'),
			'classname' => $this->input->post('class_classname'),
			'createtime' => date("Y-m-d h:i:s"),
			'description' => $this->input->post('class_classinfo'),
			'isapply' => 1,
			'college_id' => $this->input->post('class_school')
			);
		$insert = $this->class_info->insertClass($data);
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

	public function getClass()
	{
		$result = $this->class_info->getClass();
		$info = array(
			'data' => $result
			);

		echo json_encode($info);
	}

	public function updateApply()
	{
		$id = $this->input->post('id');
		$isapply = $this->input->post('data_is');

		if ($isapply) {
			$result = $this->class_info->openApply($id);
		}
		else
		{
			$result = $this->class_info->closeApply($id);
		}
	}
}