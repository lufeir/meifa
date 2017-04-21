<?php

class CaptchaController extends  Controller
{
    public function  index(){
        $this->generate();
    }
    //生成随机码
    private function makeCode($num=4){
        //1.生成随机字符串
        //a.准备字符串
        $string="ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
        //b.打乱字符串
        $string = str_shuffle($string);
        //c.取字符串长度
        return  substr($string,0,$num);
    }
    //生成随机验证码
    private function generate(){
        //1.随机码值
        $random_code = $this->makeCode(4);
        //2.将验证码保存到session中
        @session_start();
        $_SESSION['random_code']=$random_code;
        //3.随机背景
        $width= 300;
        $height = 50;
        //随机获取图片
        $captcha_path = PUBLIC_PATH."Admin/captcha/captcha_bg".mt_rand(1,5).".jpg";
        $imageinfo = getimagesize($captcha_path);//获取图片信息
        list($width,$height) = $imageinfo;

        $image = imagecreatefromjpeg($captcha_path);
        //4.白色边框
        $white = imagecolorallocate($image,255,255,255);
        //5.画边框
        imagerectangle($image,0,0,$width-1,$height-1,$white);
        //6.字体随机成白色或黑色
        $black = imagecolorallocate($image,0,0,0);
        imagestring($image,5,$width/3,$height/5,$random_code,mt_rand(0,1) ? $white : $black);
        //7.混淆验证码
        //画点
        /*  for($i=0;$i<200;$i++){
              $color = imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
              imagesetpixel($image,mt_rand(1,$width-1),mt_rand(1,$height-1),$color);
          }*/
        //画线
        /*  for($i=0;$i<6;$i++){
              $color = imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
              imageline($image,mt_rand(1,$width-1),mt_rand(1,$height-1),mt_rand(1,$width-1),mt_rand(1,$height-1),$color);
          }*/
        //8.输出验证码
        //输出前要把图片进行编译
        header("Content_Type:image/jpeg;charset=utf-8");
        imagejpeg($image);
        //9.关闭图片
        imagedestroy($image);
    }
}