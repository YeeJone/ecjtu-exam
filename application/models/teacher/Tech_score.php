<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tech_score extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function text()
	{
		$query = $this->db->select('radiofile')->from('radiolist')->get()->result_array();
		return bin2hex($query[0]['radiofile']);
	}

	public function getOric($type)
	{
		$data = null;
		$this->db->select('*')->from('radiolist')->where(array('type' => $type));
		$query = $this->db->get()->result_array();
		foreach ($query as $key => $value) {
			$data = array(
				'taskid' => $value['taskid'],
				'testname' => $this->_getTestName($value['testid']),
				'studentname' => $this->_getStuName($value['stuid']),
				'flashfile' => $this->_getFlashFile($value['flashid']),
				'radiofile' => bin2hex($value['radiofile']),
				'score' => $this->_getRadioStatus($value['taskid'],$value['id'])
				);

			$info[] = $data;
		}

		if ($data == null) {
			return 0;
		}else{
			return $info;
		}
	}

	public function getText($type)
	{
		$data = null;
		$this->db->select('*')->from('textlist')->where(array('type' => $type));
		$query = $this->db->get()->result_array();
		foreach ($query as $key => $value) {
			$data = array(
				'taskid' => $value['taskid'],
				'testname' => $this->_getTestName($value['testid']),
				'studentname' => $this->_getStuName($value['stuid']),
				'flashfile' => $this->_getFlashFile($value['flashid']),
				'text' => $value['id'], 
				'score' => $this->_getTextStatus($value['taskid'],$value['id']),
				'edit' => $value['id']
				);

			$info[] = $data;
		}

		if ($data == null) {
			return 0;
		}else{
			return $info;
		}
	}

	public function getTaskName($taskid)
	{
		$this->db->select('taskname')->from('tasklist')->where('id',$taskid);
		$query = $this->db->get()->result_array();
		return $query[0]['taskname'];
	}

	public function getExamName($taskid)
	{
		$this->db->select('examname')->from('examlist')->where('id',$taskid);
		$query = $this->db->get()->result_array();
		return $query[0]['examname'];
	}

	public function getFileId($filename)
	{
		$this->db->select('id')->from('flashques')->where('queslocate',$filename);
		$query = $this->db->get()->result_array();
		return $query[0]['id'];
	}

	public function updateTextTaskScore($id,$data)
	{
		$query = $this->db->insert('taskscore',$data);
		if ($query) {
			$this->db->where('id',$id);
			$result = $this->db->update('textlist',array('scorestatus' => 1));
			if ($result) { return true; }
			else{ return false; }
		}else{
			return false;
		}
	}

	public function updateTextExamScore($id,$data)
	{
		$query = $this->db->insert('examscore',$data);
		if ($query) {
			$this->db->where('id',$id);
			$result = $this->db->update('textlist',array('scorestatus' => 1));
			if ($result) { return true; }
			else{ return false; }
		}else{
			return false;
		}
	}

	public function searchText($textid)
	{
		$query = $this->db->select('text')->from('textlist')->where(array('id' => $textid))->get()->result_array();

		return $query[0]['text'];
	}

	public function deleteText($id)
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('textlist');
		if ($query) {
			return true;
		}
	}

	public function _getRadioStatus($taskid,$id)
	{
		$query = $this->db->select('scorestatus')->from('radiolist')->where('id',$id)->get()->result_array();
		$data = array(
			'id' => $id,
			'taskid' => $taskid,
			'scorestatus' => $query[0]['scorestatus']
			);

		return $data;
	}

	public function _getTextStatus($taskid,$id)
	{
		$query = $this->db->select('scorestatus')->from('textlist')->where('id',$id)->get()->result_array();
		$data = array(
			'id' => $id,
			'taskid' => $taskid,
			'scorestatus' => $query[0]['scorestatus']
			);

		return $data;
	}

	public function _getTestName($testid)
	{
		$query = $this->db->select('testname')->from('testlist')->where(array('id' => $testid))->get()->result_array();

		return $query[0]['testname'];
	}

	public function _getStuName($stuid)
	{
		$query = $this->db->select('realname')->from('student')->where(array('studentname' => $stuid))->get()->result_array();

		$data = array(
			'realname' => $query[0]['realname'], 
			'stuid' => $stuid
			);

		return $data;
	}

	public function _getFlashFile($flashid)
	{
		$query = $this->db->select('queslocate')->from('flashques')->where(array('id' => $flashid))->get()->result_array();

		return $query[0]['queslocate'];
	}
}
