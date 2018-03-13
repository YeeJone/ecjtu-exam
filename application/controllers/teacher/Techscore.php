<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Techscore extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('teacher/tech_score');
	}

	public function text()
	{
		$query = $this->tech_score->text();
		var_dump($query);
	}

	public function oricTaskScore()
	{
		$this->load->view('teacher/oricTaskScore');
	}

	public function textTaskScore()
	{
		$this->load->view('teacher/textTaskScore');
	}

	public function searchTaskScore()
	{
		echo 1;
	}

	public function oricExamScore()
	{
		echo 1;
	}

	public function textExamScore()
	{
		$this->load->view('teacher/textExamScore');
	}

	public function searchExamScore()
	{
		echo 1;
	}

	public function getOric($type)
	{
		$query = $this->tech_score->getOric($type);

		$data = array('data' => $query);

		echo json_encode($data);
	}

	public function getText($type)
	{
		$query = $this->tech_score->getText($type);

		$data = array('data' => $query);

		echo json_encode($data);
	}

	public function searchText($text)
	{
		$text = $this->tech_score->searchText($text);
		$data = array('text' => $text);
		$this->load->view('teacher/stuText',$data);
	}

	public function updateTextTaskScore($id)
	{
		$taskid = $this->input->post('taskid');
		$score = $this->input->post('score');
		$filename = $this->input->post('flashfile');
		$data = array(
			'taskid' => $taskid,
			'stuid' =>  $this->input->post('studentid'),
			'score' => $score,
			'quesname' => $this->tech_score->getFileId($filename),
			'taskname' => $this->tech_score->getTaskName($taskid)
			);

		$query = $this->tech_score->updateTextTaskScore($id,$data);

		if ($query) {
			echo 1;
		}
	}

	public function updateTextExamScore($id)
	{
		$examid = $this->input->post('taskid');
		$score = $this->input->post('score');
		$filename = $this->input->post('flashfile');
		$data = array(
			'examid' => $examid,
			'stuid' =>  $this->input->post('studentid'),
			'score' => $score,
			'quesname' => $this->tech_score->getFileId($filename),
			'examname' => $this->tech_score->getExamName($examid)
			);

		$query = $this->tech_score->updateTextExamScore($id,$data);
		if ($query) {
			echo 1;
		}
	}

	public function deleteText()
	{
		$id = $this->input->post('id');

		$query = $this->tech_score->deleteText($id);

		if ($query) {
			echo 1;
		}
	}
}
