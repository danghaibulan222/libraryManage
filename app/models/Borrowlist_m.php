<?php

class Borrowlist_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //插入借书
    function addbookborow($data){
        return $this->db->insert('borrowlist',$data);
    }
    //修改借书即还书
    function updatebookborrow($o_id,$id,$data){
        $this->db->where('orderid',$o_id);
        $this->db->where('id',$id);
        $this->db->where('hasreturn',0);
        $this->db->update('borrowlist',$data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    //修改超期标志
    function updateovertime($time){
        $this->db->where('hasreturn',0);
        $this->db->where('borrowtime <',$time);
        $this->db->update('borrowlist',array('isovertime'=>1));
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    //返回是否超期的标识
    function get_user_overtime($uid){
        $query = $this->db->get_where('borrowlist',array('id'=>$uid,'isovertime'=>1,'hasreturn'=>0));
        return ($query->row_array()>0)? TRUE : FALSE;
    }
    //订单号返回订单
    function get_list_by_oid($oid){
        $query = $this->db->get_where('borrowlist', array('orderid'=>$oid));
        return $query->row_array();
    }
    function get_books_by_uid($uid,$ifreturn){
        $this->db->select('a.*, b.bookid, b.bookname, u.id, u.name');
        $this->db->from('borrowlist a');
        $this->db->where('a.id',$uid);
        $this->db->where_in('a.hasreturn',$ifreturn);
        $this->db->join('books b', 'b.bookid = a.bookid','left');
        $this->db->join('users u', 'u.id = a.id');

        $this->db->order_by('borrowtime','desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_books_by_bookid($bookid,$ifreturn){
        $this->db->select('a.*, b.bookid, b.bookname, u.id, u.name');
        $this->db->from('borrowlist a');
        $this->db->where('b.bookid',$bookid);
        $this->db->where_in('a.hasreturn',$ifreturn);
        $this->db->join('books b', 'b.bookid = a.bookid','left');
        $this->db->join('users u', 'u.id = a.id');
        $this->db->order_by('borrowtime','desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function search_list_by_bookname($bookname){
        $this->db->select('bl.*,b.bookid, b.bookname,b.booknum, u.id, u.name,u.studentnum');
        $this->db->from('borrowlist bl');
        $this->db->like('bookname', $bookname);
        //$this->db->where('bookname',$bookname);
        $this->db->where('hasreturn',0);
        $this->db->join('books b', 'b.bookid = bl.bookid','left');
        $this->db->join('users u', 'u.id = bl.id');
        $this->db->order_by('orderid','asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function search_overtimebook(){
        $this->db->select('bl.*,b.bookid, b.bookname,b.booknum, u.id, u.name,u.studentnum');
        $this->db->from('borrowlist bl');
        $this->db->where('isovertime',1);
        $this->db->where('hasreturn',0);
        $this->db->join('books b', 'b.bookid = bl.bookid','left');
        $this->db->join('users u', 'u.id = bl.id');
        $this->db->order_by('orderid','asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function getborrowlist($page, $limit){
        $this->db->select('bl.*,b.bookid, b.bookname,b.booknum, u.id, u.name,u.studentnum');
        $this->db->from('borrowlist bl');
        $this->db->where('hasreturn',0);
        $this->db->join('books b', 'b.bookid = bl.bookid','left');
        $this->db->join('users u', 'u.id = bl.id');
        $this->db->order_by('orderid','asc');
        $this->db->limit($limit,$page);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        }
    }

}