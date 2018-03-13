<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ques_info extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getList()
	{
		$this->db->select('id,questiontypename,description');
		$this->db->from('questiontype');
		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$data = array(
				'Q_List' => $value['questiontypename'], 
				'Q_Info' => $value['description'],
				'edit' => $value['id']
			);

			$info[] = $data;
		}

		return $info;
	}

	public function getType()
	{
		$type = $this->db->select('id,questiontypename')->from('questiontype')->get()->result_array();
		$style = $this->db->select('id,questionstylename')->from('questionstyle')->get()->result_array();
		$data = array(
			'type' => $type,
			'style' => $style  
			);
		return $data;
	}

	public function getList2()
	{
		$this->db->select('id,questiontypename');
		$this->db->from('questiontype');
		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$data = array(
				'name' => $value['questiontypename'], 
				'operation' => $value['id']
			);

			$info[] = $data;
		}

		return $info;
	}

	public function getQuesName($id)
	{
		$this->db->select('questiontypename');
		$this->db->from('questiontype');
		$this->db->where('id',$id);
		$query = $this->db->get()->result_array();
		return $query[0]['questiontypename'];
	}

	public function getQuesList($typeid)
	{
		$data = null;
		$this->db->select('id,quesname,queslocate,testtype,teachername,state');
		$this->db->from('flashques');
		$this->db->where('questype', $typeid);
		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$data = array(
				'questionname' => $value['quesname'],
				'teachername' => $this->_getTechName($value['teachername']), 
				'flash' => $value['queslocate'], 
				'testtype' => $value['testtype'], 
				'is_active' => $value['state'], 
				'edit' => $value['id']
				);

			$info[] =$data; 
			
		}
		if ($data==null) {
			return 0;
		}else{
			return $info;
		}
	}

	public function checkDeta($id)
	{
		$this->db->select('writenumber,selectnumber,optionnumber,totaltime,direction,state,questionstyle_id');
		$this->db->from('questiontype');
		$this->db->where('id', $id);
		$query = $this->db->get()->result_array();

		$query[0]['questionstyle_id'] = $this->_checkStyle($query[0]['questionstyle_id']);

		return $query;
	}

	public function _checkStyle($id)
	{
		$this->db->select('questionstylename');
		$this->db->from('questionstyle');
		$this->db->where('id', $id);
		$result = $this->db->get()->result_array();
		return $result[0]['questionstylename'];
	}

	public function showDetail($id)
	{
		$data = null;
		$this->db->select('questiontypename,questionenglishname,writenumber,direction,description');
		$this->db->from('questiontype');
		$this->db->where('id', $id);
		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$data = array(
				'Q_Cname' => $value['questiontypename'], 
				'Q_Ename' => $value['questionenglishname'],
				'Q_CInfo' => $value['description'],
				'Q_EInfo' => $value['direction'],
				// 'Q_Select' => $value['selectnumber'],
				// 'Q_Blank' => $value['writenumber'],
				// 'Q_Num' => $value['optionnumber'],
				// 'Q_Time' => $value['totaltime'],
				// 'Q_Type' => $this->_checkStyle($value['questionstyle_id']),
				// 'Q_Temp' => $this->_getTempName($value['template_id']),
				'edit' => $id
			); 
		}

		if ($data==null) {
			return 0;
		}else{
			return $data;
		}
	}

	public function _getTempName($id)
	{
		$this->db->select('templatename');
		$this->db->from('template');
		$this->db->where('id', $id);
		$result = $this->db->get()->result_array();
		return $result[0]['templatename'];
	}

	public function _getTechName($techid)
	{
		$this->db->select('realname');
		$this->db->from('teacher');
		$this->db->where('teachername', $techid);
		$realname = $this->db->get()->result_array();

		return $realname[0]['realname'];
	}

	public function insertQues($data)
	{
		$query = $this->db->insert('flashques',$data);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function changeActive($id,$isActive)
	{
		$this->db->where('id',$id);
		if ($isActive) {
			$query = $this->db->update('flashques',array('state' => 1));
			if($query){ return 1; }
			else{ return 0; }
		}else{
			$query = $this->db->update('flashques',array('state' => 0));
			if($query){ return 1; }
			else{ return 0; }
		}
	}

	public function _deleteFile($filename)
	{
		$path = './quesList/'.$filename.'';
		$query = unlink($path);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function deleteQues($id)
	{
		$this->db->select('queslocate');
		$this->db->from('flashques');
		$this->db->where('id', $id);
		$query = $this->db->get()->result_array();
		$flashname = $query[0]['queslocate'];

		if($this->_deleteFile($flashname))
		{
			$this->db->where('id', $id);
			$query = $this->db->delete('flashques');
			if($query) { return 1; }
			else { return 0; }
		}else{
			return 0;
		}
	}

	public function getFlashName($id)
	{
		$this->db->select('queslocate');
		$this->db->from('flashques');
		$this->db->where('id',$id);
		$query = $this->db->get()->result_array();
		return $query[0]['queslocate'];
	}
}
