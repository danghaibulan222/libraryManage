<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <title><?php if($heading) echo $heading;else {?>Error<?php }?></title>
    <link href="<?php echo base_url('static/common/css/bootstrap.min.css');?>" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">

    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a type="button" class="close" href="javascript:history.back();">×
                    </a>
                    <h4 class="modal-title" id="myModalLabel">
                        <?php if($heading) echo $heading;else {?>Error<?php }?>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="alert<?php if ($status==1){ ?> alert-success<?php }else{?> alert-danger<?php } ?>" role="alert">
                        <?php echo $message;?>
                        <br>
                        名字：<?php echo $data['name'];?>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php if(!$url){ ?>
                        <a href="javascript:history.back();"  class="btn btn-default" >取消</a>
                    <?php } else{?>
                        <a href="<?php echo $url?>"  class="btn btn-default" >取消</a>
                    <?php } ?>
                    <a  class="btn btn-primary" href="<?php echo $url2?>">
                        确定
                    </a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type="text/javascript" src="<?php echo base_url('static/common/js/jquery.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('static/common/js/bootstrap.min.js');?>"></script>
    <script>
        $(function () { $('#myModal').modal('show')});
    </script>
</div>
</body>
</html>