<?php

/**
 * Created by PhpStorm.
 * User: 李政宇
 * Date: 2017/4/20
 * Time: 16:14
 */
class OrderController extends Controller
{
    public function index(){
        $orderlist=new OrderModel();
        $rows=$orderlist->getAll();
        $this->assign('rows',$rows);
    $this->display('index');

    }
    public function tongguo(){
        $id=$_GET['id'];
        $yuyue=new OrderModel($id);
        $yuyue->tongguo($id);
        $this->redirect('index.php?p=Admin&c=Order&a=index');
    }
    public function jujue(){
        $id=$_GET['id'];
        $yuyue=new OrderModel($id);
        $yuyue->jujue($id);
        $this->redirect('index.php?p=Admin&c=Order&a=index');
    }

}