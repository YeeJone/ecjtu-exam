<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stu_list extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getList()
	{
		$data = null;
		$this->db->select('studentname,password,telephone,realname,sex,qq,email,isactive,islogin,classes_id');
		$this->db->from('student');
		$result = $this->db->get()->result_array();

		for ($i=0; $i<count($result); $i++) {
			$class = $this->getClass($result[$i]['classes_id']);
			$result[$i]['classes_id'] =  "$class";
		}

		foreach($result as $key => $value)
		{
			$data = array(
				'S_number' => $value['studentname'],
				'password' => $value['password'],
				'truename' => $value['realname'],
				'phone' => $value['telephone'],
				'true_name' => $value['realname'],
				'sex' => $value['sex'],
				'email' => $value['email'],
				'QQ' => $value['qq'],
				'is_active' => $value['isactive'],
				'is_login' => $value['islogin'],
				'class' => $value['classes_id'],
				'edit' => $value['studentname']
				);
			$info[] = $data; 
		}

		if ($data==null) {
			return 0;
		}else{
			return $info;
		}
	}

	public function getClass($id)
	{
		$this->db->select('classname');
		$this->db->from('classes');
		$this->db->where('id',$id);
		$result = $this->db->get()->result_array();
		return $result[0]['classname'];
	}

	public function openActive($id)
	{
		$this->db->where('studentname',$id);
		$query = $this->db->update('student',array('isactive' => 1));
		if($query){ return 1; }
		else{ return 0; }
		
	}

	public function closeActive($id)
	{
		$this->db->where('studentname',$id);
		$query = $this->db->update('student', array('isactive' => 0));
		if($query){ return 1; }
		else{ return 0; }
	}

	public function kickLogin($id)
	{
		$id = explode(',', $id);
		foreach ($id as $value) {
			$this->db->where('studentname',$value);
			$query[] = $this->db->update('student',array('islogin' => 0));
		}
		
		$count = 0;
		foreach ($query as $value) {
			if ($value) { $count += 1; }
		}

		if ($count == count($id)) { return 1;}
		else{ return 0; }
	}

	public function deleteStu($id)
	{
		$this->db->where('studentname', $id);
		$query = $this->db->delete('student');

		if($query) { return 1; }
		else { return 0; }
	}
}
