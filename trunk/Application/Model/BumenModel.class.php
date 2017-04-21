<?php
//部门管理模型
class BumenModel extends Model
{
    //显示所有数据
    public function getList()
    {
        //构造sql
        $sql = "select * from bumen order by id desc";
        $rows = $this->db->fetchAll($sql);
        return $rows;
    }

    //添加分组
    public function add($data)
    {
        $sql = "insert into bumen(name) values('{$data['group']}')";

        $result = $this->db->query($sql);

        if ($result === false) {
            $this->error = "添加失败";
            return false;
        } else {
            return $result;
        }

    }

    //删除
    public function delete($id){

        //删除是部门下有员工不能删除
        $sql="select * from members where group_id=$id";
        $rows=$this->db->fetchAll($sql);


        if(empty($rows)){
            $this->error = "该部门下有员工，不能直接删除";
            return false;
        }

        $sql = "delete from bumen where id=$id";
        $result = $this->db->query($sql);
        if ($result === false) {
            $this->error = "删除失败";
            return false;
        } else {
            return $result;
        }
    }

    //获取一条数据
    public function getOne($id){
        $sql="select * from bumen where id=$id";
        $row=$this->db->fetchRow($sql);
        return $row;
    }

    //修改数据
    public function update($data){
        $sql="update bumen set name='{$data['group']}' where id={$data['id']}";
        $result=$this->db->query($sql);
        if ($result === false) {
            $this->error = "修改失败";
            return false;
        } else {
            return $result;
        }

    }
}