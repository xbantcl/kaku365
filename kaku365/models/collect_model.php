<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Collect_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	/**
	 * 根据用户ID获取收藏数据
	 */
	public function getCollects($user_id) {
		$this -> db -> select('c.id,c.goods_id,c.collect_date');
		$this -> db -> select('g.name as goods_name,g.price as goods_price,g.number as goods_number,g.cover_image as goods_img');
		$this -> db -> from('collect as c');
		$this -> db -> join('goods as g', 'c.goods_id = g.id', 'left');
		$this -> db -> where('c.user_id', $user_id);
		$query = $this -> db -> get();
		return $query -> result_array();
	}

	/**
	 * 根据收藏ID删除收藏记录
	 */
	public function delCollect($collect_id) {
		$this -> db -> where('id', $collect_id);
		$result = $this -> db -> delete('collect');
		if ($result)
			return TRUE;
		return FALSE;
	}
	
	/**
	 * 根据用户ID和商品ID删除收藏记录
	 */
	public function delCollects($user_id,$goods_id) {
		$this -> db -> where('user_id', $user_id);
		$this -> db -> where('goods_id', $goods_id);
		$result = $this -> db -> delete('collect');
		if ($result)
			return TRUE;
		return FALSE;
	}

	/**
	 * 添加收藏
	 */
	public function insertCollect($collect) {
		$this -> db -> select('id');
		$this -> db -> from('collect');
		$this -> db -> where('user_id', $collect['user_id']);
		$this -> db -> where('goods_id', $collect['goods_id']);
		$query = $this -> db -> get();
		if ($query -> num_rows() > 0) {
			return 'had';
		}
		if ($this -> db -> insert('collect', $collect)) {
			return 'true';
		}
		return 'false';
	}

}

/* End of file collcet_model.php */
/* Location: ./application/models/collcet_model.php */
