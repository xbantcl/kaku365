<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> model('cart_model');
	}

	public function index() {
		$user_id = $this -> session -> userdata('id');
		$data['shop_id'] = $this -> cart_model -> get_cart_shop_id($user_id);
		if ($user_id) {
			$this -> load -> model('user_model');
			$data['user'] = $this -> user_model -> getUserById($user_id);
			$data['carts'] = $this -> user_model -> get_carts_by_id($user_id);
			$data['address'] = $this -> user_model -> getDeliveryAddressById($user_id);
			$data['carts_count'] = $this -> user_model -> get_carts_count_by_id($user_id);
		} else {
			redirect('user/login');
		}

		$this -> load -> view('cart_view', $data);
	}

	/**
	 * 添加订单
	 */
	public function join_order() {
		$goods = array();
		$this -> load -> model('order_model');
		$this -> load -> model('cart_model');
		$carts = $this -> input -> post('carts');
		$shop_id = $this -> input -> post('shop_id');
		$address_id = $this -> input -> post('address_id');
		$user = $this -> order_model -> get_delivery_address_by_id($address_id);
		$goodss = array();
		foreach ($carts as $c) {
			$res = $this -> cart_model -> get_cart_by_id($c);
			if ($res) {
				$goods['id'] = $res['goods_id'];
				$goods['amount'] = $res['amount'];
				$goodss[] = $goods;
			}
		}
		$res = $this -> order_model -> addOrder($goodss, $user, $shop_id);
		if ($res) {
			foreach ($carts as $c) {
				$this -> cart_model -> del_cart_by_id($c);
			}
			echo "success";
		} else {
			echo "false";
		}
	}

	/**
	 * 更新购物车商品数量个小计
	 */
	public function update_amount() {

		$cart_id = $this -> input -> post('cart_id');
		$cart['amount'] = $this -> input -> post('amount');
		$cart['subtotal'] = $this -> input -> post('subtotal');
		$res = $this -> cart_model -> update_cart_by_id($cart, $cart_id);

		if ($res) {echo "success";
		} else {echo "false";
		}
	}

}

/* End of file cart.php */
/* Location: ./application/controllers/cart.php */
