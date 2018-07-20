<?php $this->load->view('common/header');?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('admin/login')?>">管理首页</a></li>
                <li><a href="<?php echo site_url('admin/books')?>">图书管理</a></li>
                <li class="active">编辑图书</li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">编辑图书</h3>
                </div>
                <div class="panel-body">
                    <?php if (@$msg!='') echo '<div class="alert alert-danger">'.$msg.'</div>'; ?>
                    <form accept-charset="UTF-8" action="<?php echo site_url('admin/books/edit/'.$book['bookid']);?>" class="form-horizontal" method="post" novalidate="novalidate">
                        <input type="hidden" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_token; ?>">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="book_name">书名</label>
                            <div class="col-sm-5">
                                <input class="form-control" name="book_name" size="20" type="text" value="<?php echo $book['bookname']; ?>" />
                                <?php echo form_error('book_name');?>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-sm-3" for="book_num" >书号</label>
                            <div class="col-sm-5">
                                <input class="form-control"  name="book_num" type="text"  maxlength="13" value="<?php echo $book['booknum']; ?>" />
                                <?php echo form_error('book_num');?>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-sm-3" for="book_writer" >作者</label>
                            <div class="col-sm-5">
                                <input class="form-control"  name="book_writer" type="text"  maxlength="13" value="<?php echo $book['writer']; ?>" />
                                <?php echo form_error('book_writer');?>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-sm-3" for="book_pubhouse" >出版社</label>
                            <div class="col-sm-5">
                                <input class="form-control"  name="book_pubhouse" type="text"  maxlength="15" value="<?php echo $book['pubhouse']; ?>" />
                                <?php echo form_error('book_pubhouse');?>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-sm-3" for="book_pubtime" >出版时间</label>
                            <div class="col-sm-5">
                                <input class="form-control"  name="book_pubtime" type="text"  maxlength="6"  value="<?php echo $book['pubtime']; ?>"/>

                                <?php echo form_error('book_pubtime');?>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-sm-3" for="book_introduction" >简介</label>
                            <div class="col-sm-5">
                                <input class="form-control"  name="book_introduction" type="text"  value="<?php echo $book['introduction']; ?>"/>
                                <?php echo form_error('book_introduction');?>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-sm-3" for="book_amount" >数量</label>
                            <div class="col-sm-5">
                                <input class="form-control"  name="book_amount" type="text"  value="<?php echo $book['amount']; ?>"/>
                                <?php echo form_error('book_amount');?>
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" name="commit" class="btn btn-primary">更新图书</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-md-8 -->

    </div><!-- /.row -->
</div><!-- /.container -->


<?php $this->load->view('common/footer');?>
