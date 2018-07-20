
<?php $this->load->view('common/header');?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">图书信息</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-2">
                        <img class="img-rounded img-responsive" src="<?php echo base_url($book['cover'].'default.jpg')?>" alt="<?php echo $book['bookname']?> large avatar">
                    </div>
                    <div class="col-md-6">
                        <h4><?php echo $book['bookname'];?></h4>
                        <p class="text-muted">书号：<?php echo $book['booknum'];?></p>
                        <p class="text-muted">作者：<?php echo $book['writer'];?></p>
                        <p class="text-muted">出版社：<?php echo $book['pubhouse'];?></p>
                        <p class="text-muted">出版时间：<?php echo $book['pubtime'];?></p>
                        <p class="text-muted">简介：<?php echo $book['introduction'];?></p>
                        <p>可借数：<?php echo $book['amount']-$book['borrowamount'];?>/<?php echo $book['amount'];?></p>
                    </div>
                    <div class="col-md-4">
                        <?php if($book['canborrow']){?>
                        <a href="<?php echo site_url('book/borrow/'.$book['bookid'])?>" class="btn  btn-success btn-sm">借阅</a>
                        <?php }?>
                    </div>
                </div>
            </div><!-- 信息 -->
            <?php if($this->auth->is_admin()){ ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $book['bookname'];?> 阅读情况</h3>
                    </div>

                    <div class="panel-heading">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#borrow" data-toggle="tab">被借中</a></li>
                            <li><a href="#borrow_history" data-toggle="tab">被借历史</a></li>
                        </ul>
                    </div>

                    <div class="panel-body tab-content">

                        <div class="tab-pane fade in active" id="borrow">
                            <ul class="media-list">
                                <li class="media topic-list">
                                    <div class="pull-right">
                                        <span class="badge badge-info"><?php echo count($borrow_list);?></a></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading ">总数</h5>
                                    </div>
                                </li>

                                <?php foreach ($borrow_list as $b) : ?>
                                    <li class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="<?php echo site_url('book/profiles/'.$b['bookid']);?>"><?php echo $b['bookname'];?></a></h4>
                                            <p>
                                                <span>读者用户：<?php echo $b['name'];?></span>
                                            </p>
                                            <p class="text-muted">
                                                <span>借书时间：<?php echo date('Y-m-d H:i',$b['borrowtime']);?></span>
                                            </p>
                                            <p class="text-muted">
                                                <span>期限：<?php echo sectoday(time()-$b['borrowtime']);?>/<?php echo $b['keeptime'];?>天</span>
                                            </p>
                                            <p class="text-muted<?php if($b['isovertime']==1)echo " red";?>">
                                                <span>状态：<?php echo ($b['isovertime']==1?"超期":"未超期");?></span>
                                            </p>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="tab-pane fade active" id="borrow_history">
                            <ul class="media-list">
                                <li class="media topic-list">
                                    <div class="pull-right">
                                        <span class="badge badge-info"><?php echo count($borrow_history);?></a></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading ">总数</h5>
                                    </div>
                                </li>

                                <?php foreach ($borrow_history as $bh) : ?>
                                    <li class="media">
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="<?php echo site_url('book/profiles/'.$bh['bookid']);?>"><?php echo $bh['bookname'];?></a></h4>
                                            <p>
                                                <span>读者用户：<?php echo $bh['name'];?></span>
                                            </p>
                                            <p class="text-muted">
                                                <span>借书时间：<?php echo date('Y-m-d H:i',$bh['borrowtime']);?></span>
                                            </p>
                                            <p class="text-muted">
                                                <span>还书时间：<?php echo date('Y-m-d H:i',$bh['returntime']);?></span>
                                            </p>

                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                </div><!-- /.read -->
            <?php }?>




            <script>
                $(function () {
                    $('#myTab li:eq(1) a').tab('show');
                });
            </script>
        </div><!-- /.col-md-8 -->

        <div class='col-md-4'>
            <?php $this->load->view('common/sidebar_userinfo')?>

        </div>
    </div><!-- /.row -->
</div><!-- /.container -->

<?php $this->load->view('common/footer');?>