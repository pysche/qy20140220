<?php
/**
* 通用的树型类，可以生成任何树型结构
*/
class Bc_Tree
{
	/**
	* 生成树型结构所需要的2维数组
	* @var array
	*/
	var $arr = array();

	/**
	* 生成树型结构所需修饰符号，可以换成图片
	* @var array
	*/
	var $icon = array('┃ ','┣━','┗━','　');

	/**
	* @access private
	*/
	var $ret = '';

	/**
	* 构造函数，初始化类
	* @param array 2维数组，例如：
	* array(
	*      1 => array('id'=>'1','ParentId'=>0,'Name'=>'一级栏目一'),
	*      2 => array('id'=>'2','ParentId'=>0,'Name'=>'一级栏目二'),
	*      3 => array('id'=>'3','ParentId'=>1,'Name'=>'二级栏目一'),
	*      4 => array('id'=>'4','ParentId'=>1,'Name'=>'二级栏目二'),
	*      5 => array('id'=>'5','ParentId'=>2,'Name'=>'二级栏目三'),
	*      6 => array('id'=>'6','ParentId'=>3,'Name'=>'三级栏目一'),
	*      7 => array('id'=>'7','ParentId'=>3,'Name'=>'三级栏目二')
	*      )
	*/
	public function __construct($arr=array()) {
       $this->arr = &$arr;
	   $this->ret = '';
	}

    /**
	* 得到父级数组
	* @param int
	* @return array
	*/
	public function getParent($myid) {
		$newarr = array();
		if(!isset($this->arr[$myid])) return false;
		$pid = $this->arr[$myid]['ParentId'];
		$pid = $this->arr[$pid]['ParentId'];
		if(is_array($this->arr))
		{
			foreach($this->arr as $id => $a)
			{
				if($a['ParentId'] == $pid) $newarr[$id] = $a;
			}
		}
		return $newarr;
	}

    /**
	* 得到子级数组
	* @param int
	* @return array
	*/
	public function getChild($myid) {
		$a = $newarr = array();
		if(is_array($this->arr))
		{
			foreach($this->arr as $id => $a)
			{
				if($a['ParentId'] == $myid) $newarr[$id] = $a;
			}
		}
		return $newarr ? $newarr : false;
	}

    /**
	* 得到当前位置数组
	* @param int
	* @return array
	*/
	public function getPos($myid,&$newarr) {
		$a = array();
		if(!isset($this->arr[$myid])) return false;
        $newarr[] = $this->arr[$myid];
		$pid = $this->arr[$myid]['ParentId'];
		if(isset($this->arr[$pid]))
		{
		    $this->getPos($pid,$newarr);
		}
		if(is_array($newarr))
		{
			krsort($newarr);
			foreach($newarr as $v)
			{
				$a[$v['id']] = $v;
			}
		}
		return $a;
	}

	/**
	 * -------------------------------------
	 *  得到树型结构
	 * -------------------------------------
	 * @author  Midnight(杨云洲),  yangyunzhou@foxmail.com
	 * @param $myid 表示获得这个ID下的所有子级
	 * @param $str 生成树形结构基本代码, 例如: "<option value=\$id \$select>\$spacer\$name</option>"
	 * @param $sid 被选中的ID, 比如在做树形下拉框的时候需要用到
	 * @param $adds
	 * @param $str_group
	 * @return unknown_type
	 */
	public function getTree($myid, $str, $sid = 0, $adds = '', $str_group = '') {
		$number=1;
		$child = $this->getChild($myid);

		if(is_array($child))
		{
		    $total = count($child);
			foreach($child as $id=>$a)
			{
				$j=$k='';
				if($number==$total)
				{
					$j .= $this->icon[2];
					$k = $adds ? $this->icon[3] : '';
				}
				else
				{
					$j .= $this->icon[1];
					$k = $adds ? $this->icon[0] : '';
				}
				$spacer = $adds ? $adds.$j : '';
				$selected = $id==$sid ? 'selected' : '';

				@extract($a);
				$parentid == 0 && $str_group ? eval("\$nstr = \"$str_group\";") : eval("\$nstr = \"$str\";");
				$this->ret .= $nstr;
				$this->getTree($id, $str, $sid, $adds.$k.'&nbsp;',$str_group);
				$number++;
			}
		}
		return $this->ret;
	}
    /**
	* 同上一方法类似,但允许多选
	*/
	public function getTreeMulti($myid, $str, $sid = 0, $adds = '') {
		$number=1;
		$child = $this->getChild($myid);

		if(is_array($child))
		{
		    $total = count($child);
			foreach($child as $id=>$a)
			{
				$j=$k='';
				if($number==$total)
				{
					$j .= $this->icon[2];
					$k = $adds ? $this->icon[3] : '';
				}
				else
				{
					$j .= $this->icon[1];
					$k = $adds ? $this->icon[0] : '';
				}
				$spacer = $adds ? $adds.$j : '';

				$selected = $this->have($sid,$id) ? 'selected' : '';
				//echo $sid.'=>'.$id.' : '.$selected.' . <br/>';
				@extract($a);
				eval("\$nstr = \"$str\";");
				$this->ret .= $nstr;
				$this->getTreeMulti($id, $str, $sid, $adds.$k.'&nbsp;');
				$number++;
			}
		}
		return $this->ret;
	}

	public function have($list,$item) {
		return(strpos(',,'.$list.',',','.$item.','));
	}
}