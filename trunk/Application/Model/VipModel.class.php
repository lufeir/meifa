<?php

/**
 * Created by PhpStorm.
 * User: 李政宇
 * Date: 2017/4/21
 * Time: 18:58
 */
class VipModel extends Model
{
  public function getAll(){
      $sql="select * from vip";
      $rows=$this->db->fetchAll($sql);
      return $rows;
  }
  public function add($data){
      $sql="insert into vip(vip_name,vip_zk,money) values('{$data['vip_name']}','{$data['vip_zk']}','{$data['money']}')";
      if(empty($data['vip_name'])){
          $this->error="vip等级名称不能为空";
          return false;
      }
      if(empty($data['money'])){
          $this->error="vip条件不能为空";
          return false;
      }
      $result=$this->db->query($sql);
      return $result;

  }
}