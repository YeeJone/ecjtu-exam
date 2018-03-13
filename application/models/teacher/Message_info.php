<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message_info extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function insertMsg($data)
	{
		$data['teacher_id'] = $this->getId($data['teacher_id']);
		$query = $this->db->insert('notice', $data);

		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function getMsg()
	{
		$data = null;
		$this->db->select('id,issuetime,description,teacher_id');
		$this->db->from('notice');
		$query = $this->db->get()->result_array();

		foreach ($query as $key => $value) {
			$data = array(
				'M_info' => $value['description'],
				'M_time' => $value['issuetime'],
				'M_teacher' => $this->getName($value['teacher_id']),
				'edit' =>  $value['id']
				);
			$info[] = $data;
		}

		if ($data==null) {
			return 0;
		}else{
			return $info;
		}
	}

	public function getId($id)
	{
		$this->db->select('id');
		$this->db->from('teacher');
		$this->db->where('teachername', $id);
		$query = $this->db->get()->result_array();
		return $query[0]['id'];
	}

	public function getName($id)
	{
		$this->db->select('realname');
		$this->db->from('teacher');
		$this->db->where('id', $id);
		$query = $this->db->get()->result_array();
		return $query[0]['realname'];
	}

	public function deleteMsg($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->delete('notice');

		if ($query) {
			return true;
		}else{
			return false;
		}
	}
}
