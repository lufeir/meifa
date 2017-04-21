<?php

/**
 * Created by PhpStorm.
 * User: 李政宇
 * Date: 2017/4/20
 * Time: 10:07
 */

class ArticleController extends Controller
{
  public function index(){
      $article=new ArticleModel();
      $rows=$article->getAll();
      $this->assign('rows',$rows);
      $this->display('index');

  }
  public  function  add(){
      if($_SERVER['REQUEST_METHOD']=='GET'){

          $this->display('add');
      }else{
          $data=$_POST;

          $article=new ArticleModel();
          $rows=$article->add($data);
          if($rows===false){
              $this->redirect('index.php?p=Admin&c=Article&a=add',$article->getError(),3);
          }
          $this->redirect('index.php?p=Admin&c=Article&a=index');
      }
  }
  public  function delete(){
      $id=$_GET['id'];
      $article=new ArticleModel();
      $article->delete($id);
      $this->redirect('index.php?p=Admin&c=Article&a=index');
  }
  public function edit(){
      if($_SERVER['REQUEST_METHOD']=='GET'){
          $id=$_GET['id'];
          $article=new ArticleModel();
          $row=$article->getOne($id);
          $this->assign('row',$row);
          $this->display('edit');
      }else{
          $data=$_POST;
          $article=new ArticleModel();
         $result= $article->edit($data);
         if($result===false){
             $this->redirect('index.php?p=Admin&c=Article&a=edit',$article->getError(),3);
         }
          $this->redirect('index.php?p=Admin&c=Article&a=index');

      }
  }
}