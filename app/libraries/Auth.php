<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * 判断用户session
 *
 */
class Auth
{
	/**用户*/
    private $_user = array();

    /**是否已经登录*/
    private $_hasLogin = NULL;

	/**CI句柄*/
	private $_CI;

	 /**构造函数*/
    public function __construct()
    {
        /** 获取CI句柄 */
		$this->_CI = & get_instance();
		$this->_user = unserialize($this->_CI->session->userdata('Users'));
		log_message('debug', "STBLOG: Authentication library Class Initialized");
    }

    /**判断用户是否已经登录*/

	public function is_login(){
		$id=$this->_CI->session->userdata('id');
		if(!$id){
			return false;
		}else{
			return true;
		}
	}

	 /**判断是否管理员*/
	public function is_admin()
	{
		$usertype=$this->_CI->session->userdata('usertype');
		/** 权限验证通过 */
        return ($this->is_login() && $usertype==1)? TRUE : FALSE;
	}



	public function is_user($id)
	{
		$uid=$this->_CI->session->userdata('id');
		if($uid!='' && $uid==$id){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	 /**用户登出删除session*/
	public function process_logout()
	{
		$this->_CI->session->sess_destroy();

	}

	/**用户登录注入session*/
	public function process_login($user)
	{
        $this->_CI->load->model('User_m');
		/** 获取用户信息 */
		$this->_user = $user;
		/** 每次登陆时需要更新的数据 */
		$this->_user['lastlogin'] = time();
		//修改登录时间
		if($this->_CI->User_m->update_user($this->_user['id'],$this->_user))
		{
			/** 设置session */
            $this->_user['password'] ='';
            $this->_CI->session->set_userdata($this->_user);
			$this->_hasLogin = TRUE;
			return TRUE;
		}
		return FALSE;
	}



}


