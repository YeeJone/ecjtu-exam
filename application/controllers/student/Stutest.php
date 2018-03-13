<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stutest extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('student/stu_test');
	}

	public function examList($studentid)
	{
		$data = array('studentname' => $studentid );
		$this->load->view('student/testList',$data);
	}

	public function getExam($studentname)
	{
		$list = $this->stu_test->getList($studentname);

		$data = array('data' => $list);

		echo json_encode($data);
	}

	public function goExam($examid ,$studentname)
	{
		$studentname = urldecode($studentname);
		$list = $this->stu_test->getQues($studentname,$examid);
		$flashlist = $this->getStatus($studentname,$examid,$list['num']);
		$data = array(
			'examid' => $examid,
			'list' => $list['num'],
			'time' => $list['time'],
			'stuid' => $studentname,
			'flashlist' => $flashlist,
			);
		//var_dump($data);

		$this->load->view('student/goexam',$data);
	}

	public function getStatus($stuid,$examid,$testlist)
	{
		$data = $this->stu_test->getStatus($stuid,$examid,$testlist);

		return json_encode($data);
	}

	public function updateStatus($stuid,$examid)
	{
		$type = $this->input->post('type');

		$file =explode('/', $this->input->post('file'));
		$data = array(
			'filename' => end($file), 
			'score' => $this->input->post('score'), 
			'time' => gmdate("i:s",$this->input->post('remainingTime')), 
			'stuid' => $stuid, 
			'taskid' => $examid
			);

		$this->stu_test->updateStatus($data);

		if ($type == 0) {
			$this->stu_test->insertScore($data);
		}
	}

	public function uploadRecord($stuid,$examid,$testid,$fileid)
	{
		$radiofile = $GLOBALS['HTTP_RAW_POST_DATA'];
		
		$data = array(
			'stuid' => $stuid,
			'taskid' => $examid,
			'testid' => $testid,
			'flashid' => $fileid,
			'radiofile' => $radiofile,
			'type' => 1
			);

		$this->stu_test->uploadRecord($data);
	}

	public function uploadText($stuid,$examid,$examid,$fileid,$filetype)
	{
		$data = array(
			'text' =>$this->input->post('text'),
			'stuid' => $stuid, 
			'taskid' => $examid, 
			'testid' => $examid, 
			'flashid' => $fileid, 
			'questype' => $filetype,
			'type' => 1
			);

		$query = $this->stu_task->uploadText($data);
		if ($query) {
			echo 1;
		}else{
			echo 0;
		}
	}

	public function changeExamStatus($stuid, $examid)
	{
		$stuid = urldecode($stuid);
		$result = $this->stu_test->changeExamStatus($stuid, $examid);

		if ($result) {
			echo 1;													
		}
	}
}
