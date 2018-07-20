<?php if($this->auth->is_login()){ ?>
    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-5">
                    <a href="<?php echo site_url('user/index')?>"><img alt="<?php echo $this->session->userdata('name')?> large avatar" class="img-rounded" src="<?php echo base_url($this->session->userdata('avatar').'big.png')?>" /></a>
                </div>
                <div class="col-md-7">
                    <ul class="list-unstyled">
                        <li><a href="<?php echo site_url('user/index')?>" title="<?php echo $this->session->userdata('name')?>"><?php echo $this->session->userdata('name')?></a></li>
                    </ul>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-6">

                    <p><a href="<?php echo site_url('favorites');?>">收藏</a></p>
                </div>
                <div class="col-md-6">

                    <p><a href="<?php echo site_url('follow');?>">关注</a></p>
                </div>
            </div>
        </div>
        <div class="panel-footer text-muted">
            <?php if(1){?>
                <img align="top" alt="Dot_orange" class="icon" src="<?php echo base_url('static/common/images/dot_orange.png');?>" />
                <a href=""> 条未读提醒</a>
            <?php } else{?>
                暂无提醒
            <?php }?>
        </div>
    </div>
<?php } else {?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>欢迎使用～</h4>
        </div>
        <div class="panel-body">
            <a href="<?php echo site_url('user/register');?>" class="btn btn-default">现在注册</a> 已注册请
            <a href="<?php echo site_url('user/login');?>" class="btn btn-default">登录</a>
        </div>
    </div>
<?php }?>