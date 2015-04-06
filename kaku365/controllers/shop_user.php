<?php
/**
 * @author: chenjia404
 * @Date: 2015/1/21
 * @Time: 22:38
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shop_user extends CI_Controller{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Shop_user_model');
	}


	/**
	 * 注册
	 * @author chenjia404
	 * @date   2015-01-21
	 */
	public function register()
	{
		if (!$this -> input -> post('username')) {
			$this -> load -> view('shop_user_register');
		}
		else {
			$s_captcha = $this -> session -> userdata('shop_code');
			$c_captcha = $this -> input -> post('captcha');
			if ($s_captcha != $c_captcha) {
				echo "<script>alert('验证码错误.$s_captcha')</script>";
				$this -> load -> view('shop_user_register');
			} else {
				$this -> load -> model('shop_user_model');
				$user['reg_date'] = date('Y-m-d H:i:s');
				$user['last_login'] = date('Y-m-d H:i:s');
				$user['ip'] = $this -> input -> ip_address();
				$user['username'] = $this -> input -> post('username');
				$user['phone'] = $this -> input -> post('phone');
				$user['password'] = md5($this -> input -> post('password') . 'kaku365%^&RFGHJRFGB');
				$res = $this -> shop_user_model ->register($user);
				if ($res) {
					redirect('shop_user/login');
				} else {
					echo "<script>alert('对不起,注册失败,请重新注册.')</script>";
					redirect('shop_user/register');
				}
			}
		}
	}


	/**
	 * 登录
	 * @author chenjia404
	 * @date   2015-01-21
	 */
	public function login()
	{
		if (!$this -> input -> post('username')) {
			$this -> load -> view('shop_user_login');
		} else{
			$this -> load -> model('Shop_user_model');
			$shopCode = $this -> session -> userdata('shop_code');
			$captcha = $this -> input -> post('captcha');
			if ($shopCode != $captcha) {
			    echo "<script>alert('验证码错误.$captcha')</script>";
			    $this -> load -> view('shop_user_login');
			} else {
    			$login_user['username'] = $this->input->post('username');
    			$login_user['password'] = md5($this -> input -> post('password') . 'kaku365%^&RFGHJRFGB');
    			if($this -> Shop_user_model ->login($login_user)){
    				redirect('manager');
    			}else{
    				echo "<script>alert('登录失败!')</script>";
    				$this -> load -> view('shop_user_login');
    			}
			}
		}
	}


    /**
     * 退出
     * @author chenjia404
     * @date   2015-03-09
     */
    public function logout()
    {
        $this->input->set_cookie('uid', '', 3600 * 24 * 30);
        $this->input->set_cookie('token', '', 3600 * 24 * 30);
        redirect('shop_user/login');
    }



	/**
	 * 验证码
	 */
	public function captcha() {
        $this->load->helper('image');
        $verifyCode = generateVerifyCodeImg();
        $this->session->set_userdata('shop_code', $verifyCode['code']);
        header("Content-type: image/gif");
        echo $verifyCode['img'];
        exit;
	}


	/**
	 * 商家名片
	 * @author chenjia404
	 * @date   2015-01-25
	 */
	public function Businesscard()
	{

	}
}
