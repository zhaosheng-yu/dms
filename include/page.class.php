<?php
/**
 * 分页函数助手
 *
 * @package mypage
 */
class Page{
    /**
     * 分页函数
     *
     * @param string $url 页面URL，不含page
     * @param int $total 总数据量
     * @param int $thisPage 当前页数
     * @param int $pageNum 每页数目
     * @param int $pagelen 显示个数
     * @return array
     */
    public function get($url, $total, $thisPage = 1, $pageNum = 50){
        $url = preg_replace('/\?(p=\d*)/', '?', $url);
        $url = preg_replace('/\&(p=\d*)/', '', $url);
        $thisPage = intval($thisPage);
        $thisPage = $thisPage == 0 ? 1 : $thisPage;
        $init_show_nums = 5;//刚开始显示最大个数，如果超过10就加1，直至显示的个数等于$max_show_nums
        $max_show_nums = 8;//最大显示
        $total_nums = ceil($total / $pageNum);
        
        $start = 1;
        $nums = $total_nums;
        
        if($total_nums > $init_show_nums){
            $nums = $init_show_nums + $thisPage - 1;
            if($nums <= $max_show_nums){
                $start = 1;
            }else{
                if($thisPage < ceil($max_show_nums / 2)){
                    $start = 1;
                }else{
                    $start = $thisPage - ceil($max_show_nums / 2) + 1;
                }
                $nums = $max_show_nums;
            }
            if($start + $nums - 1 > $total_nums){
                $nums = $max_show_nums;
                $start = $total_nums - $nums + 1;
            }
        }
        $and = strpos($url, '?') === false ? '?': '&';
        $lastPage = $thisPage - 1 > 0 ? $thisPage - 1 : 0;//上一页
        $nextPage = $thisPage + 1 <= $total_nums ? $thisPage + 1 : 0;//下一页
        $showpages = '';
        if($total_nums > 1){
            $showpages .= "<a class='paginate_button' href='{$url}'>首页</a>&nbsp;";
            if($lastPage)
            $showpages .= "<a href='{$url}{$and}p={$lastPage}' class='paginate_button previous'>上一页</a>&nbsp;";
            $i = $start;
            $count = 1;
            while($count <= $nums){
                $count++;
                if($i == $thisPage){
                    $showpages .= "<a class='paginate_button current' href='{$url}{$and}p={$i}'>{$i}</a>&nbsp;";
                } else {
                    $showpages .= "<a class='paginate_button' href='{$url}{$and}p={$i}'>{$i}</a>&nbsp;";
                }
                $i++;
            }
            if($nextPage)
                $showpages .= "<a class='paginate_button next' href=\"{$url}{$and}p={$nextPage}\">下一页</a>&nbsp;";
            if( $i<$total_nums )
                $showpages .= "<a class='paginate_button' href=\"{$url}{$and}p={$total_nums}\">尾页</a>&nbsp;";
        }else{
            $showpages = '';
        }
        return $showpages;
    }

}


?>
