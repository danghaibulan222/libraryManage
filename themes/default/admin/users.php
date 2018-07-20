<?php $this->load->view('common/header');?>

    <div class="container" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo site_url('admin/login')?>">管理首页</a></li>
                            <li class="active">用户管理</li>
                        </ol>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="<?php echo site_url('admin/users');?>">用户管理</a></li>
                            <li><a href="<?php echo site_url('admin/books');?>">图书管理</a></li>
                            <li><a href="<?php echo site_url('admin/borrowlist');?>">还书管理</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-pills">
                            <li class="active"><a href="<?php echo site_url('admin/users/index');?>">用户列表</a></li>
                        </ul>

                        <div class="table-responsive">
                            <table class='table table-hover '>
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>学号</th>
                                    <th>性别</th>
                                    <th>年级</th>
                                    <th>学院</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($users as $v){?>
                                    <tr id='user_<?php echo $v['id']?>'>
                                        <td>
                                            <?php echo $v['id']?>
                                        </td>
                                        <td>
                                            <strong><a href="<?php echo site_url('user/profiles/'.$v['id']);?>" class="black  profile_link" title="admin">
                                                    <?php echo $v['name']?>
                                                </a></strong>
                                        </td>
                                        <td>
                                            <?php echo $v['studentnum']?>
                                        </td>
                                        <td>
                                            <?php echo ($v['sex']==1?"男":"女");?>
                                        </td>
                                        <td>
                                            <?php echo $v['grade']?>
                                        </td>
                                        <td>
                                            <?php echo $v['college']?>
                                        </td>
                                        <td class='center'>
                                            <?php if($v['usertype']==1){ ?>
                                                管理员
                                            <?php }else{?>
                                                <a href="<?php echo site_url('admin/users/edit/'.$v['id'])?>" class="btn btn-primary btn-sm">修改</a>
                                                <a href="<?php echo site_url('admin/users/del/'.$v['id']);?>" class="btn btn-sm btn-danger">删除</a>
                                            <?php }?>
                                        </td>
                                    </tr>
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
                            <?php echo form_open('admin/users/search', array('class'=>'form-inline'));?>
                            <div class="input-group col-md-8" style="margin-top:0px positon:relative">
                                <input type="text" name="user_name" class="form-control"placeholder="用户昵称" / >
                                <span class="input-group-btn">
                                   <button type="submit" class="btn btn-info btn-search">查找</button>
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#searchModal" style="margin-left:3px">详细查找</a>
                                    <a class="btn btn-primary" href="<?php echo site_url('admin/users/add');?>">新建用户</a>
                                </span>
                            </div>
                            </form>

                            <!-- 模态框（Modal） -->
                            <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <?php echo form_open('admin/users/search_all', array('class'=>'form-horizontal'));?>
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                &times;
                                            </button>
                                            <h4 class="modal-title" id="ModalLabel">
                                                用户查找
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-8 col-sm-offset-2 clear">
                                                <div class="form-group">
                                                    <label class="control-label" for="user_name">用户名</label>
                                                    <div class="">
                                                        <input class="form-control" name="user_name" size="15" type="text"  />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label" for="student_num" >学号</label>
                                                    <div class="">
                                                        <input class="form-control"  name="student_num" type="text"  maxlength="13"  />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class=" control-label" for="user_sex">性别</label>
                                                    <div class="">
                                                        <select class="form-control"  name="user_sex">
                                                            <option value="">-------------</option>
                                                            <option value="1">男</option>
                                                            <option value="0">女</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="user_college">系名</label>
                                                    <div class="">
                                                        <select class="form-control"  name="user_college">
                                                            <option value="">-------------</option>
                                                            <option value="计算机学院">计算机学院</option>
                                                            <option value="软件学院">软件学院</option>
                                                            <option value="艺术学院">艺术学院</option>
                                                            <option value="数学学院">数学学院</option>
                                                            <option value="法学院">法学院</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class=" control-label" for="user_grade">年级</label>
                                                    <div class="">
                                                        <select class="form-control" id="user_name" name="user_grade">
                                                            <option value="">-------------</option>
                                                            <option value="2013">2013</option>
                                                            <option value="2014">2014</option>
                                                            <option value="2015">2015</option>
                                                            <option value="2016">2016</option>
                                                            <option value="2017">2017</option>
                                                        </select>
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