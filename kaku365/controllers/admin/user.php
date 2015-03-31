<?php
/**
 * Created by PhpStorm.
 * User: wubo
 * Date: 2015/1/15
 * Time: 21:01
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this -> load -> model('User_model');
    }


    /**
     * 用户管理
     * @author wuanbo
     * @date 2015-01
     */
    public function userManager()
    {
        #权限验证
        if (! $this->session->userdata('login_admin'))
        {
            redirect('admin/login');
        }

        $res = $this ->User_model-> getUserList();

        $data['res'] = $res;

        $this -> load -> view('admin/admin3_1',$data);
    }

    public function del()
    {
        $userid = $this -> input->get('userid');

        $res = $this -> User_model ->delUser($userid);

        if($res)
        {
            echo "<script>alert('成功');window.location=\"../userManager/\"</script>";
        }
        else
        {
            echo "<script>alert('失败');</script>";
        }
    }

    public function search()
    {

        $type =  $this -> input->get('type');
        $key =  $this -> input->get('key');

        $like[$type] = $key;

        $res =  $this -> User_model -> searchUser(array(),$like);
        $data['res'] = $res;
        $this -> load ->view('admin/admin3_1',$data);
    }


}