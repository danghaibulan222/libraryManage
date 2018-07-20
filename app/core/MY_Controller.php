<?php
/**
 * 自定义控制器
 */
class Base_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
                //判断关闭
		if($this->config->item('site_close')=='off'){
			show_error($this->config->item('site_close_msg'),500,'网站关闭');
		}
        //判断安装
        $file=FCPATH.'install.lock';
        if (!is_file($file)){
            show_message('系统尚未安装，跳转安装中。。。',site_url('install'));
        }
	}
}

class CIuc_Controller extends Base_Controller
{

	function __construct()
    {
		parent::__construct();
		//更新超期
		$this->load->database();
                $this->load->model ('Borrowlist_m');
                $time=time()-daytosec(30);
                $this->Borrowlist_m->updateovertime($time);

	}	
}
class Admin_Controller extends Base_Controller 
{
	function __construct()
	{
		parent::__construct();
                //更新超期
                $this->load->database();
                $this->load->model ('Borrowlist_m');
                $time=time()-daytosec(30);
                $this->Borrowlist_m->updateovertime($time);
       if(!$this->auth->is_admin())
        {
            show_message('请使用管理员账号登录',site_url('user/login'));
        }

	}
}
class Install_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
}




