<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->helper('captcha');

//		$this -> load -> model('admin_model');
		$this -> load -> model('Shop_model');
		$this -> load -> model('Admin_model');
        $this -> load -> model('user_model');
        $this -> load -> model('shop_model');
	}


	//首页加载
	public function index() {
		#权限验证
		if (! $this->session->userdata('login_admin'))
		{
			redirect('admin/login');
		}

		$userid =  $this->session->userdata('login_admin');

		$res = $this -> Admin_model -> getThisUser($userid);

		$data['name'] = $res['username'];

		$this -> load -> view('admin/admin_view',$data);
	}


	//欢迎页面
	public function serverData()
	{
		#权限验证
		if (! $this->session->userdata('login_admin'))
		{
			redirect('admin/login');
		}
        $data['userweeknums'] = $this->user_model->getWeekUsers();
        $data['shopweeknums'] = $this->shop_model->getWeekShops();
        $data['usernums'] = $this->db->count_all('user');
        $data['shopnums'] = $this->db->count_all('shop_user');
		$this -> load ->view('admin/admin1_1',$data);
	}

	//清理缓存
	public function clear()
	{
		#权限验证
		if (! $this->session->userdata('login_admin'))
		{
			redirect('admin/login');
		}
		$this -> load ->view('admin/admin1_2');
	}

	//数据备份
	public function backup()
	{
		#权限验证
		if (! $this->session->userdata('login_admin'))
		{
			redirect('admin/login');
		}
		$this -> load -> view('admin/admin1_3');
	}

	//数据恢复
	public function recover()
	{
		#权限验证
		if (! $this->session->userdata('login_admin'))
		{
			redirect('admin/login');
		}
		$this -> load ->view('admin/admin1_4');
	}





	/**
	 * 生成验证码
	 * @author wuanbo
	 * @date 2015-01
	 */

	public function code(){
	    $this->load->helper('image');
	    $verifyCode = generateVerifyCodeImg();
	    $this->session->set_userdata('admin_code', $verifyCode['code']);
	    header("Content-type: image/gif");
	    echo $verifyCode['img'];
	    exit;
	}


	/**
	 * 登陆
	 * @author wuanbo
	 * @date 2015-01
	 */
	public function login()
	{
		if(!empty($_POST))
		{

			$username = $this -> input -> post('user_name');
			$password = $this -> input -> post('password');
			$captcha = strtolower($this -> input ->post('captcha'));

			$code = strtolower($this->session->userdata('admin_code'));
			$password = trim($password);
			$password = md5($password);

			if ($captcha == $code)
			{
					$res = $this -> Admin_model -> getUser($username);

				if($res)
				{
					if($res['password'] == $password)
					{
						$this->session->set_userdata('login_admin',$res['id']);
						redirect('admin/index');

					}
					else
					{
						echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
						echo "<script> {window.alert('用户名或密码错误!');location.href='login'} </script>";

					}

				}
				else
				{
					echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
					echo "<script> {window.alert('用户名或密码错误!');} </script>";

				}
			}
			else
			{

				echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
				echo "<script> {window.alert('验证码错误!');} </script>";

			}

		}


		$this -> load ->view('admin/login');
	}
        
        public function checkAdmin()
        {
            if ($this->session->userdata('login_admin'))
                {
                    return TRUE;
		}
                else
                {
                    return FALSE;
                }
        }
        
        public function alertpassword()
        {
           
            if(!empty($_POST))
            {
                $userid =  $this->session->userdata('login_admin');
                $res = $this -> Admin_model -> getThisUser($userid);
                
                $passworddb = $res['password'];
                $passwordold = $this -> input -> post('oldpassword');
				$password = $this -> input -> post('password');
                $passwordold = md5($passwordold);
                $password = md5($password);
                
                if($passwordold == $passworddb)
                {
                    $res = $this -> Admin_model -> alterpass($password,$res['id']);
                    if($res)
                    {
                        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                        echo "<script> {window.alert('修改成功');} </script>";
                    }
                    else
                    {
                        echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                        echo "<script> {window.alert('修改失败');} </script>";
                    }
                }
                else
                {
                    echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                    echo "<script> {window.alert('密码错误');} </script>";
                }
                              
            }
            $this -> load ->view('admin/alterpass');
        }

	public function shopManage()
	{
		$shopid = $this -> input -> get("shop_user_id");
		$this->session->set_userdata('shopManage_admin',$shopid);
		redirect('/manager/info/');
	}

	public function userManage()
	{
		$userid = $this -> input -> get("user_id");
        $this -> session -> set_userdata('id',$userid);
		$this->session->set_userdata('user_admin',$userid);
		redirect('/user/index/');
	}



	public function logout()
	{
		$this->session->unset_userdata('login_admin');
		$this->session->sess_destroy();
		redirect('admin/login');
	}
	
    /**
     * 添加商品分类
     * @author xiaoboa
     * @date   2015-04-03
     */
    public function addCategory()
    {
        if (isset($_POST) && count($_POST)) {
            $category[ 'leave' ]  = $this->input->post('leave');
            $category[ 'pid' ]    = $this->input->post('pid');
            $category[ 'name' ]   = $this->input->post('name');
            $category[ 'status' ] = $this->input->post('status');
            if ($this->Admin_model->addCategory($category)) {
                echo "<script>alert('添加成功')</script>";
            } else {
                echo "<script>alert('添加失败')</script>";
            }
        }
        $data['categorys'] = $this->Admin_model->getCategories();
        $this->load->view('admin/goods/' . __FUNCTION__, $data);
    }
    
    /**
     * ajax获取商品分类
     * @author xiaoboa
     * @date   2015-04-03
     */
    public function getCategoryAjax()
    {
        $pid = (int)$this->input->get('id');
        $data = $this->Admin_model->getCategory($pid);
        echo json_encode($data);
    }
    
    /**
     * 管理分类
     * @author xiaoboa
     * @date   2015-04-03
     */
    public function categoryList()
    {
        $data['title'] = '分类管理';
        $this->load->view('admin/goods/' . __FUNCTION__, $data);
    }
    
    /**
     * ajax获取商品分类
     * @author xiaoboa
     * @date   2015-04-03
     */
    public function getCategoryTreeAjax()
    {
        $pid = (int)$this->input->get('id');
        $data = $this->Admin_model->getCategoryTree();
        echo json_encode($data);
    }
    
    /**
     * 更新分类
     * @author xiaoboa
     * @date   2015-04-03
     * 
     * @param integer $id 分类ID.
     */
    public function categoryUpdate($id)
    {
        $id = (int)$id;
        if (isset($_POST) && count($_POST)) {
            $category[ 'leave' ]  = $this->input->post('leave');
            $category[ 'pid' ]    = $this->input->post('pid');
            $category[ 'name' ]   = $this->input->post('name');
            $category[ 'status' ] = $this->input->post('status');
            if ($this->Admin_model->updateCategory($id, $category)) {
                echo "<script>alert('更新成功')</script>";
            } else {
                echo "<script>alert('更新失败')</script>";
            }
        }
        $data['categorys'] = $this->Admin_model->getCategories();
        $data['categorys_path'] = $this->Admin_model->getCategoryPath($id);
        $data['category'] = $this->Admin_model->getCategoryOne($id);
        $data['title'] = '更新分类';
        $this->load->view('admin/goods/updateCategory', $data);
    }
    
    /**
     * 删除分类
     * @author xiaoboa
     * @date   2015-04-07
     */
    public function categoryDelete()
    {
        if($this->Admin_model->categoryDelete($this->input->post('id')))
            echo json_encode(array('msg'=>'删除成功'));
        else
            echo json_encode(array('msg'=>'删除失败'));
    }
    
    /**
     * 新增品牌
     * @author xiaoboa
     * @date   2015-01-25
     */
    public function addBrand()
    {
        if (isset($_POST) && count($_POST)) {
            $brand['name'] = $this->input->post('name');
            $brand['rank'] = $this->input->post('rank');
            $filePath = UPLOAD_PATH . '/brands/';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $x   = explode('.', $_FILES[ 'image' ][ 'name' ]);
                $ext = strtolower(end($x));
                $md5 = md5_file($_FILES[ 'image' ][ 'tmp_name' ]);
                if (strpos($ext, 'jpg') !== false || strpos($ext, 'png') !== false || strpos($ext, 'gif') !== false) {
                	if (!is_dir($filePath)) {
                		@mkdir($filePath, 0777);
                	}
                	if (!is_dir($filePath)) {
                		echo "<script>alert('添加失败')</script>";
                		$this->load->view('admin/brand/' . __FUNCTION__);
                	}
                	$fileName = $filePath . $md5 . '.' . $ext;
                	$saveStatus = move_uploaded_file($_FILES[ 'image' ][ 'tmp_name' ], $fileName); 
                    if ($saveStatus) {
                        $brand['image']  = $md5 . '.' . $ext;
                    }
                }
            }
            if ($this->Admin_model->addBrand($brand)) {
                echo "<script>alert('添加成功')</script>";
            } else {
                echo "<script>alert('添加失败')</script>";
            }
        }
        $this->load->view('admin/brand/' . __FUNCTION__);
    }
    
    /**
     * 品牌管理
     * @author xiaoboa
     * @date   2015-04-03
     */
    public function brandList()
    {
        $query = '';
        $pageSize = 1;
        $page = intval($this->input->get('p'));
        if ($page < 1) {
            $page = 1;
        }
        $like = array();
        if (strlen($this->input->get('name'))) {
            $like[ 'name' ] = $this->input->get('name');
            $query .= "&name=" . $this->input->get('name');
        }
        $data['brands'] = $this->Admin_model->brandList($like, array(), $page, $pageSize);
        foreach ($data['brands'] as $index => $item) {
        	$data['brands'][$index]['image'] =  "/static/uploads/brands/" . $item['image'];
        }
        $brandsTotal = $this->Admin_model->getBrandsTotal($like, array());
        $totalPage   = ceil($brandsTotal / $pageSize);
        $this->load->helper('paginate');
        $data['pagination'] = paginationByTotalPage($page, $totalPage, $query);
        $this->load->view('admin/brand/' . __FUNCTION__, $data);
    }
    
    /**
     * 删除品牌
     * @author xiaoboa
     * @date   2015-04-03
     * @param integer $id 品牌ID.
     */
    public function deleteBrands($id = 0)
    {
        $this->Admin_model->deleteBrands($id);
        echo json_encode(array('msg' => '删除成功<script>window.location.reload();</script>'));
    }
    
    /**
     * 编辑品牌
     * @author chenjia404
     * @date   2015-01-25
     * @param int $id
     */
    public function updateBrands($id = 0)
    {
        $where['id'] = $id;
        if(isset($_POST['name']) &&  isset($_POST['rank']))
        {
            $brand[ 'name' ] = $this->input->post('name');
            $brand[ 'rank' ] = $this->input->post('rank');
            if (isset($_FILES[ 'image' ]) && $_FILES[ 'image' ]['error'] == 0) {
                $x   = explode('.', $_FILES[ 'image' ][ 'name' ]);
                $ext = strtolower(end($x));
                if(file_exists($_FILES[ 'image' ][ 'tmp_name' ])) {
                	$md5 = md5_file($_FILES[ 'image' ][ 'tmp_name' ]);
                	$filePath = UPLOAD_PATH . '/brands/';
                	$fileName = $filePath . $md5 . '.' . $ext;
                	$saveStatus = @move_uploaded_file($_FILES[ 'image' ][ 'tmp_name' ], $fileName); 
                	if (strpos($ext, 'jpg') !== false || strpos($ext, 'png') !== false || strpos($ext, 'gif') !== false) {
	                    if ($saveStatus) {
	                        $brand['image'] = $md5 . '.' . $ext;
	                    }
                	}
                }
            }
            if ($this->Admin_model->updateBrand($brand, $where)) {
                echo "<script>alert('修改成功')</script>";
            } else {
                echo "<script>alert('修改失败')</script>";
            }
        }
        $where['id'] = $id;
        $brands = $this->Admin_model->brandList(array(), $where);
        $data['brands'] = isset($brands[0]) ? $brands[0] : array();
        if (isset($data['brands']['image'])) {
        	$data['brands']['image'] = '/static/uploads/brands/' . $data['brands']['image'];
        }
        $this->load->view('admin/brand/' . __FUNCTION__, $data);
    }

}
/* End of file admin.php */
/* Location: ./application/controllers/admin.php */

