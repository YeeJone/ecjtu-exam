<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stu_score extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function _getName($name)
	{
		$this->db->select('quesname,queslocate');
		$this->db->from('flashques');
		$this->db->where('id', $name);
		$query = $this->db->get()->result_array();

		return $query[0];
	}

	public function getTaskScore($stuid)
	{
		$data = null;
		$this->db->select('taskid,taskname,sum(score) as score');
		$this->db->from('taskscore');
		$this->db->where('stuid', $stuid);
		$this->db->group_by('taskid,taskname');
		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$data = array(
				'T_Name' => $value['taskname'],
				'T_Score' => $value['score'],
				'edit' => $value['taskid']
				);

			$info[] = $data;
		}

		if ($data == null) {
			return 0;
		}else{
			return $info;
		}
	}

	public function getExamScore($stuid)
	{
		$data = null;
		$this->db->select('examid,examname,sum(score) as score');
		$this->db->from('examscore');
		$this->db->where('stuid', $stuid);
		$this->db->group_by('examid,examname');
		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$data = array(
				'E_Name' => $value['examname'],
				'E_Score' => $value['score'],
				'edit' => $value['examid']
				);

			$info[] = $data;
		}

		if ($data == null) {
			return 0;
		}else{
			return $info;
		}
	}

	public function getSelfScore($stuid)
	{
		$data = null;
		$this->db->select('assemblyid,assemblyname,sum(score) as score');
		$this->db->from('assemblyscore');
		$this->db->where('stuid', $stuid);
		$this->db->group_by('assemblyid,assemblyname');
		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$data = array(
				'A_Name' => $value['assemblyname'],
				'A_Score' => $value['score'],
				'edit' => $value['assemblyid']
				);

			$info[] = $data;
		}

		if ($data == null) {
			return 0;
		}else{
			return $info;
		}
	}

	public function examDetail($stuid, $id)
	{
		$data = array(
			'stuid' => $stuid, 
			'examid' => $id, 
			);
		$this->db->select('quesname,score');
		$this->db->from('examscore');
		$this->db->where($data);

		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$value['quesname'] = $this->_getName($value['quesname']);

			$info[] = $value;
		}

		return $info;
	}

	public function taskDetail($stuid, $id)
	{
		$data = array(
			'stuid' => $stuid, 
			'taskid' => $id, 
			);
		$this->db->select('quesname,score');
		$this->db->from('taskscore');
		$this->db->where($data);

		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$value['quesname'] = $this->_getName($value['quesname']);

			$info[] = $value;
		}

		return $info;
	}

	public function selfDetail($stuid, $id)
	{
		$data = array(
			'stuid' => $stuid, 
			'assemblyid' => $id, 
			);
		$this->db->select('quesname,score');
		$this->db->from('assemblyscore');
		$this->db->where($data);

		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$value['quesname'] = $this->_getName($value['quesname']);

			$info[] = $value;
		}

		return $info;
	}
}
