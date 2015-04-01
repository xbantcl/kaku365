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

	/**
	 * 添加商品
	 * @author chenjia404
	 * @date   2015-01-25
	 */
	public function addGoods()
	{
	    if (isset($_POST) && count($_POST)) {
	        $goods[ 'name' ]                = $this->input->post('name');
	        $goods[ 'brand_id' ]            = $this->input->post('brand_id');
	        $goods[ 'category1' ]           = $this->input->post('category1');
	        $goods[ 'category2' ]           = $this->input->post('category2');
	        $goods[ 'category3' ]           = $this->input->post('category3');
	        $goods[ 'price' ]               = $this->input->post('price');
	        $goods[ 'format' ]              = $this->input->post('format');
	        $goods[ 'product_code' ]        = $this->input->post('product_code');
	        $goods[ 'product_ingredients' ] = $this->input->post('product_ingredients');
	        $goods[ 'shelf_life' ]          = $this->input->post('shelf_life');
	        $goods[ 'description' ]         = $this->input->post('description');
	        $goods[ 'status' ]         = $this->input->post('status');
	        if (isset($_FILES[ 'images' ])) {
	            $this->load->helper('image');
	            $goods[ 'images' ] = '';
	            $goods[ 'cover_image' ] = '';
	            for ($i = 0; $i < count($_FILES[ 'images' ][ 'tmp_name' ]); $i++) {
	                if (isset($_FILES[ 'images' ][ 'tmp_name' ][ $i ]) && is_uploaded_file($_FILES[ 'images' ][ 'tmp_name' ][ $i ]) && $_FILES[ 'images' ][ 'error' ][ $i ] == 0) {
	                    $x   = explode('.', $_FILES[ 'images' ][ 'name' ][ $i ]);
	                    $ext = strtolower(end($x));
	                    $md5 = $goods[ 'product_code' ] . "_$i";
	                    if (strpos($ext, 'jpg') !== false || strpos($ext, 'png') !== false || strpos($ext,
	                            'gif') !== false
	                    ) {
	                        if (move_uploaded_file($_FILES[ 'images' ][ 'tmp_name' ][ $i ],
	                                'static/uploads/' . $md5 . '.' . $ext)) {
	                                $goods[ 'images' ] .= $md5 . '.' . $ext . ',';
	                                if($goods[ 'cover_image' ] == '')
	                                {
	                                    resizeImage('static/uploads/' . $md5 . '.' . $ext,'static/uploads/square/' . $md5 . '.' . $ext,100);
	                                    resizeImage('static/uploads/' . $md5 . '.' . $ext,'static/uploads/bmiddle/' . $md5 . '.' . $ext,320);
	                                    $goods[ 'cover_image' ] = $md5 . '.' . $ext;
	                                }
	                        }
	
	                    }
	                }
	            }
	        }
	        if($goods[ 'category1' ] == 0)
	        {
	            echo "<script>alert('请选择分类')</script>";
	        }
	        elseif(strlen($goods[ 'product_code' ]) != 13)
	        {
	            echo "<script>alert('请输入13位编码')</script>";
	        }
	        elseif ($this->Manager_model->add_goods($goods)) {
	            echo "<script>alert('添加成功')</script>";
	        } else {
	            echo "<script>alert('添加失败')</script>";
	        }
	    }

	     //$this->load->model('Manager_model');
	    //$data[ 'brands' ]    = $this->Manager_model->get_brand();
	    //$data[ 'categorys' ] = $this->Manager_model->get_category(0);
	    //$data['user'] = $this->Shop_user_model->user;
	    $this->load->view('admin/goods/header',$data);
	    $this->load->view('admin/goods/addGoods');
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */

