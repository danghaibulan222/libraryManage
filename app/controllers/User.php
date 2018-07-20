<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CIuc_Controller {

    function __construct ()
    {
        parent::__construct();
        $this->load->model ('User_m');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('encryption');
    }
    public function index()
    {
        $this->profiles($uid=$this->session->userdata('id'));
    }
    //用户信息加载
    public function profiles ($uid='')
    {
        //管理员可查看他人信息,普通用户看自己信息
        if($this->auth->is_user($uid)||$this->auth->is_admin()){
            $data['user'] = $this->User_m->get_user_by_id($uid);
            if(!$data['user']){
                show_message('用户不存在',site_url('/'));
            }


            $this->load->model('Borrowlist_m');
            $data['borrow_list'] = $this->Borrowlist_m->get_books_by_uid($uid,('0'));
            $data['borrow_history'] = $this->Borrowlist_m->get_books_by_uid($uid,('1'));
            $data['title']=$data['user']['name'];
            $this->load->view('user_profile', $data);
        }
        else{
            show_message('权限不足',site_url());
        }

    }
    //注册用户
    public function register ()
    {
        $data['title'] = '注册';
        if ($this->auth->is_login()) {
            show_message('已登录，请退出再注册',site_url());
        }
        if($_POST&& $this->form_validation->run() === TRUE){
            $passwordtemp = $this->input->post('password',true);
            $salt =get_salt();
            $data = array(
                'name' => $this->input->post('user_name'),
                'password' => password_dohash($passwordtemp,$salt),
                'salt' => $salt,
                'ip' => $this->input->ip_address(),
                'studentnum' => $this->input->post('student_num'),
                'sex' => $this->input->post('user_sex'),
                'grade' =>$this->input->post('user_grade'),
                'college' =>$this->input->post('user_college'),
                'usertype' => 0,
                'regtime' => time()
            );
            if($this->User_m->register($data)){
                //注册成功则登录
                $userid = $this->db->insert_id();//返回ID
                $newdata=array('name'=>$data['name'],'password'=>$passwordtemp);
                $this->User_m->login($newdata);
                show_message('注册成功',site_url(),1);
            }
        } else{
            $data['csrf_name'] = $this->security->get_csrf_token_name();
            $data['csrf_token'] = $this->security->get_csrf_hash();
            $this->load->view('register',$data);
        }
    }
    //登录
    public function login ()
    {
        if($this->auth->is_login()){
            redirect();
        }
        $data['title'] = '用户登录';
        if($_POST&& $this->form_validation->run() === TRUE){
            //页面获取数据
            $data = array(
                'name' => $this->input->post('user_name', TRUE),
                'password' => $this->input->post('password',TRUE)
            );
            //验证账号
            if ($this->User_m->login($data)) {
                redirect();
            } else {
                show_message('用户名或密码错误!');
            }
        } else {
            $data['csrf_name'] = $this->security->get_csrf_token_name();
            $data['csrf_token'] = $this->security->get_csrf_hash();
            $this->load->view('login',$data);
        }

    }
    //账号注销功能
    public function logout ()
    {
        $this->auth->process_logout();//删除session
        $this->load->helper('cookie');
        delete_cookie('id');
        delete_cookie('name');
        delete_cookie('usertype');
        redirect('user/login');//跳到登录功能
    }



}
