<?php


class C_antrean_onside extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $allowedAccess = ['1', '3'];
        $this->middleware->canAccessBy($need_return = 0, $allowedAccess);
    }

    public function index()
    {
        render('antrean/v_antrean_onside', $data = [], 'antrean');
    }
}
