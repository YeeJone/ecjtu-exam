<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stu_info extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getInfo($user)
	{
		$this->db->select('studentname,password,realname,idcard,sex,email,qq,address,telephone,classes_id,photo,point');
		$this->db->where('studentname',$user);
		$this->db->from('student');
		$result = $this->db->get()->result_array();
		$result[0]['classes_id'] = $this->getClass($result[0]['classes_id']);
		return $result;
	}

	public function getClass($id)
	{
		$this->db->select('classname');
		$this->db->where('id',$id);
		$this->db->from('classes');
		$result = $this->db->get()->result_array();
		return $result[0]['classname'];
	}

	public function updateInfo($id,$data)
	{
		foreach ($data as $key => $val) {
			if ($val != null) {
				$info["$key"] = $val;
			}
		}

		$this->db->where('studentname',$id);
		$query = $this->db->update('student',$info);
		
		if ($query) {
			return 1;
		}
		else
		{
			return 0;
		}
	}
}
