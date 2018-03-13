<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Techmessage extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('teacher/message_info');
	}

	public function pubMessage($teachername)
	{
		$data = array('teachername' => $teachername );
		$this->load->view('teacher/pubmessage', $data);
	}

	public function showList()
	{
		$this->load->view('teacher/msglist');
	}

	public function insertMsg()
	{
		$data = array(
			'teacher_id' => $this->input->post('msg_teachername'),
			'description' =>  $this->input->post('msg_info'),
			'issuetime' => date("Y-m-d")
			);

		$insert = $this->message_info->insertMsg($data);
		if ($insert) {
			$info = array(
				'status' => 1,
				'msg' => '发布成功'
			 );

			echo json_encode($info);
		}else{
			$info = array(
				'status' => 0,
				'msg' => '发布失败'
			 );

			echo json_encode($info);
		}
	}

	public function getMsg()
	{
		$msg = $this->message_info->getMsg();

		$data = array('data' => $msg );

		echo json_encode($data);
	}

	public function deleteMsg()
	{
		$id = $this->input->post('id');

		$delete = $this->message_info->deleteMsg($id);

		if ($delete) {
			echo 1;
		}else
		{
			echo 0;
		}
	}
}
