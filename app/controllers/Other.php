<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Other extends CI_Controller {
    function __construct ()
    {
        parent::__construct();
    }
    public function index()
    {
        if($this->auth->is_login())
            $this->load->view('other');
        else
            show_message('尚未登录',site_url('user/login'));

    }
}
