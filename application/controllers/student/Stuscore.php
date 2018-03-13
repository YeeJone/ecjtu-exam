<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stuscore extends CI_Controller
{	
	function __construct()
	{
		parent::__construct();
		$this->load->model('student/stu_score');
	}

	public function examScore($stuid)
	{
		$data = array('studentname' => $stuid);
		$this->load->view('student/examScore', $data);
	}

	public function taskScore($stuid)
	{
		$data = array('studentname' => $stuid);
		$this->load->view('student/taskScore', $data);
	}

	public function selfScore($stuid)
	{
		$data = array('studentname' => $stuid);
		$this->load->view('student/selfScore', $data);
	}

	public function getTaskScore($stuid)
	{
		$query = $this->stu_score->getTaskScore($stuid);

		$data = array('data' => $query);

		echo json_encode($data);
	}

	public function getExamScore($stuid)
	{
		$query = $this->stu_score->getExamScore($stuid);

		$data = array('data' => $query);

		echo json_encode($data);
	}

	public function getSelfScore($stuid)
	{
		$query = $this->stu_score->getSelfScore($stuid);

		$data = array('data' => $query);

		echo json_encode($data);
	}

	public function examDetail($stuid, $id)
	{
		$query = $this->stu_score->examDetail($stuid, $id);
		$data = array(
			'detail' => $query,
			'stuid' => $stuid,
			'type' => 1
			);

		$this->load->view('student/scoreDetail', $data);
	}

	public function taskDetail($stuid, $id)
	{
		$query = $this->stu_score->taskDetail($stuid, $id);
		$data = array(
			'detail' => $query,
			'stuid' => $stuid,
			'type' => 0
			);

		$this->load->view('student/scoreDetail', $data);
	}

	public function selfDetail($stuid, $id)
	{
		$query = $this->stu_score->selfDetail($stuid, $id);
		$data = array(
			'detail' => $query,
			'stuid' => $stuid,
			'type' => 2
			);

		$this->load->view('student/scoreDetail', $data);
	}
}
