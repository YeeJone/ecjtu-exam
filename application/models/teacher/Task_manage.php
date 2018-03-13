<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task_manage extends CI_Model
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

	public function searchTask($id)
	{
		$data = null;
		$limit = array(
			'questype' => $id,
			'testtype' => "1",
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

	public function insertTest($data)
	{
		$query = $this->db->insert('testlist',$data);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function searchList()
	{
		$data = null;
		$this->db->select('id,testname');
		$this->db->from('testlist');
		$this->db->where('testtype', 0);

		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$data = array(
				'testname' => $value['testname'],
				'edit' => $value['id'] 
				);

			$info[] = $data;
		}

		if ($data == null) { return 0; }
		else{ return $info; }
	}

	public function insertTask($data)
	{
		$query = $this->db->insert('tasklist',$data);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function getTask()
	{
		$data = null;
		$this->db->select('id,taskname,testlist,starttime,taskinfo,teachername,state');
		$this->db->from('tasklist');
		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$data = array(
				'T_id' => $value['id'], 
				'T_name' => $value['taskname'],
				'T_list' => $this->transList($value['testlist']),
				'T_info' => $value['taskinfo'],
				'T_starttime' => $value['starttime'],
				'T_teacher' => $this->getTechName($value['teachername']),
				'T_status' => $value['state'],
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

	public function getTechName($teachername)
	{
		$this->db->select('realname');
		$this->db->where('teachername',$teachername);
		$this->db->from('teacher');
		$result = $this->db->get()->result_array();
		return $result[0]['realname'];
	}

	public function transList($list)
	{
		$examlist = unserialize($list);
		foreach ($examlist as $key => $value) {
			$info[] = $this->getListName($value);
		}
		return implode(' ', $info);
	}

	public function getListName($id)
	{
		$this->db->select('testname');
		$this->db->from('testlist');
		$this->db->where('id',$id);
		$result = $this->db->get()->result_array();
		return $result[0]['testname'];
	}

	public function updateStatus($id,$status)
	{
		$this->db->where('id', $id);
		if ($status == 1) {
			$query = $this->db->update('tasklist', array('state' => 1 ));
			if ($query) { return 1; }
			else{ return 0; }
		}else{
			$query = $this->db->update('tasklist', array('state' => 0 ));
			if ($query) { return 1; }
			else{ return 0; }
		}
	}

	public function deleteExam($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->delete('tasklist');
		if($query){ return 1; }
		else{ return 0; }
	}
}
