<?php $this->load->view('common/header');?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
				  <li><a href="<?php echo site_url('admin/login')?>">管理首页</a></li>
				  <li><a href="<?php echo site_url('admin/users')?>">用户管理</a></li>
				  <li class="active">编辑用户</li>
				</ol>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">编辑用户</h3>
                    </div>
                    <div class="panel-body">
                        <?php if (@$msg!='') echo '<div class="alert alert-danger">'.$msg.'</div>'; ?>
					<form accept-charset="UTF-8" action="<?php echo site_url('admin/users/edit/'.$user['id']);?>" class="form-horizontal" id="edit_user_1" method="post" novalidate="novalidate">
						<input type="hidden" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_token; ?>">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="user_name">用户名</label>
							<div class="col-sm-5">
								<input class="form-control" name="user_name" size="50" type="text" value="<?php echo $user['name']?>" disabled>
                                <span class="help-block red"><?php echo form_error('user_name');?></span>
							</div>
						</div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="student_num" >学号</label>
                            <div class="col-sm-5">
                                <input class="form-control"  name="student_num" type="text"  maxlength="13" value="<?php echo $user['studentnum']?>">
                                <span class="help-block red"><?php echo form_error('student_num');?></span>
                            </div>
                        </div>
                        <div class="form-group integer optional">
                            <label class="col-sm-3 control-label" for="user_sex">性别</label>
                            <div class="col-sm-5">
                                <select class="form-control"  name="user_sex">
                                    <option selected="selected" value="<?php echo $user[ 'sex'];?>">
                                            <?php echo ($user['sex']==1?"男":"女")?>(已选)</option>
                                    <option value="" disabled="disabled">-------------</option>
                                    <option value="1">男</option>
                                    <option value="0">女</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group integer optional">
                            <label class="col-sm-3 control-label" for="user_college">系名</label>
                            <div class="col-sm-5">
                                <select class="form-control"  name="user_college">
                                    <option selected="selected" value="<?php echo $user[ 'college'];?>">
                                            <?php echo $user[ 'college']?>(已选)</option>
                                    <option value="" disabled="disabled">-------------</option>
                                    <option value="计算机学院">计算机学院</option>
                                    <option value="软件学院">软件学院</option>
                                    <option value="艺术学院">艺术学院</option>
                                    <option value="数学学院">数学学院</option>
                                    <option value="法学院">法学院</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group integer optional">
                            <label class="col-sm-3 control-label" for="user_grade">年级</label>
                            <div class="col-sm-5">
                                <select class="form-control" id="user_name" name="user_grade">
                                    <option selected="selected" value="<?php echo $user[ 'grade'];?>">
                                        <?php echo $user[ 'grade']?>(已选)</option>
                                    <option value="" disabled="disabled">-------------</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                </select>
                            </div>
                        </div>





						<div class="form-group">
							<div class="col-md-offset-3 col-md-9">
								<button type="submit" name="commit" class="btn btn-primary">更新用户信息</button>
							</div>
						</div>
					</form>
                    </div>
                </div>
            </div><!-- /.col-md-8 -->

        </div><!-- /.row -->
    </div><!-- /.container -->


<?php $this->load->view('common/footer');?>
