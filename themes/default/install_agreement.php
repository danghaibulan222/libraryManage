<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $this->load->view ( 'common/header-meta' ); ?>
    <title>安装向导</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">安装向导 >> 协议</div>
                    <div class="panel-body">
						<h2 class="text-center"><b>图书管理系统使用协议</b></h2></br>
						<p class="text-center">数据库课程设计——图书管理系统</p>
						<p>采用MVC模式，基于php+codeigniter+musql的图书管理系统,实现了以下基本功能</p>
                        <p class="green">（1）用户登录注册</p>
                        <p class="green">（2）用户对自己基本信息的修改，包括密码</p>
                        <p class="green">（3）用户对书籍进行查找，借阅，归还</p>
                        <p class="green">（4）管理员可对用户进行管理，搜索，增加，修改，删除</p>
                        <p class="green">（5）管理员可对书籍进行管理，搜索，增加，修改，删除</p>
                        <p class="green">（6）管理员可对用户进行借书，还书操作，筛选超期</p>
                        <p class="green">（7）自适应移动端</p>
						</br></br>
                            <p class="pull-right">danghaibulan222</br><?php echo date('Y-m-d',time())?></p>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <br>
                                <a class="btn btn-primary btn-block" href="<?php echo site_url('install/check');?>" role="button">接受协议并继续</a>
                            </div>
                    </div>
                    <p class="panel-footer text-center">
                        Copyright © 2017 访问开发者<a href="https://github.com/danghaibulan222">danghaibulan222</a>的github
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
