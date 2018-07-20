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
                    <div class="panel-heading">安装向导 >> 创建数据</div>
                    <div class="panel-body">
                        <?php if (@$msg!='') echo '<div class="alert alert-danger">'.$msg.'</div>'; ?>
                        <?php echo form_open('install/process', array('class' => 'form-horizontal', 'role' => 'form', 'onsubmit' => 'return validate_form(this)'));?>
                            <div class="form-group">
                                <label class="col-md-offset-1 control-label"><h3><b>数据库信息：</b></h3></label>
                            </div>
                            <div class="form-group">
                                <label for="dbhost" class="col-md-2 col-md-offset-1 control-label">数据库服务器</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="dbhost" name="dbhost" value="<?php echo $item['dbhost'];?>" placeholder="localhost">
	                            	<span class="help-block red"><?php echo form_error('dbhost');?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="port" class="col-md-2 col-md-offset-1 control-label">数据库端口</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="port" name="port" value="<?php echo $item['port'];?>" placeholder="3306">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dbuser" class="col-md-2 col-md-offset-1 control-label">数据库用户名</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="dbuser" name="dbuser" value="<?php echo set_value('dbuser')?>">
	                            	<span class="help-block red"><?php echo form_error('dbuser');?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dbpsw" class="col-md-2 col-md-offset-1 control-label">数据库密码</label>
                                <div class="col-md-7">
                                    <input type="password" class="form-control" id="dbpsw" name="dbpsw" value="<?php echo set_value('dapsw')?>" >
                                    <span class="help-block red"><?php echo form_error('dbpsw');?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dbname" class="col-md-2 col-md-offset-1 control-label">数据库名</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="dbname" name="dbname" value="">
                                </div> 
                            </div>
                             <div class="form-group">
                                <label for="dbprefix" class="col-md-2 col-md-offset-1 control-label">数据库表前缀</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="dbprefix" name="dbprefix" value="<?php echo $item['dbprefix'];?>" placeholder="stb_">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10  col-md-offset-3">
                                    <p class="form-control-static text-primary" id="testdb"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-offset-1 control-label"><h3><b>管理员信息：</b></h3></label>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-md-2 col-md-offset-1 control-label">管理员</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $item['name'];?>" placeholder="name">
	                            	<span class="help-block red"><?php echo form_error('name');?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-2 col-md-offset-1 control-label">密码</label>
                                <div class="col-md-7">
                                    <input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password')?>" placeholder="Password">
	                            	<span class="help-block red"><?php echo form_error('password');?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">创建数据</button>
                            </div>

                    </div>
                    <p class="panel-footer text-center">
                        Copyright © 2017 访问开发者<a href="https://github.com/danghaibulan222">danghaibulan222</a>的github
                    </p>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript" src="<?php echo base_url('static/common/js/jquery.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('static/common/js/bootstrap.min.js');?>"></script>

    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
         $(document).ready(function(){
             $("#dbname").blur(function(){
                 $.ajax({
                     url: '<?php echo site_url('install/testdb');?>'+'/'+
                     document.getElementById("dbhost").value+'/'+document.getElementById("dbuser").value+'/'+
                     document.getElementById("dbpsw").value+'/'+document.getElementById("dbname").value+'/'+
                     document.getElementById("port").value,
                     success: function(data) {
                         $("#testdb").html(data);
                     }});
             });
         });//表单验证
    </script>
</body>
</html>
