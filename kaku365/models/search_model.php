<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Search_model extends MY_Model {

	public function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	//获取商店数据
	//$per_page：每页数据条数
	public function getSome($per_page = 5) {
        $this -> db ->where('status',1);
		$this -> db -> select('id,name,telephone,address,introduce,img_path');
		$this -> db -> from('shop');
		$this -> db -> order_by('id', 'DESC');
		$this -> db -> limit($per_page);
		$query = $this -> db -> get();
		return $query -> result_array();
	}

	//模糊查询商店数据
	//$per_page：每页数据条数
	//$string：查询关键词
	public function getLike($string, $per_page = 5) {
		$this -> db -> select('id,name,telephone,address,introduce,img_path');
		$this -> db -> from('shop');                
		$this -> db -> like('name', $string, 'both');
		$this -> db -> order_by('id', 'DESC');
        $this -> db -> where('status',1);
		$this -> db -> limit($per_page);
		$query = $this -> db -> get();
		return $query -> result_array();
	}

	//查询商店分页数据 (有查询条件)
	//$per_page：每页数据条数
	//$index: 读取数据位置
	//$string：查询关键词
	public function getPages($string, $per_page = 5, $index) {
		$this -> db -> select('id,name,telephone,address,introduce,img_path');
		$this -> db -> from('shop');
		$this -> db -> like('name', $string, 'both');
		$this -> db -> order_by('id');
        $this -> db ->where('status',1);
		$this -> db -> limit($per_page,$index);
		$query = $this -> db -> get();
		return $query -> result_array();
	}

	//查询商店分页数据 （无查询条件）
	//$per_page：每页数据条数
	//$index: 读取数据位置
	public function getPage($per_page, $index) {
        $this -> db -> where('status',1);
		$this -> db -> select('id,name,telephone,address,introduce,img_path');
		$this -> db -> from('shop');
		$this -> db -> order_by('id');
		$this -> db -> limit($per_page, $index);
		return $this -> db -> get() -> result_array();
	}

	//或许商店数据总条数
	public function getTotal($string = '') {
		if (!empty($string)) {
            $this -> db ->where('status',1);
			$this -> db -> like('name', $string, 'both');
			$this -> db -> from('shop');
			return $this -> db -> count_all_results();
		} else {
            $this -> db ->where('status',1);
			return $this -> db -> count_all_results('shop');
		}
	}
        
	/**
	 * @abstract 根据关键词筛选商品
	 * @param string $words 筛选关键词
	 * @return array result
	 */
	 public function search_by_words($words){
	 	
	 }
	 
	 /**
	  * @abstract 根据ID获取分类信息
	  * @param int $id 分类ID
	  * @return array result
	  */
	  public function get_category_by_id($id){
	  	$this -> db -> select('id,pid,name,leave');
		$this -> db -> where('status',1);
		$this -> db -> where('id',$id);
		$this -> db -> from('goods_category');
		return $this -> db -> get() -> row_array();
	  }
	  
	  /**
	   * @abstract 根据商店ID品牌信息
	   * @param int $shop_id 商店ID
	   * @return array result
	   */
	  public function get_brands_by_id($shop_id,$cate_id=0){
          $sql = "SELECT
	goods_brand.`id`,
	goods_brand.`name`,
	COUNT(goods_brand.id) AS goods_amount
FROM
	goods,
	goods_brand
WHERE
	(
		category1 = $cate_id
		OR category_id = $cate_id
		OR category2 = $cate_id
		OR category3 = $cate_id
	)AND goods.shop_id = $shop_id AND goods.`status`=1 AND goods_brand.id = goods.brand_id  GROUP BY goods_brand.`name`";
          return $this->_query($sql);
		
	  }

}

/* End of file search_model.php */
/* Location: ./application/models/search_model.php */
