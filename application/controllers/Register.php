<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Student_post');
	}

	public function _check()
	{
		$pass1 = $this->input->post('user_password');
		$pass2 = $this->input->post('user_passrepeat');
		$this->form_validation->set_rules('user_name','用户名','trim|required|xss_clean');
		$this->form_validation->set_rules('user_sex','性别','required');
		$this->form_validation->set_rules('user_phone','电话','trim|required|exact_length[11]|xss_clean');
		$this->form_validation->set_rules('user_password','密码','required|xss_clean');
		$this->form_validation->set_rules(
			'user_passrepeat','第二次输入密码',
			array(
				'same_pass',
				function() use ($pass1,$pass2) //自定义验证规则，先这么写
				{
					if ($pass2 != $pass1) { return TRUE; } //只写返回true的,用户填写不正确返回1
				}
			 )
			);
		$this->form_validation->set_rules('user_school','学校','required');
		$this->form_validation->set_rules('user_class','班级','required');
		$this->form_validation->set_message('required','必须填写');
		$this->form_validation->set_message('exact_length','{field}必须为11位');
		$this->form_validation->set_message('same_pass','两次输入密码不一致');
		return $this->form_validation->run();
	}

	public function registerCheck()
	{
		$pass1 = $this->input->post('user_password');
		$pass2 = $this->input->post('user_passrepeat');
		if ($this->_check() == FALSE) {
			$this->form_validation->set_error_delimiters('', '');  //设置错误消息的前缀和后缀。
			$errors = array(
                'status' => '2',
                'result' =>
                array(
                'user_name' => form_error('user_name'),
                'user_sex' => form_error('user_sex'),
                'user_phone' => form_error('user_phone'),
                'user_password' => form_error('user_password'),
                'user_passrepeat' => form_error('user_passrepeat'),
                'user_school' => form_error('user_school'),
                'user_class' => form_error('user_class')
            )
        );
            echo json_encode($errors);
		}
		else
		{
			//echo $this->insertInfo();
			if($this->insertInfo())
			{
				$success = array(
					'status' => '1', 
					'result' =>
					array(
						'msg' => '注册成功'
						)
					);
				echo json_encode($success);
			}else
			{
				$failed = array(
					'status' => '3',
					'result' =>
					array(
						'msg' => '此用户名已被注册'
						) 
					);
				echo json_encode($failed);
			}
		}
	}

	public function insertInfo()
	{
		$username = $this->input->post('user_name');
		$usersex = $this->input->post('user_sex');
		$userphone = $this->input->post('user_phone');
		$password  = $this->input->post('user_password');
		$userschool = $this->input->post('user_phone');
		$userclass = $this->input->post('user_class');
		
		$data = array(
			'studentname' => $username,
			'password' => $password,
			'sex' => $usersex,
			'telephone' => $userphone,
			'role_id' => 4,
			'classes_id' => $userclass,
			'createtime' => date("Y-m-d H:i:s",now('Asia/Shanghai')),
			'islogin' => 0
			); 
		$result = $this->Student_post->insertInfo($data);
		return $result;
	}
}
