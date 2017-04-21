<?php

class MembersModel extends Model
{
    public function getList(){
        $sql = "select * from members";
        return $this->db->fetchAll($sql);
    }
    public function add($data){
        if(empty($data['username'])){
            $this->error="用户名不能为空";
            return false;
        }
        if(empty($data['realname'])){
            $this->error="名字不能为空";
            return false;
        }
        if(empty($data['password'])){
            $this->error="密码不能为空";
            return false;
        }
        if($data['password']!=$data['repassword']){
            $this->error="两次输入的密码不一致";
            return false;
        }
        if(empty($data['telephone'])){
            $this->error="电话号码不能为空";
        }
        $time=time();
        $password=md5($data['password']);
        $sql="insert into members(username,password,realname,sex,telephone,group_id,last_login,last_loginip,is_admin,photo)
        values('{$data['username']}','{$password}','{$data['realname']}','{$data['sex']}','{$data['telephone']}','{$data['group_id']}',
        '$time',0,'{$data['is_admin']}',0)";
        $result= $this->db->query($sql);
        return $result;
    }
    public function delete($id){
        $sql="delete from members where member_id={$id}";
        $result=$this->db->query($sql);
        return $result;
    }
    public function getOne($id){
        $sql="select * from members where member_id={$id}";
        $result=$this->db->fetchRow($sql);
        return $result;
    }
    public function update($data){
        if(empty($data['username'])){
            $this->error="用户名不能为空";
            return false;
        }
        if(empty($data['realname'])){
            $this->error="员工姓名不能为空";
            return false;
        }
        if(empty($data['old_password'])){
            $sql="update members set username='{$data['username']}',realname='{$data['realname']}',sex='{$data['sex']}',telephone='{$data['telephone']}',group_id='{$data['group_id']}',last_login='{$data['last_login']}',last_loginip=0,is_admin='{$data['is_admin']}',photo=0  WHERE member_id={$data['id']}";
        }else{
            if(empty($data['password'])){
                $this->error="密码不能为空";
                return false;
            }
            if($data['password']!=$data['repassword']){
                $this->error="新密码不一致";
            }
            $sql_password="select password from members where member_id={$data['id']}";
            $old_password=$this->db->fetchColumn($sql_password);
            if($old_password!=md5($data['old_password'])){
                $this->error="旧密码输入错误";
                return false;
            }
            $password=md5($data['password']);
            $time=time();
            $sql= "update members set username='{$data['username']}',password='$password',realname='{$data['realname']}',sex='{$data['sex']}',telephone='{$data['telephone']}',group_id='{$data['group_id']}',last_login='$time',last_loginip=0,is_admin='{$data['is_admin']}',photo=0 WHERE member_id={$data['id']}";
        }

        $result=$this->db->query($sql);
        return $result;
    }
    public function check($username,$password){
        //1.将传入的密码进行md5加密
        $password = md5($password);

        //2.到数据库中查询是否有对应得用户和密码
        $sql = "select * from members WHERE username='{$username}' and password='{$password}' limit 1";
        $row = $this->db->fetchRow($sql);
        //var_dump($row);exit;
        if(empty($row)){
            $this->error = "用户名或者密码错误！";
            return false;
        }else{
            return $row;
        }
    }

    public function checkByCookie($id,$password){
        $sql="select * from members WHERE member_id={$id} limit 1";
        $row=$this->db->fetchRow($sql);
        if(empty($row)){
            return false;
        }
        //  $password_in_db=$row['password'];
        $password_in_db=md5($row['password']);
        if($password==$password_in_db){
            return $row;
        }else{
            return false;
        }
    }


    //获取部门数据
    public function getAll(){
        $sql="select * from bumen";
        $rows=$this->db->fetchAll($sql);
        return $rows;
    }
}