<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 *
 * @author chenmeng
 * @date 2015年1月14日 19:46:05
 */
class Goods_model extends MY_Model {

	public function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	//根据商店或许商品数据
	//$shop_id:商店id
	public function getGoods($shop_id) {
		$this -> db -> select('id,name,category_id,category1,category2,category3,cover_image,price');
		$this -> db -> from('goods');
		$this -> db -> where('shop_id', $shop_id);
		$this -> db -> where('status', 1);
		return $this -> db -> get() -> result_array();
	}
	
	/**
	 * 根据商品id获取shop_id
	 *
	 * @param integer $goods_id 商品id.
	 * 
	 * @return integer
	 */
	public function getGoodsShopId($goods_id) {
		$this -> db -> select('shop_id');
		$this -> db -> from('goods');
		$this -> db -> where('id', $goods_id);
		$query = $this-> db ->get() -> row();
		return $query->shop_id;
	}
	
	/**
	 * 根据商品id获取商品信息.
	 *
	 * @param string  $fields   字段.
	 * @param integer $goods_id 商品id.
	 *
	 * @return integer
	 */
	public function getGoodsInfo($fields, $goods_id) {
	    $this -> db -> select($fields);
	    $this -> db -> from('goods');
	    $this -> db -> where('id', $goods_id);
	    return $this-> db ->get() -> row();
	}
	
	/**
	 * 根据商品目录id获取商品数据
	 * $s_c_id:商品二级目录id
	 */
	public function getSecondCategoryGoods($shop_id,$category_id){
		$this -> db -> select('id,name,category_id,cover_image,price');
		$this -> db -> from('goods');
		$this -> db -> where('shop_id', $shop_id);
		$this -> db -> where('category_id', $category_id);
		$this -> db -> where('status', 1);
		return $this -> db -> get() -> result_array();
	}

	/**
	 * @abstract 根据分类ID获取商品
	 * @param int $shop_id 商店ID
	 * @param int $cate_id 分类ID
	 * @param int $brand_id 品牌ID
	 * @return array result
	 */
	 public function get_goods_by_cate_id($shop_id,$cate_id,$brand_id=0,$price=0,$page,$limit=20,$sort_price){
         if($brand_id)
            $brand = "`brand_id` = $brand_id
AND ";
         else
             $brand = '';
         switch($price)
         {
             case 1:
                 $price_str = "price < 50 and";
                 break;
             case 2:
                 $price_str = "price >= 50 and price <= 100 and";
                 break;
             case 3:
                 $price_str = "price >= 100 and price <= 200 and";
                 break;
             case 4:
                 $price_str = "price >= 200 and price <= 300 and";
                 break;
             case 5:
                 $price_str = "price >= 300 and";
                 break;
             default:
                 $price_str = "";
                 break;

         }
         $offset = ($page - 1) * $limit;
         $sql = "SELECT
	`id`,
	`name`,
	`category_id`,
	`cover_image`,
	`price`,
	`brand_id`
FROM
	(`goods`)
WHERE
	$price_str $brand `shop_id` = '$shop_id'
AND `status` = 1
AND( `category_id` = '$cate_id'
OR `category1` = '$cate_id'
OR `category2` = '$cate_id'
OR `category3` = '$cate_id')
ORDER BY price $sort_price
LIMIT $offset,$limit";
         $goods = $this->_query($sql);
		return $goods;
	 }

	/**
	 * @abstract 根据分类ID获取商品
	 * @param int $shop_id 商店ID
	 * @param int $cate_id 分类ID
	 * @param int $brand_id 品牌ID
	 * @return array result
	 */
	 public function get_goods_amount_by_cate_id($shop_id,$cate_id,$brand_id=0,$price=0){
         if($brand_id)
            $brand = "`brand_id` = $brand_id
AND ";
         else
             $brand = '';
         switch($price)
         {
             case 1:
                 $price_str = "price < 50 and";
                 break;
             case 2:
                 $price_str = "price >= 50 and price <= 100 and";
                 break;
             case 3:
                 $price_str = "price >= 100 and price <= 200 and";
                 break;
             case 4:
                 $price_str = "price >= 200 and price <= 300 and";
                 break;
             case 5:
                 $price_str = "price >= 300 and";
                 break;
             default:
                 $price_str = "";
                 break;

         }
         $sql = "SELECT
	count(`id`) as goods_count
FROM
	(`goods`)
WHERE
	$price_str $brand `shop_id` = '$shop_id'
AND `status` = 1
AND( `category_id` = '$cate_id'
OR `category1` = '$cate_id'
OR `category2` = '$cate_id'
OR `category3` = '$cate_id')";
         $goods = $this->_query($sql);
		return $goods;
	 }


    public function get_root_Category($cate_id)
    {
        $this->table = 'goods_category';
        $pid = $cate_id;
        $where['id'] = $cate_id;
        $Category = $this->_get('*',$where);
        if(isset($Category[0]['pid']) && $Category[0]['pid'] > 0 && $pid > $Category[0]['pid'])
        {
            return $this->get_root_Category($Category[0]['pid']);
        }
        else
            return $pid;
    }

	/**
	 * @abstract 根据价格区间获取分类商品
	 * @param int $shop_id 商店ID
	 * @param int $cate_id 分类ID
	 * @param int $s_price 起始金额
	 * @param int $e_price 最终金额
	 */
	 public function get_goods_by_price($shop_id,$cate_id,$s_price,$e_price){
	 	$this -> db -> select('id,name,category_id,cover_image,price');
		$this -> db -> from('goods');
		$this -> db -> where('shop_id', $shop_id);
		$this -> db -> where('category_id', $cate_id);
		$this -> db -> where('price >',$s_price);
		$this -> db -> where('price <',$e_price);
		$this -> db -> where('status', 1);
		return $this -> db -> get() -> result_array();
	 }
	
	/**
	 * get_goods_by_words
	 * @abstract 根据关键词搜索商品
	 * @param int shop_id 商店ID
	 * @param string words 关键词
	 * @return array result
	 */
	public function get_goods_by_words($shop_id,$words){
		$this -> db -> select('id,name,category_id,cover_image,price');
		$this -> db -> from('goods');
		$this -> db -> where('status', 1);
		$this -> db -> where('shop_id', $shop_id);
		$this -> db -> like('name',$words);
		return $this -> db -> get() -> result_array();
	}
	
	/**
	 * 获取系统商品模板信息.
	 * 
	 * @param string $prdCode 商品编码.
	 * 
	 * @return array
	 */
	public function getGoodsTemplate($prdCode)
	{
		$this -> db -> select('*');
		$this -> db -> from('goods_template');
		$this -> db -> where('status', 1);
		$this -> db -> where('product_code', $prdCode);
		$gt = $this -> db -> get() -> result_array();
		if (!empty($gt[0]['brand_id'])) {
			$this -> db -> select('name');
			$this -> db -> from('goods_brand');
			$this -> db -> where('id', $gt[0]['brand_id']);
			$this -> db -> where('status', 1);
			$brand = $this -> db -> get() -> result_array();
			$gt[0]['brand_name']  = $brand[0]['name'];
		}
		if (!empty($gt[0])) {
			return $gt[0];
		}
		return $gt;
	}
}

/* End of file goods_model.php */
/* Location: ./kaku365/models/goods_model.php */
