<?php
/**
 * Class model基类，优化db操作
 * @author chenjia404
 * @date
 */
class MY_Model extends CI_Model
{
	/**
	 * @var string 表名
	 */
	public $table = '';


	 /**
	 * 构造函数初始化数据库
	 */
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
	}


	/**
	 * 获取数据列表
	 * @param string $filed
	 * @param array $where
	 * @param array $like
	 * @param array $order
	 * @param array $limit
	 * @return array
	 */
	protected function _get($filed='*',$where=array(),$like=array(),$order=array(),$limit=array())
	{
		$this->db->select($filed, false);
		$this->db->from($this->table);
		/* where条件 */
		if(is_array($where))
		{
			foreach($where as $key=>$value)
			{
				$this->db->where($key,$value);
			}
		}

		/* like条件 */
		if(is_array($like))
		{
			foreach($like as $key=>$value)
			{
				$this->db->like($key,$value);
			}
		}

		/* order条件 */
		if(is_array($order))
		{
			foreach($order as $key=>$value)
			{
				$this->db->order_by($key,$value);
			}
		}

		if(is_array($limit) && count($limit))
		{
			$this->db->limit($limit['limit'],$limit['offset']);
		}

		$query= $this->db->get();
		return $query->result_array();
	}

	/**
	 * 统计行数
	 * @param array $where
	 * @param array $like
	 * @return int
	 */
	protected function _count($where=array(),$like=array())
	{
		if(is_array($where))
		{
			foreach($where as $key=>$value)
			{
				$this->db->where($key,$value);
			}
		}
		/* like条件 */
		if(is_array($like))
		{
			foreach($like as $key=>$value)
			{
				$this->db->like($key,$value);
			}
		}
		return $this->db->count_all_results($this->table);
	}

	/**
	 * 更新数据
	 * @param array $data
	 * @param array $where
	 * @return bool
	 */
	protected function _update($data=array(),$where=array())
	{
		if(is_array($where) && count($where) > 0)
		{
			foreach($where as $key=>$value)
			{
				$this->db->where($key,$value);
			}
		}
		else
		{
			return false;
		}
		if(is_array($data) && count($data) > 0)
		{
			$this->db->update($this->table, $data);
		}
		else
		{
			return false;
		}
		return $this->db->affected_rows();
	}

	/**
	 * 添加数据
	 * @param $data
	 * @return object
	 */
	protected function _add($data)
	{
	   return $this->db->insert($this->table,$data);
	}

	/**
	 * 删除方法
	 * @param $where
	 * @return bool|object
	 */
	protected function _del($where)
	{
		if(is_array($where))
		{
			foreach($where as $key=>$value)
			{
				$this->db->where($key,$value);
			}
		}
		else
		{
			return false;
		}
		return  $this->db->delete($this->table);
	}


	/**
	 * 执行sql
	 *
	 * @access public
	 * @param string $sql
	 * @return bool|object
	 */
	protected function _query($sql)
	{
		$query = $this->db->query($sql);
		return is_bool($query)?$query:$query->result_array();
	}


	/**
	 * 获取最后插入的一条数据的id
	 * @return int
	 */
	protected function _getlastid()
	{
		return $this->db->insert_id();
	}


	/**
	 * 事物处理
	 *
	 * @access public
	 * @param array $sql sql数组
	 * @return bool
	 */
	 protected function _transtion($sql=array())
	 {
		if(empty($sql))
		{
			return false;
		}
		$this->db->trans_begin();
		foreach($sql as $v)
		{
			$this->db->query($v);
		}
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			 return true;
		}
	 }
}