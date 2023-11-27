<?php

class C_nav extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$allowedAccess = ['1', '3'];
		$this->middleware->canAccessBy($need_return = 0, $allowedAccess);
	}

	public function index()
	{
		render('master/v_nav_master', $data = [], 'master');
	}
}
