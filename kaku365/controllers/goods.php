<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Goods extends CI_Controller {

	public function __construct() {
		parent::__construct();
//		$this -> load -> model('goods_model');
	}

	public function index() {
		$this -> load -> view('goods/goods_view');
	}
	
	public function goods_list(){
		$this -> load -> view('goods_list');
	}


	/**
	 * @author chenjia404
	 * @date    2015-01-14
	 * @param int $goods_id 单个商品id
	 */
	public function view($goods_id)
	{
		if(!is_numeric($goods_id))
			return ;
		$this->load->model('User_Goods_model');
		$Goods = $this->User_Goods_model->getGoods($goods_id);

		$data['Goods'] = $Goods;

		$this -> load -> model('Shop_model');
		$shop_id = $Goods['shop_id'];
		$data['shop'] = $this -> Shop_model -> getShop($shop_id);
		$data['category'] = $this -> Shop_model -> getGoodsCategory($shop_id);
		$data['s_category'] = $this -> Shop_model -> getSecondCategory($shop_id);
		$data['th_category'] = $this -> Shop_model -> getThirdCategory($shop_id);
		$user_id = $this -> session -> userdata('id');
		if($user_id){
			$this -> load -> model('user_model');
			$data['user'] = $this -> user_model -> getUserById($user_id);
			$data['carts'] = $this -> user_model -> get_carts_by_id($user_id);
			$data['carts_count'] = $this -> user_model -> get_carts_count_by_id($user_id);
		}
		$this -> load -> view('goods/goods_view',$data);
	}


    /**
     * @author chenjia404
     * @date   2015-03-07
     * @param $goods_id
     */
    public function view_ajax($goods_id)
    {
        if(!is_numeric($goods_id))
            return ;
        $this->load->model('User_Goods_model');
        $Goods = $this->User_Goods_model->getGoods($goods_id);

        $data['Goods'] = $Goods;

        $this -> load -> model('Shop_model');
        $shop_id = $Goods['shop_id'];
        $data['shop'] = $this -> Shop_model -> getShop($shop_id);
        $json['html'] = $this ->load->view('goods/goods_view_ajax',$data);
    }
}

/* End of file goods.php */
/* Location: ./application/controllers/goods.php */

