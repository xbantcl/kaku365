<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Order_model extends MY_Model {

	public function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	/**
	 * 根据用户id查询订单数据
	 */
	public function getOrders($user_id) {
		$this -> db -> select('o.id,s.id as shop_id,o.price,s.name as shop_name,o.created_at,o.status');
		$this -> db -> from('order as o');
		$this -> db -> join('shop as s', 's.id = o.shop_id', 'left');
		$this -> db -> where('o.user_id', $user_id);
		$this -> db -> where('o.status !=', 0);
		$query = $this -> db -> get();
		return $query -> result_array();
	}

	/**
	 * 根据用户id查询订单数据
	 */
	public function getOrder($order_id) {
		$where['id'] = $order_id;
        $this->table = 'order';
        $data = $this->_get('*',$where);
        if(isset($data[0]['id']))
            return $data[0];
		return false;
	}

	/**
	 * 根据用户id和条件查询订单数据
	 */
	public function getOrdersOnTerms($user_id, $terms) {
		if ($terms == 'all') {
			return $this -> getOrders($user_id);
		}
		if ($terms == 'month') {
			$selection = 'TO_DAYS(NOW()) - TO_DAYS(created_at) <= 30';
			$this -> db -> select('o.id,s.id as shop_id,o.price,s.name as shop_name,o.created_at,o.status');
			$this -> db -> from('order as o');
			$this -> db -> join('shop as s', 's.id = o.shop_id', 'left');
			$this -> db -> where('o.user_id', $user_id);
			$this -> db -> where('o.status !=', 0);
			$this -> db -> where($selection);
			$query = $this -> db -> get();
			return $query -> result_array();
		}
		if ($terms == 'dealing') {
			$this -> db -> select('o.id,s.id as shop_id,o.price,s.name as shop_name,o.created_at,o.status');
			$this -> db -> from('order as o');
			$this -> db -> join('shop as s', 's.id = o.shop_id', 'left');
			$this -> db -> where('o.user_id', $user_id);
			$this -> db -> where('o.status !=', 0);
			$this -> db -> where('o.status !=', 3);
			$query = $this -> db -> get();
			return $query -> result_array();
		}
		if ($terms == 'done') {
			$this -> db -> select('o.id,s.id as shop_id,o.price,s.name as shop_name,o.created_at,o.status');
			$this -> db -> from('order as o');
			$this -> db -> join('shop as s', 's.id = o.shop_id', 'left');
			$this -> db -> where('o.user_id', $user_id);
			$this -> db -> where('o.status', 3);
			$query = $this -> db -> get();
			return $query -> result_array();
		}
	}

	/**
	 * 根据用户id查询订单统计数据
	 */
	public function getOrdersCount($user_id) {
		$this -> db -> select('count(id) as number');
		$this -> db -> select('sum(price) as total');
		$this -> db -> from('order');
		$this -> db -> where('user_id', $user_id);
		$this -> db -> where_not_in('status', 0);
		$query = $this -> db -> get();
		return $query -> row();
	}

	/**
	 * 根据用户id获取已成功交易订单数量数据
	 */
	public function getOrdersSuccessCount($user_id) {
		$this -> db -> select('sum(price) as s_total');
		$this -> db -> select('count(id) as s_number');
		$this -> db -> from('order');
		$this -> db -> where('user_id', $user_id);
		$this -> db -> where('status', 2);
		$query = $this -> db -> get();
		return $query -> row();
	}

	/**
	 * 根据订单ID获取订单详细信息
	 */
	public function getOrderDetails($order_id) {
		$this -> db -> select('d.id,d.order_id,d.goods_id,d.amount,d.subtotal,d.detail,d.status');
		$this -> db -> select('g.name as goods_name,g.product_code,g.format,g.cover_image as goods_iamge,g.price as goods_price');
		$this -> db -> from('order_detail as d');
		$this -> db -> join('goods as g', 'g.id = d.goods_id', 'left');
		$this -> db -> where('d.order_id', $order_id);
		$this -> db -> where_not_in('d.status', 0);
		$query = $this -> db -> get();
		return $query -> result_array();
	}

	/**
	 * 根据订单ID获取订单详细信息的统计信息
	 */
	public function getDetailsCount($order_id) {
		$this -> db -> select('sum(amount) as number');
		$this -> db -> select('sum(subtotal) as total');
		$this -> db -> from('order_detail');
		$this -> db -> where('order_id', $order_id);
		$this -> db -> where_not_in('status', 0);
		$query = $this -> db -> get();
		return $query -> row();
	}

	/**
	 * 根据订单详细信息ID移除物品(退货)
	 */
	public function delGoods($order_detail_id) {
		$this -> db -> select('order_id,status');
		$this -> db -> where('id', $order_detail_id);
		$this -> db -> from('order_detail');
		$order_detail = $this -> db -> get() -> row();
		if ($order_detail -> status != 1) {
			return 'cant';
		} else {
			$data = array('status' => 0);
			$this -> db -> where('id', $order_detail_id);
			$res = $this -> db -> update('order_detail', $data);
			if ($res) {
				$this -> db -> select('sum(subtotal) as total');
				$this -> db -> where('order_id', $order_detail -> order_id);
				$this -> db -> where('status !=', 0);
				$this -> db -> from('order_detail');
				$order = $this -> db -> get() -> row();
				$data = array('price' => $order -> total);
				$this -> db -> where('id', $order_detail -> order_id);
				$result = $this -> db -> update('order', $data);
				if ($result)
					return $order_detail -> order_id;
			} else {
				return 'false';
			}
		}
	}

	/**
	 * 根据商家来查询订单
	 * @author chenjia404
	 * @date   2015-02-12
	 * @param $shop_id
	 */
	public function getOrderByShop($shop_id, $status = 0, $page = 1, $count = 10) {
		$this -> db -> from('order');
		$this -> db -> where('shop_id', $shop_id);
		if ($status > 0)
			$this -> db -> where('status', $status);
		$offset = $count * ($page - 1);
		$this -> db -> limit($count, $offset);
		$query = $this -> db -> get();
		return $query -> result_array();
	}

	/**
	 * 更新订单状态
	 * @author chenjia404
	 * @date   2015-02-12
	 * @param $order_id
	 * @param $status
	 * @return mixed
	 */
	public function updateOrder($order_id, $status) {
		$this -> db -> where('id', $order_id);
		$data['status'] = $status;
		$this -> db -> update('order', $data);
		return $this -> db -> affected_rows();
	}

	/**
	 * 下单
	 * @author chenjia404
	 * @date   2015-02-12
	 * @param array $goods
	 * @param array $user
	 * @param int $shop_id
	 * @return bool
	 */
	public function addOrder($goods, $user, $shop_id) {
		$price_total = 0;
		$order_details = array();
		$this -> load -> model('User_Goods_model');
		foreach ($goods as $go) {
			$one = $this -> User_Goods_model -> getGoods($go['id']);
			$order_detail['status'] = 1;
			$order_detail['goods_id'] = $go['id'];
			$order_detail['amount'] = $go['amount'];
			$order_detail['price'] = $one['price'];
			$order_detail['subtotal'] = $go['amount'] * $one['price'];
			$order_detail['detail']   = $go['detail'];
			$price_total += $order_detail['subtotal'];
			$order_details[] = $order_detail;
		}

		$order['user_id'] = $user['user_id'];
		$order['user_name'] = $user['name'];
		$order['user_tel'] = $user['phone'];
		$order['user_address'] = $user['address'];
		$order['status'] = 1;
		$order['price'] = $price_total;
		$order['shop_id'] = $shop_id;
		$order['created_at'] = date('Y-m-d H:i:s');
		$this -> db -> insert('order', $order);
		$order_id = $this -> db -> insert_id();

		if($order_id)
		{
			foreach ($order_details as $order_detail) {
				$order_detail['order_id'] = $order_id;
				if($this -> db -> insert('order_detail', $order_detail))
					continue;
				else
					return false;
			}
		}
		else
			return false;
		return true;
	}
	
	/**
	 * 根据ID获取收获地址数据
	 */
	 public function get_delivery_address_by_id($address_id){
	 	$this->db->from('delivery_address');
		$this->db->where('id',$address_id);
		$res = $this->db->get()->row_array();
		if($res) return $res;
		return FALSE;
	 }
}

/* End of file order_model.php */
/* Location: ./application/models/order_model.php */
