
<div id="navbar-wrapper">
<div  id="navigation" class="navbar navbar-inverse  navbar-fixed-top">
<div class="container">
	<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
		<a class="navbar-brand" href="<?php echo site_url()?>">首页</a>
	</div>

        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
              <li><a href="<?php echo site_url('book/search_all')?>">图书借阅</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
	        <?php if($this->auth->is_login()){ ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-user'></span> <?php echo $this->session->userdata('name');?> <b class="caret"></b></a>
              <ul class="dropdown-menu menur">
                  <li><a href="<?php echo site_url('user/index')?>">我的主页</a></li>
                  <li><a href="<?php echo site_url('setting')?>">账号设置</a></li>
                  <li><a href="<?php echo site_url('book/search_all')?>">图书借阅</a></li>
                  <li><a href="">其他</a></li>
                  <?php if($this->auth->is_admin()){ ?>
                      <li class="divider"></li>
                      <li><a href="<?php echo site_url('admin/login')?>">后台管理</a></li>
                  <?php }?>
                  <li class="divider"></li>
                  <li><a href="<?php echo site_url('user/logout')?>">注销</a></li>
              </ul>
            </li>
			<?php }else{?>
            <li><a href="<?php echo site_url('user/register')?>">注册</a></li>
            <li><a href="<?php echo site_url('user/login')?>">登录</a></li>
            <?php }?>
          </ul>
        </div>
        
</div>
</div>

</div>
