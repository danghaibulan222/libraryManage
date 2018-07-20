<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CIuc_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_m');
        $this->load->helper('form');
        $this->load->library('form_validation');
        if(!$this->auth->is_login ()){
            redirect('user/login');
        }
    }

    public function index()
    {
        $this->profile();
    }

    public function profile()
    {
        $data ['title'] = '资料修改';
        $uid = $this->session->userdata ('id');
        $data = $this->User_m->get_user_by_id($uid);
        $data['user']= $this->User_m->get_user_by_id($uid);
        if($_POST && $this->form_validation->run('setting/profile')===TRUE){
            $str = array(
                'studentnum' => $this->input->post('student_num'),
                'sex' => $this->input->post('user_sex'),
                'grade' =>$this->input->post('user_grade'),
                'college' =>$this->input->post('user_college')
            );
            if($this->User_m->update_user($uid, $str)){
                $data = $this->User_m->get_user_by_id($uid);
                //重写session
                $user = $this->User_m->get_user_by_name($data['name']);
                $this->session->set_userdata(array (
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'avatar'=>$user['avatar'],
                        'usertype' => $user['usertype'],
                    )
                );
                show_message('修改成功！',site_url(),1);
            }else{
                $data ['msg'] = '修改失败，请确认已修改';
            }

        }
        $data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_token'] = $this->security->get_csrf_hash();
        $this->load->view('profile_setting', $data);
    }


    public function password()
    {
        $data ['title'] = '密码修改';
        if ($_POST && $this->form_validation->run('setting/password')===TRUE) {
            $newpassword = $this->input->post ('new_password');
            $data = array ('id' => $this->session->userdata ( 'id' ), 'password' =>$newpassword);
            if($this->User_m->update_pwd($data)) {
                show_message('修改密码成功,请重新登录！',site_url('user/logout'),1);
            } else {
                $data ['msg'] = '修改失败';
            }
        }
        $data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_token'] = $this->security->get_csrf_hash();
        $this->load->view('password_setting', $data);

    }



    //回调函数检测之前密码是否正确
    function _check_password($password){
        $data = array(
            'name' => $this->session->userdata('name'),
            'password' => $password,
        );
        if (!$this->User_m->login($data)){
            return FALSE;
        } else {
            return TRUE;
        }
    }

}