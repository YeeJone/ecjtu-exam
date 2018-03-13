 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();   //这个不能缺
		$this->load->model('info_post');
	}
	
	public function studentLogin()
	{
		$data = $this->info_post->getSchoolClass();
		$this->load->view('stu_login', $data); 
	}
    
    public function teacherLogin()
    {
    	$this->load->view('teac_login');
    }

    public function adminConfirm()
    {
    	$this->load->view('admin_check');
    }

    public function adminPass()
    {
    	$pass = $this->input->post('password');
    	$passcon = $this->info_post->adminConfirm($pass);
    	if ($pass == $passcon) {
    		echo 1;
    	}else{
    		echo 0;
    	}
    }

    public function adminLogin()
    {
    	$this->load->view('admin_login');
    }

	public function studentCheck()
	{
		$data = array(
			'studentname' => $this->input->post('username'),
			'password' => $this->input->post('password')
			 );
	    $status = $this->info_post->checkStudent($data);
		switch ($status) {
			case '0':
				echo "<script language='javascript' type='text/javascript'>";
				echo "alert('用户名不正确!')";
				echo "</script>";
				$this->studentLogin();
				break;

			case '1':
				$info = array(
					'status' => 1,
					'name' => $data['studentname']
					);
				$this->info_post->changeStuStatus($info['name']);
				$this->load->view('center',$info);
				break;
			
			case '2':
				echo "<script language='javascript' type='text/javascript'>";
				echo "alert('密码有问题，请检查一下!')";
				echo "</script>";
				$this->studentLogin();
				break;

			case '3':
				echo "<script language='javascript' type='text/javascript'>";
				echo "alert('登录已锁定，请联系教师解锁!')";
				echo "</script>";
				$this->studentLogin();
				break;
		}
	}

	public function teacherCheck()
	{
		$data = array(
			'teachername' => $this->input->post('username'),
			'password' => $this->input->post('password')
			);
		$status = $this->info_post->checkTeacher($data);
		if ($status) {
			$info = array(
				'status' => 2,
				'name' => $data['teachername']
				);
			$this->load->view('center',$info);
		}else
		{
			echo "<script language='javascript' type='text/javascript'>";
			echo "alert('用户名或密码错误!')";
			echo "</script>";
			$this->teacherLogin();
		}
	}

	public function adminCheck()
	{
		$data = array(
			'adminname' => $this->input->post('username'),
			'password' => $this->input->post('password')
			);

	 	$status = $this->info_post->checkAdmin($data);
		if ($status) {
			$info = array(
				'status' => 3,
				'name' => $data['adminname']
				);
			$this->load->view('center',$info);
		}else
		{
			echo "<script language='javascript' type='text/javascript'>";
			echo "alert('用户名或密码错误!')";
			echo "</script>";
			$this->adminLogin();
		}
	 }

	 public function logoutSafe($status,$name)
	 {
	 	switch ($status) {
	 		case '1':
	 			$result = $this->info_post->stuLogout($name);
	 			if ($result) {
	 				echo "<script language='javascript' type='text/javascript'>";
					echo "alert('成功退出!')";
					echo "</script>";
	 				$this->studentLogin();
	 			}else
	 			{
	 				echo 'error';
	 			}
	 			break;
	 		
	 		case '2':
	 			echo "<script language='javascript' type='text/javascript'>";
				echo "alert('成功退出!')";
				echo "</script>";
	 			$this->teacherLogin();
	 			break;

	 		case '3':
	 			echo "<script language='javascript' type='text/javascript'>";
				echo "alert('成功退出!')";
				echo "</script>";
	 			$this->adminLogin();
	 			break;
	 	}
	 }
} 
