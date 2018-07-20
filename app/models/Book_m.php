<?php


class Book_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function addbook($data){
        return $this->db->insert('books',$data);
    }
    function delbook($book_id)
    {
        $this->db->where('bookid',$book_id)->delete('books');
    }
    function updatebook($book_id,$data){
        $this->db->where('bookid',$book_id);
        $this->db->update('books', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    function get_book_by_bookname($book_name){
        $query = $this->db->get_where('books',array('bookname'=>$book_name));
        return $query->row_array();
    }
    function get_book_by_booknum($book_num){
        $query = $this->db->get_where('books',array('booknum'=>$book_num));
        return $query->row_array();
    }

    function get_book_by_bookid($book_id)
    {
        $query = $this->db->get_where('books', array('bookid'=>$book_id));
        return $query->row_array();
    }

    //搜索名字返回
    public function search_book_by_bookname($book_name)
    {
        $this->db->from('books');
        $this->db->like('bookname', $book_name);
        $query = $this->db->get();
        return $query->result_array();
    }

    //组合查询
    public function search_book($book_name,$book_num,$book_writer,$pubhouse,$pubtime,$introduction)
    {
        $data=array();
        $data2['flag']=0;
        //if($book_name!=NULL) $data['bookname']=$book_name;
        if($book_name!=NULL){
            $this->db->like('bookname',$book_name);
            $data2['flag']=1;
        }
        if($book_num) $data['booknum']=$book_num;
        if($book_writer) $data['writer']=$book_writer;
        if($pubhouse) {
            $this->db->like('pubhouse', $pubhouse);
            $data2['flag']=1;
        }
        if($pubtime) $data['pubtime']=$pubtime;
        if($introduction){
            $this->db->like('introduction', $introduction);
            $data2['flag']=1;
        }
        if(!$data&&$data2['flag']==0){
            return false;
        }
        $query = $this->db->get_where('books', $data);
        return $query->result_array();
    }

    //返回所有
    public function get_all_books($page, $limit)
    {
        $this->db->select('*');
        $this->db->from('books');
        $this->db->order_by('booknum','asc');
        $this->db->limit($limit,$page);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
    }



}