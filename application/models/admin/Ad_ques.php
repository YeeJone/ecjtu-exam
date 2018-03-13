<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ad_ques extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function addQuesType($data)
	{
		$query = $this->db->insert('questiontype',$data);
		if ($query) {
			return 1;
		}else{
			return 0;
		}
	}

	public function getType()
	{
		$data = null;
		$this->db->select('id,questiontypename,description,state');
		$this->db->from('questiontype');
		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$data = array(
				'Q_name' => $value['questiontypename'], 
				'Q_info' => $value['description'], 
				'Q_status' => $value['state'], 
				'edit' => $value['id']
				);
			$info[] = $data; 
		}

		if ($data == null) {
			return 0;
		}else{
			return $info;
		}
	}

	public function updateStatus($id,$status)
	{
		$this->db->where('id', $id);
		if ($status == 1) {
			$query = $this->db->update('questiontype',array('state' => 1));
			if ($query) { return 1; }
			else{ return 0; }
		}else{
			$query = $this->db->update('questiontype',array('state' => 0));
			if ($query) { return 1; }
			else{ return 0; }
		}
	}
}