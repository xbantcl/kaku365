<?php
/**
 * Created by PhpStorm.
 * User: wubo
 * Date: 2015/1/15
 * Time: 14:48
 */
 class Admin_model extends MY_Model
 {

     public $table = 'admin';
     public function __construct()
     {
         parent::__construct();
         $this -> load -> database();
     }

     /**
      * @author wuanbo
      * @date 2015-01
      * @param $username
      * @return bool|object
      */
     public function getUser($username)
     {
         $sql = "select * from ".$this->table." where username ='".$username."'";
         $query = $this -> _query($sql);
         if(isset($query[0]['id']))
            return $query[0];
         else
             false;
     }
     
     
     public function alterpass($password,$id)
     {
         $data = array('password' => $password);
         $this->db->where('id', $id);
         return $this->db->update($this->table, $data); 

     }

     /**
      * 得到当前登陆用户的信息
      * @author wuanbo
      * @date 2015-01
      * @param $userid
      */
     public function getThisUser($userid)
     {
         $sql = "select * from ".$this->table." where id ='".$userid."'";
         $query = $this -> _query($sql);

         if(isset($query[0]['id']))
             return $query[0];
         else
             false;
     }
     
     /**
      * 获取商品分类
      * @author xiaoboa
      * @date   2015-04-03
      * @param $pid
      * @return array
      */
     public function getCategories()
     {
         $this->table        = 'goods_category';
         $where[ 'shop_id' ] = 0;
         $where[ 'status' ]  = 1;
         $data               = $this->_get('*', $where);
         $categorys          = array();
         $categorys[0]       = array('name' => '本级新建');
         foreach ($data as $item) {
             if(0 == $item['pid']) {
                $categorys[$item['id']] = array('name' => $item['name']);
             } elseif (isset($categorys[$item['pid']])) {
             	$categorys[$item['pid']]['cell'][0] = array('name' => '本级新建');
                $categorys[$item['pid']]['cell'][$item['id']] = array('name' => $item['name']);
             }
         }
         return $categorys;
     }
     
     /**
     * 添加商品分类
     * @author chenjia404
     * @date   2015-01-25
     * @param $category
     * @return object
     */
    public function addCategory($category)
    {
        $this->table           = 'goods_category';
        $category[ 'shop_id' ] = 0;
        $category[ 'created_at' ] = date('Y-m-d H:i:s');
        return $this->_add($category);
    }
    
    /**
     * 获取分类数据.
     * 
     * @return array
     */
    public function getCategoryTree()
    {
        $this->table        = 'goods_category';
        $where[ 'shop_id' ] = 0;
        $where[ 'status' ]  = 1;
        $data               = $this->_get('*', $where);
        $categorys          = array();
        foreach ($data as $d) {
            $categorys_one['id'] = $d['id'];
            $categorys_one['pId'] = $d['pid'];
            $categorys_one['name'] = $d['name'];
            if($categorys_one['pId'] == 0)
            {
                $categorys_one['open'] = true;
            }
            $categorys[] = $categorys_one;
        }
        return $categorys;
    }
    
     /**
     * 获取商品分类
     * @author xiaoboa
     * @date   2015-04-03
     * 
     * @param integer $pid 分类父节. 
     * @return array
     */
    public function getCategory($pid)
    {
        $this->table        = 'goods_category';
        $where[ 'shop_id' ] = 0;
        $where[ 'pid' ]     = $pid;
        $where[ 'status' ]  = 1;
        $data               = $this->_get('*', $where);
        $categorys          = array();
        $categorys[ 0 ]     = array('name' => '本级新建');
        foreach ($data as $d) {
            $categorys[$d[ 'id']] = array('name' => $d['name']);
        }
        return $categorys;
    }
    
     /**
     * 获取商品分类
     * @author xiaoboa
     * @date   2015-04-03
     * @param  integer $id 分类ID.
     * @return array
     */
    public function getCategoryPath($id)
    {
        $this->table        = 'goods_category';
        $where[ 'shop_id' ] = 0;
        $where[ 'id' ]      = $id;
        $where[ 'status' ]  = 1;
        $data               = $this->_get('pid', $where);
        if(isset($data[0]['pid']))
        {
            $categorys[] = $data[0]['pid'];
            $where['id'] = $data[0]['pid'];
            $data        = $this->_get('pid', $where);
            if(!empty($data[0]['pid']))
            {
                $categorys[ ] = $data[ 0 ][ 'pid' ];
            }
        }
        if(isset($categorys))
            $categorys = trim(implode(',',array_reverse($categorys)),',');
        else
            $categorys = '';
        return $categorys;
    }
    
     /**
     * 获取商品分类
     * @author xiaoboa
     * @date   2015-04-03
     * @param  integer $id 分类ID.
     * @return array
     */
    public function getCategoryOne($id)
    {
        $this->table      = 'goods_category';
        $where['shop_id'] = 0;
        $where['id']      = $id;
        $data             = $this->_get('*', $where);
        if(count($data))
            $categorys = $data[0];
        else
            $categorys = array();
        return $categorys;
    }
    
     /**
     * 更新分类
     * @author xiaoboa
     * @date   2015-04-03
     * @param integer $id   分类ID.
     * @param array   $data 更新数据.
     * 
     * @return bool
     */
    public function updateCategory($id, $data)
    {
        $this->table        = 'goods_category';
        $where[ 'shop_id' ] = 0;
        $where[ 'id' ]      = (int)$id;
        return $this->_update($data, $where);
    }
    
     /**
     * 删除分类
     * @author xiaoboa
     * @date   2015-04-07
     * @param  integer $id 分类ID.
     * @return integer
     */
    public function categoryDelete($id)
    {
        $this->table        = 'goods_category';
        $data[ 'status' ]   = 2;
        $where[ 'shop_id' ] = 0;
        $where[ 'id' ]      = (int)$id;
        return $this->_update($data, $where);
    }
    
     /**
     * 添加品牌
     * @author xiaoboa
     * @date   2015-04-03
     * @param  array $brand 商品信息.
     * @return object
     */
    public function addBrand($brand)
    {
    	if (!is_array($brand) || empty($brand)) {
    		return false;
    	}
        $this->table           = 'goods_brand';
        $brand[ 'shop_id' ]    = 0;
        $brand[ 'created_at' ] = date('Y-m-d H:i:s');
        return $this->_add($brand);
    }
    
    /**
     * 获取商品品牌信息.
     * 
     * @param array $like    匹配项.
     * @param array $where   查询条件.
     * @param integer $page  查询位置.
     * @param integer $count 一次查询量.
     * @return array
     */
    public function brandList($like = array(), $where = array(), $page = 1, $count = 10)
    {
        $this->table      = 'goods_brand';
        $where['shop_id'] = 0;
        if (!isset($where['status'])) {
            $where['status < '] = 2;
        }
        $limit['limit']  = $count;
        $limit['offset'] = ($page - 1) * $count;
        return $this->_get('*', $where, $like, array('rank'=>'ASC'), $limit);
    }
    
     /**
     * 删除品牌
     * @author xiaoboa
     * @date   2015-04-03
     * @param integer $id 品牌ID.
     * @return bool
     */
    public function deleteBrands($id = 0)
    {
        $this->table      = 'goods_brand';
        $data['status']   = 2;
        $where['shop_id'] = 0;
        $where[ 'id' ]    = (int)$id;
        return $this->_update($data, $where);
    }
    
     /**
     * 更新品牌信息.
     * @author xiaoboa
     * @date   2015-04-03
     * @param array $brand 品牌信息.
     * @param array $where 查询条件.
     * 
     * @return boolean
     */
    public function updateBrand($brand, $where)
    {
    	if (empty($brand) || empty($where) || !is_array($brand) || !is_array($where)) {
    		return false;
    	}
        $this->table        = 'goods_brand';
        $where[ 'shop_id' ] = 0;
        return $this->_update($brand, $where);
    }
    
    /**
     * 商品添加
     * @author xiaoboa
     * @date   2015-04-04
     * @param  array $goods 商品信息.
     * @return integer
     */
    public function addGoods($goods)
    {
    	if (!is_array($goods) || empty($goods)) {
    		return false;
    	}
        $this->table           = 'goods_template';
        $goods[ 'created_at' ] = date('Y-m-d H:i:s');
        return $this->_add($goods);
    }

    /**
     * 获取商品列表
     * @author xiaoboa
     * @date   2015-04-04
     * @param array   $like
     * @param array   $where
     * @param integer $page
     * @param integer $count
     * @return array
     */
    public function goodsList($like = array(), $where = array(), $page = 1, $count = 10)
    {
        $this->table = 'goods_template';
        if (!isset($where[ 'status' ])) {
            $where[ 'status < ' ] = 2;
        }
        $limit[ 'limit' ]   = $count;
        $limit[ 'offset' ]  = ($page - 1) * $count;
        $goods              = $this->_get('*', $where, $like, array(), $limit);
        foreach ($goods as &$go) {
            $go[ 'images' ] = explode(',', $go[ 'images' ]);
        }
        return $goods;
    }
    
     /**
     * 获取商品列表
     * @author xiaoboa
     * @date   2015-04-04
     * @param array   $like
     * @param array   $where
     * @param integer $page
     * @param integer $count
     * @return array
     */
    public function getGoodsTotalCount($like = array(), $where = array())
    {
        $this->table = 'goods_template';
        if (!isset($where[ 'status' ])) {
            $where[ 'status < ' ] = 2;
        }
        $totalCount = $this->_get('count(1) as count', $where, $like, array());
        if (!empty($totalCount[0]['count'])) {
        	return $totalCount[0]['count'];
        }
        return 0;
    }
    
     /**
     * 删除商品
     * @author xiaoboa
     * @date   2015-04-04
     * @param  integer $id
     * @return bool|object
     */
    public function deleteGoodsTemplate($id = 0)
    {
        $this->table        = 'goods_template';
        $data[ 'status' ]   = 0;
        $where[ 'id' ]      = (int)$id;
        return $this->_update($data, $where);
    }
    
     /**
     * 更新商品
     * @author xiaoboa
     * @date   2015-04-04
     * @param $goods
     * @param $id
     * @return bool
     */
    public function updataGoods($goods, $id)
    {
    	if (!is_array($goods) || empty($goods)) {
    		return false;
    	}
        $this->table   = 'goods_template';
        $where[ 'id' ] = $id;
        return $this->_update($goods, $where);
    }
    
 }