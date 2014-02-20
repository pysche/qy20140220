<?php

abstract class Bc_View_Helper_Base {
	public $view;
	
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}
	
	public function Aurl(array $params=array(), $a=null, $b=true) {
		$aurl = 'http://'.$_SERVER['HTTP_HOST'].$this->view->url($params, $a, $b);
		return $aurl;
	}	
	
	public function Pager($page, $total, $limit) {
		$pages = $limit ? ceil($total/$limit) : 0;
		$params = $this->view->params;
		unset($params['_']);
		
		$str = "<ul class='pagination bccms'>";
		if ($page>1 && $pages>1) {
			$_params = $params;
			$_params['page'] = 1;
			
			$str .= "<li class=''><a href='".$this->view->url($_params)."' data-target='main_content' data-transport='ajax'>&laquo;</a></li>";
		} else {
			$str .= "<li class='disabled'><a href='#'>&laquo;</a></li>";
		}
		
		$start = $page - 5;
		$start>0 || $start = 1;
		
		$end = $page + 5;
		$end>$pages && $end = $pages;
		
		for ($i=$start;$i<=$end;$i++) {
			$_params = $params;
			$_params['page'] = $i;
			$str .= "<li class='".($i==$page ? 'active' : '')."'><a href='".$this->view->url($_params)."' data-target='main_content' data-transport='ajax'>".$i."</a></li>";
		}
		
		if ($page<$pages) {
			$_params = $params;
			$_params['page'] = $pages;
			
			$str .= "<li class=''><a href='".$this->view->url($_params)."' data-target='main_content' data-transport='ajax'>&raquo;</a></li>";
		} else {
			$str .= "<li class='disabled'><a href='#'>&raquo;</a></li>";
		}
		
		$str .= "</ul>";
		
		return $str;
	}
	
	public function Tree(array $params=array(), $selected=-1, $name='ParentId') {
		$tree = new Bc_Tree($params);
	
		$html ="<select id='".$name."' name='".$name."' class='form-control'>";
		$html .= "<option value='0'>顶级分类</option>";
	
		$str  = "<option value='\$id' \$selected>\$spacer\$Name</option>";
		$html .= $tree->getTree(0, $str, $selected);
		$html .= "</select>";
	
		return $html;
	}
	
	public function Treemulti(array $params = array()) {
		$tree = new Bc_Tree($params);
	
		$eurl = $this->view->url(array(
				'controller' => $this->view->cName,
				'action' => 'edit',
				'module' => $this->view->MODULE,
				'id' => '',
				'page' => null
		));
		$durl = $this->view->url(array(
				'controller' => $this->view->cName,
				'action' => 'delete',
				'module' => $this->view->MODULE,
				'id' => '',
				'page' => null
		));
	
		$str=<<<EOF
		<tr>
			<td>\$id</td>
			<td>\$spacer\$Name</td>
			<td>\$CreateTime</td>
			<td>
			<a class='btn btn-primary' href='{$eurl}\$id' data-target='main_content' data-transport='ajax'>修改</a>
			<a class='btn btn-danger' href='{$durl}\$id' data-target='main_content' data-transport='ajax'>删除</a></td>
		</tr>
EOF;
	
		$html = $tree->getTreeMulti(0, $str, -1);
	
		return $html;
	}
	
	public function Treelist(array $params = array()) {
		$tree = new Bc_Tree($params);
		
		$eurl = $this->view->url(array(
				'controller' => $this->view->cName,
				'action' => 'edit',
				'module' => $this->view->MODULE,
				'id' => '',
				'page' => null
		));
		
		$durl = $this->view->url(array(
					'controller' => $this->view->cName,
					'action' => 'delete',
			'module' => $this->view->MODULE,
					'id' => '',
					'page' => null
			));
	
					$str = "<div id=\$id><a class='glyphicon glyphicon-edit' href='".$eurl."\$id' data-transport='ajax'></a> <a href='".$durl."\$id' data-transport='ajax' class='glyphicon glyphicon-trash'></a>│  \$spacer\$Name  </div>";
		$html = $tree->getTree(0, $str, -1);
	
		return $html;
	}
		
	public function Breadcrumb($index, $var, $class=null) {
		$menu = &Bc_Config::menu($this->view);
		
		$str = "<ul class='breadcrumb'>";
		$str .= '<li>'.Bc_Config::appConfig()->app_name."<span class='divider'>/</span></li>";
		
		if ($class!==null) {
			$str .= "<li>".$menu['index'][$index][0]."<span class='divider'>/</span></li>";
			$str .= "<li class='active'>".$menu[$var][$class][0]."</li>";
		} else {
			$str .= "<li class='active'>未知分类</li>";
		}
		
		$str .= "</ul>";
		
		return $str;
	}
	
	public function Errormsg($msg, $exit=true) {
$str=<<<EOF
<script type='text/javascript'>
try {
	top.msgError('{$msg}');
} catch (e) {
	console.log(e);
}
</script>
EOF;
		Bc_Output::prepareHtml();
		echo $str;
		Bc_Output::doOutput();
		
		if ($exit) {
			exit(0);
		}
	}

	public function Successmsg($msg) {
		$str=<<<EOF
<script type='text/javascript'>
var url = '{$this->view->return}';
try {
	top.msgSuccess('{$msg}');
	if (url!='') {
		top.gotoUrl(url);		
	}
} catch (e) {
	console.log(e);
}
</script>
EOF;
		Bc_Output::prepareHtml();
		echo $str;
		Bc_Output::doOutput();
		
		if ($exit) {
			exit(0);
		}
	}
	
	public function Bool($flag, $successCss='', $errorCss='') {
		return $flag ? '<span class="'.$successCss.'">是</span>' : '<span class="'.$errorCss.'">否</span>';
	}

}