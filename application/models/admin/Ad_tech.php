<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ad_tech extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function insertInfo($info)
	{
		$query = $this->db->insert('admin',$info);
		return $query;
	}

	public function getList()
	{
		$this->db->select('id,teachername,password,telephone,realname,sex,qq,email,isactive,college_id');
		$this->db->from('teacher');
		$result = $this->db->get()->result_array();

		for ($i=0; $i<count($result); $i++) {
			$college = $this->getCollege($result[$i]['college_id']);
			$result[$i]['college_id'] =  $college;
		}

		foreach($result as $key => $value)
		{
			$data = array(
				'T_number' => $value['teachername'],
				'password' => $value['password'],
				'phone' => $value['telephone'],
				'true_name' => $value['realname'],
				'sex' => $value['sex'],
				'email' => $value['email'],
				'QQ' => $value['qq'],
				'is_active' => $value['isactive'],
				'college' => $value['college_id'],
				'edit' => $value['id']
				);
			$info[] = $data; 
		}

		return $info;
	}

	public function getCollege($id)
	{
		$this->db->select('collegename');
		$this->db->from('college');
		$this->db->where('id',$id);
		$result = $this->db->get()->result_array();
		return $result[0]['collegename'];
	}

	public function openActive($id)
	{
		$this->db->where('teachername',$id);
		$query = $this->db->update('teacher',array('isactive' => 1));
		if($query){ return 1; }
		else{ return 0; }
		
	}

	public function closeActive($id)
	{
		$this->db->where('teachername',$id);
		$query = $this->db->update('teacher', array('isactive' => 0));
		if($query){ return 1; }
		else{ return 0; }
	}

	public function searchClass($teacherid)
	{
		$classes = $this->db->select('*')->from('classes')->where('teacher_id',$teacherid)->get()->result_array();

		return $classes;
	}


}