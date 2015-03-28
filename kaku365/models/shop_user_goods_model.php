<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Class 商家商品操作model
 * @author chenjia404
 * @date
 */
class Shop_User_Goods_model extends MY_Model
{
	private $table = "goods";

	public $goods = null;

	/**
	 * @var int 商家id
	 */
	public $shop_id = 0;


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
		$where[ 'shop_id' ] = $this->shop_id;
		return $this->_get('*', $where);
	}


	/**
	 * 商品搜索
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
		$where[ 'shop_id' ] = $this->shop_id;
		$limit[ 'limit' ]  = $count;
		$limit[ 'offset' ] = $count * ($page - 1);
		return $this->_get('id,shop_id,name,cover_image,price', $where, $like, '', $limit);
	}


}