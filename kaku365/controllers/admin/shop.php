<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//$this -> load -> model('admin_model');
		$this -> load -> model('Shop_model');
		$this -> load -> model('search_model');
		$this -> load -> library('pagination');
	}


	//商家管理
	public function manager()
	{
	    // 页数显示
	    $pageSize = 5;
		#权限验证
		if (! $this->session->userdata('login_admin'))
		{
			redirect('admin/login');
		}
        $this->load->helper('paginate');
		$page = (int)$this->input->get('p');
        if($page <= 0)
            $page = 1;
		$res = $this ->Shop_model-> getShopList($pageSize, $page-1);
		$data['all_page'] = ceil($this ->Shop_model-> getTotal() / $pageSize) ;
        $data['pagination'] = paginationByTotalPage($page, $data['all_page']);
		$data['res'] = $res;
		$this -> load ->view('admin/admin2_1',$data);
	}


	/**
	 * 删除商户
	 * @author wuanbo
	 * @date 2015-01
	 */
	public function del()
	{
		$shopid = $this -> input->get('shopid');

		$res = $this -> Shop_model ->delShop($shopid);

		if($res)
		{
			echo "<script>alert('成功');window.location=\"../manager/\"</script>";
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

		$res =  $this -> Shop_model -> searchShop(array(),$like);
		$data['res'] = $res;
		$this -> load ->view('admin/admin2_1',$data);
	}


}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */

