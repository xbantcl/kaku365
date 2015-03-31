<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Search extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> model('search_model');
		$this -> load -> library('pagination');
		$this -> load -> library('session');
	}

	public function getPages() {
		$data['shop'] = $this -> search_model -> getPages();
	}

	/**
	 * @abstract 查询商店数据数据
	 * @access public
	 * @return view
	 */
	public function index() {
		if (!$this -> uri -> segment(3) && !$this -> input -> post('string')) {
			$this -> session -> unset_userdata('string');
		}

		$string = $this -> input -> post('string') ? $this -> input -> post('string') : $this -> session -> userdata('string');
		$num_page = $this -> uri -> segment(3, 1);
		$config['base_url'] = site_url('search/index');
		$config['per_page'] = 5;
		if (!$string) {
			$config['total_rows'] = $this -> search_model -> getTotal();
			$this -> pagination -> initialize($config);
			$data['shop'] = $this -> search_model -> getPage($config['per_page'], $num_page - 1);
			// $data['page'] = $this -> pagination -> create_links();
			$data['page'] = paginationByTotalPage($num_page, $config['total_rows']);
		} else {
			$this -> session -> set_userdata('string', $string);
			$config['total_rows'] = $this -> search_model -> getTotal($string);
			$this -> pagination -> initialize($config);
			$data['shop'] = $this -> search_model -> getPages($string, $config['per_page'], $num_page - 1);
			//$data['page'] = $this -> pagination -> create_links();
			$data['page'] = paginationByTotalPage($num_page, $config['total_rows']);
		}
		$user_id = $this -> session -> userdata('id');
		if ($user_id) {
			$this -> load -> model('user_model');
			$data['user'] = $this -> user_model -> getUserById($user_id);
		}
		$this -> load -> view('search_view', $data);
	}

	/**
	 * @abstract 商品筛选
	 * @access public
	 * @return view
	 */
	public function filter()
    {
        $this->load->model('Shop_model');
        $this->load->model('Goods_model');
        $shop_id    = $this->input->get('shop_id', true);
        $words      = $this->input->get('words', true);
        $brand_id   = (int)$this->input->get('brand_id', true);
        $price      = (int)$this->input->get('price', true);
        $cate_id    = $this->input->get('cateid', true);
        $sort_price = $this->input->get('sort_price', true);
        switch ($sort_price)
        {
            case "desc":
                break;
            default:
                $sort_price = 'asc';
                break;
        }
        $data['sort_price'] = $sort_price;
		$user_id = $this -> session -> userdata('id');
        $limit = 30;
		$data['page'] = (int)$this -> input -> get('p', TRUE);
        if($data['page'] < 1)
            $data['page'] = 1;
		$data['shop'] = $this -> Shop_model -> getShop($shop_id);
		$data['category'] = $this -> Shop_model -> getGoodsCategory($shop_id);
		$data['s_category'] = $this -> Shop_model -> getSecondCategory($shop_id);
		$data['th_category'] = $this -> Shop_model -> getThirdCategory($shop_id);
		if ($user_id) {
			$this -> load -> model('user_model');
			$data['user'] = $this -> user_model -> getUserById($user_id);
			$data['carts'] = $this -> user_model -> get_carts_by_id($user_id);
			$data['carts_count'] = $this -> user_model -> get_carts_count_by_id($user_id);
		}
		if ($cate_id) {
			$this -> load -> model('search_model');
			$data['is_words'] = FALSE;
			$data['tag'] = $this -> search_model -> get_category_by_id($cate_id);
			$data['root_pid'] = $this -> Goods_model -> get_root_Category($cate_id);
			$data['brands'] = $this -> search_model -> get_brands_by_id($shop_id, $cate_id);
			$data['goods'] = $this -> Goods_model -> get_goods_by_cate_id($shop_id, $cate_id,$brand_id,$price,$data['page'],$limit,$sort_price);
			$goods_count = $this -> Goods_model -> get_goods_amount_by_cate_id($shop_id, $cate_id,$brand_id,$price);
			$data['goods_count'] = $goods_count[0]['goods_count'];
            $data['all_page'] = ceil($data['goods_count']/$limit);
            unset($_GET['p']);
			$this -> load -> view('list', $data);
		} else if($words){
			$data['goods'] = $this -> Goods_model -> get_goods_by_words($shop_id,$words);
			$data['goods_count'] = count($data['goods']);
			$data['is_words'] = TRUE;
			$this -> load -> view('list', $data);
		}
	}
	
	/**
	 * @abstract ajax-按价格返回商品数据
	 * @access public
	 * @return ajax string 
	 */
	 public function search_by_price(){
	 	$this -> load -> model('goods_model');
		$this -> load -> model('shop_model');
	 	$shop_id = $this -> input -> post('shop_id', TRUE);
		$cate_id = $this -> input -> post('cate_id', TRUE);
		$s_price = $this -> input -> post('s_price', TRUE);
		$e_price = $this -> input -> post('e_price', TRUE);
		$data['shop'] = $this -> shop_model -> getShop($shop_id);
		$data['goods'] = $this -> goods_model -> get_goods_by_price($shop_id,$cate_id,$s_price,$e_price);
		return $this->load->view('list_main_div',$data);
	 }

}

/* End of file search.php */
/* Location: ./application/controllers/search.php */
