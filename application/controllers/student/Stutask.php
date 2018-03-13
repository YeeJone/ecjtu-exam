<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stutask extends CI_Controller
{	
	function __construct()
	{
		parent::__construct();
		$this->load->model('student/stu_task');
	}

	public function taskList($stuname)
	{
		$data = array('studentname' => $stuname );
		$this->load->view('student/taskList',$data);
	}

	public function getTask($studentname)
	{
		$list = $this->stu_task->getList($studentname);

		$data = array('data' => $list);

		echo json_encode($data);
	}

	public function goTask($taskid ,$studentname)
	{
		$studentname = urldecode($studentname);
		$list = $this->stu_task->getQues($studentname,$taskid);
		$flashlist = $this->getStatus($studentname,$taskid,$list['num']);
		$data = array(
			'taskid' => $taskid,
			'list' => $list['num'],
			'time' => $list['time'],
			'stuid' => $studentname,
			'flashlist' => $flashlist
			);

		$this->load->view('student/gotask',$data);
	}

	public function getStatus($stuid,$taskid,$testlist)
	{
		$data = $this->stu_task->getStatus($stuid,$taskid,$testlist);

		return json_encode($data);
	}

	public function updateStatus($stuid,$taskid)
	{
		$type = $this->input->post('type');

		$file =explode('/', $this->input->post('file'));
		$data = array(
			'filename' => end($file), 
			'score' => $this->input->post('score'), 
			'time' => gmdate("i:s",$this->input->post('remainingTime')), 
			'stuid' => $stuid, 
			'taskid' => $taskid
			);

		$this->stu_task->updateStatus($data);

		if ($type == 0) {
			$this->stu_task->insertScore($data);
		}
	}

	public function uploadRecord($stuid,$taskid,$testid,$fileid)
	{
		$radiofile = $GLOBALS['HTTP_RAW_POST_DATA'];
		
		$data = array(
			'stuid' => $stuid,
			'taskid' => $taskid,
			'testid' => $testid,
			'flashid' => $fileid,
			'radiofile' => $radiofile,
			'type' => 0
			);

		$this->stu_task->uploadRecord($data);
	}

	public function uploadText($stuid,$taskid,$testid,$fileid,$filetype)
	{
		$data = array(
			'text' =>$this->input->post('text'),
			'stuid' => $stuid, 
			'taskid' => $taskid, 
			'testid' => $testid, 
			'flashid' => $fileid, 
			'questype' => $filetype,
			'type' => 0 
			);

		$query = $this->stu_task->uploadText($data);
		if ($query) {
			echo 1;
		}else{
			echo 0;
		}
	}

	public function changeTaskStatus($stuid, $taskid)
	{
		$stuid = urldecode($stuid);
		$result = $this->stu_task->changeTaskStatus($stuid, $taskid);

		if ($result) {
			echo 1;													
		}
	}
}
