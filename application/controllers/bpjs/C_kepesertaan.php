<?php

class C_kepesertaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $allowedAccess = ['1', '3'];
        $this->middleware->canAccessBy($need_return = 0, $allowedAccess);
    }

    public function index()
    {
        render('bpjs/v_kepesertaan', $data = [], 'bpjs');
    }

    public function cekKepesertaanNoka()
    {
        $noka = $this->input->post('noka');
        $tgl_pelayanan = $this->input->post('tgl_pelayanan');
        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/kepesertaan/nokartu/' . $noka);

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }
    public function cekKepesertaanNIK()
    {
        $noka = $this->input->post('noka');
        $tgl_pelayanan = $this->input->post('tgl_pelayanan');
        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/kepesertaan/nik/' . $noka);

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }
}
