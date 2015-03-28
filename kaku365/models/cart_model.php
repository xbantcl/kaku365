<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Cart_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	public function insert_cart($cart) {
		$this -> db -> select('id');
		$this -> db -> from('cart');
		$this -> db -> where('user_id', $cart['user_id']);
		$this -> db -> where('goods_id', $cart['goods_id']);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return 'had';
		}
		$this -> db -> select('price');
		$this -> db -> from('goods');
		$this -> db -> where('id', $cart['goods_id']);
		$goods = $this -> db -> get() -> row();
		$cart['subtotal'] = $cart['amount'] * $goods -> price;
		if ($this -> db -> insert('cart', $cart)) {
			return 'true';
		}
		return 'false';
	}

	/**
	 * 根据购物车ID删除数据
	 */
	public function del_cart_by_id($cart_id) {
		$this -> db -> where('id', $cart_id);
		$result = $this -> db -> delete('cart');
		if ($result)
			return TRUE;
		return FALSE;
	}

	/**
	 * 根据用户ID获取购物车店铺ID
	 */
	public function get_cart_shop_id($user_id) {
		$this -> db -> select('shop_id');
		$this -> db -> from('cart');
		$this -> db -> where('user_id', $user_id);
		$this -> db -> limit(1);
		$res = $this -> db -> get() -> row();
		if ($res) {
			return $res -> shop_id;
		} else {
			return FALSE;
		}
	}

	/**
	 * 根据用户ID清空当前购物车
	 */
	public function clear_cart_by_user_id($user_id) {
		$this -> db -> where('user_id', $user_id);
		$result = $this -> db -> delete('cart');
		if ($result)
			return TRUE;
		return FALSE;
	}
	
	/**
	 * 根据购物车ID获取购物车数据
	 */
	 public function get_cart_by_id($cart_id){
		$this -> db -> from('cart');
		$this -> db -> where('id', $cart_id);
		$this -> db -> limit(1);
		$res = $this -> db -> get() -> row_array();
		if ($res) return $res;
		return FALSE;
	 }
	 
	 /**
	  * 根据ID更新购物车数据
	  */
	  public function update_cart_by_id($cart,$cart_id){
	  	$this -> db -> where('id', $cart_id);
		$this -> db -> update('cart', $cart);
		return $this -> db -> affected_rows();
	  }

}

/* End of file cart_model.php */
/* Location: ./application/models/cart_model.php */
