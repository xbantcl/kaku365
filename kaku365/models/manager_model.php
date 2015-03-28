<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @author: chenjia404
 * @Date  : 2015/1/25
 * @Time  : 12:15
 */
class Manager_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Shop_user_model');
        if (!$this->Shop_user_model->isLogin()) {
            redirect('shop_user/login');
        }
    }


    /**
     * 获取当前登录用户的店铺信息，不存在就知道添加
     * @author chenjia404
     * @date   2015-01-25
     * @return array
     */
    public function get_shop()
    {
        $this->table        = 'shop';
        $where[ 'user_id' ] = $this->Shop_user_model->user[ 'id' ];
        $shop               = $this->_get('*', $where);
        if (count($shop) == 0) {
            $this->add_shop();
            $shop = $this->_get('*', $where);
        }

        $shop = $shop[ 0 ];
        return $shop;
    }


    /**
     * 添加店铺
     * @author chenjia404
     * @date   2015-01-25
     * @param array $shop
     * @return object
     */
    public function add_shop($shop = array())
    {
        $shop[ 'name' ]       = '请填写商家名称';
        $shop[ 'contacts' ]   = '请填写商家法人';
        $shop[ 'telephone' ]  = '请填写联系电话';
        $shop[ 'address' ]    = '请填写详细地址';
        $shop[ 'introduce' ]  = '请填写商家简介';
        $shop[ 'user_id' ]    = $this->Shop_user_model->user[ 'id' ];
        $shop[ 'enjoy_date' ] = date('Y-m-d H:i:s');
        $this->table          = 'shop';
        $this->_add($shop);
        $shop_id = $this->_getlastid();
        $data['shop_id'] = $shop_id;
        $where['id'] = $this->Shop_user_model->user[ 'id' ];
        return $this->_update($shop);
    }


    /**
     * 更新店铺信息
     * @author chenjia404
     * @date   2015-01-25
     * @param $shop
     * @return bool
     */
    public function update_shop($shop)
    {
        $this->table        = 'shop';
        $where[ 'user_id' ] = $this->Shop_user_model->user[ 'id' ];
        return $this->_update($shop, $where);
    }


    /**
     * 添加品牌
     * @author chenjia404
     * @date   2015-01-25
     * @param $brand
     * @return object
     */
    public function add_brand($brand)
    {
        $shop                  = $this->Manager_model->get_shop();
        $this->table           = 'goods_brand';
        $brand[ 'shop_id' ]    = $shop[ 'id' ];
        $brand[ 'created_at' ] = date('Y-m-d H:i:s');
        return $this->_add($brand);
    }


    /**
     * 添加品牌
     * @author chenjia404
     * @date   2015-01-25
     * @param $brand
     * @return object
     */
    public function update_brand($brand,$where)
    {
        $shop                  = $this->Manager_model->get_shop();
        $this->table           = 'goods_brand';
        $where[ 'shop_id' ]    = $shop[ 'id' ];
        return $this->_update($brand,$where);
    }


    /**
     * 获取分类
     * @author chenjia404
     * @date   2015-01-25
     * @return array
     */
    public function get_brand($like = array(), $where = array())
    {
        $shop               = $this->Manager_model->get_shop();
        $this->table        = 'goods_brand';
        $where[ 'shop_id' ] = $shop[ 'id' ];
        if (!isset($where[ 'status' ])) {
            $where[ 'status < ' ] = 2;
        }
        return $this->_get('*', $where,$like,array('rank'=>'ASC'));
    }


    /**
     * 获取分类
     * @author chenjia404
     * @date   2015-01-25
     * @return array
     */
    public function all_page()
    {
        $shop               = $this->Manager_model->get_shop();
        $this->table        = 'goods';
        $where[ 'shop_id' ] = $shop[ 'id' ];
        $where[ 'status < ' ] = 2;
        $amount = ceil($this->_count($where)/10);
        return $amount;
    }




    public function brand_list($like = array(), $where = array(), $page = 1, $count = 10)
    {
        $shop               = $this->Manager_model->get_shop();
        $this->table        = 'goods_brand';
        $where[ 'shop_id' ] = $shop[ 'id' ];
        if (!isset($where[ 'status' ])) {
            $where[ 'status < ' ] = 2;
        }
        $limit[ 'limit' ]   = $count;
        $limit[ 'offset' ]  = ($page - 1) * $count;
        return $this->_get('*', $where,$like,array('rank'=>'ASC'),$limit);
    }


    /**
     * 删除品牌
     * @author chenjia404
     * @date   2015-01-25
     * @param int $id
     * @return bool
     */
    public function delete_brands($id = 0)
    {
        $shop               = $this->Manager_model->get_shop();
        $this->table        = 'goods_brand';
        $data[ 'status' ]   = 2;
        $where[ 'shop_id' ] = $shop[ 'id' ];
        $where[ 'id' ]      = (int)$id;
        return $this->_update($data, $where);
    }


    /**
     * 添加商品分类
     * @author chenjia404
     * @date   2015-01-25
     * @param $category
     * @return object
     */
    public function add_category($category)
    {
        $shop                  = $this->Manager_model->get_shop();
        $this->table           = 'goods_category';
        $category[ 'shop_id' ] = $shop[ 'id' ];;
        $category[ 'created_at' ] = date('Y-m-d H:i:s');
        return $this->_add($category);
    }


    /**
     * 获取商品分类
     * @author chenjia404
     * @date   2015-01-25
     * @param $pid
     * @return array
     */
    public function get_category($pid)
    {
        $shop               = $this->Manager_model->get_shop();
        $this->table        = 'goods_category';
        $where[ 'shop_id' ] = $shop[ 'id' ];
        $where[ 'pid' ]     = $pid;
        $where[ 'status' ]  = 1;
        $data               = $this->_get('*', $where);
        $categorys          = array();
        $categorys[ 0 ]     = array('name' => '本级新建');
        foreach ($data as $d) {
            $categorys[ $d[ 'id' ] ] = array('name' => $d[ 'name' ]);
        }
        return $categorys;
    }


    /**
     * 获取商品分类
     * @author chenjia404
     * @date   2015-01-25
     * @param $id
     * @return array
     */
    public function get_category_path($id)
    {
        $shop               = $this->Manager_model->get_shop();
        $this->table        = 'goods_category';
        $where[ 'shop_id' ] = $shop[ 'id' ];
        $where[ 'id' ]     = $id;
        $where[ 'status' ]  = 1;
        $data               = $this->_get('pid', $where);
        if($data[0]['pid'])
        {
            $categorys[] = $data[0]['pid'];
            $where[ 'id' ]     = $data[0]['pid'];
            $data               = $this->_get('pid', $where);
            if($data[0]['pid'])
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
     * 获取商品分类id字符串
     * @author chenjia404
     * @date   2015-01-25
     * @param  array
     * @return string
     */
    public function get_good_category($goods)
    {
        $this->load->model('Goods_model');
        $categorys = array();
        $defVal = '';
        if($goods['category1'])
            $categorys[] = $goods['category1'];
        if($goods['category2'])
            $categorys[] = $goods['category2'];
        if($goods['category3'])
            $categorys[] = $goods['category3'];
        $defVal = implode(',',$categorys);
        return $defVal;
    }


    /**
     * 获取商品分类
     * @author chenjia404
     * @date   2015-01-25
     * @param $pid
     * @return array
     */
    public function get_all_category()
    {
        $shop               = $this->Manager_model->get_shop();
        $this->table        = 'goods_category';
        $where[ 'shop_id' ] = $shop[ 'id' ];
        $where[ 'status' ]  = 1;
        $data               = $this->_get('*', $where);
        $categorys          = array();
        $categorys[ 0 ]     = array('name' => '本级新建');
        foreach ($data as $d) {
            $categorys[ $d[ 'id' ] ] = array('name' => $d[ 'name' ]);
        }
        return $categorys;
    }

    /**
     * 获取商品分类
     * @author chenjia404
     * @date   2015-01-25
     * @param $id
     * @return array
     */
    public function get_category_one($id)
    {
        $shop               = $this->Manager_model->get_shop();
        $this->table        = 'goods_category';
        $where[ 'shop_id' ] = $shop[ 'id' ];
        $where[ 'id' ]     = $id;
        $data               = $this->_get('*', $where);
        if(count($data))
            $categorys          = $data[0];
        else
            $categorys = array();
        return $categorys;
    }



    public function get_category_tree()
    {
        $shop               = $this->Manager_model->get_shop();
        $this->table        = 'goods_category';
        $where[ 'shop_id' ] = $shop[ 'id' ];
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
     * 删除分类
     * @author chenjia404
     * @date   2015-02-11
     * @param $id
     * @return bool|object
     */
    public function category_delete($id)
    {
        $shop               = $this->Manager_model->get_shop();
        $this->table        = 'goods_category';
        $data[ 'status' ]   = 2;
        $where[ 'shop_id' ] = $shop[ 'id' ];
        $where[ 'id' ]      = (int)$id;
        return $this->_update($data, $where);
    }


    /**
     * 更新分类
     * @author chenjia404
     * @date   2015-02-11
     * @param $id
     * @param $data
     * @return bool
     */
    public function category_update($id,$data)
    {
        $shop               = $this->Manager_model->get_shop();
        $this->table        = 'goods_category';
        $where[ 'shop_id' ] = $shop[ 'id' ];
        $where[ 'id' ]      = (int)$id;
        return $this->_update($data, $where);
    }

    /**
     * 商品添加
     * @author chenjia404
     * @date   2015-01-25
     * @param $goods
     * @return object
     */
    public function add_goods($goods)
    {
        $shop               = $this->Manager_model->get_shop();
        $this->table        = 'goods';
        $goods[ 'shop_id' ] = $shop[ 'id' ];;
        $goods[ 'created_at' ] = date('Y-m-d H:i:s');
        return $this->_add($goods);
    }


    /**
     * 获取商品列表
     * @author chenjia404
     * @date   2015-01-25
     * @param array $like
     * @param array $where
     * @param int   $page
     * @param int   $count
     * @return array
     */
    public function goods_list($like = array(), $where = array(), $page = 1, $count = 10)
    {
        $shop        = $this->Manager_model->get_shop();
        $this->table = 'goods';
        if (!isset($where[ 'status' ])) {
            $where[ 'status < ' ] = 2;
        }
        $where[ 'shop_id' ] = $shop[ 'id' ];
        $limit[ 'limit' ]   = $count;
        $limit[ 'offset' ]  = ($page - 1) * $count;
        $goods              = $this->_get('*', $where, $like, array(), $limit);
        foreach ($goods as &$go) {
            $go[ 'images' ] = explode(',', $go[ 'images' ]);
        }
        return $goods;
    }


    /**
     * 删除商品
     * @author chenjia404
     * @date   2015-01-25
     * @param int $id
     * @return bool|object
     */
    public function delete_goods($id = 0)
    {
        $shop               = $this->Manager_model->get_shop();
        $this->table        = 'goods';
        $data[ 'status' ]   = 2;
        $where[ 'shop_id' ] = $shop[ 'id' ];
        $where[ 'id' ]      = (int)$id;
        return $this->_update($data, $where);
    }


    /**
     * 更新商品
     * @author chenjia404
     * @date   2015-01-25
     * @param $goods
     * @param $id
     * @return bool
     */
    public function updata_goods($goods, $id)
    {
        $shop               = $this->Manager_model->get_shop();
        $this->table        = 'goods';
        $where[ 'shop_id' ] = $shop[ 'id' ];
        $where[ 'id' ]      = $id;
        return $this->_update($goods, $where);
    }
}