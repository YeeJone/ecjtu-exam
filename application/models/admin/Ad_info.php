<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ad_info extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function passConfirm($oldpass,$newpass)
	{
		$query = $this->db->select('password')->from('adminconfirm')->where('id',1)->get()->result_array();
		if ($oldpass == $query[0]['password']) {
			$this->db->where('id',1);
			$this->db->update('adminconfirm',array('password' => $newpass));
			return true;
		}else{
			return false;
		}
	}

	public function getInfo($user)
	{
		$this->db->select('adminname,password,realname,sex,email,qq,telephone,college_id');
		$this->db->where('adminname',$user);
		$this->db->from('admin');
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

		$this->db->where('adminname',$id);
		$query = $this->db->update('admin',$info);
		
		if ($query) {
			return 1;
		}
		else
		{
			return 0;
		}
	}
}
