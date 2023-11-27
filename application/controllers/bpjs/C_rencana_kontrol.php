<?php


class C_rencana_kontrol extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $allowedAccess = ['1', '3'];
        $this->middleware->canAccessBy($need_return = 0, $allowedAccess);
    }

    public function index()
    {
        render('bpjs/v_rencana_kontrol', $data = [], 'bpjs');
    }

    public function createRencanaKontrol()
    {
        $data = [
            'no_sep' => $this->input->post('no_sep'),
            'kode_dokter' => $this->input->post('kode_dokter'),
            'poli_kontrol' => $this->input->post('poli_kontrol'),
            'tgl_rencana' => $this->input->post('tgl_rencana'),
            'id_user_inputer' => $this->session->userdata['auth_users']['id_auth_users']
        ];

        $response = $this->ws->setbaseurl('bpjs')
            ->data($data)
            ->post('/bpjs/rencana-kontrol');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function updateRencanaKontrol()
    {
        $data = [
            'no_surat' => $this->input->post('no_surat'),
            'no_sep' => $this->input->post('no_sep'),
            'kode_dokter' => $this->input->post('kode_dokter'),
            'poli_kontrol' => $this->input->post('poli_kontrol'),
            'tgl_rencana' => $this->input->post('tgl_rencana'),
            'id_user_inputer' => $this->session->userdata['auth_users']['id_auth_users']
        ];

        $response = $this->ws->setbaseurl('bpjs')
            ->data($data)
            ->patch('/bpjs/rencana-kontrol');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function createSpri()
    {
        $data = [
            'no_kartu' => $this->input->post('no_kartu'),
            'kode_dokter' => $this->input->post('kode_dokter'),
            'poli_kontrol' => $this->input->post('poli_kontrol'),
            'tgl_rencana' => $this->input->post('tgl_rencana'),
            'id_user_inputer' => $this->session->userdata['auth_users']['id_auth_users']
        ];

        $response = $this->ws->setbaseurl('bpjs')
            ->data($data)
            ->post('/bpjs/rencana-kontrol/spri');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function updateSpri()
    {
        $data = [
            'no_spri' => $this->input->post('no_spri'),
            'kode_dokter' => $this->input->post('kode_dokter'),
            'poli_kontrol' => $this->input->post('poli_kontrol'),
            'tgl_rencana' => $this->input->post('tgl_rencana'),
            'id_user_inputer' => $this->session->userdata['auth_users']['id_auth_users']
        ];

        $response = $this->ws->setbaseurl('bpjs')
            ->data($data)
            ->patch('/bpjs/rencana-kontrol/spri');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getDataRencanaKotrol()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');

        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/rencana-kontrol?tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir);

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function deleteDataRencanaKotrol()
    {
        $userInputer = str_pad($this->session->userdata['auth_users']['id_auth_users'],6,"0");

        $data = [
            'no_surat' => $this->input->post('no_surat'),
            'id_user_inputer' => $userInputer,
            'IdUserINputer' => $this->session->userdata['auth_users']['id_auth_users']
        ];

        $response = $this->ws->setbaseurl('bpjs')
            ->data($data)
            ->delete('/bpjs/rencana-kontrol');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }
}
