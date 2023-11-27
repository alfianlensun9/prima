<?php
class M_auth extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getUserLogin()
    {
        // dd($this->input->post());
        return $this->db->where('username', $this->input->post('identity'))
            ->where('flag_active', 1)
            ->limit(1)
            ->get('auth_users')->row_array(0);
    }

    public function isLoggedIn()
    {
        // dd($this->input->post());
        return $this->db->where('username', $this->input->post('identity'))
            ->where('flag_active', 1)
            ->limit(1)
            ->get('auth_users')->row_array(0);
    }
}
