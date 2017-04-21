<?php
//平台同一验证控制器
class PlatformController extends Controller
{
    //初始化
    public function __construct(){
        if($this->checkLogin() === false){
            $this->redirect('index.php?p=Admin&c=Login&a=login',"没有登录，请先登录",3);
        }
    }
    //验证登录信息
    //检测session中的信息
   public function checkLogin(){
       //检测session，如果session中没有用户信息
       if(!isset($_SESSION['USER_INFO'])){
           //session中没有就到cookie中找
           if(isset($_COOKIE['id']) && isset($_COOKIE['password'])){
               //传过来cookie中有就拿到数据库中去对比
               $id = $_COOKIE['id'];
               $password = $_COOKIE['password'];

               $usersModel = new UsersModel();
               $result = $usersModel ->checkByCookie($id,$password);
               if($result !== false){
                   return true;
               }else{
                   return false;
               }
           }
           return false;
       }
   }
}