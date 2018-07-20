
<?php $this->load->view('common/header');?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('admin/login')?>">管理首页</a></li>
                <li><a href="<?php echo site_url('admin/books')?>">图书管理</a></li>
                <li class="active">新建图书</li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">新建图书</h3>
                </div>
                <div class="panel-body">
                    <?php if (@$msg!='') echo '<div class="alert alert-danger">'.$msg.'</div>'; ?>
                    <form accept-charset="UTF-8" action="<?php echo site_url('admin/books/add');?>" class="form-horizontal"  method="post" novalidate="novalidate">
                        <input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_token;?>">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="book_name">书名</label>
                            <div class="col-sm-5">
                                <input class="form-control" name="book_name" size="20" type="text" value="<?php echo set_value('book_name'); ?>" />
                                <span class="help-block red"><?php echo form_error('book_name');?></span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-sm-4" for="book_num" >书号</label>
                            <div class="col-sm-5">
                                <input class="form-control"  name="book_num" type="text"  maxlength="13" value="<?php echo set_value('book_num'); ?>" />
                                <span class="help-block red"><?php echo form_error('book_num');?></span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-sm-4" for="book_writer" >作者</label>
                            <div class="col-sm-5">
                                <input class="form-control"  name="book_writer" type="text"  maxlength="13" value="<?php echo set_value('book_writer'); ?>" />
                                <span class="help-block red"><?php echo form_error('book_writer');?></span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-sm-4" for="book_pubhouse" >出版社</label>
                            <div class="col-sm-5">
                                <input class="form-control"  name="book_pubhouse" type="text"  maxlength="15" placeholder="如人民出版社" value="<?php echo set_value('book_pubhouse'); ?>" />
                                <span class="help-block red"><?php echo form_error('book_pubhouse');?></span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-sm-4" for="book_pubtime" >出版时间</label>
                            <div class="col-sm-5">
                                <input class="form-control"  name="book_pubtime" type="text"  maxlength="6" placeholder="如201702" value="<?php echo set_value('book_pubtime'); ?>"/>

                                <span class="help-block red"><?php echo form_error('book_pubtime');?></span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-sm-4" for="book_introduction" >简介</label>
                            <div class="col-sm-5">
                                <input class="form-control"  name="book_introduction" type="text"  value="<?php echo set_value('book_introduction'); ?>"/>
                                <span class="help-block red"><?php echo form_error('book_introduction');?></span>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-sm-4" for="book_amount" >数量</label>
                            <div class="col-sm-5">
                                <input class="form-control"  name="book_amount" type="text"  value="<?php echo set_value('book_amount'); ?>"/>
                                <span class="help-block red"><span class="help-block red"><?php echo form_error('book_amount');?></span>
                            </div>
                        </div>
                        <div class='form-group'>
                            <div class="col-sm-offset-6 col-sm-12">
                                <button type="submit" name="commit" class="btn btn-primary">提交</button>
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