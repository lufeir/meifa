<?php

/**
 * Created by PhpStorm.
 * User: 李政宇
 * Date: 2017/4/21
 * Time: 18:29
 */
class VipController extends PlatformController
{
  public function index(){
     $vip=new VipModel();
     $rows=$vip->getAll();
     $this->assign('rows',$rows);
     $this->display('index');
  }
  public function add(){
      if($_SERVER['REQUEST_METHOD']=='GET'){
          $this->display('add');
      }else{
          $data=$_POST;
          $VIP=new VipModel();
          $result=$VIP->add($data);
          if($result== false){
              $this->redirect('index.php?p=Admin&c=Vip&a=add',$VIP->getError(),3);
          }
          $this->redirect('index.php?p=Admin&c=Vip&a=index');
      }

  }
}