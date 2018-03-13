<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Find_pass extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function findPass($role,$data)
	{
		switch ($role) {
			case '学生':
				$query = $this->db->get_where('student',$data)->num_rows();
				break;
			
			case '教师':
				$query = $this->db->get_where('teacher',$data)->num_rows();
				break;

			case '管理员':
				$query = $this->db->get_where('admin',$data)->num_rows();
			    break;

		}

		if ($query) {
			switch ($role) {
				case '学生':
				$getpass = $this->db->select('password')->from('student')
								->where(array('studentname' => $data['studentname']))
								->get()->result_array();

				return $getpass[0]['password'];
				break;
			
			case '教师':
				$getpass = $this->db->select('password')->from('teacher')
								->where(array('teachername' => $data['teachername']))
								->get()->result_array();

				return $getpass[0]['password'];
				break;

			case '管理员':
				$getpass = $this->db->select('password')->from('admin')
								->where(array('adminname' => $data['adminname']))
								->get()->result_array();

				return $getpass[0]['password'];
			    break;
			}
		}
		else
		{
			return 0;
		}
	}
}
