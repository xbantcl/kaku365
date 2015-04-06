<?php
/**
 * @author: chenjia404
 * @Date  : 2015/1/27
 * @Time  : 13:51
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Manager extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Shop_user_model');
        if (!$this->Shop_user_model->isLogin()) {
            redirect('shop_user/login');
        }
        $this->load->model('Manager_model');
        $this->load->model('goods_model');
    }


    /**
     * 商家后台首页
     * @author chenjia404
     * @date   2015-01-25
     */
    public function index()
    {
        $data['user'] = $this->Shop_user_model->user;
        $this->load->view('manager/header',$data);
        $this->load->view('manager/menu');
        $this->load->view('manager/' . __FUNCTION__);
        $this->load->view('manager/footer');
    }


    /**
     * 商家名片编辑
     * @author chenjia404
     * @date   2015-01-25
     */
    public function info()
    {

        if (isset($_POST) && count($_POST)) {
            $shop[ 'name' ]      = $this->input->post("name");
            $shop[ 'contacts' ]  = $this->input->post("contacts");
            $shop[ 'telephone' ] = $this->input->post("telephone");
            $shop[ 'address' ]   = $this->input->post("address");
            $shop[ 'introduce' ] = $this->input->post("introduce");
            if (isset($_FILES[ 'img_path' ])) {
                $config[ 'upload_path' ]   = 'static/uploads/';
                $config[ 'allowed_types' ] = 'gif|jpg|png';
                $config[ 'encrypt_name' ]  = true;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('img_path')) {
                    $upload             = $this->upload->data();
                    $shop[ 'img_path' ] = 'static/uploads/'.$upload[ 'file_name' ];
                }
            }
            $this->Manager_model->update_shop($shop);
        }
        $data[ 'shop' ] = $this->Manager_model->get_shop();
        $data['user'] = $this->Shop_user_model->user;
        $this->load->view('manager/header',$data);
        $this->load->view('manager/menu');
        $this->load->view('manager/' . __FUNCTION__);
        $this->load->view('manager/footer');
    }


    /**
     * 添加商品
     * @author chenjia404
     * @date   2015-01-25
     */
    public function add_goods()
    {
    	$checkValue = '';
    	// 前端模板页面
    	$template   = 'add_goods_1';
    	if (isset($_POST) && count($_POST)) {
    		$checkValue = $this->input->post('add-goods');
    	}
    	if (isset($_POST) && count($_POST) && 'prdCode' == $checkValue) {
    		$prdCode = $this->input->post('product_code');
    		$gt = $this->goods_model->getGoodsTemplate($prdCode);
    		if (!empty($gt)) {
    			$data['name']   = $gt['brand_name'] . ' ' . $gt['name'] . ' ' . $gt['net_content'];
    			$data['format'] = $gt['format'];
    			$data['brand_name']  = $gt['brand_name'];
    			$data['product_code'] = $gt['product_code'];
    			$data['product_ingredients'] = $gt['product_ingredients'];
    			$data['shelf_life'] = $gt['shelf_life'];
    			$data['brand_id']   = $gt['brand_id'];
    			$data['cover_image']   = $gt['cover_image'];
    			$data['prd_images']   = $gt['images'];
    			$data['images'] = explode(',', $gt['images']);
	    		$data[ 'brands' ]    = $this->Manager_model->get_brand();
		        $data[ 'categorys' ] = $this->Manager_model->get_category(0);
		        $data['user'] = $this->Shop_user_model->user;
				$template = 'add_goods_2';
    		}
    	} elseif (isset($_POST) && count($_POST)) {
            $goods[ 'name' ]                = $this->input->post('name');
            $goods[ 'brand_id' ]            = $this->input->post('brand_id');
            $goods[ 'category1' ]           = $this->input->post('category1');
            $goods[ 'category2' ]           = $this->input->post('category2');
            $goods[ 'category3' ]           = $this->input->post('category3');
            $goods[ 'price' ]               = $this->input->post('price');
            $goods[ 'format' ]              = $this->input->post('format_h');
            $goods[ 'product_code' ]        = $this->input->post('product_code_h');
            $goods[ 'product_ingredients' ] = $this->input->post('product_ingredients_h');
            $goods[ 'shelf_life' ]          = $this->input->post('shelf_life_h');
            $goods[ 'description' ]         = $this->input->post('description');
            $goods[ 'status' ]              = $this->input->post('status');
            $goods[ 'cover_image' ]         = $this->input->post('cover_image');
            $goods[ 'images' ]          = $this->input->post('prd_images');
            if (isset($_FILES[ 'images' ])) {
                $this->load->helper('image');
                $goods[ 'images' ] = '';
                $goods[ 'cover_image' ] = '';
                for ($i = 0; $i < count($_FILES[ 'images' ][ 'tmp_name' ]); $i++) {
                    if (isset($_FILES[ 'images' ][ 'tmp_name' ][ $i ]) && is_uploaded_file($_FILES[ 'images' ][ 'tmp_name' ][ $i ]) && $_FILES[ 'images' ][ 'error' ][ $i ] == 0) {
                        $x   = explode('.', $_FILES[ 'images' ][ 'name' ][ $i ]);
                        $ext = strtolower(end($x));
                        $md5 = $goods[ 'product_code' ] . "_$i";
                        $this->load->helper('common');
                		$filePath = createFolder(UPLOAD_PATH, 'manager_goods');
	            		if (!$filePath) {
	            			echo "<script>alert('添加商品失败')</script>";
	            		}
                        if (strpos($ext, 'jpg') !== false || strpos($ext, 'png') !== false || strpos($ext,
                                'gif') !== false
                        ) {
                        	$fileName   = "{$md5}.{$ext}";  
	                    	$saveStatus = move_uploaded_file($_FILES[ 'images' ][ 'tmp_name' ][ $i ], $filePath . $fileName);
                            if ($saveStatus) {
                                $goods[ 'images' ] .= $fileName . ',';
                                if($goods[ 'cover_image' ] == '')
                                {
	                            	$squarePath = createFolder(UPLOAD_PATH, 'manager_square');
	                            	$bmiddlePath = createFolder(UPLOAD_PATH, 'manager_bmiddle');
	                            	resizeImage($filePath . $fileName, $squarePath . $fileName, 100);
	                                resizeImage($filePath . $fileName, $bmiddlePath . $fileName, 320);
	                                $goods[ 'cover_image' ] = $fileName;
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
        $data[ 'brands' ]    = $this->Manager_model->get_brand();
        $data[ 'categorys' ] = $this->Manager_model->get_category(0);
        $data['user'] = $this->Shop_user_model->user;
        $this->load->view('manager/header',$data);
        $this->load->view('manager/menu');
        $this->load->view('manager/' . $template);
        $this->load->view('manager/footer');
    }

    /**
     * 添加商品
     * @author chenjia404
     * @date   2015-01-25
     */
    public function add_goods_2()
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
        $data[ 'brands' ]    = $this->Manager_model->get_brand();
        $data[ 'categorys' ] = $this->Manager_model->get_category(0);
        $data['user'] = $this->Shop_user_model->user;
        $this->load->view('manager/header',$data);
        $this->load->view('manager/menu');
        $this->load->view('manager/add_goods_1');
        $this->load->view('manager/footer');
    }

    /**
     * 新增品牌
     * @author chenjia404
     * @date   2015-01-25
     */
    public function add_brand()
    {
        if (isset($_POST) && count($_POST)) {
            $brand[ 'name' ] = $this->input->post('name');
            $brand[ 'rank' ] = $this->input->post('rank');
            if (isset($_FILES[ 'image' ]) && $_FILES[ 'image' ]['error'] == 0) {
                $x   = explode('.', $_FILES[ 'image' ][ 'name' ]);
                $ext = strtolower(end($x));
                $md5 = md5_file($_FILES[ 'image' ][ 'tmp_name' ]);
                if (strpos($ext, 'jpg') !== false || strpos($ext, 'png') !== false || strpos($ext,
                        'gif') !== false
                ) {
                    if (move_uploaded_file($_FILES[ 'image' ][ 'tmp_name' ],
                        'd:/webroot/kaku365/static/uploads/brand/' . $md5 . '.' . $ext)) {
                        $brand[ 'image' ]  = $md5 . '.' . $ext;
                    }
                }
            }
            if ($this->Manager_model->add_brand($brand)) {
                echo "<script>alert('添加成功')</script>";
            } else {
                echo "<script>alert('添加失败')</script>";
            }
        }
        $data['user'] = $this->Shop_user_model->user;
        $this->load->view('manager/header',$data);
        $this->load->view('manager/menu');
        $this->load->view('manager/' . __FUNCTION__);
        $this->load->view('manager/footer');
    }


    /**
     * 编辑品牌
     * @author chenjia404
     * @date   2015-01-25
     * @param int $id
     */
    public function update_brands($id = 0)
    {
        $where[ 'id' ]    = $id;
        if(isset($_POST['name']) &&  isset($_POST['rank']))
        {
            $brand[ 'name' ] = $this->input->post('name');
            $brand[ 'rank' ] = $this->input->post('rank');
            if (isset($_FILES[ 'image' ]) && $_FILES[ 'image' ]['error'] == 0) {
                $x   = explode('.', $_FILES[ 'image' ][ 'name' ]);
                $ext = strtolower(end($x));
                if(file_exists($_FILES[ 'image' ][ 'tmp_name' ]))
                {
                $md5 = md5_file($_FILES[ 'image' ][ 'tmp_name' ]);
                if (strpos($ext, 'jpg') !== false || strpos($ext, 'png') !== false || strpos($ext,
                        'gif') !== false
                ) {
                    if (move_uploaded_file($_FILES[ 'image' ][ 'tmp_name' ],
                        'static/uploads/brand/' . $md5 . '.' . $ext)) {
                        $brand[ 'image' ] = $md5 . '.' . $ext;
                    }
                }
                }
            }
            $this->Manager_model->update_brand($brand, $where);
        }
        $where[ 'id' ]    = $id;
        $brands           = $this->Manager_model->brand_list(array(), $where);
        $data[ 'brands' ] = $brands[0];
        $data['user'] = $this->Shop_user_model->user;
        $this->load->view('manager/header',$data);
        $this->load->view('manager/menu');
        $this->load->view('manager/' . __FUNCTION__);
        $this->load->view('manager/footer');
    }


    /**
     * 品牌管理
     * @author chenjia404
     * @date   2015-01-25
     */
    public function brand_list()
    {
        $next_page = '?';
        $like      = array();
        if (strlen($this->input->get('name'))) {
            $like[ 'name' ] = $this->input->get('name');
            $next_page .= "&name=" . $this->input->get('name');
        }
        $page = intval($this->input->get('page'));
        if ($page < 1) {
            $page = 1;
        }
        $data[ 'brands' ] = $this->Manager_model->brand_list($like, array(), $page);
        if (count($data[ 'brands' ]) >= 10) {
            $data[ 'next_page' ] = $next_page . "&page=" . ($page + 1);
        }
        if ($page > 1) {
            $data[ 'preview_page' ] = $next_page . "&page=" . ($page - 1);
        }
        $data['user'] = $this->Shop_user_model->user;
        $this->load->view('manager/header',$data);
        $this->load->view('manager/menu');
        $this->load->view('manager/' . __FUNCTION__);
        $this->load->view('manager/footer');
    }


    /**
     * 删除品牌
     * @author chenjia404
     * @date   2015-01-25
     * @param int $id
     */
    public function delete_brands($id = 0)
    {
        $this->Manager_model->delete_brands($id);
        echo json_encode(array('msg' => '删除成功<script>window.location.reload();</script>'));
    }

    /**
     * 添加商品分类
     * @author chenjia404
     * @date   2015-01-25
     */
    public function add_category()
    {
        if (isset($_POST) && count($_POST)) {
            $category[ 'leave' ]  = $this->input->post('leave');
            $category[ 'pid' ]    = $this->input->post('pid');
            $category[ 'name' ]   = $this->input->post('name');
            $category[ 'status' ] = $this->input->post('status');
            if ($this->Manager_model->add_category($category)) {
                echo "<script>alert('添加成功')</script>";
            } else {
                echo "<script>alert('添加失败')</script>";
            }
        }
        $data[ 'categorys' ] = $this->Manager_model->get_category(0);
        $data['user'] = $this->Shop_user_model->user;
        $this->load->view('manager/header',$data);
        $this->load->view('manager/menu');
        $this->load->view('manager/' . __FUNCTION__);
        $this->load->view('manager/footer');
    }


    /**
     * 管理分类
     * @author chenjia404
     * @date   2015-01-25
     */
    public function category_list()
    {
        $data['title'] = '分类管理';
        $data['user'] = $this->Shop_user_model->user;
        $this->load->view('manager/header',$data);
        $this->load->view('manager/menu');
        $this->load->view('manager/' . __FUNCTION__);
        $this->load->view('manager/footer');
    }

    /**
     * ajax获取商品分类
     * @author chenjia404
     * @date   2015-01-25
     */
    public function get_category_ajax()
    {
        $pid = (int)$this->input->get('id');
        $data = $this->Manager_model->get_category($pid);
        echo json_encode($data);
    }


    /**
     * 删除分类
     * @author chenjia404
     * @date   2015-02-11
     */
    public function category_delete()
    {
        if($this->Manager_model->category_delete($this->input->post('id')))
            echo json_encode(array('msg'=>'删除成功'));
        else
            echo json_encode(array('msg'=>'删除失败'));
    }


    /**
     * 更新分类
     * @author chenjia404
     * @date   2015-02-11
     */
    public function category_update($id)
    {
        $id = (int)$id;
        if (isset($_POST) && count($_POST)) {
            $category[ 'leave' ]  = $this->input->post('leave');
            $category[ 'pid' ]    = $this->input->post('pid');
            $category[ 'name' ]   = $this->input->post('name');
            $category[ 'status' ] = $this->input->post('status');
            if ($this->Manager_model->category_update($id,$category)) {
                echo "<script>alert('更新成功')</script>";
            } else {
                echo "<script>alert('更新失败')</script>";
            }
        }
       
        $data[ 'categorys' ] = $this->Manager_model->get_category(0);//exit(json_encode($data[ 'categorys' ]));
        $data[ 'categorys_path' ] = $this->Manager_model->get_category_path($id);
        $data['category'] = $this->Manager_model->get_category_one($id);
        $data['title'] = '更新分类';
        $data['user'] = $this->Shop_user_model->user;
        $this->load->view('manager/header',$data);
        $this->load->view('manager/menu');
        $this->load->view('manager/' . __FUNCTION__);
        $this->load->view('manager/footer');
    }


    /**
     * ajax获取商品分类
     * @author chenjia404
     * @date   2015-01-25
     */
    public function get_category_tree_ajax()
    {
        $pid = (int)$this->input->get('id');
        $data = $this->Manager_model->get_category_tree($pid);
        echo json_encode($data);
    }


    /**
     * 管理商品
     * @author chenjia404
     * @date   2015-01-25
     */
    public function goods_list()
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


        $data[ 'goods' ]     = $this->Manager_model->goods_list($like, $where, $page);
        $data['brands']    = $this->Manager_model->get_brand();
        $data['all_page']    = $this->Manager_model->all_page();
        $brands    = $data['brands'];
        foreach($brands as $br)
        {
            $data['all_brands'][$br['id']] = $br['name'];
        }
        $data[ 'categorys' ] = $this->Manager_model->get_category(0);
        $data[ 'all_category' ] = $this->Manager_model->get_all_category();
        $data[ 'page_href' ] = $next_page;
        $data[ 'page' ] = $page;
        if (count($data[ 'goods' ]) >= 10) {
            $data[ 'next_page' ] = $next_page . "&page=" . ($page + 1);
        }
        if ($page > 1) {
            $data[ 'preview_page' ] = $next_page . "&page=" . ($page - 1);
        }
        $data['user'] = $this->Shop_user_model->user;
        $this->load->view('manager/header',$data);
        $this->load->view('manager/menu');
        $this->load->view('manager/' . __FUNCTION__);
        $this->load->view('manager/footer');
    }


    /**
     * 删除商品
     * @author chenjia404
     * @date   2015-01-25
     * @param int $id
     */
    public function delete_goods($id = 0)
    {
        $this->Manager_model->delete_goods($id);
        echo json_encode(array('msg' => '删除成功'));
    }


    public function update_goods($id = 0)
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
                $goods[ 'images' ] = '';
                $goods[ 'cover_image' ] = '';
                $this->load->helper('image');
                for ($i = 0; $i < count($_FILES[ 'images' ][ 'tmp_name' ]); $i++) {
                    if ($_FILES[ 'images' ][ 'error' ][ $i ] == 0 && is_uploaded_file($_FILES[ 'images' ][ 'tmp_name' ][ $i ])) {
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
                if($goods[ 'images' ]  == '')
                    unset($goods[ 'images' ] );
                if($goods[ 'cover_image' ]  == '')
                    unset($goods[ 'cover_image' ] );
            }
            if ($this->Manager_model->updata_goods($goods, $id)) {
                echo "<script>alert('更新成功')</script>";
            } else {
                echo "<script>alert('更新失败')</script>";
            }
        }
        $where[ 'id' ]       = $id;
        $goods               = $this->Manager_model->goods_list(array(), $where);
        $data[ 'goods' ]     = $goods[ 0 ];
        $data[ 'brands' ]    = $this->Manager_model->get_brand();
        $data[ 'category_s' ] = $this->Manager_model->get_good_category($data[ 'goods' ]);
        $data[ 'categorys' ] = $this->Manager_model->get_category(0);
        $data['user'] = $this->Shop_user_model->user;
        $this->load->view('manager/header',$data);
        $this->load->view('manager/menu');
        $this->load->view('manager/' . __FUNCTION__);
        $this->load->view('manager/footer');
    }


    /**
     * 订单列表
     * @author chenjia404
     * @date   2015-02-12
     */
    public function order_list()
    {
        $data['title'] = '订单列表';
        $data['status'] = array('关闭','未处理','已处理','已废除');
        $shop = $this->Manager_model->get_shop();
        $shop_id = $shop['id'];
        $status = (int) $this->input->get('status');
        $page = (int) $this->input->get('p');
        if($page < 1)
            $page = 1;
        $this->load->model('Order_model');
        $data['orders'] = $this->Order_model->getOrderByShop($shop_id,$status,$page,10);
        if($page > 1)
         $data['preview_page'] = '/manager/order_list/?p=' . ($page - 1);
        if(count($data['orders']) == 10)
        $data['next_page'] = '/manager/order_list/?p=' . ($page + 1);
        if($status > 0)
        {
            if(isset($data['next_page']))
                $data['next_page'] .= '&status=' . $status;
            if(isset($data['preview_page']))
                $data['preview_page'] .= '&status=' . $status;
        }
        $data['user'] = $this->Shop_user_model->user;
        $this->load->view('manager/header',$data);
        $this->load->view('manager/menu');
        $this->load->view('manager/' . __FUNCTION__);
        $this->load->view('manager/footer');
    }



    public function order_detail($order_id)
    {
        $this->load->model('Order_model');
        if($this->input->get('send_goods'))
        {
            if($this->Order_model->updateOrder($order_id,$this->input->get('send_goods')))
                exit(json_encode(array('msg'=>'操作成功')));
            else
                exit(json_encode(array('msg'=>'操作失败')));
        }
        $data['title'] = '订单详情';
        $data['details'] = $this->Order_model->getOrderDetails($order_id);
        $data['orders'] = $this->Order_model->getOrder($order_id);
        $data['user'] = $this->Shop_user_model->user;
        $this->load->view('manager/header',$data);
        $this->load->view('manager/menu');
        $this->load->view('manager/' . __FUNCTION__);
        $this->load->view('manager/footer');
    }
}