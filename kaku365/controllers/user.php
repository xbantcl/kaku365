<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> model('user_model');

	}

	/**
	 * 用户首页
	 */
	public function index() {
		$this -> check_login();
		if ($this -> session -> userdata('login_admin') && $this -> session -> userdata('user_admin')) {
			$user_id = $this -> session -> userdata('user_admin');

			$data['user'] = $this -> user_model -> getUserById($user_id);
			$data['address'] = explode('-', $data['user'] -> address);
		} else {

			$username = $this -> session -> userdata('username');
			$data['user'] = $this -> user_model -> getUserByName($username);
			$data['address'] = explode('-', $data['user'] -> address);
		}

		$this -> load -> view('user/user_home', $data);
	}

    /**
     * 生成验证码
     * @author wuanbo
     * @date 2015-01
     */

    public function code(){
        $this->load->helper('captcha');
        $vals = array(
            'word_length' => 4,
            'img_width' => 100,
            'img_height'=>42
        );
        $code = create_captcha($vals);
        $this->session->set_userdata('user_code',$code);
    }

	/**
	 * 用户注册
	 */
	public function register() {

		if (!$_POST) {
			$this -> load -> view('user_register');
		} else {
            $captcha = strtolower($this -> input ->post('captcha'));

            $code = strtolower($this->session->userdata('user_code'));
            if ($captcha == $code){
                $user['reg_date'] = date('Y-m-d H:i:s');
                $user['last_login'] = date('Y-m-d H:i:s');
                $user['ip'] = $this -> input -> ip_address();
                $user['username'] = $this -> input -> post('username');
                $user['phone'] = $this -> input -> post('phone');
                $user['password'] = md5($this -> input -> post('password') . $user['reg_date']);
                $user_data = $this -> user_model -> insertUser($user);
                if ($user_data) {
                    redirect('user/login');
                } else {
                    echo "<script>alert('注册失败')</script>";
                    $this -> load -> view('user_register');
                }
            }
            else{
                echo "<script>alert('对不起,验证码错误.')</script>";
                $this -> load -> view('user_register');
            }

		}
	}

	/**
	 * 用户登录
	 */
	public function login() {
		$username = $this -> input -> post('username');
		if (!$username) {
			if (isset($_SERVER['HTTP_REFERER'])) {
				$this -> session -> set_userdata('url', $_SERVER['HTTP_REFERER']);
			}
			$this -> load -> view('user_login');
		} else {
			$password = $this -> input -> post('password');
			$user_data = $this -> user_model -> checkUser($username, $password);
			if ($user_data) {
				$this -> session -> set_userdata($user_data);
				redirect('welcome/index');
				/*
				直接跳到首页，不用跳到上次浏览页面
				$url = $this -> session -> userdata('url');
				if ($url) {
					redirect($url);
				} else {
					redirect('welcome/index');
				}
                */
			} else {
				echo "<script>alert('登录失败')</script>";
				$this -> load -> view('user_login');
			}
		}
	}

	/**
	 * 用户注销
	 */
	public function logout() {
		$this -> session -> sess_destroy();
		redirect('user/login');
	}

	/**
	 * 验证码
	 */
	public function captcha() {
		$this -> load -> helper('captcha');
		$vals = array('word_length' => 4, 'img_width' => 420, 'img_height' => 34);
		$code = create_captcha($vals);
		$this -> session -> set_userdata('code', $code);
	}

	/**
	 * 检查用户名是否存在
	 */
	public function check_username() {
		$username = $this -> input -> post('username');
		if (!$username)
			show_404();
		$result = $this -> user_model -> checkUserName($username);
		if ($result != 1) {
			echo "true";
		} else {
			echo "false";
		}
	}

	/**
	 * 检查邮箱是否被注册
	 */
	public function check_email() {
		$email = $this -> input -> post('email');
		if (!$email)
			show_404();
		$result = $this -> user_model -> checkEmail($email);
		if ($result != 1) {echo "true";
		} else {echo "false";
		}
	}

	/**
	 * 用户订单管理
	 */
	public function order() {
		$this -> check_login();
		$this -> load -> model('order_model');
		$user_id = $this -> session -> userdata('id');
		$data['user'] = $this -> user_model -> getUserById($user_id);
		$data['orders'] = $this -> order_model -> getOrders($user_id);
		$data['order_count'] = $this -> order_model -> getOrdersCount($user_id);
		$data['order_s_count'] = $this -> order_model -> getOrdersSuccessCount($user_id);
		$this -> load -> view('user/user_order', $data);
	}

	/**
	 * 用户订单筛选查询
	 */
	public function order_selection() {
		$this -> check_login();
		$terms = $this -> input -> post('terms');
		if (!$terms)
			show_404();
		$this -> load -> model('order_model');
		$user_id = $this -> session -> userdata('id');
		$data['orders'] = $this -> order_model -> getOrdersOnTerms($user_id, $terms);
		$data['order_count'] = $this -> order_model -> getOrdersCount($user_id);
		$data['order_s_count'] = $this -> order_model -> getOrdersSuccessCount($user_id);
		$html = $this -> load -> view('user/user_order_div', $data);
		return $html;
	}

	/**
	 * 获取用户订单详情
	 */
	public function order_detail($order_id=0) {
		$this -> check_login();
		$this -> load -> model('order_model');
        $user_id = $this -> session -> userdata('id');
        $data['user'] = $this -> user_model -> getUserById($user_id);
		$data['order'] = $this -> order_model -> getOrder($order_id);
		$data['order_id'] = date("YmdHis",strtotime($data['order']['created_at']));
		$data['order_detail'] = $this -> order_model -> getOrderDetails($order_id);
		$data['details_count'] = $this -> order_model -> getDetailsCount($order_id);
		$this -> load -> view('user/user_order_detail', $data);
	}

	/**
	 * 将物品从订单中移除
	 */
	public function return_goods() {
		$this -> check_login();
		$order_detail_id = $this -> input -> post('order_detail_id');
		if (!$order_detail_id)
			show_404();
		$this -> load -> model('order_model');
		$result = $this -> order_model -> delGoods($order_detail_id);
		if ($result == 'cant') {
			echo $result;
		} elseif ($result == 'false') {
			echo $result;
		} else {
			$data['order_id'] = $result;
			$data['order_detail'] = $this -> order_model -> getOrderDetails($result);
			$data['details_count'] = $this -> order_model -> getDetailsCount($result);
			$html = $this -> load -> view('user/user_order_detail_div', $data);
			return $html;
		}

	}

	/**
	 * 用户收藏管理
	 */
	public function collect() {
		$this -> check_login();
		$this -> load -> model('collect_model');
		$this -> load -> model('goods_model');
		$user_id = $this -> session -> userdata('id');
		$data['user'] = $this -> user_model -> getUserById($user_id);
		$data['collects'] = $this -> collect_model -> getCollects($user_id);
		// 获取商品编码
		foreach ($data['collects'] as $index => $item) {
		    $productCode = $this->goods_model->getGoodsInfo('product_code', $item['goods_id'])->product_code;
		    if (empty($productCode)) {
		        $productCode = '';
		    }
		    $data['collects'][$index]['product_code'] = $productCode;
		}
		$this -> load -> view('user/user_collect', $data);
	}

	/**
	 * 添加用户收藏
	 */
	public function join_collect() {
		$this -> check_login();
		$goods_id = $this -> input -> post('goods_id');
		if (!$goods_id)
			show_404();
		$this -> load -> model('collect_model');
		$user_id = $this -> session -> userdata('id');
		$collect['user_id'] = $user_id;
		$collect['goods_id'] = $goods_id;
		$collect['collect_date'] = date('Y-m-d H:i:s');
		$result = $this -> collect_model -> insertCollect($collect);
		echo $result;
	}

	/**
	 * 删除收藏
	 */
	public function del_collect() {
		$collect_id = $this -> input -> post('collect_id');
		$goods_id = $this -> input -> post('goods_id');
		if (!$collect_id && !$goods_id)
			show_404();
		$this -> check_login();
		$this -> load -> model('collect_model');
		$user_id = $this -> session -> userdata('id');
		if (!$goods_id) {
			$result = $this -> collect_model -> delCollect($collect_id);
		} else {
			foreach ($goods_id as $g) {
				$result = $this -> collect_model -> delCollects($user_id, $g);
			}
		}
		if ($result) {
			$data['collects'] = $this -> collect_model -> getCollects($user_id);
			$html = $this -> load -> view('user/user_collect_div', $data);
			return $html;
		} else {
			echo 'false';
		}
	}

	/**
	 * 将商品添加到购物车中
	 */
	public function join_cart() {
		$user_id = $this -> session -> userdata('id');
		if(!$user_id){ echo 'no_login';exit;}
		$goods_id = $this -> input -> post('goods_id');
		$shop_id = $this -> input -> post('shop_id');
        $amount = $this -> input -> post('amount');
		$cart_shop_id = $this -> _get_cart_shop_id();

		if ($cart_shop_id == 0 || $shop_id == $cart_shop_id) {
			if (!$goods_id)
				show_404();
			$this -> load -> model('cart_model');
			if (!is_array($goods_id)) {
				if (empty($shop_id)) {
					$this->load->model('goods_model');
					$shop_id = $this->goods_model->getGoodsShopId($goods_id);
				}
				$cart['amount'] = $amount ? $amount :'1';
				$cart['goods_id'] = $goods_id;
				$cart['shop_id'] = $shop_id;
				$cart['user_id'] = $user_id;
				$cart['created_at'] = date('Y-m-d H:i:s');
				echo $this -> cart_model -> insert_cart($cart);
			} else {
				foreach ($goods_id as $g) {
					if (empty($shop_id)) {
						$this->load->model('goods_model');
						$shop_id = $this->goods_model->getGoodsShopId($g);
					}
					$cart['amount'] = 1;
					$cart['goods_id'] = $g;
					$cart['shop_id'] = $shop_id;
					$cart['user_id'] = $user_id;
					$cart['created_at'] = date('Y-m-d H:i:s');
					$result = $this -> cart_model -> insert_cart($cart);
				}
				echo $result;

			}
		} else if ($shop_id != $cart_shop_id) {
			echo 'error';
		}

	}

	/**
	 * 清空购物车
	 */
	public function clear_cart() {
		$user_id = $this -> session -> userdata('id');
		$this -> load -> model('cart_model');
		$res = $this -> cart_model -> clear_cart_by_user_id($user_id);
		if ($res) {
			echo "success";
		} else {
			echo "false";
		}
	}

	/**
	 * 获取当前购物车店铺id
	 */
	public function _get_cart_shop_id() {
		$user_id = $this -> session -> userdata('id');
		$this -> load -> model('cart_model');
		$res = $this -> cart_model -> get_cart_shop_id($user_id);
		if ($res) {
			return $res;
		} else {
			return 0;
		}
	}

	/**
	 * 将物品从购物车中删除
	 */
	public function del_cart() {
		$cart_id = $this -> input -> post('cart_id');
		if (!$cart_id)
			show_404();
		$this -> check_login();
		$this -> load -> model('cart_model');
		if (is_array($cart_id)) {
			foreach ($cart_id as $c) {
				$result = $this -> cart_model -> del_cart_by_id($c);
			}
		} else {
			$result = $this -> cart_model -> del_cart_by_id($cart_id);
		}
		if ($result) {
			echo "success";
		} else {
			echo "false";
		}
	}

	/**
	 * 用户密码设置
	 */
	public function set_password() {
		$this -> check_login();
		$old_pwd = $this -> input -> post('old_password');
		$user_id = $this -> session -> userdata('id');
		$username = $this -> session -> userdata('username');
		$new_pwd = $this -> input -> post('new_password');
		$c_new_pwd = $this -> input -> post('c_new_password');
		if ($old_pwd && $new_pwd) {
			$res = $this -> user_model -> checkUser($username, $old_pwd);
			if ($res) {
				if ($this -> user_model -> update_password($user_id, $new_pwd)) {
					echo "<script>alert('密码修改成功!')</script>";
					$data['user'] = $this -> user_model -> getUserById($user_id);
					$this -> load -> view('user/user_set_password.php', $data);
				}
			} else {
				echo "<script>alert('密码错误!')</script>";
				$data['user'] = $this -> user_model -> getUserById($user_id);
				$this -> load -> view('user/user_set_password.php', $data);
			}
		} else {
			$data['user'] = $this -> user_model -> getUserById($user_id);
			$this -> load -> view('user/user_set_password.php', $data);
		}
	}

	/**
	 * 用户收货地址设置
	 */
	public function set_address() {
		$this -> check_login();
		$user_id = $this -> session -> userdata('id');
		$data['address'] = $this -> user_model -> getDeliveryAddressById($user_id);
		$data['user'] = $this -> user_model -> getUserById($user_id);
		$this -> load -> view('user/user_set_address.php', $data);
	}

	/**
	 * 用户收货地址数据更新
	 */
	public function update_delivery_address() {
		$this -> check_login();
		$user_id = $this -> session -> userdata('id');
		$phone = $this -> input -> post('phone');

	}

	/**
	 * 添加用户收货地址
	 */
	public function insert_delivery_address() {
		$this -> check_login();
		$name = $this -> input -> post('name');
		if (!$name)
			show_404();
		$user_id = $this -> session -> userdata('id');
		$address['phone'] = $this -> input -> post('phone');

		$url = $this -> input -> post('url');
		$address['address'] = $this -> input -> post('province') . '-' . $this -> input -> post('city') . '-' . $this -> input -> post('area') . '-' . str_replace("-", "—", $this -> input -> post('address'));
		$address['name'] = $name;
		$address['user_id'] = $user_id;
		$res = $this -> user_model -> insert_delivery_address($address);
		

			redirect($url);
		
		

	}

	/**
	 * 删除用户收货地址
	 */
	public function del_delivery_address() {
		$this -> check_login();
		$address_id = $this -> input -> post('address_id');
		if (!$address_id)
			show_404();
		$res = $this -> user_model -> del_delivery_address($address_id);
		if ($res) {
			$user_id = $this -> session -> userdata('id');
			$data['address'] = $this -> user_model -> getDeliveryAddressById($user_id);
			$html = $this -> load -> view('user/user_set_address_div.php', $data);
			return $html;
		} else {
			echo 'false';
		}
	}

	/**
	 * 用户数据更新
	 * 判断是否登录,获取cookie中的id,获取用户提交表单信息,更新数据到数据库,跳转到用户首页面
	 */
	public function update_data() {
		$this -> check_login();
		$user_id = $this -> session -> userdata('id');
		$user['contacts'] = $this -> input -> post('contacts');
		$user['phone'] = $this -> input -> post('phone');
		$user['sex'] = $this -> input -> post('sex');
		$user['address'] = $this -> input -> post('province') . '-' . $this -> input -> post('city') . '-' . $this -> input -> post('area') . '-' . str_replace("-", "—", $this -> input -> post('address'));
		if (!$user['contacts'])
			show_404();
		$status = $this -> user_model -> update_user_data($user_id, $user);
		echo $status;
	}

	/**
	 * 检查是否登录
	 * 判断是否设置了用户的ID和用户名COOKIE,其中一样没有设置都跳转到登录页面.
	 */
	public function check_login() {

		if (!($this -> session -> userdata('login_admin') && $this -> session -> userdata('user_admin'))) {
			if (!$this -> session -> userdata('id') || !$this -> session -> userdata('username')) {
				redirect('user/login');
			}
		}

	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
