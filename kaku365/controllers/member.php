<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//		$this -> load -> model('member_model');
	}

	public function index() {
		$this -> load -> view('member_view');
	}

	//收藏
	public function collect() {
		$this -> load -> view('member_collect');
	}

	//排序
	public function order() {
		$this -> load -> view('member_order');
	}

	//排序详细信息
	public function order_info() {
		$this -> load -> view('member_order_info');
	}

	//收货地址
	public function address() {
		$this -> load -> view('person_address');
	}

	//投诉
	public function complain() {
		$this -> load -> view('person_complain');
	}
	
	//用户详细信息
	public function data(){
		$this -> load -> view('person_data');
	}
	
	//密码修改
	public function password(){
		$this -> load -> view('person_password');
	}

}

/* End of file member.php */
/* Location: ./application/controllers/member.php */
