<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Users extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model ('User_m');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    function index($page=1){
        $data['title'] = '用户管理';
        $data['act']='index';
        $limit = 10;
        $start = ($page-1)*$limit;
        $data['users'] = $this->User_m->get_all_users($start, $limit);
        $config['per_page'] = $limit;
        $config['base_url'] = site_url('admin/users/index');
        $config['total_rows'] = $this->db->count_all('users');
        $this->load->library('pagination');

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('admin/users',$data);

    }
    public function add ()
    {
        $data['title'] = '新建用户';
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
                'regtime' => time(),
                'ip' => $this->input->ip_address()
            );
            if($this->User_m->register($data)){
                show_message('创建成功',site_url('admin/users'),1);
            }
            else{
                $data ['msg'] = '创建失败，该学号号可能已被占用';
            }
        }
        $data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_token'] = $this->security->get_csrf_hash();
        $this->load->view('admin/useradd',$data);

    }


    function edit($uid='')
    {
        $data['title'] = '修改用户信息';
        $data['user'] = $this->User_m->get_user_by_id($uid);
        if(!$data['user']){
            show_message('用户不存在',site_url('admin/users'));
        }
        if($_POST&&$this->form_validation->run('admin/users/edit') === TRUE){
            $str = array(
                'studentnum' => $this->input->post('student_num'),
                'sex' => $this->input->post('user_sex'),
                'grade' =>$this->input->post('user_grade'),
                'college' =>$this->input->post('user_college')
            );
            if($this->User_m->update_user($uid, $str)){
                show_message('修改用户成功',site_url('admin/users/index'),1);
            }else{
                $data ['msg'] = '修改失败请确认更改或该学号已被占用';
            }

        }
        //加载form类，为调用错误函数,需view前加载
        $this->load->helper('form');
        $data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_token'] = $this->security->get_csrf_hash();
        $this->load->view('admin/user_edit', $data);
    }

    function del($uid='')
    {
        $user=$this->User_m->get_user_by_id($uid);
        $this->load->model('Borrowlist_m');
        $data['borrow_list'] = $this->Borrowlist_m->get_books_by_uid($uid,('0'));
        if(!$user){
            show_message('用户不存在',site_url('admin/users/index'));
        }
        if ($user['usertype']==1){
            show_message('管理员不能被删除',site_url('admin/users/index'));
        }
        if($data['borrow_list']){
            show_message('用户有未还书籍不能被删除',site_url('admin/users/index'));
        }
        else{
            show_dialog('确定删除该用户吗?',site_url('admin/users/index'),site_url('admin/users/do_del/'.$user['id']),$user);
        }
    }


     function do_del($uid='')
    {
        $user=$this->User_m->get_user_by_id($uid);
        if(!$user){
            show_message('用户不存在',site_url('admin/users/index'));
        }
        if ($user['usertype']==1){
            show_message('管理员不能被删除',site_url('admin/users/index'));
        }
        $user=$this->User_m->get_user_by_id($uid);
        $this->User_m->del($uid);
        if($user['avatar']!='uploads/avatar/default/'){
            @unlink(FCPATH.$user['avatar'].'big.png');
            @unlink(FCPATH.$user['avatar'].'normal.png');
            @unlink(FCPATH.$user['avatar'].'small.png');
        }
        show_message('删除用户成功',site_url('admin/users/index'),1);

    }

    public function search()
    {
        //查找用户
        $data['title'] = '用户搜索';
        if($_POST){
            $data['users']=$this->User_m->search_user_by_name($this->input->post('user_name'));
        }
        else{
            $data['users']=$this->User_m->search_user_by_name(' ');
        }
            $this->load->view('admin/users', $data);
    }
    public function search_all()
    {
        //查找用户
        $data['title'] = '用户搜索';
        if($_POST){
            $str = array(
                'name'=> $this->input->post('user_name'),
                'studentnum' => $this->input->post('student_num'),
                'sex' => $this->input->post('user_sex'),
                'grade' =>$this->input->post('user_grade'),
                'college' =>$this->input->post('user_college')
            );
            $data['users']=$this->User_m->search_user($str['name'],$str['studentnum'],$str['sex'],$str['grade'],$str['college']);
            if(!$data['users'])$data['users']=$this->User_m->search_user_by_name(' ');
        }
        else{
            $data['users']=$this->User_m->search_user_by_name(' ');
        }

        $this->load->view('admin/users', $data);
    }

}