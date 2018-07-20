<?php $this->load->view('common/header');?>

    <div class="container" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo site_url('admin/login')?>">管理首页</a></li>
                            <li class="active">还书管理</li>
                        </ol>
                        <ul class="nav nav-tabs">
                            <li><a href="<?php echo site_url('admin/users');?>">用户管理</a></li>
                            <li><a href="<?php echo site_url('admin/books');?>">图书管理</a></li>
                            <li class="active"><a href="#">还书管理</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-pills">
                            <li class="active"><a href="<?php echo site_url('admin/borrowlist');?>">借书列表</a></li>
                        </ul>

                        <div class="table-responsive">
                            <table class='table table-hover '>
                                <thead>
                                <tr>
                                    <th>orderID</th>
                                    <th>书名</th>
                                    <th>书号</th>
                                    <th>借书用户</th>
                                    <th>学号</th>
                                    <th>借书时间</th>
                                    <th>可借时间</th>
                                    <th>是否超期</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($list){?>
                                <?php foreach($list as $v){?>
                                    <tr id='user_<?php echo $v['orderid']?>'>
                                        <td>
                                            <?php echo $v['orderid']?>
                                        </td>
                                        <td>
                                            <strong><a href="<?php echo site_url('book/profiles/'.$v['bookid']);?>" class="black  profile_link">
                                                    <?php echo $v['bookname']?>
                                                </a></strong>
                                        </td>
                                        <td>
                                            <?php echo $v['booknum']?>
                                        </td>
                                        <td>
                                            <strong><a href="<?php echo site_url('user/profiles/'.$v['id']);?>" class="black  profile_link">
                                                    <?php echo $v['name'];?>
                                                </a></strong>
                                        </td>
                                        <td>
                                            <?php echo $v['studentnum']?>
                                        </td>
                                        <td>
                                            <?php echo date('Y-m-d H:i',$v['borrowtime']);?>
                                        </td>
                                        <td>
                                            <?php echo sectoday(time()-$v['borrowtime']);?>/ <?php echo $v['keeptime']?>天
                                        </td>
                                        <td>
                                            <?php echo ($v['isovertime']==1?"超期":"未超期");?>
                                        </td>
                                        <td class='center'>
                                            <a href="<?php echo site_url('admin/borrowlist/returnbook/'.$v['orderid'])?>" class="btn btn-primary btn-sm">还书</a>
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
                            <?php echo form_open('admin/borrowlist/search', array('class'=>'form-inline'));?>
                            <div class="input-group col-md-8" style="margin-top:0px positon:relative">
                                <input type="text" name="book_name" class="form-control"placeholder="图书名称" / >
                                <span class="input-group-btn">
                                   <button type="submit" class="btn btn-info btn-search">查找</button>
                                    <a class="btn btn-primary" href="<?php echo site_url('admin/borrowlist/searchall')?>" style="margin-left:3px">筛选超期</a>
                                    <a class="btn btn-primary" href="<?php echo site_url('admin/borrowlist/newborrow');?>">新建借书</a>
                                </span>
                            </div>
                            </form>



                        </div>


                    </div>
                </div>
            </div><!-- /.col-md-12 -->

        </div><!-- /.row -->

    </div><!-- /.container -->

<?php $this->load->view('common/footer');?>