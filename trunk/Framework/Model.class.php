<?php

/**
 * Created by PhpStorm.
 * User: 12195
 * Date: 2017/4/5
 * Time: 18:37
 */
//基础模型类，所以的模型都要基础该类
class Model
{
    protected $db;//保存db对象
    protected  $error;//保存错误信息
    public function __construct(){
        //创建对象
//        require './Framework/Tools/DB.class.php';
        $this->db=DB::getInstance($GLOBALS['config']['db']);

    }
    //获取错误信息
    public function getError(){
        return $this->error;
    }
}