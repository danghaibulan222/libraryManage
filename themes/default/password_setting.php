<?php $this->load->view('common/header');?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel">
                <div class="panel-heading">
                    <h4>账号设置</h4>
                </div>
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li><a href="<?php echo site_url('setting/profile');?>">基本信息</a></li>
                        <li class="active"><a href="#">密码安全</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="setting">
                        <?php if (@$msg!='') echo '<div class="alert alert-danger">'.$msg.'</div>'; ?>
                        <form accept-charset="UTF-8" action="<?php echo site_url('setting/password');?>" class="simple_form form-horizontal" method="post">
                            <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_token;?>">
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="old_password">当前密码</label>
                                <div class="col-md-6">
                                    <input class="form-control"  name="old_password" value="<?php echo set_value('old_password'); ?>" size="18" type="password" />
                                    <span class="help-block red"><?php echo form_error('old_password');?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="new_password">新密码</label>
                                <div class="col-md-6">
                                    <input class="form-control" id="user_password" name="new_password" value="<?php echo set_value('new_password'); ?>" size="18" type="password" />
                                    <span class="help-block red"><?php echo form_error('new_password');?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="new_password2">密码确认</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="new_password2" value="<?php echo set_value('new_password2'); ?>" size="18" type="password" />
                                    <span class="help-block red"><?php echo form_error('new_password2');?></span>
                                </div>
                            </div>

                            <div class='form-group'>
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" name="commit" class="btn btn-primary">修改密码</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>

<?php $this->load->view('common/footer');?>
