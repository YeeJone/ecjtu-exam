<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ad_main extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function selectRealname($name)
	{
		$this->db->select('realname');
		$this->db->where('adminname',$name);
		$this->db->from('admin');
		$result = $this->db->get()->result_array();
		return $result[0]['realname'];
	}
}
