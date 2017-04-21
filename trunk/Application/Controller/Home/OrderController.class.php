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
    public function add(){
        if($_SERVER['REQUEST_METHOD']=='GET'){
            $memberlist=new MembersModel();
            $members=$memberlist->getList();
            $this->assign('members',$members);

            $this->display('add');
        }else{
            $data=$_POST;
            $yuyue=new OrderModel();
            $result=$yuyue->add($data);
            if($result===false){
                $this->redirect('index.php?p=Home&c=Order&a=add',$yuyue->getError(),3);
            }
            $this->redirect('index.php?p=Home&c=Order&a=index',$yuyue->getError(),3);
        }
    }
    public function  delete(){
        $id=$_GET['id'];
        $yuyue=new OrderModel();
        $yuyue->delete($id);
        $this->redirect('index.php?p=Home&c=Order&a=index');
    }
    public function edit(){
        if($_SERVER['REQUEST_METHOD']=='GET'){
            $id=$_GET['id'];
            $yuyue=new OrderModel();
            $row=$yuyue->getOne($id);
            $memberlist=new MembersModel();
            $members=$memberlist->getList();
            $this->assign('members',$members);
            $this->assign('row',$row);
            $this->display('edit');
        }
    }
}