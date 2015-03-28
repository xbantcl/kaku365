<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Class 普通用户商品操作model
 * @author chenjia404
 * @date
 */
class User_Goods_model extends MY_Model
{
	public $table = "goods";

	public $goods = null;



	/**
	 * 获取单个商品
	 * @author chenjia404
	 * @date    2015-01-14
	 * @param int $goods_id 商品id
	 * @return array
	 */
	public function getGoods($goods_id)
	{
		$where[ 'status' ] = 1;
		$where[ 'id' ] = $goods_id;
		$sql = "SELECT
	goods.*,
	goods_brand.`name` AS goods_brandName
FROM
	goods
LEFT JOIN goods_brand ON
 goods_brand.id = goods.brand_id WHERE goods.id = $goods_id";
		$goods = $this->_query($sql);
		if(isset($goods[0]['name']))
		{
			$goods = $goods[0];
			$goods['img_content'] = explode(',',$goods['images']);
		}
		else
		{
			$goods = null;
		}
		return $goods;
	}


	/**
	 * 店铺商品浏览
	 * @author chenjia404
	 * @date    2015-01-14
	 * @param int $shop_id 店铺id
	 * @param array $where where条件
	 * @param array $like  like条件
	 * @param int $page    页码
	 * @param int $count   每页数量
	 * @return array
	 */
	public function getGoodsByShop($shop_id,$where = array(), $like = array(), $page, $count = 20)
	{
		$where[ 'status' ] = 1;
		$where[ 'shop_id' ] = $shop_id;
		$limit[ 'limit' ]   = $count;
		$limit[ 'offset' ]  = $count * ($page - 1);
		return $this->_get('id,shop_id,name,cover_image,price', $where, $like, array(), $limit);
	}

	/**
	 * 全站商品搜索
	 * @author chenjia404
	 * @date    2015-01-14
	 * @param array $where where条件
	 * @param array $like  like条件
	 * @param int   $page  页码
	 * @param int   $count 每页数量
	 * @return array
	 */
	public function search($where = array(), $like = array(), $page = 1, $count = 20)
	{
		$where[ 'status' ] = 1;
		$limit[ 'limit' ]  = $count;
		$limit[ 'offset' ] = $count * ($page - 1);
		return $this->_get('id,shop_id,name,cover_image,price', $where, $like, '', $limit);
	}


}