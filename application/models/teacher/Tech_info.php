<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tech_info extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getInfo($user)
	{
		$this->db->select('teachername,password,realname,sex,email,createtime,qq,telephone,college_id');
		$this->db->where('teachername',$user);
		$this->db->from('teacher');
		$result = $this->db->get()->result_array();
		$result[0]['college_id'] = $this->getCollege($result[0]['college_id']);
		return $result;
	}

	public function getCollege($college_id)
	{
		$this->db->select('collegename');
		$this->db->where('id',$college_id);
		$this->db->from('college');
		$result = $this->db->get()->result_array();
		return $result[0]['collegename'];
	}

	public function updateInfo($id, $data)
	{
		foreach ($data as $key => $val) {
			if ($val != null) {
				$info["$key"] = $val;
			}
		}

		$this->db->where('teachername',$id);
		$query = $this->db->update('teacher',$info);
		
		if ($query) {
			return 1;
		}
		else
		{
			return 0;
		}
	}
}
