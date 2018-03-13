<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stu_main extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function selectRealname($name)
	{
		$this->db->select('realname');
		$this->db->where('studentname',$name);
		$this->db->from('student');
		$result = $this->db->get()->result_array();
		return $result[0]['realname'];
	}
}
