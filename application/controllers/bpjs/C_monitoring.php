<?php


class C_monitoring extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $allowedAccess = ['1', '3'];
        $this->middleware->canAccessBy($need_return = 0, $allowedAccess);
    }

    public function index()
    {
        render('bpjs/v_monitoring', $data = [], 'bpjs');
    }

    public function getDataKunjungan()
    {
        $jenis_pelayanan = $this->input->post('jenis_pelayanan');
        $tgl_pelayanan = $this->input->post('tgl_pelayanan');
        $response = $this->ws->setbaseurl('bpjs')
            ->get("/bpjs/v2/monitoring/kunjungan/pelayanan/$jenis_pelayanan?tanggal=$tgl_pelayanan");

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }
}
