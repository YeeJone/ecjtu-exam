<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stuself extends CI_Controller
{	
	function __construct()
	{
		parent::__construct();
		$this->load->model('student/stu_self');
	}

	public function assemblyQues($studentname)
	{
		$check = $this->stu_self->checkExist($studentname);
		if ($check) {
			$this->assemblyList($studentname);
		}else{
			$type = $this->stu_self->getType();
			$data = array(
				'studentname' => $studentname,
				'type' => $type
				);

			$this->load->view('student/assemblyQues', $data);
		}
	}

	public function assemblyList($studentname)
	{
		$data = array('studentname' => $studentname);
		$this->load->view('student/assemblyList', $data);
	}

	public function searchAssemby()
	{
		$id = $this->input->post('id');
		$query = $this->stu_self->searchAssemby($id);
		$data = array('data' => $query);

		echo json_encode($data);
	}

	public function assemblykMade()
	{
		$queslist = $this->input->post('val');
		$data = array(
			'assemblyname' => $this->input->post('name'), 
			'queslist' => serialize($queslist), 
			'assemblystatus' => 2, 
			'stunum' => $this->input->post('studentname')
			);

		$result = $this->stu_self->insertAssembly($data);

		if ($result) {
			echo 1;
		}else{
			echo 0;
		}
	}

	public function getList($studentname)
	{
		$query = $this->stu_self->getList($studentname);

		$data = array('data' => $query);

		echo json_encode($data);
	}

	public function goAssembly($studentname,$id)
	{
		$studentname = urldecode($studentname);
		$this->stu_self->chengeStatus($id);

		$flashlist = $this->getStatus($id);

		$name = $this->stu_self->getName($id);

		$data = array(
			'id' => $id, 
			'name' => $name,
			'stuid' => $studentname, 
			'flashlist' => $flashlist
			);

		$this->load->view('student/goAssembly', $data);
	}

	public function getStatus($id)
	{
		$data = $this->stu_self->getStatus($id);

		return json_encode($data);
	}

	public function updateStatus($stuid, $id, $name)
	{
		$type = $this->input->post('type');

		if ($type != 1) {
			$data = array(
			'assemblyid' => $id,
			'assemblyname' => $name,
			'quesname' => $this->input->post('file'),
			'score' => $this->input->post('score'),
			'stuid' => $stuid
			);

			if ($type == 2) {
				$n = rand(1,10);
				if ($n <= 6) {
					$data['score'] = rand(50,79);
				}else if($n >= 7 && $n <=9){
					$data['score'] = rand(80,89);
				}else{
					$data['score'] = rand(90,95);
				}
			}

			$this->stu_self->updateStatus($data);
		}
	}

	public function uploadText($stuid,$id,$name,$flashid)
	{
		$text = $this->input->post('text');

		$data = array(
			'assemblyid' => $id,
			'assemblyname' => $name,
			'quesname' => $flashid,
			'score' => 0,
			'stuid' => $stuid
			);

		if ($text == '') {
			$data['score'] = 0;
		}else{
			$n = rand(1,10);
			if ($n <= 6) {
				$data['score'] = rand(50,79);
			}else if($n >= 7 && $n <=9){
				$data['score'] = rand(80,89);
			}else{
				$data['score'] = rand(90,95);
			}
		}

		$query = $this->stu_self->uploadText($data);
		if ($query) {
			echo 1;
		}else{
			echo 0;
		}
	}

	public function deleteAssemblyStatus($id)
	{


		$query = $this->stu_self->deleteAssemblyStatus($id);
		
		if ($query) {
			echo 1;
		}
	}
}
