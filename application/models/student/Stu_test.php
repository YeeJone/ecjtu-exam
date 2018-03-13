<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stu_test extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getList($studentname)
	{
		$data = null;
		$this->db->select('id,examname,starttime,examinfo,finishtime,teachername');
		$this->db->from('examlist');
		$this->db->where('state',1);
		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$data = array(
				'T_Name' => $value['examname'], 
				'T_Info' => $value['examinfo'],
				'T_Start' => $value['starttime'],
				'T_Finish' => $value['finishtime'],
				'T_Author' => $this->getTechName($value['teachername']),
				'edit' => $this->_checkTaskStatus($value['id'], $studentname)
				);

			$info[] = $data;
		}
		if ($data == null) {
			return 0;
		}else{
			return $info;
		}
	}

	public function getTechName($teachername)
	{
		$this->db->select('realname');
		$this->db->from('teacher');
		$this->db->where('teachername',$teachername);
		$result = $this->db->get()->result_array();
		return $result[0]['realname'];
	}

	public function _checkTaskStatus($id,$studentname)
	{
		$data = array(
			'examid' => $id, 
			'studentid' => $studentname
			);
		$this->db->select('examstatus')->from('examstatus')->where($data);

		$query = $this->db->get()->result_array();
		if ($query) {
			if ($query[0]['examstatus'] == 0) {
				$info = array(
					'taskid' => $id,
					'status' => 0,
					'studentname' => $studentname
					);
				return $info;
			}elseif ($query[0]['examstatus'] == 1) {
			 	$info = array(
			 		'taskid' => $id,
			 		'status' => 1,
			 		'studentname' => $studentname
			 		);
			 	return $info;
			}
		}else{
			$info = array(
				'taskid' => $id,
				'status' => 2,
				'studentname' => $studentname
				);
			return $info;
		}
	}

	public function _getQues($id)
	{
		$this->db->select('examlist');
		$this->db->from('examlist');
		$this->db->where('id', $id);
		$query = $this->db->get()->result_array();
		$query = unserialize($query[0]['examlist']);

		return $query;
	}

	public function _getTime($num)
	{
		$this->db->select('answertime');
		$this->db->from('testlist');
		$this->db->where('id', $num);
		$query = $this->db->get()->result_array();
		return $query[0]['answertime'];
	}

	public function getQues($stuid,$examid)
	{
		if (!$this->_checkExist($stuid,$examid)) {
			$query = $this->_getQues($examid);
			$num = $query[array_rand($query)];
			$time = $this->_getTime($num);
			$init = $this->initExam($stuid,$examid,$num);
			if ($init) { 
				$data = $this->_checkStatus($stuid,$examid);
				$num = $data['testid'];
				$time = $this->_getTime($num);
			}
		}else{
			$data = $this->_checkStatus($stuid,$examid);
			if ($data['status'] == null) {
				$num = $data['testid'];
				$time = $this->_getTime($num);
			}else{
				$num = $data['testid'];
				$time = $data['time'];
			}
		}
		
		$data = array(
			'num' => $num,
			'time' => $time
		 );
		return $data;
	}

	public function initExam($stuid,$examid,$testid)
	{
		$data = array(
			'examid' => $examid,
			'testid' => $testid,
			'score' => 0,
			'time' => 0,
			'examstatus' => 0,
			'studentid' => $stuid
			);

		$query = $this->db->insert('examstatus',$data);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function _checkExist($stuid,$examid)
	{
		$data = array(
			'examid' => $examid,
			'studentid' => $stuid 
			);
		$this->db->select('*');
		$this->db->from('examstatus');
		$this->db->where($data);
		$query = $this->db->get()->num_rows();
		if ($query) { return true; }
		else{ return false; }
	}

	public function _checkStatus($stuid,$examid)
	{
		$data = array(
			'examid'=>$examid,
			'studentid'=>$stuid
			);
		$status = $this->db->select('*')->from('examstatus')->where($data)->get()->result_array();
		$data = array(
			'status' => $status[0]['status'],
			'testid' => $status[0]['testid'],
			'time' => $status[0]['time'] 
			);
		return $data;
	}

	public function _getFlashId($testid)
	{
		$this->db->select('queslist');
		$this->db->from('testlist');
		$this->db->where('id',$testid);
		$query = $this->db->get()->result_array();
		return unserialize($query[0]['queslist']);
	}

	public function _getFlashFile($queslist)
	{
		foreach ($queslist as $key => $value) {
			$data = $this->getFileName($value);

			$info[] = $data;
		}

		return $info;
	}

	public function getFileName($value)
	{
		$query = $this->_getFileName($value);

		$data = array(
			'fileid' => $value,
			'filename' => base_url('queslist/'.$query[0]['queslocate']), 
			'type' => $query[0]['quesstyle']
			);
		return $data;
	}

	public function _getFileName($flashid)
	{
		$this->db->select('queslocate,questype,quesstyle');
		$this->db->from('flashques');
		$this->db->where('id', $flashid);
		$query = $this->db->get()->result_array();
		return $query;
	}

	public function getStatus($stuid,$examid,$testlist)
	{
		$info = null;
		
		$queslist = $this->_getFlashId($testlist);

		$quesflash = $this->_getFlashFile($queslist);
		
		$query = $this->_checkStatus($stuid,$examid);

		if ($query['status'] == null) {
			return $quesflash;
		}else{
			foreach ($quesflash as $key => $value) {
				$filename = explode('/', $value['filename']);
				if(end($filename) == $query['status'])
				{
					$k = $key;
				}
			}
			foreach ($quesflash as $key => $value) {
				if ($key>$k) {
					$info[] = $value;
				}
			}

			if ($k == (count($quesflash)-1)) {
				$this->db->where(array('examid' => $examid, 'studentid' => $stuid));
				$this->db->update('examstatus',array('examstatus' => 1));
			}

			return $info;
		}
	}

	public function updateStatus($data)
	{
		$info = array(
			'examid' => $data['taskid'],
			'studentid' => $data['stuid'] 
			);

		$update = array(
			'status' => $data['filename'],
			'time' => $data['time'] 
			);

		$score = $data['score'];

		$this->db->where($info);
		$this->db->set('score',"score+$score",FALSE);
		$this->db->update('examstatus',$update);
	}

	public function uploadRecord($data)
	{
		$filename = $this->_getFileName($data['flashid']);
		$update = array(
			'studentid' => $data['stuid'],
			'examid' => $data['taskid']
			);
		
		$this->db->insert('radiolist',$data);

		$this->db->where($update);
		$this->db->update('examstatus',array('status' => $filename[0]['queslocate']));
	}

	public function uploadText($data)
	{
		$filename = $this->_getFileName($data['flashid']);
		$update = array(
			'studentid' => $data['stuid'],
			'examid' => $data['taskid']
			);

		$check = array(
			'stuid' => $data['stuid'], 
			'flashid' => $data['flashid'], 
			'taskid' => $data['taskid']
			);

		$query = $this->db->select('*')->from('textlist')->where($check)->get()->num_rows();
		if ($query) {
			return true;
		}else{
			$this->db->insert('textlist',$data);

			$this->db->where($update);
			$this->db->update('examstatus',array('status' => $filename[0]['queslocate']));
			return false;
		}
	}

	public function changeExamStatus($stuid,$examid)
	{
		$data = array(
			'studentid' => $stuid,
			'examid' => $examid 
			);

		$this->db->where($data);
		$query = $this->db->update('examstatus',array('examstatus' => 1));
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function _getTestName($taskid)
	{
		$this->db->select('examname')->from('examlist')->where('id',$taskid);
		$query = $this->db->get()->result_array();
		return $query[0]['examname'];
	}

	public function _getFileId($filename)
	{
		$this->db->select('id')->from('flashques')->where('queslocate',$filename);
		$query = $this->db->get()->result_array();
		return $query[0]['id'];
	}

	public function insertScore($data)
	{
		$info = array(
			'examid' => $data['taskid'],
			'stuid' => $data['stuid'],
			'score' => $data['score'],
			'examname' => $this->_getTestName($data['taskid']),
			'quesname' => $this->_getFileId($data['filename'])
			);

		$this->db->insert('examscore', $info);
	}
}
