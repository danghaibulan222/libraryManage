<?php
class User_m extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this -> load -> database();
        $this->load->helper('url');
        $this->load->library('encryption');
    }
    //插入用户
    function register($data){
        return $this->db->insert('users',$data);
    }
    //删除用户
    function del($u_id)
    {
        $this->db->where('id',$u_id)->delete('users');
    }
    //更新用户
    function update_user($u_id, $data){
        $this->db->where('id',$u_id);
        $this->db->update('users', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    //更新密码
    function update_pwd($data){
        $query = $this->get_user_by_id($data['id']);
        $password = password_dohash($data['password'],@$query['salt']);
        $this->db->where('id',$data['id']);
        $this->db->update('users', array('password'=>$password));
        return $this->db->affected_rows();
    }
    /*login in*/
    function login($data){
        $user = $this->get_user_by_name($data['name']);
        if($user){
            $password= password_dohash($data['password'],$user['salt']);
            //判断密码是否正确
            if($user['password']==$password){
                //登录成功，注入session
                $this->auth->process_login($user);
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function get_user_by_name($u_name){
        $query = $this->db->get_where('users', array('name'=>$u_name));
        return $query->row_array();
    }

    function get_user_by_id($u_id)
    {
        $query = $this->db->get_where('users', array('id'=>$u_id));
        return $query->row_array();
    }
    function get_user_by_studentnum($u_num)
    {
        $query = $this->db->get_where('users', array('studentnum'=>$u_num));
        return $query->row_array();
    }

    //返回所有用户
    public function get_all_users($page, $limit)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->order_by('id','asc');
        $this->db->limit($limit,$page);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
    }

    //通过名字返回用户
    public function search_user_by_name($u_name)
    {
        $this->db->from('users');
        $this->db->like('name', $u_name);
        $query = $this->db->get();
        return $query->result_array();
    }


    //组合查询
    public function search_user($u_name,$u_stu,$u_sex,$u_grade,$u_college)
    {
        $data=array();
        if($u_name!=NULL) {
            $this->db->like('name', $u_name);
        }
        if($u_stu) $data['studentnum']=$u_stu;
        if($u_sex!='') $data['sex']=$u_sex;
        if($u_grade!='') $data['grade']=$u_grade;
        if($u_college!='') $data['college']=$u_college;
        if(!$data&&$u_name==NULL){
            return false;
        }
        $query = $this->db->get_where('users', $data);
        return $query->result_array();
    }





}
?>
