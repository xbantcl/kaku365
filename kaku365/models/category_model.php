<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Category_model extends MY_Model
{
	/*
	public function __construct()
    {
        parent::__construct();
        $this->load->model('manager_model');
    }
*/
    /**
	 * 注册添加默认分类.
	 * @param integer $shopId 商家ID.
	 */
	public function addDefaultCategory()
	{
		$this->table       = 'goods_category';
		$where['shop_id']  = 0;
		$where['status']   = 1;
		$defaultCategories = $this->_get('*', $where);
		$this->load->model('manager_model');
		$shop = $this->manager_model->get_shop();
		$category = $this->_get('id', array('shop_id' => $shop['id']));
		if (!empty($category)) {
			return true;
		}
		$firstLevel  = array();
		$secondLevel = array();
		$thirdLevel  = array();
		foreach ($defaultCategories as $item) {
			if (0 == $item['pid']) {
				$firstLevel[$item['id']] = $item;
			} elseif (isset($firstLevel[$item['pid']])) {
				$secondLevel[$item['id']] = $item;
			} elseif (isset($secondLevel[$item['pid']])) {
				$thirdLevel[$item['id']] = $item;
			}
		}
		// 添加一级分类
		foreach ($firstLevel as $index => $item) {
			unset($item['id']);
			$item['shop_id']    = $shop['id'];
			$item['created_at'] = date('Y-m-d H:i:s');
			$status = $this->_add($item);
			if ($status) {
				$category = $this->_get('id', $item);
			}
			$firstLevel[$index] = $category[0]['id'];
		}
		// 添加二级分类
		foreach ($secondLevel as $index => $item) {
			unset($item['id']);
			$item['shop_id']    = $shop['id'];
			$item['pid']        = $firstLevel[$item['pid']];
			$item['created_at'] = date('Y-m-d H:i:s');
			$status = $this->_add($item);
			if ($status) {
				$category = $this->_get('id', $item);
			}
			$secondLevel[$index] = $category[0]['id'];
		} 
		// 添加三级分类
		foreach ($thirdLevel as $index => $item) {
			unset($item['id']);
			$item['shop_id']    = $shop['id'];
			$item['pid']        = $secondLevel[$item['pid']];
			$item['created_at'] = date('Y-m-d H:i:s');
			$this->_add($item);
		} 
		return true;
	}
}