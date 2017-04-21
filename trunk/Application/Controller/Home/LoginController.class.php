<?php

class LoginController extends Controller{
    //后台登录
    public function login(){
        //1.接收参数
        //2.处理数据
        //3.显示页面
        $this->display('login');
    }
    //验证功能
    public function check(){
        //验证用户输入的验证码和session中的验证码是否一致
        @session_start();
        //验证 验证码
        $captcha = $_POST['captcha'];
        /**
         * 将验证 和生成的 随机字符串都转化成小写比对，不区分大小写
         */
        if(strtolower($captcha) != strtolower($_SESSION['random_code'])){
            $this->redirect("index.php?p=Home&c=Login&a=login","验证码错误！",3);
        }

        //1.接收参数
        $username= $_POST['username'];
        $password= $_POST['password'];
        //2.处理数据
        $usersModel = new UsersModel();
        $result=$usersModel->check($username,$password);
        //var_dump($result);exit;
        //3.显示页面
        if($result === false){
            $this->redirect('index.php?p=Home&c=Login&a=login',$usersModel->getError(),3);
        }else{
            //登录成功保存用户信息
            //1.保存在session中
            //var_dump($result);exit;
            $_SESSION['USER_INFO'] = $result;
            //var_dump($_SESSION['USER_INFO']);exit;
            //2.保存在cookie中(用户点击自动登录的时候)
            if(isset($_POST['remember'])){
                //保存id
                setcookie('id',$result['id'],time()+1*24*3600,'/');
                //需要对密码再次进行加密,再保存密码
                $password=md5($result['password']);
                setcookie('password',$password,time()+1*24*3600,'/');
            }
            $this->redirect('index.php?p=Home&c=Index&a=index');
        }
    }

    //退出登录
    public function logout(){
        //将登录相关的信息删除
        //不能删除cookie中的PHPSESSID

        //删除session中的用户信息
        @session_start();
        unset($_SESSION['USER_INFO']);
        //删除cookie中的id和password
        setcookie('id',null,-1,'/');//一定要写上路径
        setcookie('password',null,-1,'/');

        //跳转到登录页面
        $this->redirect('index.php?p=Admin&c=Login&a=login',"注销成功！",3);
    }
}