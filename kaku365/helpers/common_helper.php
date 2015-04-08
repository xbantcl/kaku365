<?php
/**
 * 创建文件目录.
 * 
 * @param string $bashPath 基地址.
 * @param string $category 具体分类目录名称.
 * 
 * @return string
 */
function createFolder($bashPath, $category = '')
{
	$bashPath = rtrim($bashPath, '/');
	$filePath = $bashPath . '/' . $category;
	if (!empty($category)) {
		$filePath = $bashPath . '/' . $category . '/';
	}
	if (!is_dir($filePath)) {
		mkdir($filePath, DIR_WRITE_MODE);
	}
	if (!is_dir($filePath)) {
		return false;
	}
	return $filePath;
}