<?php

//平台同一验证控制器
class PlatformController extends Controller
{
    public function __construct(){
        if($this->checkLogin() === false){
            $this->redirect('index.php?p=Admin&c=Login&a=login',"没有登录，请先登录",3);
        }
    }
    //验证登录
    public function checkLogin(){
        //检测session中的用户信息，判断用户是否登录
        @session_start();
        //如果session中没有
        if(!isset($_SESSION['USER_INFO'])){
            //如果session中没有，就检测cookie中有没有
            if(isset($_COOKIE['id']) && isset($_COOKIE['password'])){
                //如果cookie中有就提取出来到数据库中去比对
                $id=$_COOKIE['id'];
                $password = $_COOKIE['password'];
                $membersModel = new MembersModel();
                //
                $result = $membersModel->checkByCookie($id,$password);
                if($result !== false){
                    //保存cookie中的信息到session
                    $_SESSION['USER_INFO'] = $result;
                    return true;
                }else{
                    return false;
                }
            }
            return false;
        }
    }
}