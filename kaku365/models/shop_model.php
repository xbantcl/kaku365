<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Shop_model extends MY_Model {

	public $table = 'shop';

	public function __construct() {
		parent::__construct();
		
		$this -> load -> database();

	}

	//获取指定店铺信息
	public function getShop($id) {
		$this -> db -> select('id,name,contacts,telephone,address,introduce,img_path');
		$this -> db -> from('shop');
		$this -> db -> where('id', $id);
		return $this -> db -> get() -> row_array();
	}


    /**
     * 根据用户获取店铺信息
     * @author chenjia404
     * @date   2015-03-09
     * @param $user_id
     * @return array
     */
    public function getShopByUser($user_id)
    {
        $where['user_id'] = $user_id;
        return $this->_get('*',$where);
    }

	//获取指定店铺物品一级分类信息
	public function getGoodsCategory($id) {
		$this -> db -> select('id,pid,name');
		$this -> db -> from('goods_category');
		$this -> db -> where('shop_id', $id);
		$this -> db -> where('leave', 1);
		$this -> db -> where('status', 1);
		return $this -> db -> get() -> result_array();
	}

	//获取指定商店二级分类信息
	public function getSecondCategory($id) {
		$this -> db -> select('id,pid,name');
		$this -> db -> from('goods_category');
		$this -> db -> where('shop_id', $id);
		$this -> db -> where('status', 1);
		$this -> db -> where('leave', 2);
		return $this -> db -> get() -> result_array();
	}
	
	//获取指定商店三级分类信息
	public function getThirdCategory($id) {
		$this -> db -> select('id,pid,name');
		$this -> db -> from('goods_category');
		$this -> db -> where('shop_id', $id);
		$this -> db -> where('status', 1);
		$this -> db -> where('leave', 3);
		return $this -> db -> get() -> result_array();
	}

	//获取商家列表
	public function getShopList($per_page, $num_page)
	{
            
		$this -> db -> from('shop');
		$this -> db ->where('status',1);
                $this -> db -> limit($per_page, $num_page * $per_page);
		$query = $this -> db -> get();
		return $query -> result_array();
	}


	/**
	 * 删除店铺
	 * @param int $shopid 店铺ID
	 *
	 */
	public function delShop($shopid)
	{
		$data['status'] = 0;
		$where['id'] = $shopid;

		return $this->_update($data, $where);
	}

       /**
        * 搜索商户
        * @param array $where
        * @param type $like
        * @param type $page
        * @param type $count
        * @return type
        */
	public function searchShop($where = array(), $like = array(), $page = 1, $count = 20)
	{
		$where[ 'status' ] = 1;
		$limit[ 'limit' ]  = $count;
		$limit[ 'offset' ] = $count * ($page - 1);
		return $this->_get('id,name,address,contacts,telephone', $where, $like, '', $limit);
	}
        
        //获取商店数据总条数
	public function getTotal($string = '') {
            if (!empty($string)) {
                $this -> db ->where('status',1);
		$this -> db -> like('name', $string, 'both');
		$this -> db -> or_like('address', $string, 'both');
		$this -> db -> or_like('telephone', $string, 'both');
		$this -> db -> from('shop');
		return $this -> db -> count_all_results();
            } else {
                $this -> db ->where('status',1);
		return $this -> db -> count_all_results('shop');
            }
	}

    public function getWeekShops(){
        $thistime = strtotime(date('Y-m-d H:i:s',time()));
        $weektime = 7*24*3600;
        $datetime = date('Y-m-d H:i:s',$thistime-$weektime);
        $sql = "select * from shop_user where reg_date>='$datetime'";
        return $this ->db->query($sql)->num_rows();

    }
}

/* End of file shop_model.php */
/* Location: ./application/models/shop_model.php */
