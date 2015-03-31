<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->helper('captcha');

//		$this -> load -> model('admin_model');
		$this -> load -> model('Shop_model');
		$this -> load -> model('Admin_model');
        $this -> load -> model('user_model');
        $this -> load -> model('shop_model');
	}


	//首页加载
	public function index() {
		#权限验证
		if (! $this->session->userdata('login_admin'))
		{
			redirect('admin/login');
		}

		$userid =  $this->session->userdata('login_admin');

		$res = $this -> Admin_model -> getThisUser($userid);

		$data['name'] = $res['username'];

		$this -> load -> view('admin/admin_view',$data);
	}


	//欢迎页面
	public function serverData()
	{
		#权限验证
		if (! $this->session->userdata('login_admin'))
		{
			redirect('admin/login');
		}
        $data['userweeknums'] = $this->user_model->getWeekUsers();
        $data['shopweeknums'] = $this->shop_model->getWeekShops();
        $data['usernums'] = $this->db->count_all('user');
        $data['shopnums'] = $this->db->count_all('shop_user');
		$this -> load ->view('admin/admin1_1',$data);
	}

	//清理缓存
	public function clear()
	{
		#权限验证
		if (! $this->session->userdata('login_admin'))
		{
			redirect('admin/login');
		}
		$this -> load ->view('admin/admin1_2');
	}

	//数据备份
	public function backup()
	{
		#权限验证
		if (! $this->session->userdata('login_admin'))
		{
			redirect('admin/login');
		}
		$this -> load -> view('admin/admin1_3');
	}

	//数据恢复
	public function recover()
	{
		#权限验证
		if (! $this->session->userdata('login_admin'))
		{
			redirect('admin/login');
		}
		$this -> load ->view('admin/admin1_4');
	}





	/**
	 * 生成验证码
	 * @author wuanbo
	 * @date 2015-01
	 */

	public function code(){
	    $this->load->helper('image');
	    $verifyCode = generateVerifyCodeImg();
	    $this->session->set_userdata('admin_code', $verifyCode['code']);
	    header("Content-type: image/gif");
	    echo $verifyCode['img'];
	    exit;
	}


	/**
	 * 登陆
	 * @author wuanbo
	 * @date 2015-01
	 */
	public function login()
	{
		if(!empty($_POST))
		{

			$username = $this -> input -> post('user_name');
			$password = $this -> input -> post('password');
			$captcha = strtolower($this -> input ->post('captcha'));

			$code = strtolower($this->session->userdata('admin_code'));
			$password = trim($password);
			$password = md5($password);

			if ($captcha == $code)
			{
					$res = $this -> Admin_model -> getUser($username);

				if($res)
				{
					if($res['password'] == $password)
					{
						$this->session->set_userdata('login_admin',$res['id']);
						redirect('admin/index');

					}
					else
					{
						echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
						echo "<script> {window.alert('用户名或密码错误!');location.href='login'} </script>";

					}

				}
				else
				{
					echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
					echo "<script> {window.alert('用户名或密码错误!');} </script>";

				}
			}
			else
			{

				echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
				echo "<script> {window.alert('验证码错误!');} </script>";

			}

		}


		$this -> load ->view('admin/login');
	}
        
        public function checkAdmin()
        {
            if ($this->session->userdata('login_admin'))
                {
                    return TRUE;
		}
                else
                {
                    return FALSE;
                }
        }
        
        public function alertpassword()
        {
           
            if(!empty($_POST))
            {
                $userid =  $this->session->userdata('login_admin');
                $res = $this -> Admin_model -> getThisUser($userid);
                
                $passworddb = $res['password'];
                $passwordold = $this -> input -> post('oldpassword');
				$password = $this -> input -> post('password');
                $passwordold = md5($passwordold);
                $password = md5($password);
                
                if($passwordold == $passworddb)
                {
                    $res = $this -> Admin_model -> alterpass($password,$res['id']);
                    if($res)
                    {
                        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                        echo "<script> {window.alert('修改成功');} </script>";
                    }
                    else
                    {
                        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                        echo "<script> {window.alert('修改失败');} </script>";
                    }
                }
                else
                {
                    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                    echo "<script> {window.alert('密码错误');} </script>";
                }
                              
            }
            $this -> load ->view('admin/alterpass');
        }

	public function shopManage()
	{
		$shopid = $this -> input -> get("shop_user_id");
		$this->session->set_userdata('shopManage_admin',$shopid);
		redirect('/manager/info/');
	}

	public function userManage()
	{
		$userid = $this -> input -> get("user_id");
        $this -> session -> set_userdata('id',$userid);
		$this->session->set_userdata('user_admin',$userid);
		redirect('/user/index/');
	}



	public function logout()
	{
		$this->session->unset_userdata('login_admin');
		$this->session->sess_destroy();
		redirect('admin/login');
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */

