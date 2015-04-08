<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 创建分页.
 *
 * @param integer $current_page 当前的页数.
 * @param integer $total_page   总页数.
 *
 * @return array
 */
function build_pages($current_page, $total_page){
    $pages = array();
    for($i = $current_page; $i >= $current_page - 4 && $i > 0; $i--){
        array_unshift($pages, $i);
    }
    $offset = 4 + ((3 - $i) > 0 ? 3 - $i : 0);
    for($k = $current_page + 1; $k <= $current_page + $offset && $k <= $total_page; $k++){
        array_push($pages, $k);
    }
    if($current_page >= 9){
        array_unshift($pages, '...');
        array_unshift($pages, 2);
        array_unshift($pages, 1);
    }else{
        for($j = $current_page - 5; $j > 0; $j --){
            array_unshift($pages, $j);
        }
    }

    if($current_page < $total_page - 8){
        array_push($pages, '...');
        array_push($pages, $total_page - 1);
        array_push($pages, $total_page);
    }else{
        for($j = $current_page + 5; $j <= $total_page; $j++){
            if(!in_array($j, $pages)){
                array_push($pages, $j);
            }
        }
    }
    return $pages;
}

/**
 * 数据分页方法，已知总页数.
 *
 * @param integer $currentPage 当前页
 * @param integer $totalPage   总页数
 *
 * @return string
 */
function paginationByTotalPage($currentPage, $totalPage, $query = '')
{
    $currentPage = empty($currentPage) || $currentPage < 0 ? 1 : $currentPage;
    $pages = build_pages($currentPage, $totalPage);
    $prev = $currentPage - 1;
    $next = $currentPage + 1 > $totalPage ? $totalPage : $currentPage + 1;

    $html = '';
    if ($totalPage > 1) {
        $html .= '<div class="page_btn">';
        if ($currentPage == 1) {
            $html .= '<span class="prev">上一页</span>';
        } else {
            $html .= '<a class="prev" href="?p='. $prev . $query . '">上一页</a>';
        }
        foreach ($pages as $key => $page) {
            if ($page == '...' || $currentPage == $page) {
                $html .= '<span class="active">' . $page . '</span>';
            } else {
                $html .= '<a href="?p=' . $page . $query . '">' . $page . '</a>';
            }
        }
        if ($currentPage == $totalPage) {
            $html .= '<span class="next">下一页</span>';
        } else {
            $html .= '<a class="next" href="?p=' . $next . $query . '">下一页</a>';
        }
    }
    return $html;
}