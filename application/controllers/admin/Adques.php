<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adques extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/ad_ques');
	}

	public function addQuesTypeView()
	{
		$this->load->view('admin/addQuesType');
	}

	public function quesTypeManageView()
	{
		$this->load->view('admin/quesManage');
	}

	public function addQuesType()
	{
		$data = array(
			'questiontypename' => $this->input->post('quesname'), 
			'questionenglishname' => $this->input->post('quesenname'), 
			'direction' => $this->input->post('direction'), 
			'description' => $this->input->post('description'),
			'state' => 0
			);


		$result = $this->ad_ques->addQuesType($data);
		if ($result) {
			echo 1;
		}else{
			echo 0;
		}
	}

	public function quesTypeManage()
	{
		$query = $this->ad_ques->getType();

		$data = array('data' => $query );

		echo json_encode($data);

	}

	public function updateStatus()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('data_is');
		$result = $this->ad_ques->updateStatus($id,$status);
		if ($result) {
			echo 1;
		}
	}
}
