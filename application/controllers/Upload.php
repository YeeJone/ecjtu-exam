<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('upload_file');
	}

	public function uploadFile($user)
	{
		$user = urldecode($user);

		$this->_mkdirStu($user);

		$file = $_FILES['file'];
		//echo json_encode($file);
		if (preg_match_all('/image\/*/', $file['type'])) {
			$this->uploadImg($user,$file);
		}elseif (preg_match_all('/application\/*/', $file['type'])) {
			$this->uploadMp3($user,$file);
		}
	}

	public function _mkdirStu($user)
	{
		//路径是相对于你网站的 index.php 文件的，而不是相对于控制器或视图文件。 这是因为 CodeIgniter 使用的前端控制器，所以所有的路径都是相对于 index.php 所在路径。(重要)
		$pathimg = './student/headimg/';
		$pathmusic = './student/mp3/';
		$pathimguser = './student/headimg/'.$user.'/';
		$pathmusicuser = './student/mp3/'.$user.'/';
		//return $path;
		if(!is_dir($pathimg)) {
		 	mkdir($pathimg);
		}

		if (!is_dir($pathimguser)) {
			mkdir($pathimguser);
		}

		if (!is_dir($pathmusic)) {
		 	mkdir($pathmusic);
		}

		if (!is_dir($pathmusicuser)) {
			mkdir($pathmusicuser);
		}
	}

	public function _mkdirSwf()
	{
		$pathflash = './quesList';
		if (!is_dir($pathflash)) {
			mkdir($pathflash);
		}
	}

	public function _changeName($filename)
	{
		$postfix = explode('.', $filename);
		$postfix = end($postfix);
		$filename = time().md5(rand()).'.'."$postfix";

		return $filename;
	}

	public function uploadImg($user,$file)
	{
		$postfix = explode('.', $file['name']);
		$postfix = end($postfix);
		$file['name'] = $this->_changeName($file['name']);

		$path = './student/headimg/'.$user.'/';
		$pathfile = $path.basename($file['name']);

		if (is_uploaded_file($file['tmp_name'])) {
			move_uploaded_file($file['tmp_name'], $pathfile);
			echo $file['name'];
		}else
		{
			echo 0;
		}
	}

	public function uploadMP3($user,$file)
	{
		$postfix = explode('.', $file['name']);
		$postfix = end($postfix);
		$file['name'] = $this->_changeName($file['name']);

		$path = './student/mp3/'.$user.'/';
		$pathfile = $path.basename($file['name']);

		if (is_uploaded_file($file['tmp_name'])) {
			move_uploaded_file($file['tmp_name'], $pathfile);
			echo $file['name'];
		}else
		{
			echo 0;
		}
	}

	public function uploadFlash()
	{
		$name = $_REQUEST['name'];
		$guid = $_REQUEST['guid'];
		$chunk = $_REQUEST['chunk'];

		$this->_mkdirSwf();

		$path = './quesList/';

		if(preg_match_all("#['!`~\/\\%^&*()+=\$\#:;<>\]\[{}]#", $name))
		{
			echo 2;
		}else{
			$query = $this->upload_file->checkName($name);

			if ($query) {
				echo 1;
			}else{
				$path = $path.$guid;

				if (!is_dir($path)) {
					mkdir($path);
				}

				$pathfile = $path.'/'.$chunk;
				$file = $_FILES['file'];

				if (is_uploaded_file($file['tmp_name'])) {
					move_uploaded_file($file['tmp_name'], $pathfile);
				}else{
					echo 0;
				}
			}
		}
	}

	public function mergeFlash()
	{
		$guid = $_REQUEST['guid'];
		$path = './quesList/';
		$pathguid = $path.$guid.'/';
		$filename = $_REQUEST['fileName'];
		
		$file = scandir($pathguid);

		foreach ($file as $key => $name) {
			if ($name != '..' && $name != '.') {
				$str = file_get_contents($pathguid.$name);
				file_put_contents($path.$filename, $str, FILE_APPEND);
			}
		}

		foreach ($file as $key => $name) {
			if ($name != '..' && $name != '.') {
				unlink($pathguid.$name);
			}
		}

		rmdir($pathguid);

		$this->upload_file->insertFlash($filename);

		echo $filename;
	}
}
