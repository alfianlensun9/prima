<?php
class Welcome extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $allowedAccess = ['1', '3'];
        $this->middleware->canAccessBy($need_return = 0, $allowedAccess);
    }

    public function index()
    {
        getUserGroup();
        render('v_welcome_page');
    }
}
