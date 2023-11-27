<?php

class C_auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('auth/M_auth', 'auth');
    }

    public function index()
    {
        $this->load->view('v_login');
    }

    public function login()
    {
        
        $user = $this->auth->getUserLogin();
        // dd($user);
        if ($user !== null) {
            if (password_verify($this->input->post('password'), $user['password'])) {
                $this->session->set_userdata("auth_users", $user);
                redirect(base_url('/Welcome'));
            } else {
                $this->session->set_flashdata('errmessage', 'Username / Password anda salah');
                redirect('/login');
            }
        } else {
            $this->session->set_flashdata('errmessage', 'Username / Password anda salah');
            redirect('/login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/login');
    }

    public function refreshToken()
    {

        $body = [
            "username" => "0800",
            "password" => "123"
        ];

        $response = $this->ws->setbaseurl('aevy')
            ->data($body, $uat = 1)
            ->post("/auth/signin");
        // dd($response);



        $jenis_absensi = $this->ws
            ->setToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZF9hdXRoX3VzZXJzIjoyLCJmdWxsX25hbWUiOiJBbGZpYW4gUiBMZW5zdW4iLCJyb2xlcyI6W10sInVzZXJfYWdlbnQiOiJVRzl6ZEcxaGJsSjFiblJwYldVdk55NHlPUzR3IiwiaWF0IjoxNjQ5Mzc5MTg2fQ.m50w7SftspY4ynPVuUS-XKexAA7Ep8MrPSMc5wkIal8');
        redirect('welcome');
    }
}
