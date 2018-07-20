<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CIuc_Controller {

    function __construct ()
    {
        parent::__construct();
        $this->load->model ('Book_m');
        $this->load->model('Borrowlist_m');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('encryption');
    }
    public function index()
    {
        $this->search_all();
    }
    //用户信息加载
    public function profiles ($bid='')
    {
        //管理员可查看借阅情况,普通用户看书籍信息
        $data['book'] = $this->Book_m->get_book_by_bookid($bid);
        if(!$data['book']){
            show_message('图书不存在',site_url('/'));
        }
        $this->load->model('Borrowlist_m');
        $data['borrow_list'] = $this->Borrowlist_m->get_books_by_bookid($bid,('0'));
        $data['borrow_history'] = $this->Borrowlist_m->get_books_by_bookid($bid,('1'));

        $data['title']=$data['book']['bookname'];
        $this->load->view('book_profile', $data);

    }
    public function search_all()
    {
        //查找图书
        $data['title'] = '图书借阅';
        if($_POST){
            $str = array(
                'bookname'=> $this->input->post('book_name'),
                'booknum' => $this->input->post('book_num'),
                'writer' => $this->input->post('book_writer'),
                'pubhouse' =>$this->input->post('book_pubhouse'),
                'pubtime' =>$this->input->post('book_pubtime'),
                'introduction' =>$this->input->post('book_introduction')
            );
            $data['books']=$this->Book_m->search_book($str['bookname'],$str['booknum'],$str['writer'],$str['pubhouse'],
                $str['pubtime'],$str['introduction']);
            if(!$data['books'])$data['books']=$this->Book_m->search_book_by_bookname(' ');
        }
        else{
            $data['books']=$this->Book_m->search_book_by_bookname(' ');
        }

        $this->load->view('book_search', $data);
    }

    //用户借书
    public function borrow($bid){
        $data['title'] = '图书借阅';
        $data['book'] = $this->Book_m->get_book_by_bookid($bid);
        //判断登录
        if (!$this->auth->is_login()) {
            show_message('请先登录',site_url('user/login'));
        }
        //判断图书是否存在
        if(!$data['book']){
            show_message('图书不存在',site_url('book/search_all'));
        }
        //判断图书是否借完
        if($data['book']['canborrow']!=1){
            show_message('图书不可借',site_url('book/search_all'));
        }
        //判断个人是否有超期
        if($this->Borrowlist_m->get_user_overtime($this->session->userdata('id'))){
            show_message('有超期图书不可借书',site_url('book/search_all'));
        }
        //更新借书表
        $data2['id']=$this->session->userdata('id');
        $data2['bookid']=$bid;
        $data2['borrowtime']=time();
        $data3['borrowamount']=$data['book']['borrowamount']+1;
        //书被借完
        if($data3['borrowamount']==$data['book']['amount'])
            $data3['canborrow']=0;
        if($this->Borrowlist_m->addbookborow($data2)){
            $this->Book_m->updatebook($bid,$data3);
            show_message('借书成功',site_url(),1);
        }
        else
            show_message('借书失败',site_url('book/search_all'));
    }

    //用户还书
    public function returnbook($oid){
        $data['title'] = '图书归还';
        //获取图书
        $data['list'] = $this->Borrowlist_m->get_list_by_oid($oid);
        $bid=$data['list']['bookid'];
        $data['book'] = $this->Book_m->get_book_by_bookid($bid);
        if ($this->auth->is_login()) {
            $str['returntime']=time();
            $str['hasreturn']=1;
            if($this->Borrowlist_m->updatebookborrow($oid,$this->session->userdata('id'),$str)){
                $data3['borrowamount']=$data['book']['borrowamount']-1;
                $data3['canborrow']=1;
                $this->Book_m->updatebook($bid,$data3);
                show_message('还书成功',site_url('user/index'),1);
            }else
                show_message('用户还书失败',site_url('user/index'));

        }
        else
        show_message('请先登录',site_url('user/login'));
    }




}
