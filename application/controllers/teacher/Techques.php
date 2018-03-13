<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Techques extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('teacher/ques_info');
	}

	public function quesTypeList()
	{
		$this->load->view('teacher/questypelist');
	}

	public function quesList()
	{
		$this->load->view('teacher/questionlist');
	}

	public function listView()
	{
		$list = $this->ques_info->getList2();
		$data = array(
			'data' => $list 
			);

		echo json_encode($data);
	}

	public function inputQues($teachername)
	{
		$quesType = $this->ques_info->getType();
		$data = array(
			'teachername' => $teachername,
			'quesType' => $quesType['type'],
			'quesStyle' => $quesType['style']
			);
		$this->load->view('teacher/questionInput', $data);
	}

	public function showList()
	{
		$list = $this->ques_info->getList();
		$data = array(
			'data' => $list 
			);

		echo json_encode($data);
	}

	public function checkDeta()
	{
		$typeid = $this->input->post('id');
		
		$detail = $this->ques_info->checkDeta($typeid);

		echo json_encode($detail);
	}

	public function showDetail($id)
	{
		$data = $this->ques_info->showDetail($id);
		$this->load->view('teacher/quesdetails', $data);
	}

	public function questionSave()
	{
		//echo 1;
		$data = array(
			'quesname' => $this->input->post('questionname'), 
			'queslocate' => urldecode($this->input->post('t_flash')),
			'questype' => $this->input->post('questiontype'),
			'testtype' => $this->input->post('testtype'),
			'quesstyle' => $this->input->post('questionstyle'),
			'teachername' => $this->input->post('teachername'),
			'state' => 1
			); 
		$result = $this->ques_info->insertQues($data);

		if ($result) {
			$info = array(
				'status' => 1, 
				'msg' =>'上传成功'
				);
			echo json_encode($info);
		}else{
			$info = array(
				'status' => 0, 
				'msg' =>'上传失败'
				);
			echo json_encode($info);
		}
	}

	public function quesManage($typeid)
	{
		$typename = $this->ques_info->getQuesName($typeid);
		$data = array(
			'typeid' => $typeid,
			'typename' => $typename 
			);
		$this->load->view('teacher/qlManage' ,$data);
	}

	public function getQuesList($typeid)
	{
		$result = $this->ques_info->getQuesList($typeid);
		$data = array('data' => $result);

		echo json_encode($data);
	}

	public function quesPub()
	{
		$id = $this->input->post('id');
		$isActive = $this->input->post('data_is');
		
		$result = $this->ques_info->changeActive($id,$isActive);
		if ($result) {
			echo 1;
		}
	}

	public function deleteQues()
	{
		$id = $this->input->post('id');

		$result = $this->ques_info->deleteQues($id);
		if ($result) {
			echo 1;
		}
	}

	public function showQues($id)
	{
		$flashname = $this->ques_info->getFlashName($id);
		$data = array('flashname' => $flashname);
		$this->load->view('teacher/showFlash',$data);
	}

}
