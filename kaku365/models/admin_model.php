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
 }