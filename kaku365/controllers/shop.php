<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> model('shop_model');
		$this -> load -> model('goods_model');
	}

	/**
	 * 商店首页数据展示
	 */
	public function index() {
		$shop_id = $this -> uri -> segment(3);
		if(!$shop_id) show_404();
		$data['shop'] = $this -> shop_model -> getShop($shop_id);
		$data['category'] = $this -> shop_model -> getGoodsCategory($shop_id);
		$data['s_category'] = $this -> shop_model -> getSecondCategory($shop_id);
		$data['th_category'] = $this -> shop_model -> getThirdCategory($shop_id);
		$data['goods'] = $this -> goods_model -> getGoods($shop_id);
		$user_id = $this -> session -> userdata('id');
		if($user_id){
			$this -> load -> model('user_model');
			$data['user'] = $this -> user_model -> getUserById($user_id);
			$data['carts'] = $this -> user_model -> get_carts_by_id($user_id);
			$data['carts_count'] = $this -> user_model -> get_carts_count_by_id($user_id);
		}
		$this -> load -> view('shop/shop_view', $data);
	}


	public function goods() {
		$shop_id = $this -> input -> post('shop_id');
		$category_pid = $this -> input -> post('category_pid');
		$category_id = $this -> input -> post('category_id');
		$data['goods'] = $this -> goods_model -> getSecondCategoryGoods($shop_id, $category_id);
		if (empty($data['goods'])) {
			$string = '<h1>对不起,暂时没有该类商品.</h1>';
		} else {
			$string = $this -> load -> view('shop_goods', $data);
		}
		echo $string;
	}

}

/* End of file shop.php */
/* Location: ./application/controllers/shop.php */
