<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Middleware
{
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('auth/M_auth');
    }



    public function isLoggedIn()
    {
        // dd($this->ci->session);
        if (!$this->ci->session->userdata('auth_users')['id_auth_users']) {
            redirect('C_auth/logout', 'refresh');
        }
    }

    public function canAccessBy($need_return = 0, $allowed)
    {
        $this->isLoggedIn();

        $group = $this->ci->session->userdata('auth_users')['id_auth_group'];
        $usergroup[] = $group;


        if (!array_intersect($usergroup, $allowed)) {
            if ($need_return == 0) {
                redirect('auth/logout', 'refresh');
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
}
