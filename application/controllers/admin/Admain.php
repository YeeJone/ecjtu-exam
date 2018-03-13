<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admain extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/ad_main');
	}

	public function admainMenu($name)
	{
		$user = $this->ad_main->selectRealname(urldecode($name));
		$data = array(
			'role' => '管理员',
			'username' => $name,
			'realname' => $user
			);
		$this->load->view('admin/admin_menu',$data);
	}
}
