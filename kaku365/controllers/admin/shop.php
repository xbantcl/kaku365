<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> load -> model('admin_model');
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
	 * @author xiaoboa
	 * @date   2015-04-04
	 */
	public function addGoods()
	{
	    if (isset($_POST) && count($_POST)) {
	        $goods[ 'name' ]                = $this->input->post('name');
	        $goods[ 'brand_id' ]            = $this->input->post('brand_id');
	        $goods[ 'net_content' ]         = $this->input->post('net_content');
	        $goods[ 'format' ]              = $this->input->post('format');
	        $goods[ 'product_code' ]        = $this->input->post('product_code');
	        $goods[ 'product_ingredients' ] = $this->input->post('product_ingredients');
	        $goods[ 'shelf_life' ]          = $this->input->post('shelf_life');
	        $goods[ 'status' ]              = 1;
	    	if(strlen($goods[ 'product_code' ]) != 13) {
	            echo "<script>alert('请输入13位编码')</script>";
	            $this->load->view('admin/goods/addGoods');
	            exit;
	        } elseif (isset($_FILES[ 'images' ])) {
	        	$this->load->helper('common');
	            $this->load->helper('image');
	            $goods[ 'images' ] = '';
	            $goods[ 'cover_image' ] = '';
	            $filePath = createFolder(UPLOAD_PATH, 'admin_goods');
	            if (!$filePath) {
	            	echo "<script>alert('添加商品失败')</script>";
	            }
	            for ($i = 0; $i < count($_FILES[ 'images' ][ 'tmp_name' ]); $i++) {
	                if (isset($_FILES[ 'images' ][ 'tmp_name' ][ $i ]) && is_uploaded_file($_FILES[ 'images' ][ 'tmp_name' ][ $i ]) && $_FILES[ 'images' ][ 'error' ][ $i ] == 0) {
	                    $x   = explode('.', $_FILES[ 'images' ][ 'name' ][ $i ]);
	                    $ext = strtolower(end($x));
	                    $md5 = $goods[ 'product_code' ] . "_{$i}_" . time();
	                    if (strpos($ext, 'jpg') !== false || strpos($ext, 'png') !== false || strpos($ext, 'gif') !== false) {
	                    	$fileName   = "{$md5}.{$ext}";  
	                    	$saveStatus = move_uploaded_file($_FILES[ 'images' ][ 'tmp_name' ][ $i ], $filePath . $fileName);
	                        if ($saveStatus) {
	                        	$goods[ 'images' ] .= $fileName . ',';
	                            if($goods[ 'cover_image' ] == ''){
	                            	$squarePath = createFolder(UPLOAD_PATH, 'square');
	                            	$bmiddlePath = createFolder(UPLOAD_PATH, 'bmiddle');
	                            	resizeImage($filePath . $fileName, $squarePath . $fileName, 100);
	                                resizeImage($filePath . $fileName, $bmiddlePath . $fileName, 320);
	                                $goods[ 'cover_image' ] = $fileName;
	                            }
	                        }
	
	                    }
	                }
	            }
	        }
	        if ($this->admin_model->addGoods($goods)) {
	            echo "<script>alert('添加成功')</script>";
	        } else {
	            echo "<script>alert('添加失败')</script>";
	        }
	    }
	    $data[ 'brands' ] = $this->admin_model->brandList();
	    $this->load->view('admin/goods/addGoods', $data);
	}
	
    /**
     * 管理商品
     * @author xiaoboa
     * @date   2015-04-04
     */
    public function goodsList()
    {
        $like      = array();
        $next_page = '?';
        if (strlen($this->input->get('name'))) {
            $like[ 'name' ] = $this->input->get('name');
            $next_page .= "&name=" . $this->input->get('name');
        }
        $where = array();
        if (strlen($this->input->get('brand_id'))) {
            $where[ 'brand_id' ] = $this->input->get('brand_id');
            $next_page .= "&brand_id=" . $this->input->get('brand_id');
        }
        if ($this->input->get('status') != 'all' && $this->input->get('status') !== false) {
            $where[ 'status' ] = $this->input->get('status');
            $next_page .= "&status=" . $this->input->get('status');
        }
        if (strlen($this->input->get('category1'))) {
            $where[ 'category1' ] = $this->input->get('category1');
            $next_page .= "&category1=" . $this->input->get('category1');
        }
        if (strlen($this->input->get('category2'))) {
            $where[ 'category2' ] = $this->input->get('category2');
            $next_page .= "&category2=" . $this->input->get('category2');
        }
        if (strlen($this->input->get('category3'))) {
            $where[ 'category3' ] = $this->input->get('category3');
            $next_page .= "&category3=" . $this->input->get('category3');
        }
        $page = intval($this->input->get('page'));
        if ($page < 1) {
            $page = 1;
        }
        $data['goods']     = $this->admin_model->goodsList($like, $where, $page);
        $data['brands']    = $this->admin_model->brandList();
        $brands    = $data['brands'];
        foreach($brands as $br)
        {
            $data['all_brands'][$br['id']] = $br['name'];
        }
        $this->load->view('admin/goods/' . __FUNCTION__, $data);
    }

    /**
     * 删除商品
     * @author xiaoboa
     * @date   2015-04-04
     * @param  integer $id
     */
    public function deleteGoodsTemplate($id = 0)
    {
        $this->admin_model->deleteGoodsTemplate($id);
        echo json_encode(array('msg' => '删除成功'));
    }
    
    /**
     * 更新商品
     * @param integer $id
     */
    public function updateGoods($id = 0)
    {
        if (isset($_POST) && count($_POST)) {
	        $goods[ 'name' ]                = $this->input->post('name');
	        $goods[ 'brand_id' ]            = $this->input->post('brand_id');
	        $goods[ 'net_content' ]         = $this->input->post('net_content');
	        $goods[ 'format' ]              = $this->input->post('format');
	        $goods[ 'product_code' ]        = $this->input->post('product_code');
	        $goods[ 'product_ingredients' ] = $this->input->post('product_ingredients');
	        $goods[ 'shelf_life' ]          = $this->input->post('shelf_life');
	        $goods[ 'status' ]              = $this->input->post('status');
            if (isset($_FILES[ 'images' ])) {
                $goods[ 'images' ] = '';
                $goods[ 'cover_image' ] = '';
                $this->load->helper('image');
                $this->load->helper('common');
                $filePath = createFolder(UPLOAD_PATH, 'admin_goods');
	            if (!$filePath) {
	            	echo "<script>alert('更新商品失败')</script>";
	            }
                for ($i = 0; $i < count($_FILES[ 'images' ][ 'tmp_name' ]); $i++) {
                    if ($_FILES[ 'images' ][ 'error' ][ $i ] == 0 && is_uploaded_file($_FILES[ 'images' ][ 'tmp_name' ][ $i ])) {
                        $x   = explode('.', $_FILES[ 'images' ][ 'name' ][ $i ]);
                        $ext = strtolower(end($x));
                        $md5 = $goods[ 'product_code' ] . "_$i";
                        if (strpos($ext, 'jpg') !== false || strpos($ext, 'png') !== false || strpos($ext, 'gif') !== false) {
                            $fileName   = "{$md5}.{$ext}";  
	                    	$saveStatus = move_uploaded_file($_FILES[ 'images' ][ 'tmp_name' ][ $i ], $filePath . $fileName);
                        	if ($saveStatus) {
                                $goods[ 'images' ] .= $fileName . ',';
                                if($goods[ 'cover_image' ] == '')
                                {
	                            	$squarePath = createFolder(UPLOAD_PATH, 'square');
	                            	$bmiddlePath = createFolder(UPLOAD_PATH, 'bmiddle');
	                            	resizeImage($filePath . $fileName, $squarePath . $fileName, 100);
	                                resizeImage($filePath . $fileName, $bmiddlePath . $fileName, 320);
	                                $goods[ 'cover_image' ] = $fileName;
                                }
                            }

                        }
                    }
                }
                if($goods[ 'images' ]  == '')
                    unset($goods[ 'images' ] );
                if($goods[ 'cover_image' ]  == '')
                    unset($goods[ 'cover_image' ] );
            }
            if ($this->admin_model->updataGoods($goods, $id)) {
                echo "<script>alert('更新成功')</script>";
            } else {
                echo "<script>alert('更新失败')</script>";
            }
        }
        $where[ 'id' ]       = $id;
        $goods               = $this->admin_model->goodsList(array(), $where);
        $data[ 'goods' ]     = $goods[ 0 ];
        $data[ 'brands' ]    = $this->admin_model->brandList();
        $this->load->view('admin/goods/' . __FUNCTION__, $data);
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */

