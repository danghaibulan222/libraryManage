<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model ('User_m');
        $this->load->model ('Borrowlist_m');
        $this->load->model ('Book_m');
    }

    public function index()
    {
        /** 检查登陆 */

        $data['title'] = '管理后台';
        $this->load->view('admin/dashboard', $data);

    }





}