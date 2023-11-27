<?php

class C_absensi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $allowedAccess = ['1', '3'];
        $this->load->model('sdm/M_kepegawaian', 'sdm');
        $this->middleware->canAccessBy($need_return = 0, $allowedAccess);
    }

    public function refreshToken()
    {
        $jenis_absensi = $this->ws
            ->setToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZF9hdXRoX3VzZXJzIjoyLCJmdWxsX25hbWUiOiJBbGZpYW4gUiBMZW5zdW4iLCJyb2xlcyI6W10sInVzZXJfYWdlbnQiOiJVRzl6ZEcxaGJsSjFiblJwYldVdk55NHlPUzR3IiwiaWF0IjoxNjQ5Mzc5MTg2fQ.m50w7SftspY4ynPVuUS-XKexAA7Ep8MrPSMc5wkIal8');
        redirect('welcome');
    }

    public function index()
    {
        $listPeagawai = $this->sdm->getListPegawai();
        $jenis_absensi = $this->ws
            ->setbaseurl('aevy')
            ->get("/master/jenis_absensi");


        if (isset($jenis_absensi['error']['type'])) {
            refreshToken();
            redirect('sdm/C_absensi');
        }

        $data_absen = array_filter($jenis_absensi['data'], function ($item) {
            return $item['id_mst_jenis_absensi'] != 1;
        });


        $data["listPegawai"] = $listPeagawai;
        $data["listJenisAbsen"] = $data_absen;
        render('sdm/absensi/v_list_pegawai', $data, 'sdm');
    }

    public function monitoringAbsensi()
    {

        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $id_user = $this->input->post('id_user');

        $sdm = $this->sdm->getIDAuthByIDKepegawaian($id_user);
        $id_auth_users = $sdm->id_auth_users;

        $response = $this->ws
            ->setbaseurl('aevy')
            ->get("/attendance/user/report?tanggal_awal=$tgl_awal&tanggal_akhir=$tgl_akhir&id_auth_users=$id_auth_users");

        $encoded = json_encode($response);


        $data["list_absensi"] = $encoded;
        $data["id_auth_users"] = $id_auth_users;
        $this->load->view('sdm/absensi/v_ajax_absen', $data, 'sdm');
    }

    public function absensiManual()
    {
        $sdm = $this->sdm->getIDAuthByIDKepegawaian($this->input->post('id_pegawai'));
        $kepegawaian = $sdm;

        $awal = strtotime($this->input->post('tgl_awal')); // or your date as well
        $akhir = strtotime($this->input->post('tgl_akhir'));
        $datediff = $akhir - $awal;
        $jml_hari = round($datediff / (60 * 60 * 24));

        if ($jml_hari >= 1 && $jml_hari < 361) {
            $begin = new DateTime($this->input->post('tgl_awal'));
            $end = new DateTime($this->input->post('tgl_akhir'));

            for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
                echo

                $body = [
                    'id_mst_jenis_absensi' => $this->input->post('id_mst_jenis_absensi'),
                    'id_auth_users' => $this->input->post('id_pegawai'),
                    'nama_pegawai' => $kepegawaian->nm_pegawai,
                    'client_datetime' => date('Y-m-d H:i:s'),
                    'server_datetime' => $i->format("Y-m-d H:i:s"),
                    'id_trx_jadwal_kerja' => null,
                    'id_mst_jam_kerja' => null,
                    'absen_type' => 0,
                    'id_mst_unit_kerja' => $kepegawaian->id_mst_unit
                ];
                $response = $this->ws->setbaseurl('aevy')
                    ->data($body, $uat = 1)
                    ->post("/attendance/manual");
            }
        } else if ($jml_hari == 0) {

            $body = [
                'id_mst_jenis_absensi' => $this->input->post('id_mst_jenis_absensi'),
                'id_auth_users' => $this->input->post('id_pegawai'),
                'nama_pegawai' => $kepegawaian->nm_pegawai,
                'client_datetime' => date('Y-m-d H:i:s'),
                'server_datetime' => $this->input->post('tgl_akhir'),
                'id_trx_jadwal_kerja' => null,
                'id_mst_jam_kerja' => null,
                'absen_type' => 0,
                'id_mst_unit_kerja' => $kepegawaian->id_mst_unit
            ];
            $response = $this->ws->setbaseurl('aevy')
                ->data($body, $uat = 1)
                ->post("/attendance/manual");
        } else {
            echo "Format Tanggal Tidak Sesuai";
        }

        $tgl_awal = formatYmd($this->input->post('tgl_awal'));
        $tgl_akhir = formatYmd($this->input->post('tgl_akhir'));

        redirect("sdm/C_absensi/getAbsenManualById/" . $this->input->post('id_pegawai') . "/" . $tgl_awal . "/" . $tgl_akhir);
    }

    public function getAbsenManualById($id_user = 0, $tgl_awal = 0, $tgl_akhir = 0)
    {
        if ($tgl_awal == 0) {
            $tgl_awal = date("Y-m-d");
            $tgl_akhir = date("Y-m-d");
        } else {
            $tgl_awal = $tgl_awal;
            $tgl_akhir = $tgl_akhir;
        }

        $tgl_awal_submit = $this->input->post('tgl_awal') ? $this->input->post('tgl_awal') : $tgl_awal;
        $tgl_akhir_submit = $this->input->post('tgl_akhir') ? $this->input->post('tgl_akhir') : $tgl_akhir;
        $id_user = $this->input->post('id_user') ? $this->input->post('id_user') : $id_user;

        $jenis_absensi = $this->ws
            ->setbaseurl('aevy')
            ->get("/master/jenis_absensi");
        $data["listJenisAbsen"] = $jenis_absensi['data'];

        $response = $this->ws
            ->setbaseurl('aevy')
            ->get("/attendance/manual?tanggal_awal=$tgl_awal_submit&tanggal_akhir=$tgl_akhir_submit&id_auth_users=$id_user");

        $encoded = json_encode($response);
        $data["list_absensi"] = $encoded;
        $data["id_user"] = $id_user;
        $data["tgl_awal"] = $tgl_awal_submit;
        $data["tgl_akhir"] = $tgl_akhir_submit;

        $this->load->view('sdm/absensi/v_ajax_absen_manual', $data, 'sdm');
    }

    public function deleteAbsensiManual()
    {
        $id_trx_absensi = $this->input->post('id');
        $body = [
            'deleted_by' => $this->session->userdata['auth_users']['fullname']
        ];

        $response = $this->ws
            ->setbaseurl('aevy')
            ->data($body)
            ->delete("/attendance/manual/$id_trx_absensi");
        dd($id_trx_absensi);
    }
}
