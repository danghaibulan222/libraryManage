<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Books extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model ('Book_m');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    function index($page=1){
        $data['title'] = '图书管理';
        $limit = 10;
        $start = ($page-1)*$limit;
        $data['books'] = $this->Book_m->get_all_books($start, $limit);
        $config['per_page'] = $limit;
        $config['base_url'] = site_url('admin/books/index');
        $config['total_rows'] = $this->db->count_all('books');
        $this->load->library('pagination');

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('admin/books',$data);

    }
    public function add ()
    {
        $data['title'] = '图书录入';
        if($_POST&& $this->form_validation->run() === TRUE){
            $data = array(
                'bookname' => $this->input->post('book_name'),
                'booknum' => $this->input->post('book_num'),
                'writer' => $this->input->post('book_writer'),
                'pubhouse' =>$this->input->post('book_pubhouse'),
                'pubtime' =>$this->input->post('book_pubtime'),
                'introduction' =>$this->input->post('book_introduction'),
                'amount' =>$this->input->post('book_amount')
            );
            if($this->Book_m->addbook($data)){
                show_message('创建成功',site_url('admin/books'),1);
            }else{
                $data ['msg'] = '创建失败，该书号可能已被占用';
            }
        }
        //加载form类，为调用错误函数,需view前加载
        $this->load->helper('form');
        $data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_token'] = $this->security->get_csrf_hash();
        $this->load->view('admin/bookadd',$data);

    }


    function edit($bid='')
    {
        $data['title'] = '修改图书信息';
        $data['book'] = $this->Book_m->get_book_by_bookid($bid);
        if(!$data['book']){
            show_message('书籍不存在',site_url('admin/books'));
        }
        if($_POST&&$this->form_validation->run('admin/books/edit') === TRUE){
            $str = array(
                'bookname' => $this->input->post('book_name'),
                'booknum' => $this->input->post('book_num'),
                'writer' => $this->input->post('book_writer'),
                'pubhouse' =>$this->input->post('book_pubhouse'),
                'pubtime' =>$this->input->post('book_pubtime'),
                'introduction' =>$this->input->post('book_introduction'),
                'amount' =>$this->input->post('book_amount')
            );
            //更新可借
            if($str['amount']>$data['book']['amount'])
                $str['canborrow']=1;
            if($str['amount']<$data['book']['borrowamount'])
            {
                $str['amount']=$data['book']['amount'];
            }
            if($str['amount']==$data['book']['borrowamount'])
                $str['canborrow']=0;
            if($this->Book_m->updatebook($bid, $str)){
                show_message('修改图书成功',site_url('admin/books/index'),1);
            }else{
                $data ['msg'] = '修改失败请确认更改或书号已被占用或书籍数量与借出不符';
            }

        }
        //加载form类，为调用错误函数,需view前加载
        $this->load->helper('form');
        $data['csrf_name'] = $this->security->get_csrf_token_name();
        $data['csrf_token'] = $this->security->get_csrf_hash();
        $this->load->view('admin/book_edit', $data);
    }

    function del($bid='')
    {
        $book=$this->Book_m->get_book_by_bookid($bid);
        if(!$book){
            show_message('图书不存在',site_url('admin/books/index'));
        }
        if ($book['canborrow']==0){
            show_message('图书已借出不能被删除',site_url('admin/books/index'));
        }
        else{
            $book['name']=$book['bookname'];
            show_dialog('确定删除该图书吗?',site_url('admin/books/index'),site_url('admin/books/do_del/'.$book['bookid']),$book);
        }
    }


    function do_del($bid='')
    {
        $book=$this->Book_m->get_book_by_bookid($bid);
        if(!$book){
            show_message('图书不存在',site_url('admin/books/index'));
        }
        if ($book['borrowamount']!=0){
            show_message('图书已借出不能被删除',site_url('admin/books/index'));
        }
        $book=$this->Book_m->get_book_by_bookid($bid);
        $this->Book_m->delbook($bid);
        show_message('删除图书成功',site_url('admin/books/index'),1);

    }

    //图书查找
    public function search()
    {
        //查找
        $data['title'] = '图书搜索';
        if($_POST){
            $data['books']=$this->Book_m->search_book_by_bookname($this->input->post('book_name'));
        }
        else{
            $data['books']=$this->Book_m->search_book_by_bookname(' ');
        }
        $this->load->view('admin/books', $data);
    }
    public function search_all()
    {
        //查找用户
        $data['title'] = '图书搜索';
        if($_POST){
            $str = array(
                'bookname'=> $this->input->post('book_name'),
                'booknum' => $this->input->post('book_num'),
                'writer' => $this->input->post('book_writer'),
                'pubhouse' =>$this->input->post('book_pubhouse'),
                'pubtime' =>$this->input->post('book_pubtime'),
                'introduction' =>$this->input->post('book_introduction')
            );
            $data['books']=$this->Book_m->search_book($str['bookname'],$str['booknum'],$str['writer'],$str['pubhouse'],$str['pubtime'],$str['introduction']);
            if(!$data['books'])$data['books']=$this->Book_m->search_book_by_bookname(' ');
        }
        else{
            $data['books']=$this->Book_m->search_book_by_bookname(' ');
        }

        $this->load->view('admin/books', $data);
    }


}