<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CIuc_Controller {
    function __construct ()
    {
        parent::__construct();
        $this->load->model ('Book_m');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
	public function index($page=1)
	{
        $limit = 10;
        $start = ($page-1)*$limit;
        $data['books'] = $this->Book_m->get_all_books($start, $limit);
        $config['per_page'] = $limit;
        $config['base_url'] = site_url('home/index');
        $config['total_rows'] = $this->db->count_all('books');
        $this->load->library('pagination');

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

		$this->load->view('home',$data);
	}
}
