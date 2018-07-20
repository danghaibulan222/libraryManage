<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 *
 *  验证规则，直接修改
 *
 *
 *  */

$CI =& get_instance();
$config = array(
	'user/register' => array(
		array(
			'field' => 'user_name',
			'label' => '用户名',
			'rules' => 'trim|required|is_unique[users.name]|min_length[2]|max_length[10]|xss_clean'
		),
		array(
			'field' => 'password',
			'label' => '密码',
			'rules' => 'trim|required|min_length[6]|max_length[18]'
		),
		array(
			'field' => 'password_confirm',
			'label' => '重复密码',
			'rules' => 'trim|required|matches[password]'
		),
        array(
            'field' => 'student_num',
            'label' => '学号',
            'rules' => 'trim|required|is_unique[users.studentnum]|in_length[13]|integer'
        )

	),
	'user/login' => array(
		array(
			'field' => 'user_name',
			'label' => '用户名',
			'rules' => 'trim|required|min_length[2]|max_length[10]|xss_clean'
		),
		array(
			'field' => 'password',
			'label' => '密码',
			'rules' => 'trim|required|min_length[4]|max_length[18]'
		)
		
	),

    'setting/profile' => array(
        array(
            'field' => 'student_num',
            'label' => '学号',
            'rules' => 'trim|required|min_length[13]'
        )
    ),
    'setting/password' => array(
        array(
            'field' => 'old_password',
            'label' => '原密码',
            'rules' => 'trim|required|min_length[4]|max_length[18]|callback__check_password'
        ),
        array(
            'field' => 'new_password',
            'label' => '新密码',
            'rules' => 'trim|required|min_length[4]|max_length[18]'
        ),
        array(
            'field' => 'new_password2',
            'label' => '重复新密码',
            'rules' => 'trim|required|matches[new_password]'
        )
    ),
    'admin/users/edit' => array(
        array(
            'field' => 'student_num',
            'label' => '学号',
            'rules' => 'trim|required|min_length[13]|integer'
        )
    ),
    'admin/users/add' => array(
        array(
            'field' => 'user_name',
            'label' => '用户名',
            'rules' => 'trim|required|is_unique[users.name]|min_length[2]|max_length[10]|xss_clean'
        ),
        array(
            'field' => 'password',
            'label' => '密码',
            'rules' => 'trim|required|min_length[6]|max_length[18]'
        ),
        array(
            'field' => 'password_confirm',
            'label' => '重复密码',
            'rules' => 'trim|required|matches[password]'
        ),
        array(
            'field' => 'student_num',
            'label' => '学号',
            'rules' => 'trim|required|min_length[13]|is_unique[users.studentnum]|integer'
        )

    ),
    'admin/books/add' => array(
        array(
            'field' => 'book_name',
            'label' => '书名',
            'rules' => 'trim|required|max_length[20]|xss_clean'
        ),
        array(
            'field' => 'book_num',
            'label' => '书号',
            'rules' => 'trim|required|integer|is_unique[books.booknum]'
        ),
        array(
            'field' => 'book_writer',
            'label' => '作者',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'book_pubhouse',
            'label' => '出版社',
            'rules' => 'trim|required|max_length[20]'
        ),
        array(
            'field' => 'book_pubtime',
            'label' => '出版时间',
            'rules' => 'trim|required|min_length[6]|integer'
        ),
        array(
            'field' => 'book_introduction',
            'label' => '简介',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'book_amount',
            'label' => '数量',
            'rules' => 'trim|required|is_natural_no_zero'
        )
    ),
    'admin/books/edit' => array(
        array(
            'field' => 'book_name',
            'label' => '书名',
            'rules' => 'trim|required|max_length[20]|xss_clean'
        ),
        array(
            'field' => 'book_num',
            'label' => '书号',
            'rules' => 'trim|required|integer'
        ),
        array(
            'field' => 'book_writer',
            'label' => '作者',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'book_pubhouse',
            'label' => '出版社',
            'rules' => 'trim|required|max_length[20]'
        ),
        array(
            'field' => 'book_pubtime',
            'label' => '出版时间',
            'rules' => 'trim|required|min_length[6]|integer'
        ),
        array(
            'field' => 'book_introduction',
            'label' => '简介',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'book_amount',
            'label' => '数量',
            'rules' => 'trim|required|is_natural_no_zero'
        )
    ),
    'admin/borrowlist/newborrow' => array(

        array(
            'field' => 'book_num',
            'label' => '书号',
            'rules' => 'trim|required|integer'
        ),
        array(
            'field' => 'user_studentnum',
            'label' => '学号',
            'rules' => 'trim|required|min_length[13]|integer'
        )
    ),
    'install/process' => array(

        array(
            'field' => 'dbhost',
            'label' => '服务器',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'dbuser',
            'label' => '数据库用户名',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'dbname',
            'label' => '数据库名',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'name',
            'label' => '管理员',
            'rules' => 'trim|required|min_length[3]|max_length[15]'
        ),
        array(
            'field' => 'password',
            'label' => '密码',
            'rules' => 'trim|required|min_length[6]|max_length[18]'
        )
    )





);

