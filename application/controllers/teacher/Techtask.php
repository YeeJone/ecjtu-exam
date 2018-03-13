<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Techtask extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('teacher/task_manage');
	}

	public function taskMadeView()
	{
		$type = $this->task_manage->getType();
		$data = array(
			'type' => $type
			);

		$this->load->view('teacher/generateTaskTest', $data);
	}

	public function taskPubView($teachername)
	{
		$data = array('teachername' => $teachername );
		$this->load->view('teacher/pubTask',$data);
	}

	public function taskManageView()
	{
		$this->load->view('teacher/taskManage');
	}

	public function searchTask()
	{
		$id = $this->input->post('id');
		$query = $this->task_manage->searchTask($id);
		$data = array('data' => $query);

		echo json_encode($data);
	}

	public function taskMade()
	{
		$list = $this->input->post('val');
		$queslist = serialize($list);
		$testname = $this->input->post('name');
		$testtime = $this->input->post('time');
		
		$data = array(
			'testname' => $testname,
			'queslist' => $queslist,
			'time' => date("Y-m-d"),
			'answertime' => $testtime,
			'testtype' => 0
			);

		$result = $this->task_manage->insertTest($data);

		if ($result) { echo 1; }
		else{ echo 0; }
	}

	public function taskList()
	{
		$result = $this->task_manage->searchList();
		$data = array('data' => $result);
		echo json_encode($data);
	}

	public function taskPub()
	{
		$list = $this->input->post('val');
		$info = $this->input->post('info');
		$testlist = serialize($list);
		$taskname = $this->input->post('name');
		$teachername = $this->input->post('teachername');
		
		$data = array(
			'taskname' => $taskname,
			'testlist' => $testlist,
			'starttime' => date("Y-m-d"),
			'finishtime' => date("Y-m-d",strtotime("+30 day")),
			'taskinfo' => $info,
			'teachername' =>$teachername,
			'state' => 0
			);

		$result = $this->task_manage->insertTask($data);

		if ($result) { echo 1; }
		else{ echo 0; }
	}

	public function taskManage()
	{
		$query = $this->task_manage->getTask();
		$data = array('data' => $query);

		echo json_encode($data);
	}

	public function updateStatus()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('data_is');

		$result = $this->task_manage->updateStatus($id,$status);

		if ($result) { echo 1; }
		else{ echo 0; }
	}

	public function deleteExam()
	{
		$id = $this->input->post('id');

		$result = $this->task_manage->deleteExam($id);
		if ($result) { echo 1; }
	}
}
