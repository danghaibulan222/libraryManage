<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Borrowlist extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model ('Borrowlist_m');
        $this->load->model ('User_m');
        $this->load->model ('Book_m');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    function index($page=1){
        $data['title'] = '还书管理';
        $limit = 10;
        $start = ($page-1)*$limit;
        $data['list'] = $this->Borrowlist_m->getborrowlist($start, $limit);
        $config['per_page'] = $limit;
        $config['base_url'] = site_url('admin/borrowlist/index');
        $config['total_rows'] = count($data['list']);
        $this->load->library('pagination');

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('admin/borrowlist',$data);

    }
    public function newborrow()
    {
        $data['title'] = '新建借书';
        if($_POST&& $this->form_validation->run() === TRUE){
            $data = array(
                'booknum' => $this->input->post('book_num'),
                'student_num' => $this->input->post('user_studentnum')
            );
            $data['book'] = $this->Book_m->get_book_by_booknum($data['booknum']);
            $data['user'] = $this->User_m->get_user_by_studentnum($data['student_num']);
            if($data['book']&&$data['user']){
                //判断图书是否借完
                if($data['book']['canborrow']!=1){
                    show_message('图书不可借',site_url('book/search_all'));
                }
                //判断个人是否有超期
                if($this->Borrowlist_m->get_user_overtime($data['user']['id'])){
                    show_message('有超期图书不可借书',site_url('admin/borrowlist'));
                }
                //更新借书表
                $data2['id']=$data['user']['id'];
                $data2['bookid']=$data['book']['bookid'];
                $data2['borrowtime']=time();
                $data3['borrowamount']=$data['book']['borrowamount']+1;
                //书被借完
                if($data3['borrowamount']==$data['book']['amount'])
                    $data3['canborrow']=0;
                if($this->Borrowlist_m->addbookborow($data2)){
                    $this->Book_m->updatebook($data2['bookid'],$data3);
                    show_message('借书成功',site_url('admin/borrowlist'),1);
                }
                else
                    show_message('借书失败',site_url('admin/borrowlist'));
            }
            else
                show_message('用户或书不存在',site_url('admin/borrowlist'));
        } else{
            $data['csrf_name'] = $this->security->get_csrf_token_name();
            $data['csrf_token'] = $this->security->get_csrf_hash();
            $this->load->view('admin/borrowadd',$data);
        }
    }
    public function do_add(){

    }


    //图书查找
    public function search()
    {
        //查找
        $data['title'] = '借书搜索';
        if($_POST){
            $data['list']=$this->Borrowlist_m->search_list_by_bookname($this->input->post('book_name'));
        }
        else{
            $data['list']=array();
        }
        $this->load->view('admin/borrowlist', $data);
    }
    //图书超期查找
    public function searchall()
    {
        //查找用户
        $data['title'] = '借书搜索';
        if(!$data['list']=$this->Borrowlist_m->search_overtimebook()){
            $data['books']=$this->Borrowlist_m->search_list_by_bookname(' ');
        }
        $this->load->view('admin/borrowlist', $data);
    }

    //管理员还书
    function do_return($oid)
    {
        $data['title'] = '图书归还';
        //获取图书
        $data['list'] = $this->Borrowlist_m->get_list_by_oid($oid);
        $bid=$data['list']['bookid'];
        $uid=$data['list']['id'];
        $data['book'] = $this->Book_m->get_book_by_bookid($bid);
        $str['returntime']=time();
        $str['hasreturn']=1;
        if($this->Borrowlist_m->updatebookborrow($oid,$uid,$str)){
            $data3['borrowamount']=$data['book']['borrowamount']-1;
            $data3['canborrow']=1;
            $this->Book_m->updatebook($bid,$data3);
            show_message('还书成功',site_url('admin/borrowlist'),1);
        }else
            show_message('还书失败',site_url('admin/borrowlist'));
    }

    //管理员还书询问
    public function returnbook($oid){
        $data['title'] = '图书归还';
        $data['list'] = $this->Borrowlist_m->get_list_by_oid($oid);
        $bid=$data['list']['bookid'];
        $data['book'] = $this->Book_m->get_book_by_bookid($bid);
        $str['name']=$data['book']['bookname'];
        show_dialog('确定帮该用户归还图书吗?',site_url('admin/borrowlist/index'),
            site_url('admin/borrowlist/do_return/'.$oid),$str);

    }


}