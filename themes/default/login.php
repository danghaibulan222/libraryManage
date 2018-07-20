
<?php $this->load->view('common/header');?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">请登录</h3>
                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" action="<?php echo site_url('user/login');?>" class="form-horizontal" id="new_user" method="post" novalidate="novalidate">
                        <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_token;?>">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="user_name">用户名</label>
                            <div class="col-md-6">
                                <input class="form-control" id="user_name" name="user_name" size="50" type="text" value="<?php echo set_value('user_name'); ?>"/>
                                <span class="help-block red"><?php echo form_error('user_name');?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="password">密码</label>
                            <div class="col-md-6">
                                <input class="form-control" id="password" name="password" size="50" type="password" value="<?php echo set_value('password'); ?>"/>
                                <span class="help-block red"><?php echo form_error('password');?></span>
                            </div>
                        </div>
                        <div class='form-group'>
                            <div class="col-md-offset-2 col-md-9">
                                <button type="submit" name="commit" class="btn btn-primary">登录</button>
                                <a href="<?php echo site_url('user/findpwd');?>" class="btn btn-default" role="button">找回密码</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div><!-- /.col-md-8 -->

        <div class="col-md-4">

        </div><!-- /.col-md-4 -->

    </div><!-- /.row -->
</div><!-- /.container -->

<?php $this->load->view('common/footer');?>