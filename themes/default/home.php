<?php $this->load->view('common/header');?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">你的登录状态：<?php if ($this->auth->is_login()){ echo $this->session->userdata('name');echo '在线';}else  echo '未登录'?></h3>
                </div>
                <div class="panel-body">
                    <p>欢迎使用图书管理系统</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <?php $this->load->view('common/sidebar_userinfo');?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">图书一览</h3>
                </div>
                <div class="panel-body">



                    <div class="table-responsive">
                        <table class='table table-hover '>
                            <thead>
                            <tr>
                                <th>书号</th>
                                <th>书名</th>
                                <th>作者</th>
                                <th>是否可借</th>
                                <th>可借/馆藏</th>
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
                                            <?php echo ($v['canborrow']==1?"可借":"借出");?>
                                        </td>
                                        <td>
                                            <?php echo $v['amount']-$v['borrowamount'];?>/
                                            <?php echo $v['amount'];?>
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
                </div>
            </div>
        </div>


    </div>
</div>

<?php $this->load->view('common/footer');?>