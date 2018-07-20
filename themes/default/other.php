<?php if($this->auth->is_login()){ ?>

 <?php $this->load->view('common/header');?>



<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">需权限页面</h3>
                </div>
                <div class="panel-body">

                </div>
            </div>
        </div>

        <div class="col-md-4">

        </div>
    </div>
</div>
    <?php $this->load->view('common/footer');?>
<?php }?>