<?php


class C_antrean_ws extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $allowedAccess = ['1', '3'];
        $this->middleware->canAccessBy($need_return = 0, $allowedAccess);
    }

    public function index()
    {
        render('antrean/v_antrean_ws', $data = [], 'antrean');
    }

    public function generateToken()
    {
        $response = $this->ws->setbaseurl('antrean')
                             ->generateAntreanToken('/bpjs/api/token');
        return $response['response']['token'];
    }

    public function getSisaAntrean()
    {
        $data = [
                    'kodebooking' => $this->input->post('kodebooking')
                ];
        $token = $this->generateToken();
        $headers[] = "x-token:$token";
        $response = $this->ws->setbaseurl('antrean')
                             ->headers($headers)
                             ->data($data)
                             ->post('/bpjs/api/getSisaAntrean');
        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getAmbilAntrean()
    {
        $token = $this->generateToken();
        $headers[] = "X-Token:$token";
        $data = $this->input->post();
        $response = $this->ws->setbaseurl('antrean')
                             ->headers($headers)
                             ->data($data)
                             ->post('/bpjs/api/getAntrean');
        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getStatusAntrean()
    {
        $token = $this->generateToken();
        $headers[] = "X-Token:$token";
        $data = $this->input->post();
        $response = $this->ws->setbaseurl('antrean')
                             ->headers($headers)
                             ->data($data)
                             ->post('/bpjs/api/getStatusAntrean');
        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function batalAntrean()
    {
        $token = $this->generateToken();
        $headers[] = "X-Token:$token";
        $data = $this->input->post();
        $response = $this->ws->setbaseurl('antrean')
                             ->headers($headers)
                             ->data($data)
                             ->post('/bpjs/api/batalAntrean');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function ambilJadwalOperasi()
    {
        $token = $this->generateToken();
        $headers[] = "X-Token:$token";
        $data = $this->input->post();
        $response = $this->ws->setbaseurl('antrean')
                             ->headers($headers)
                             ->data($data)
                             ->post('/bpjs/api/insert_jadwal_operasi');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getJadwalOperasi()
    {
        $token = $this->generateToken();
        $headers[] = "X-Token:$token";
        $data = $this->input->post();
        $response = $this->ws->setbaseurl('antrean')
                             ->headers($headers)
                             ->data($data)
                             ->post('/bpjs/api/jadwal_operasi');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getJadwalOperasiPasien()
    {
        $token = $this->generateToken();
        $headers[] = "X-Token:$token";
        $data = $this->input->post();
        $response = $this->ws->setbaseurl('antrean')
                             ->headers($headers)
                             ->data($data)
                             ->post('/bpjs/api/jadwal_operasi_by_peserta');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function createPasienBaru()
    {
        $token = $this->generateToken();
        $headers[] = "X-Token:$token";
        $data = $this->input->post();
        $response = $this->ws->setbaseurl('antrean')
                             ->headers($headers)
                             ->data($data)
                             ->post('/bpjs/api/pasien_baru');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }
}
