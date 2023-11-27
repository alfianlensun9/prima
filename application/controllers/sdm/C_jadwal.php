<?php

class C_jadwal extends CI_Controller
{

	public $tokenAuth = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZF9hdXRoX3VzZXJzIjoyLCJmdWxsX25hbWUiOiJBbGZpYW4gUiBMZW5zdW4iLCJyb2xlcyI6W10sInVzZXJfYWdlbnQiOiJVRzl6ZEcxaGJsSjFiblJwYldVdk55NHlPUzR3IiwiaWF0IjoxNjQ5MjkxODE0fQ.jRTIH_MYR1xFKS_YV6lpGWAnMSOgEDgyWIolVNxMDTk";

	function __construct()
	{
		parent::__construct();
		$allowedAccess = ['1', '3'];
		$this->load->model('sdm/M_kepegawaian', 'sdm');
		$this->load->model('master/M_master', 'master');
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

		$this->ws->setToken($this->tokenAuth);
		$response = $this->ws->setbaseurl('absen')
			->get("/master/schedule");

		$json = json_decode(json_encode($response));
		$data['listPegawai'] = $this->sdm->getListPegawai();
		$data['unitRuangan'] = $this->master->getListUnit();
		$data['jamKerja'] =  $json->data;

		render('sdm/jadwal/v_jadwal', $data, 'sdm');
	}

	public function createJadwal()
	{
		$idUnit = $this->input->post("id_mst_unit");
		$tanggalAwal = $this->input->post("tanggal_awal");
		$tanggalAkhir = $this->input->post("tanggal_akhir");
		$idMstJamKerja = $this->input->post("id_mst_jam_kerja");
		// dd($this->input->post());

		$listIDAuthPegawaiByIDUnit = $this->sdm->getListIDAuthPegawaiByIDUnit($idUnit);
		if (!$listIDAuthPegawaiByIDUnit) {
			$this->session->set_flashdata('msg', 'Tidak ada pegawai dalam unit yang dipilih');
			redirect("sdm/C_jadwal");
		}

		$data['listPegawaiByUnit']  = $listIDAuthPegawaiByIDUnit;

		$this->ws->setToken($this->tokenAuth);

		$statusCode = [];
		foreach ($listIDAuthPegawaiByIDUnit as $idAuth) {
			$response = $this->ws->setbaseurl('absen')
				->data([
					"id_mst_jam_kerja" => $idMstJamKerja,
					"tanggal_awal" => $tanggalAwal,
					"tanggal_akhir" => $tanggalAkhir,
					"id_auth_users" => $idAuth,
				])
				->showStatusCode()
				->post("/schedule");

			$json = json_decode(json_encode($response));
			var_dump($json);
			$statusCode[] = $json->statusCode;
		}

		$this->session->set_flashdata('msg', 'Jadwal berhasil dibuat');
		redirect("sdm/C_jadwal");
		// $totalJadwalProcessed = [
		// 	""
		// ]
		// dd($statusCode);

	}

	public function getTabelJadwalByIDKepegawaian($idKepegawaian)
	{
		$wsListJadwal = new Ws();
		$pegawai = $this->sdm->getPegawaiByID($idKepegawaian);

		if (!$pegawai['status']) {
			echo "Pegawai belum terdafar dalam User Auth";
			return 0;
		}

		$id_auth_users = $pegawai['msg']->id_auth_users;

		$responseJadwal = $wsListJadwal->setbaseurl('absen')
			->get("/schedule/user/list?id_auth_users={$id_auth_users}");
		$jsonJadwal = json_decode(json_encode($responseJadwal));
		$data['listJadwal'] =  $jsonJadwal->data;
		$data['idKepegawaian'] =  $idKepegawaian;

		$this->load->view('sdm/jadwal/v_tbl_jadwal', $data);
	}

	public function createJadwalByIDAuth()
	{
		$tanggalAwal = $this->input->post("tanggal_awal");
		$tanggalAkhir = $this->input->post("tanggal_akhir");
		$idMstJamKerja = $this->input->post("id_mst_jam_kerja");
		$idTrxKepegawaian = $this->input->post("id_trx_kepegawaian");
		$idAuth = $this->sdm->getPegawaiByID($idTrxKepegawaian);

		$response = $this->ws->setbaseurl('absen')
			->data([
				"id_mst_jam_kerja" => $idMstJamKerja,
				"tanggal_awal" => $tanggalAwal,
				"tanggal_akhir" => $tanggalAkhir,
				"id_auth_users" => $idAuth['msg']->id_auth_users,
			])
			->showStatusCode()
			->post("/schedule");

		echo json_encode($response);
	}

	public function deleteJadwal($idJadwal)
	{
		$response = $this->ws->setbaseurl('absen')
			->delete("/schedule/{$idJadwal}");
		echo json_encode($response);
	}
}
