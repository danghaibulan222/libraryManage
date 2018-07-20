<?php
/**
 * User: danghaibulan
 */
/*返回信息*/
function show_message($message='', $url='', $status = 2, $heading='提示信息', $time = 1800)
{
    include VIEWPATH.'errors/html/show_message.php';
    exit;
}
//弹窗
function show_dialog($message='', $url='',$url2='', $data='',$status = 2, $heading='提示信息')
{
    include VIEWPATH.'errors/html/show_dialog.php';
    exit;
}
/*生成盐salt*/

function get_salt($length=-6){
    return substr(uniqid(rand()), $length);
}

/*生成密码*/

function password_dohash($password,$salt)
{
    $salt=$salt?$salt:get_salt();
    return md5(md5($password).$salt);
}

//时间转换
function sectoday($sec){
    $result=0;
    if($sec){
        $result=floor($sec/3600/24);
    }
    return $result;
}
function daytosec($day){
    $result=0;
    if($day){
        $result=$day*24*3600;
    }
    return $result;
}
