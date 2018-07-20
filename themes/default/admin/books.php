<?php $this->load->view('common/header');?>

    <div class="container" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo site_url('admin/login')?>">管理首页</a></li>
                            <li class="active">图书管理</li>
                        </ol>
                        <ul class="nav nav-tabs">
                            <li><a href="<?php echo site_url('admin/users');?>">用户管理</a></li>
                            <li class="active"><a href="#">图书管理</a></li>
                            <li><a href="<?php echo site_url('admin/borrowlist');?>">还书管理</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-pills">
                            <li class="active"><a href="<?php echo site_url('admin/books/index');?>">图书列表</a></li>
                        </ul>


                        <div class="table-responsive">
                            <table class='table table-hover '>
                                <thead>
                                <tr>
                                    <th>书号</th>
                                    <th>书名</th>
                                    <th>作者</th>
                                    <th>出版社</th>
                                    <th>出版时间</th>
                                    <th>简介</th>
                                    <th>是否可借</th>
                                    <th>可借/馆藏</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($books){?>
                                <?php foreach($books as $v){?>
                                    <tr id='user_<?php echo $v['bookid']?>'>
                                        <td>
                                            <?php echo $v['booknum']?>
                                        </td>
                                        <td>
                                            <strong><a href="<?php echo site_url('book/profiles/'.$v['bookid']);?>" class="black  profile_link">
                                                    <?php echo $v['bookname']?>
                                                </a></strong>
                                        </td>
                                        <td>
                                            <?php echo $v['writer'];?>
                                        </td>
                                        <td>
                                            <?php echo $v['pubhouse']?>
                                        </td>
                                        <td>
                                            <?php echo $v['pubtime']?>
                                        </td>
                                        <td>
                                            <?php echo $v['introduction']?>
                                        </td>
                                        <td>
                                            <?php echo ($v['canborrow']==1?"可借":"借出");?>
                                        </td>
                                        <td>
                                            <?php echo $v['amount']-$v['borrowamount'];?>/
                                            <?php echo $v['amount'];?>
                                        </td>
                                        <td class='center'>
                                            <a href="<?php echo site_url('admin/books/edit/'.$v['bookid'])?>" class="btn btn-primary btn-sm">修改</a>
                                            <a href="<?php echo site_url('admin/books/del/'.$v['bookid']);?>" class="btn btn-sm btn-danger">删除</a>
                                        </td>
                                    </tr>
                                <?php }?>
                                <?php }?>
                                </tbody>
                            </table>
                            <?php if(@$pagination){?>
                                <ul class='pagination'>
                                    <?php  echo $pagination?>
                                </ul><!--分页-->
                            <?php }?>
                        </div>

                        <div>
                            <?php echo form_open('admin/books/search', array('class'=>'form-inline'));?>
                            <div class="input-group col-md-8" style="margin-top:0px positon:relative">
                                <input type="text" name="book_name" class="form-control"placeholder="图书名称" / >
                                <span class="input-group-btn">
                                   <button type="submit" class="btn btn-info btn-search">查找</button>
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#searchModal" style="margin-left:3px">详细查找</a>
                                    <a class="btn btn-primary" href="<?php echo site_url('admin/books/add');?>">录入图书</a>
                                </span>
                            </div>
                            </form>

                            <!-- 模态框（Modal） -->
                            <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <?php echo form_open('admin/books/search_all', array('class'=>'form-horizontal'));?>
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <h4 class="modal-title" id="ModalLabel">
                                                图书查找
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-8 col-sm-offset-2 clear">
                                                <div class="form-group">
                                                    <label class="control-label" for="book_name">书名</label>
                                                    <div class="">
                                                        <input class="form-control" name="book_name" size="15" type="text"  />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="book_num" >书号</label>
                                                    <div class="">
                                                        <input class="form-control"  name="book_num" type="text"  maxlength="13"  />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="book_writer" >作者</label>
                                                    <div class="">
                                                        <input class="form-control"  name="book_writer" type="text"  maxlength="13"  />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="book_pubhouse" >出版社</label>
                                                    <div class="">
                                                        <input class="form-control"  name="book_pubhouse" type="text"  maxlength="13"  />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="book_pubtime" >出版时间</label>
                                                    <div class="">
                                                        <input class="form-control"  name="book_pubtime" placeholder="如201702" type="text"  maxlength="13"  />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="book_introduction" >简介</label>
                                                    <div class="">
                                                        <input class="form-control"  name="book_introduction" type="text"  maxlength="15"  />
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                                            </button>
                                            <button type="submit"  class="btn btn-primary">开始查找</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal -->
                            </div>

                        </div>


                    </div>
                </div>
            </div><!-- /.col-md-12 -->

        </div><!-- /.row -->

    </div><!-- /.container -->

<?php $this->load->view('common/footer');?>