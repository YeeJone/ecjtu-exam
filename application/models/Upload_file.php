<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_file extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function checkName($name)
	{
		$result = 0;
		$path = './quesList/';
		$file = scandir($path);

		foreach ($file as $key => $value) {
			if ($name == $value) {
				$result = 1;
			}
		}
		// $this->db->select('*');
		// $this->db->from('flash');
		// $this->db->where('flashname', $name);
		// $result = $this->db->get()->num_rows();
		return $result;
	} 

	public function insertFlash($filename)
	{
		$data = array('flashname' => $filename );
		$this->db->insert('flash', $data);
	}
}