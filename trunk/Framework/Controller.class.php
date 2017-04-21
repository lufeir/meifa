<?php

/**
 * Created by PhpStorm.
 * User: 12195
 * Date: 2017/4/6
 * Time: 17:20
 */
//基础控制器
class Controller
{
    private $data = [];

    /**
     * 该方法专门用于加载视图页面，需要传入视图文件的名称
     * @param $template 视图文件的名称
     */
    public function display($template){

         //将关联数组中的值取出，放到对应的键名的变量中
        extract($this->data);
        require CURRENT_VIEW_PATH.$template.'.html';
    }

    /**
     * 专业用于将数据分配到页面
     * @param $key 如果只传一个值，并且是一维数组，可以在页面通过一维数组的键取得其值
     * @param $value
     */
    public function assign($key,$value = ''){
        if(is_array($key)){
            $this->data = array_merge($this->data,$key);//合并多个数组
        }else{
            $this->data[$key] = $value;
        }
    }

    /**
     * 专业跳转方法
     * @param 跳转的url $url
     * @param string $msg 提示信息
     * @param int $times 等待时间
     */
    public function redirect($url,$msg = '',$times = 0){
        /* if($times){//提示信息并等待一定时间后跳转
             echo "<h1>{$msg}</h1>";
             header("Refresh: {$times};{$url}");//延迟
         }else{//直接跳转
             header("Location: {$url}");
         }*/
        if($times){//提示信息并等待一定时间后跳转
            echo "<h1>{$msg}</h1>";
        }
        header("Refresh: {$times};{$url}");//延迟
        exit;
    }
    //弹框提示，跳转
    public function alert($str,$url){
        echo '<script>alert("'.$str.'");location.href="'.$url.'";</script>';
    }

}