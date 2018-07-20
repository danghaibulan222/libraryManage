
<?php $this->load->view('common/header');?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('admin/login')?>">管理首页</a></li>
                <li><a href="<?php echo site_url('admin/borrowlist')?>">还书管理</a></li>
                <li class="active">新建借书</li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">新建借书</h3>
                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" action="<?php echo site_url('admin/borrowlist/newborrow');?>" class="form-horizontal"  method="post" novalidate="novalidate">
                        <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_token;?>">
                        <div class="form-group ">
                            <label class="control-label col-sm-4" for="book_num" >书号</label>
                            <div class="col-sm-5">
                                <input class="form-control"  name="book_num" type="text"  maxlength="13" value="<?php echo set_value('book_num'); ?>" />
                                <?php echo form_error('book_num');?>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-sm-4" for="user_studentnum" >学号</label>
                            <div class="col-sm-5">
                                <input class="form-control"  name="user_studentnum" type="text"  maxlength="13" value="<?php echo set_value('user_studentnum'); ?>" />
                                <?php echo form_error('user_studentnum');?>
                            </div>
                        </div>

                        <div class='form-group'>
                            <div class="col-sm-offset-6 col-sm-12">
                                <button type="submit" name="commit" class="btn btn-primary">检索</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="col-md-4">

        </div>
    </div>
</div>

<?php $this->load->view('common/footer');?>