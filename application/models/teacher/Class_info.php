<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Class_info extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getCollege()
	{
		$college = $this->db->select('id, collegename')->from('college')->where('isactive',1)->get()->result_array();

		return $college;
	}

	public function getClass()
	{
		$data = null;
		$this->db->from('classes');
		$result = $this->db->get()->result_array();
		foreach ($result as $key => $value) {
			$data = array(
				'C_number' => $value['classnumber'],
				'C_name' => $value['classname'],
				'C_info' => $value['description'],
				'C_time' => $value['createtime'],
				'C_school' => $this->getCollegeName($value['college_id']),
				'C_status' => $value['isapply']
				);
			$info[] = $data;
		}

		if ($data==null) {
			return 0;
		}else{
			return $info;
		}
	}

	public function getCollegeName($class)
	{
		$this->db->select('collegename');
		$this->db->where('id',$class);
		$this->db->from('college');
		$result = $this->db->get()->result_array();
		return $result[0]['collegename'];
	}

	public function getTechName($teachername)
	{
		$this->db->select('realname');
		$this->db->where('teachername',$teachername);
		$this->db->from('teacher');
		$result = $this->db->get()->result_array();
		return $result[0]['realname'];
	}

	public function getTechId($teachername)
	{
		$this->db->select('id');
		$this->db->where('teachername',$teachername);
		$this->db->from('teacher');
		$result = $this->db->get()->result_array();
		return $result[0]['id'];
	}

	public function insertClass($data)
	{
		$data['teacher_id'] = $this->getTechId($data['teacher_id']);

		$query = $this->db->insert('classes',$data);
		if ($query) {
			return 1;
		}else{
			return 0;
		}
	}

	public function openApply($id)
	{
		$this->db->where('classnumber',$id);
		$query = $this->db->update('classes',array('isapply' => 1));
		if($query){ return 1; }
		else{ return 0; }
	}

	public function closeApply($id)
	{
		$this->db->where('classnumber',$id);
		$query = $this->db->update('classes', array('isapply' => 0));
		if($query){ return 1; }
		else{ return 0; }
	}
}
