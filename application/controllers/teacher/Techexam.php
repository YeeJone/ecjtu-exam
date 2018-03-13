<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Techexam extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('teacher/exam_manage');
	}

	public function examMadeView()
	{
		$type = $this->exam_manage->getType();
		$data = array(
			'type' => $type
			);
		$this->load->view('teacher/generateExamTest', $data);
	}

	public function examPubView($teachername)
	{
		$data = array('teachername' => $teachername );
		$this->load->view('teacher/pubExam',$data);
	}

	public function examManageView()
	{
		$this->load->view('teacher/examManage');
	}

	public function searchExam()
	{
		$id = $this->input->post('id');
		$query = $this->exam_manage->searchExam($id);
		$data = array('data' => $query);

		echo json_encode($data);
	}

	public function examMade()
	{
		$list = $this->input->post('val');
		$queslist = serialize($list);
		$examname = $this->input->post('name');
		$examtime = $this->input->post('time');
		
		$data = array(
			'testname' => $examname,
			'queslist' => $queslist,
			'time' => date("Y-m-d"),
			'answertime' => $examtime,
			'testtype' => 1
			);

		$result = $this->exam_manage->insertTest($data);

		if ($result) { echo 1; }
		else{ echo 0; }
	}

	public function examList()
	{
		$result = $this->exam_manage->searchList();
		$data = array('data' => $result);
		echo json_encode($data);
	}

	public function examPub()
	{
		$list = $this->input->post('val');
		$examlist = serialize($list);
		$examname = $this->input->post('examname');
		$examtime = $this->input->post('examtime');
		$examinfo = $this->input->post('examinfo');
		$teachername = $this->input->post('teachername');
		
		$data = array(
			'examname' => $examname,
			'examlist' => $examlist,
			'examstart' => date("Y-m-d"),
			'examfinish' => date("Y-m-d",strtotime("+30 day")),
			'examtime' => $examtime,
			'examinfo' => $examinfo,
			'examauthor' =>$teachername,
			'state' => 0
			);

		$result = $this->exam_manage->insertExam($data);

		if ($result) { echo 1; }
		else{ echo 0; }
	}

	public function examManage()
	{
		$query = $this->exam_manage->getExam();
		$data = array('data' => $query);

		echo json_encode($data);
	}

	public function updateStatus()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('data_is');

		$result = $this->exam_manage->updateStatus($id,$status);

		if ($result) { echo 1; }
	}

	public function deleteExam()
	{
		$id = $this->input->post('id');

		$result = $this->exam_manage->deleteExam($id);
		if ($result) { echo 1; }
	}
}
