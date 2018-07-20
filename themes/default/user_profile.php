
<?php $this->load->view('common/header');?>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $user['name'];?> 个人中心</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-2">
                            <img class="img-rounded img-responsive" src="<?php echo base_url($user['avatar'].'big.png')?>" alt="<?php echo $user['name']?> large avatar">
                        </div>
                        <div class="col-md-6">
                            <h4><?php echo $user['name'];?></h4>
                            <p class="text-muted"><small><?php echo $user['name'];?>是第<?php echo $user['id'];?>号会员，加入于<?php echo date('Y-m-d H:i',$user['regtime']);?></small></p>
                            <p>学号：<?php echo $user['studentnum'];?></p>
                            <p>性别：<?php echo ($user['sex']==1?"男":"女");?></p>
                            <p>系别：<?php echo $user['college'];?></p>
                            <p>年级：<?php echo $user['grade'];?></p>
                            <p>上次登录：<?php echo date('Y-m-d H:i',$user['lastlogin']);?></p>
                        </div>
                        <div class="col-md-4">


                        </div>
                        <div class="col-md-12">
                            <p><?php echo $user['other'];?></p>
                        </div>
                    </div>
                </div><!-- /个人信息 -->

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $user['name'];?> 借阅情况</h3>
                    </div>

                    <div class="panel-heading">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#borrow" data-toggle="tab">在借列表</a></li>
                            <li><a href="#borrow_history" data-toggle="tab">借书历史</a></li>
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
                                            <p class="text-muted">
                                                <span>借书时间：<?php echo date('Y-m-d H:i',$b['borrowtime']);?></span>
                                            </p>
                                            <p class="text-muted">
                                                <span>期限：<?php echo sectoday(time()-$b['borrowtime']);?>/<?php echo $b['keeptime'];?>天</span>
                                            </p>
                                            <p class="text-muted<?php if($b['isovertime']==1)echo " red";?>">
                                                <span>状态：<?php echo ($b['isovertime']==1?"超期":"未超期");?></span>
                                            </p>
                                            <?php if(!$this->auth->is_admin()){?>
                                                <a href="<?php echo site_url('book/returnbook/'.$b['orderid'])?>" class="btn  btn-primary btn-sm">还书</a>
                                            <?php }?>
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