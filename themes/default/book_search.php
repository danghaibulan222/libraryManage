<?php $this->load->view('common/header');?>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        图书查找
                    </div>
                    <div class="panel-body">
                        <div>
                            <?php echo form_open('book/search_all', array('class'=>'form-inline'));?>
                            <div class="input-group col-md-8" style="margin-top:0px positon:relative">
                                <input type="text" name="book_name" class="form-control"placeholder="图书名称" / >
                                <span class="input-group-btn">
                                   <button type="submit" class="btn btn-info btn-search">查找</button>
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#searchModal" style="margin-left:3px">详细查找</a>
                                </span>
                            </div>
                            </form>

                            <!-- 模态框（Modal） -->
                            <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <?php echo form_open('book/search_all', array('class'=>'form-horizontal'));?>
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
                        <?php foreach($books as $v){?>
                        <div class="panel-body">
                                <div class="col-md-2">
                                    <img class="img-rounded img-responsive" src="<?php echo base_url($v['cover'].'default.jpg')?>" alt="<?php echo $v['bookname']?> large avatar">
                                </div>
                                <div class="col-md-6">
                                    <h4><a class="black  profile_link" href="<?php echo site_url('book/profiles/'.$v['bookid']);?>"><?php echo $v['bookname'];?></a></h4>
                                    <p class="text-muted">作者：<?php echo $v['writer'];?></p>
                                    <p class="text-muted">出版社：<?php echo $v['pubhouse'];?></p>
                                    <p>可借数：<?php echo $v['amount']-$v['borrowamount'];?>/<?php echo $v['amount'];?></p>
                                </div>
                                <div class="col-md-4">
                                    <?php if($v['canborrow']){?>
                                    <a href="<?php echo site_url('book/borrow/'.$v['bookid'])?>" class="btn  btn-success btn-sm">借阅</a>
                                    <?php }?>
                                </div>

                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <?php $this->load->view('common/sidebar_userinfo');?>
            </div>
        </div>
    </div>

<?php $this->load->view('common/footer');?>