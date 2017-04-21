<?php

class ArticleModel extends Model
{
  public  function getAll(){
      $time=time();

      $sql="select * from article";
      $rows=$this->db->fetchAll($sql);
      return $rows;
  }
  public function  add($data){
      $time=time();
      $data['start']=strtotime($data['start']);
      $data['end']=strtotime($data['end']);
      $sql="insert into article(title,content,start,end,time) VALUES ('{$data['title']}','{$data['content']}',{$data['start']},{$data['end']},$time)";
      if(empty($data['title'])){
          $this->error="标题不能为空";
          return false;
      }
      if(empty($data['content'])){
          $this->error="内容不能为空";
          return false;
      }
      $result=$this->db->query($sql);
      return $result;
  }
  public function delete($id){
      $sql="delete from article where article_id={$id}";
      $result=$this->db->query($sql);
      return $result;
  }
  public function getOne($id){
      $sql="select * from article where article_id=$id";
      $row=$this->db->fetchRow($sql);
      return $row;
  }
  public  function edit($data){
      $sql="update article set title='{$data['title']}',content='{$data['content']}',start='{$data['start']}',end='{$data['end']}' where article_id={$data['id']}";
      $result=$this->db->query($sql);
      return $result;
  }
}