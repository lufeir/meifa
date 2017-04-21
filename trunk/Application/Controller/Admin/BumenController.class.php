<?php

//部门管理控制器
class BumenController extends Controller{
    //url index.php?p=Admin&c=Bumen&a=index
    //显示所有分组
    public function index(){
        //接收数据
        //处理数据
        $BumenModel=new BumenModel();
        $rows=$BumenModel->getList();
        $this->assign('rows',$rows);
        //显示页面

        $this->display('index');
    }

    //添加分组
    public function add(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->display('add');
        } else {
            $data = $_POST;
            $bumenmodel = new BumenModel();
            $result = $bumenmodel->add($data);
            if ($result === false) {
                $this->redirect('index.php?p=Admin&c=Bumen&a=add', $bumenmodel->getError(), 3);
            }
            $this->redirect('index.php?p=Admin&c=bumen&a=index');

        }
    }

        //删除
        public function delete(){
            $id = $_GET['id'];
            $bumenmodel = new BumenModel();
            $result = $bumenmodel->delete($id);
            if ($result === false) {
                $this->redirect('index.php?p=Admin&c=Bumen&a=index', $bumenmodel->getError(), 3);
            }
            $this->redirect('index.php?p=Admin&c=bumen&a=index');
        }
    //修改
    public function edit(){

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $id=$_GET['id'];
            $bumenmodel=new BumenModel();
            $row=$bumenmodel->getOne($id);
            //var_dump($row);exit;
            $this->assign('row',$row);
            $this->display('edit');
        }else{
            $data=$_POST;
            //var_dump($data);exit;
            $bumenmodel=new BumenModel();
            $result=$bumenmodel->update($data);
            if ($result === false) {
                $this->redirect("index.php?p=Admin&c=Bumen&a=edit&id={$data['id']}", $bumenmodel->getError(), 3);
            }
            $this->redirect('index.php?p=Admin&c=bumen&a=index');

        }


    }


}