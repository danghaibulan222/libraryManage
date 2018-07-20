<?php $this->load->view('common/header');?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">欢迎进入后台管理</h3>
                    </div>
                    <div class="panel-body">
                        <span>图书管理系统</span>
                    </div>
                </div>
            </div><!-- /.col-md-12 -->

        </div><!-- /.row -->
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">用户管理</h3>
                    </div>
                    <div class="panel-body">
                        <a href="<?php echo site_url('admin/users')?>">去管理</a>
                    </div>
                </div>
            </div><!-- /.col-md-4 -->
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">图书管理</h3>
                    </div>
                    <div class="panel-body">
                        <a href="<?php echo site_url('admin/books')?>">去管理</a>
                    </div>
                </div>
            </div><!-- /.col-md-4 -->
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">还书管理</h3>
                    </div>
                    <div class="panel-body">
                        <a href="<?php echo site_url('admin/borrowlist')?>">去管理</a>
                    </div>
                </div>
            </div><!-- /.col-md-4 -->
        </div>
    </div><!-- /.container -->


<?php $this->load->view('common/footer');?>