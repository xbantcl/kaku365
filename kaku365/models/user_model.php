<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_model extends MY_Model {

	public $table = 'user';

	public function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	/**
	 * 获取用户列表
	 * @author wuanbo
	 * @date 2015-01
	 * @return mixed
	 */
	public function getUserList() {

		$this -> db -> from($this -> table);
		$this -> db -> where('status', 1);
		$query = $this -> db -> get();
		return $query -> result_array();
	}

	/**
	 * 删除用户
	 * @param int $userid 用户ID
	 *
	 */
	public function delUser($userid) {
		$data['status'] = 0;
		$where['id'] = $userid;
		return $this -> _update($data, $where);
	}

	/**
	 * 搜索用户
	 * @author wuanbo
	 * @date 2015-01
	 * @param array $where
	 * @param array $like
	 * @param int $page
	 * @param int $count
	 * @return array
	 */
	public function searchUser($where = array(), $like = array(), $page = 1, $count = 20) {
		$where['status'] = 1;
		$limit['limit'] = $count;
		$limit['offset'] = $count * ($page - 1);
		return $this -> _get('id,username,address,contacts,phone', $where, $like, '', $limit);
	}

	/**
	 * 添加用户
	 * @author chenmeng
	 * @date 2015-01
	 */
	public function insertUser($user) {
		if ($this -> db -> insert('user', $user)) {
			$this -> db -> select('id,username');
			$this -> db -> from('user');
			$this -> db -> where('username', $user['username']);
			$query = $this -> db -> get();
			return $query -> row();
		}
		return FALSE;
	}

	/**
	 * 检查用户名是存在
	 * @author chenmeng
	 * @date 2015-01
	 */
	public function checkUserName($username) {
		$this -> db -> select('username');
		$this -> db -> from('user');
		$this -> db -> where('username', $username);
		return $this -> db -> count_all_results();
	}

	/**
	 * 检查用户邮箱是存在
	 * @author chenmeng
	 * @date 2015-01
	 */
	public function checkEmail($email) {
		$this -> db -> from('user');
		$this -> db -> where('email', $email);
		return $this -> db -> count_all_results();
	}

	/**
	 * 检查用户合法登录
	 * @author chenmeng
	 * @date 2015-01
	 */
	public function checkUser($username, $password) {
		$this -> db -> select('reg_date');
		$this -> db -> from('user');
		$this -> db -> where('username', $username);
		$this -> db -> where('status', 1);
		$res = $this -> db -> get() -> row();
		if (!$res)
			return FALSE;
		$this -> db -> select('id,username');
		$this -> db -> from('user');
		$this -> db -> where('password', md5($password . $res -> reg_date));
		$query = $this -> db -> get();
		if ($query -> num_rows() == 1) {
			$this -> db -> where('username', $username);
			$this -> db -> update($this -> table, array('last_login' => date('Y-m-d H:i:s')));
			return $query -> row();
		}
		return FALSE;
	}

	/**
	 * 根据用户名获取用户信息
	 */
	public function getUserByName($username) {
		$this -> db -> select('id,username,contacts,address,sex,phone,last_login');
		$this -> db -> from('user');
		$this -> db -> where('username', $username);
		$query = $this -> db -> get();
		return $query -> row();
	}

	/**
	 * 根据ID获取用户信息
	 */
	public function getUserById($id) {
		$this -> db -> select('id,username,contacts,address,sex,phone,last_login');
		$this -> db -> from('user');
		$this -> db -> where('id', $id);
		$query = $this -> db -> get();
		return $query -> row();
	}

	/**
	 * 根据用户ID获取收获地址
	 */
	public function getDeliveryAddressById($user_id) {
		$this -> db -> select('id,name,phone,address');
		$this -> db -> from('delivery_address');
		$this -> db -> where('user_id', $user_id);
		$query = $this -> db -> get();
		return $query -> result_array();
	}
	
	/**
	 * 根据用户ID获取购物车数据
	 */ 
	public function get_carts_by_id($user_id){
		$this -> db -> select('c.id,c.amount,c.subtotal');
		$this -> db -> select('g.id as goods_id,g.name as goods_name,g.cover_image as goods_img,g.price as goods_price');
		$this -> db -> from('cart as c');
		$this -> db -> join('goods as g', 'c.goods_id = g.id', 'left');
		$this -> db -> where('c.user_id', $user_id);
		$this -> db -> where('c.status', 1);
		$query = $this -> db -> get();
		return $query -> result_array();
	}
	
	/**
	 * 根据用户ID获取购物车统计数据数据
	 */
	public function get_carts_count_by_id($user_id){
		$this -> db -> select('sum(amount) as number');
		$this -> db -> select('sum(subtotal) as total');
		$this -> db -> from('cart');
		$this -> db -> where('user_id', $user_id);
		$this -> db -> where('status','1');
		return $this -> db -> get() -> row_array();
	}
	
	/*
	 * 根据收获地址ID删除数据
	 * return bool true(成功) false(失败)
	 */ 
	 public function del_delivery_address($id){
	 	$this->db->where('id', $id);
		return $this->db->delete('delivery_address');
	 }
	 
	/**
	 * 根据收货地址ID更新用户收获地址
	 * return int 1(成功) 0(失败)
	 */
	public function update_delivery_address($address){
		$this -> db -> where('id', $address['id']);
		$this -> db -> update('delivery_address', $address);
		return $this -> db -> affected_rows();
	}
	
	/**
	 * 添加用户收货地址
	 * return bool true(成功) false(失败)
	 */
	 public function insert_delivery_address($address){
	  return $this->db->insert('delivery_address', $address); 
	 }
	/**
	 * 根据用户ID更新用户数据
	 */
	public function update_user_data($user_id, $user) {
		$this -> db -> where('id', $user_id);
		$this -> db -> update('user', $user);
		return $this -> db -> affected_rows();
	}
	
	public function update_password($user_id,$password){
		$this -> db -> select('reg_date');
		$this -> db -> where('id', $user_id);
		$this -> db -> from('user');
		$res = $this -> db -> get()->row();
		$reg_date = $res->reg_date;
		$user['password'] = md5($password.$reg_date);
		$this -> db -> where('id', $user_id);
		$this -> db -> update('user', $user);
		return $this -> db -> affected_rows();
	}

    public function getWeekUsers(){
        $thistime = strtotime(date('Y-m-d H:i:s',time()));
        $weektime = 7*24*3600;
        $datetime = date('Y-m-d H:i:s',$thistime-$weektime);
        $sql = "select * from user where reg_date>='$datetime'";
        return $this ->db->query($sql)->num_rows();

    }

}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */
