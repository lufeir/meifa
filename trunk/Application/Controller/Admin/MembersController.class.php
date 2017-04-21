<?php


class MembersController extends Controller
{
    public function index(){
        $membersModel=new MembersModel;
        $rows=$membersModel->getList();
        $this->assign('rows',$rows);
        $this->display('index');
    }
    public function add(){//添加一个类来新增用户
        if($_SERVER['REQUEST_METHOD']=='GET'){//判断当接收道的数据的传值方式
            //获取部门数据
            $membersmodel=new MembersModel();
            $rows=$membersmodel->getAll();
            $this->assign('rows',$rows);

            $this->display('add');//当是get方式传值的时候返回新增用户的页面
        }else{
            $data=$_POST;//接收post方式传值
            $db=new MembersModel();//新建一个对象
            $row=$db->add($data);//调用模型里的add方法来新增用户
            if($row==false){//判断新增用户是否成功
                $this->redirect('index.php?p=Admin&c=Members&a=index',$db->getError(),3);//新增失败，显示错误信息，3秒后返回用户信息列表
            }
            $this->redirect('index.php?p=Admin&c=Members&a=index');//新城成功，跳转到用户信息列表
        }

    }

    public function delete(){//创建一个类来删除用户信息
        $id=$_GET['id'];//接收腰删除用户信息的id
        $db=new MembersModel();//新增一个对象
        $db->delete($id);//调用对象里的delete的方法来删除用户的信息
        $this->redirect('index.php?p=Admin&c=Members&a=index');//放回到用户列表

    }
    public function edit(){//创建一个类来修改用户的信息
        if($_SERVER['REQUEST_METHOD']=='GET'){//判断传值的方式
            $id=$_GET['id'];//接收以get方式传过来的值

            //获取部门数据
            $membersmodel=new MembersModel();
            $rows=$membersmodel->getAll();
            $this->assign('rows',$rows);


            $db=new MembersModel();//新建一个对象
            $row= $db->getOne($id);//调用对象里的getOne的方法 获取对应id的用户所有数据
            $this->assign('data',$row);//分配数据到页面
            $this->display('edit');//显示页面

        }else{
            $data=$_POST;//接收以post方式传送过来的数据
            $db=new MembersModel();//创建一个对象
            $row=$db->update($data);//调用对象里的update的方法来将修改后的用户数据写入数据库
            if($row ===false){
                $this->redirect('index.php?p=Admin&c=Members&a=edit&id='.$data['id'],$db->getError(),3);//修改失败，显示错误信息，3秒胡跳转至修改页面
            }
            $this->redirect('index.php?p=Admin&c=Members&a=index');//修改成功，返回用户信息列表
        }

    }
}