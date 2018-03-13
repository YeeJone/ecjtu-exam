<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stu_self extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getType()
	{
		$query = $this->db->select('id,questiontypename')->from('questiontype')->get()->result_array();
		return $query;
	}

	public function searchAssemby($id)
	{
		$data = null;
		$limit = array(
			'questype' => $id,
			'testtype' => "2",
			'state' =>"1" 
			);
		$this->db->select('id,quesname');
		$this->db->from('flashques');
		$this->db->where($limit);
		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$data = array(
				'questionname' => $value['quesname'], 
				'edit' => $value['id']
				);

			$info[] = $data;
		}

		if ($data==null) {
		 	return 0;
	    }else{
			return $info;
		}
	}

	public function insertAssembly($data)
	{
		$query = $this->db->insert('assemblyques', $data);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function checkExist($studentname)
	{
		$this->db->select('*')->from('assemblyques')->where('stunum', $studentname);
		$query = $this->db->get()->num_rows();

		return $query;
	}

	public function getList($studentname)
	{
		$data = null;
		$this->db->select('id,assemblyname,assemblystatus')->from('assemblyques')->where('stunum', $studentname);
		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$data = array(
				'A_Name' => $value['assemblyname'],
				'edit' => array('id' => $value['id'], 'status' => $value['assemblystatus'])
				);

			$info[] = $data;
		}

		if ($data == null) {
			return 0;
		}else{
			return $info;
		}
	}

	public function getName($id)
	{
		$query = $this->db->select('assemblyname')->from('assemblyques')->where('id',$id)->get()->result_array();

		return $query[0]['assemblyname'];
	}

	public function chengeStatus($id)
	{
		$this->db->where('id', $id);
		$this->db->update('assemblyques', array('assemblystatus' => 0));
	}

	public function getQues($id)
	{
		$data = $this->_checkStatus($id);
		if ($data['status'] == null) {
			$num = $data['testid'];
			$time = $this->_getTime($num);
		}else{
			$num = $data['testid'];
			$time = $data['time'];
		}

		
		$data = array(
			'num' => $num,
			'time' => $time
		 );
		return $data;
	}

	public function _checkStatus($id)
	{
		$query = $this->db->select('status')->from('assemblyques')->where(array('id' => $id))->get()->result_array();
		return $query[0];
	}

	public function _getFlashId($id)
	{
		$this->db->select('queslist');
		$this->db->from('assemblyques');
		$this->db->where('id',$id);
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

	public function getStatus($id)
	{
		$queslist = $this->_getFlashId($id);

		$quesflash = $this->_getFlashFile($queslist);

		$query = $this->_checkStatus($id);

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
				$this->db->where(array('id' => $id));
				$this->db->update('assemblyques',array('assemblystatus' => 1));
			}

			return $info;
		}
	}

	public function updateStatus($data)
	{
		$check = array(
			'assemblyid' => $data['assemblyid'], 
			'stuid' => $data['stuid'], 
			'quesname' => $data['quesname'] 
			);

		$filename = $this->_getFileName($data['quesname']);

		$query = $this->db->select('*')->from('assemblyscore')->where($check)->get()->result_array();

		if ($query == null) {
			$this->db->insert('assemblyscore', $data);

			$this->db->where('id', $data['assemblyid']);
		    $this->db->update('assemblyques',array('status' => $filename[0]['queslocate']));
		}else{
			$this->db->where($check);
			$this->db->update('assemblyscore', array('score' => $data['score']));
		}
	}

	public function uploadText($data)
	{
		$check = array(
			'assemblyid' => $data['assemblyid'], 
			'stuid' => $data['stuid'], 
			'quesname' => $data['quesname'] 
			);
		$filename = $this->_getFileName($data['quesname']);

		$query = $this->db->select('*')->from('assemblyscore')->where($check)->get()->num_rows();

		if ($query) {
			return true;
		}else{
			$this->db->insert('assemblyscore', $data);
			$filename = $this->_getFileName($data['quesname']);

			$this->db->where('id', $data['assemblyid']);
			$this->db->update('assemblyques',array('status' => $filename[0]['queslocate']));
			return false;
		}
	}

	public function deleteAssemblyStatus($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->delete('assemblyques');

		if ($query) {
			return 1;
		}
	}
}
