<?php


class C_master extends CI_Controller
{

    public $tokenAuth = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZF9hdXRoX3VzZXJzIjoyLCJmdWxsX25hbWUiOiJBbGZpYW4gUiBMZW5zdW4iLCJyb2xlcyI6W10sInVzZXJfYWdlbnQiOiJVRzl6ZEcxaGJsSjFiblJwYldVdk55NHlPUzR3IiwiaWF0IjoxNjQ5MjkxODE0fQ.jRTIH_MYR1xFKS_YV6lpGWAnMSOgEDgyWIolVNxMDTk";

    function __construct()
    {
        parent::__construct();
        $this->load->model('master/M_master', 'mst');
    }

    public function getMasterAlkesSelectize()
    {
        $result = $this->mst->searchAlkes();
        $finalResult = array_map(function ($item) {
            return [
                'id' => $item['id'],
                'text' => $item['nama_alat_kesehatan'], // as label
                'label' => $item['nama_alat_kesehatan'], // as label
            ];
        }, $result);
        echo json_encode($finalResult);
    }

    public function createMasterUnit()
    {
        $unit = [
            "nm_mst_unit" => $this->input->post("nm_mst_unit"),
        ];


        $id = $this->mst->createMasterUnit($unit);

        if ($id) {
            $this->session->set_flashdata('msg', 'Unit berhasil dibuat');
            redirect("master/C_master/viewMasterUnit");
        } else {
            $this->session->set_flashdata('msg', 'Unit gagal dibuat');
            redirect("master/C_master/viewMasterUnit");
        }
    }

    public function viewMasterUnit()
    {
        $data['listUnit'] = $this->mst->getListUnit();
        render('master/v_unit', $data, 'master');
    }

    public function viewMasterJamKerja()
    {
        $data['listUnit'] = $this->mst->getListUnit();
        $this->ws->setToken($this->tokenAuth);
        $response = $this->ws->setbaseurl('absen')
            ->get("/master/schedule");
        $json = json_decode(json_encode($response));
        $data['listJamKerja'] =  $json->data;
        // dd($data);
        render('master/v_jam_kerja', $data, 'master');
    }

    public function createMasterJamKerja()
    {
        $response = $this->ws->setbaseurl('absen')
            ->data([
                "nm_mst_jam_kerja" => $this->input->post("nm_mst_jam_kerja"),
                "jam_masuk_terhitung" =>  $this->input->post("jam_masuk_terhitung"),
                "jam_masuk_terlambat" =>  $this->input->post("jam_masuk_terlambat"),
                "jam_masuk" =>  $this->input->post("jam_masuk"),
                "jam_pulang" =>  $this->input->post("jam_pulang"),
                "jam_pulang_terhitung" =>  $this->input->post("jam_pulang_terhitung"),
                "is_default" => 0
            ])
            ->showStatusCode()
            ->post("/master/schedule");
        $json = json_decode(json_encode($response));

        if ($json->statusCode === 201) {
            $this->session->set_flashdata('msg', 'Jam berhasil dibuat');
            redirect("master/C_master/viewMasterJamKerja");
        } else {
            $this->session->set_flashdata('msg', "Create jam kerja: " . $json->data->info->msg);
            redirect("master/C_master/viewMasterJamKerja");
        }
        dd($json);
    }

    public function deleteJamKerja($idJamKerja)
    {
        $response = $this->ws->setbaseurl('absen')
            ->delete("/master/schedule/{$idJamKerja}");

        echo json_encode($response);
    }
}
