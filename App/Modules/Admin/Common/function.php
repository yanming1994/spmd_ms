<?php
/**
 * 递归重组节点信息为多维数组
 * @param  [type]  $node [要处理的节点数组]
 * @param  integer $pid  ［父级id］
 * @return [type]
 */
function node_merge($node,$access = null, $pid = 0){
	$arr = array();

	foreach ($node as $v){
		if (is_array($access)) {
			$v['access'] = in_array($v['id'], $access) ? 1 : 0;
		}
		if($v['pid']==$pid){
			$v['child']=node_merge($node,$access,$v['id']);
			$arr[] = $v;
		}
	}
	return $arr;
	
}
function class_merge($class,$access = null, $fid = 0){
	$arr = array();

	foreach ($class as $v){
		if (is_array($access)) {
			$v['access'] = in_array($v['id'], $access) ? 1 : 0;
		}
		if($v['fid']==$fid){
			$v['child']=class_merge($class,$access,$v['id']);
			$arr[] = $v;
		}
	}
	return $arr;
	
}

?>