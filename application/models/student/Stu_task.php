<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stu_task extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getList($studentname)
	{
		$data = null;
		$this->db->select('id,taskname,starttime,taskinfo,finishtime,teachername');
		$this->db->from('tasklist');
		$this->db->where('state',1);
		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$data = array(
				'T_Name' => $value['taskname'], 
				'T_Info' => $value['taskinfo'],
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

	public function _checkTaskStatus($id,$studentname)
	{
		$data = array(
			'taskid' => $id, 
			'studentid' => $studentname
			);
		$this->db->select('taskstatus')->from('taskstatus')->where($data);

		$query = $this->db->get()->result_array();
		if ($query) {
			if ($query[0]['taskstatus'] == 0) {
				$info = array(
					'taskid' => $id,
					'status' => 0,
					'studentname' => $studentname
					);
				return $info;
			}elseif ($query[0]['taskstatus'] == 1) {
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

	public function getTechName($teachername)
	{
		$this->db->select('realname');
		$this->db->from('teacher');
		$this->db->where('teachername',$teachername);
		$result = $this->db->get()->result_array();
		return $result[0]['realname'];
	}

	public function _getQues($id)
	{
		$this->db->select('testlist');
		$this->db->from('tasklist');
		$this->db->where('id', $id);
		$query = $this->db->get()->result_array();
		$query = unserialize($query[0]['testlist']);

		return $query;
	}

	public function getQues($stuid,$taskid)
	{
		if (!$this->_checkExist($stuid,$taskid)) {
			$query = $this->_getQues($taskid);
			$num = $query[array_rand($query)];
			$time = $this->_getTime($num);
			$init = $this->initTask($stuid,$taskid,$num);
			if ($init) { 
				$data = $this->_checkStatus($stuid,$taskid);
				$num = $data['testid'];
				$time = $this->_getTime($num);
			}
		}else{
			$data = $this->_checkStatus($stuid,$taskid);
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

	public function _getTime($num)
	{
		$this->db->select('answertime');
		$this->db->from('testlist');
		$this->db->where('id', $num);
		$query = $this->db->get()->result_array();
		return $query[0]['answertime'];
	}

	public function initTask($stuid,$taskid,$testid)
	{
		$data = array(
			'taskid' => $taskid,
			'testid' => $testid,
			'score' => 0,
			'time' => 0,
			'taskstatus' => 0,
			'studentid' => $stuid
			);

		$query = $this->db->insert('taskstatus',$data);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function _checkExist($stuid,$taskid)
	{
		$data = array(
			'taskid' => $taskid,
			'studentid' => $stuid 
			);
		$this->db->select('*');
		$this->db->from('taskstatus');
		$this->db->where($data);
		$query = $this->db->get()->num_rows();
		if ($query) { return true; }
		else{ return false; }
	}

	public function _checkStatus($stuid,$taskid)
	{
		$data = array(
			'taskid'=>$taskid,
			'studentid'=>$stuid
			);
		$status = $this->db->select('*')->from('taskstatus')->where($data)->get()->result_array();
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

	public function _getFileName($flashid)
	{
		$this->db->select('queslocate,questype,quesstyle');
		$this->db->from('flashques');
		$this->db->where('id', $flashid);
		$query = $this->db->get()->result_array();
		return $query;
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

	public function getStatus($stuid,$taskid,$testlist)
	{
		$queslist = $this->_getFlashId($testlist);

		$quesflash = $this->_getFlashFile($queslist);
		
		$query = $this->_checkStatus($stuid,$taskid);

		if ($query['status'] == null) {
			return $quesflash;
		}else{
			$k = 0;
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
			'taskid' => $data['taskid'],
			'studentid' => $data['stuid'] 
			);

		$update = array(
			'status' => $data['filename'],
			'time' => $data['time'] 
			);

		$score = $data['score'];

		$this->db->where($info);
		$this->db->set('score',"score+$score",FALSE);
		$this->db->update('taskstatus',$update);
	}

	public function uploadRecord($data)
	{
		$filename = $this->_getFileName($data['flashid']);
		$update = array(
			'studentid' => $data['stuid'],
			'taskid' => $data['taskid']
			);
		
		$this->db->insert('radiolist',$data);

		$this->db->where($update);
		$this->db->update('taskstatus',array('status' => $filename[0]['queslocate']));
	}

	public function uploadText($data)
	{
		$filename = $this->_getFileName($data['flashid']);
		$update = array(
			'studentid' => $data['stuid'],
			'taskid' => $data['taskid']
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
			$this->db->update('taskstatus',array('status' => $filename[0]['queslocate']));
			return false;
		}
	}

	public function changeTaskStatus($stuid,$taskid)
	{
		$data = array(
			'studentid' => $stuid,
			'taskid' => $taskid 
			);

		$this->db->where($data);
		$query = $this->db->update('taskstatus',array('taskstatus' => 1));
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function _getTaskName($taskid)
	{
		$this->db->select('taskname')->from('tasklist')->where('id',$taskid);
		$query = $this->db->get()->result_array();
		return $query[0]['taskname'];
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
			'taskid' => $data['taskid'],
			'stuid' => $data['stuid'],
			'score' => $data['score'],
			'taskname' => $this->_getTaskName($data['taskid']),
			'quesname' => $this->_getFileId($data['filename'])
			);

		$this->db->insert('taskscore', $info);
	}
}
