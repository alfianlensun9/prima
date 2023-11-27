<?php 


class C_nav_antrean extends CI_Controller{
    function __construct()
	{
        parent::__construct();
    }
    
    public function index(){
        render('antrean/v_nav_antrean', $data = [], 'antrean');
    }
}