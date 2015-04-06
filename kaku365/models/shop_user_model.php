<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * @author: chenjia404
 * @Date  : 2015/1/25
 * @Time  : 12:15
 */
class Shop_user_model extends MY_Model
{
    public $table = 'shop_user';


    /**
     * 当前登录用户
     * @var null
     */
    public $user = null;

    /**
     * 登录
     * @author chenjia404
     * @date   2015-01-25
     * @return bool
     */
    public function login($login_user)
    {
        if (isset($login_user[ 'username' ]) && isset($login_user[ 'password' ])) {
            $where             = $login_user;
            $where[ 'status' ] = 1;
        } else {
            return false;
        }
        $user = $this->_get('*', $where);
        if (is_array($user) && isset($user[ 0 ][ 'id' ])) {
            $token           = md5(time() . rand(1, 999999999));
            $data[ 'token' ] = $token;
            $this->_update($data, $where);
            $this->user = $user;
            // $this->input->set_cookie('uid', $user[ 0 ][ 'id' ], 3600 * 24 * 30);
            // $this->input->set_cookie('token', $token, 3600 * 24 * 30);
            $this->session->set_userdata('uid', $user[ 0 ][ 'id' ]);
            $this->session->set_userdata('token', $token);
            // 添加默认分类
		    $this->load->model('category_model');
		    $this->category_model->addDefaultCategory();
            return true;
        } else {
            return false;
        }
    }


    /**
     * 判断是否登录
     * @param array $user 如果传入参数为空，根据cookie判断是否登录
     * @author chenjia404
     * @date   2015-01-25
     * @return bool
     */
    public function isLogin($user = null)
    {
        if($this->session->userdata('login_admin') && $this->session->userdata('shopManage_admin'))
        {
            $user[ 'id' ]    = $this->session->userdata('shopManage_admin');
            $where['id'] = (int)$user[ 'id' ];
        }
        elseif ($user == null) {
            // $user[ 'id' ]    = $this->input->cookie('uid');
            // $user[ 'token' ] = $this->input->cookie('token');
            $user[ 'id' ]    = $this->session->userdata('uid');
            $user[ 'token' ] = $this->session->userdata('token');
            $where[ 'id' ]    = (int)$user[ 'id' ];
            $where[ 'token' ] = $user[ 'token' ];
        }
        else
        {
            if (isset($user[ 'id' ]) && isset($user[ 'token' ]) && strlen($user[ 'token' ]) > 20) {
                $where[ 'id' ]    = (int)$user[ 'id' ];
                $where[ 'token' ] = $user[ 'token' ];
            } else {
                return false;
            }
        }
        $data = $this->_get('*', $where);
        if (is_array($data) && isset($data[ 0 ][ 'id' ])) {
            if($data[0]['shop_id'] == 0)
            {
                $this->load->model('Shop_model');
                $shop = $this->Shop_model->getShopByUser($data[ 0 ][ 'id' ]);
                if(isset($shop[0]['id']))
                {
                    $update_data['shop_id'] =  $shop[0]['id'];
                    $this->_update($update_data,$where);
                }
            }
            $this->user = $data[ 0 ];
            return true;
        } else {
            return false;
        }
    }


    /**
     * 注册
     * @author chenjia404
     * @date   2015-01-25
     * @return bool
     */
    public function register($new_user)
    {
        if (isset($new_user[ 'username' ]) && isset($new_user[ 'password' ]) && isset($new_user[ 'phone' ])) {
        	if ($this->_add($new_user)) {
        		return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    /**
     * 检测用户名是否已经存在
     * @author chenjia404
     * @date   2015-01-25
     * @return bool
     */
    public function checkUserNameExists($username)
    {
        $where[ 'username' ] = $username;
        if ($this->_count($username)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 退出登录
     * @author chenjia404
     * @date   2015-01-25
     * @return bool
     */
    public function logout()
    {
        if ($this->isLogin()) {
            $data[ 'token' ] = '';
            $where[ 'id' ]   = $this->user[ 'id' ];
            return $this->_update($data, $where);
        } else {
            return false;
        }
    }
}