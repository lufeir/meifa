<?php

/**
 * Created by PhpStorm.
 * User: 李政宇
 * Date: 2017/4/20
 * Time: 17:28
 */
class OrderModel extends Model
{
   public function getAll(){
       $sql="select * from `order`";
       $rows=$this->db->fetchAll($sql);
       return $rows;
   }
   public function add($data){
       $data['date']=strtotime($data['date']);
       if(empty($data['realname'])){
           $this->error="姓名不能为空";
           return false;

       }
       if(empty($data['phone'])){
           $this->error="电话不能为空";
           return false;

       }
       if(empty($data['date'])){
           $this->error="必须填写日期";
           return false;

       }
       $sql="insert into `order`(phone,realname,barber,content,date) values('{$data['phone']}','{$data['realname']}','{$data['barber']}','{$data['content']}',{$data['date']})";
       $result=$this->db->query($sql);
       return $result;
   }
   public function delete($id){
       $sql="delete from `order` where order_id=$id";
       $result=$this->db->query($sql);
       return $result;
   }
   public function getOne($id){
      $sql="select * from `order` where order_id=$id";
      $row=$this->db->fetchRow($sql);
      return $row;
   }
   public function tongguo($id){
       $sql="update `order` set status=1 where order_id=$id";
       $this->db->query($sql);

   }
    public function jujue($id){
        $sql="update `order` set status=3 where order_id=$id";
        $this->db->query($sql);

    }
}