<?php

class IndexController extends Controller
{
    public function index(){
        $lifa=new ArticleModel();
        $rows=$lifa->getAll();
        $this->assign('rows',$rows);
        $this->display('index');
    }
}