<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info_post extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getSchoolClass()
	{
		$college = $this->db->select('id,collegename')->from('college')->where('isactive', 1)->get()->result_array();
		$class = $this->db->select('id,classname')->from('classes')->where('isapply', 1)->get()->result_array();
		$data = array(
			'college' => $college,
			'class' => $class 
			);

		return $data;
	}

	public function _checkStudent($username)
	{
		$select = $this->db->get_where('student',array('studentname' => $username));
		return $select;
	}

	public function checkStudent($data)
	{
		$select = $this->_checkStudent($data['studentname']);
		$query = $select->row_array();
		if($query)
		{
			if($query['password'] == $data['password'])
			{
				if ($query['islogin'] == 0) { return 1; }
				else { return 3; }
			}
			else { return 2; }
		}
		else { return 0; }
	}

	public function insertInfo($data)
	{
		$select = $this->_checkStudent($data['studentname']);
		$class_id = $this->db->select('id')->from('classes')->where(array('classname'=> $data['classes_id']))->get()->result_array();
		$data['classes_id'] = $class_id[0]['id'];
		$query = $select->num_rows();
		if($query) { return 0; }
		else
		{
			$this->db->insert('student',$data);
			return 1;
		}
	}

	public function checkTeacher($data)
	{
		$select = $this->db->get_where('teacher',$data)->num_rows();
		if ($select) {
			return 1;
		}
		else{
			return 0;
		}
	}

	public function checkAdmin($data)
	{
		$select = $this->db->get_where('admin',$data)->num_rows();
		if ($select) {
			return 1;
		}
		else{
			return 0;
		}
	}

	public function adminConfirm($pass)
	{
		$query = $this->db->select('password')->from('adminconfirm')->where('id',1)->get()->result_array();
		return $query[0]['password'];
	}

	public function changeStuStatus($name)
	{
		$this->db->where('studentname',$name);
		$query = $this->db->update('student', array('islogin' => 1));
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function stuLogout($name)
	{
		$this->db->where('studentname',$name);
		$query = $this->db->update('student', array('islogin' => 0));
		if ($query) {
			return true;
		}else{
			return false;
		}
	}
}
