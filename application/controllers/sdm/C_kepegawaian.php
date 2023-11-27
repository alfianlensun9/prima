<?php

class C_kepegawaian extends CI_Controller
{
	public $tokenAuth = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZF9hdXRoX3VzZXJzIjoyLCJmdWxsX25hbWUiOiJBbGZpYW4gUiBMZW5zdW4iLCJyb2xlcyI6W10sInVzZXJfYWdlbnQiOiJVRzl6ZEcxaGJsSjFiblJwYldVdk55NHlPUzR3IiwiaWF0IjoxNjQ5MjkxODE0fQ.jRTIH_MYR1xFKS_YV6lpGWAnMSOgEDgyWIolVNxMDTk";

	function __construct()
	{
		parent::__construct();
		$allowedAccess = ['1', '3'];
		$this->load->model('sdm/M_kepegawaian', 'sdm');
		$this->load->model('master/M_master', 'mst');
		$this->middleware->canAccessBy($need_return = 0, $allowedAccess);
	}

	public function viewListPegawai()
	{
		$listPeagawai = $this->sdm->getListPegawai();
		$data["listPegawai"] = $listPeagawai;
		render('sdm/kepegawaian/v_list_pegawai', $data, 'sdm');
	}

	public function viewAddPegawai()
	{
		$data['listKategoriPegawai'] = $this->mst->getListKategoriPegawai();
		$data['listJenisPegawai'] = $this->mst->getListJenisPegawai();
		$data['listGolonganPegawai'] = $this->mst->getListGolonganPegawai();
		$data['listUnit'] = $this->mst->getListUnit();
		render('sdm/kepegawaian/v_pegawai', $data, 'sdm');
	}

	public function viewEditPegawai($idPegawai)
	{
		if (!$idPegawai) {
			redirect("sdm/C_kepegawaian/viewListPegawai");
		}

		$data['listJenisPegawai'] = $this->mst->getListJenisPegawai();
		$data['listGolonganPegawai'] = $this->mst->getListGolonganPegawai();
		$data['listUnit'] = $this->mst->getListUnit();
		$pegawai = $this->sdm->getPegawaiByID($idPegawai);
		$data['pegawai'] = $pegawai;

		$this->ws->setToken($this->tokenAuth);

		$responseSkedule = $this->ws->setbaseurl('absen')
			->get("/master/schedule");
		$jsonSkedule = json_decode(json_encode($responseSkedule));
		$data['jamKerja'] =  $jsonSkedule->data;

		$wsListJadwal = new Ws();
		$id_auth_users = $pegawai['msg']->id_auth_users;
		$responseJadwal = $wsListJadwal->setbaseurl('absen')
			->get("/schedule/user/list?id_auth_users={$id_auth_users}");
		$jsonJadwal = json_decode(json_encode($responseJadwal));
		$data['listJadwal'] =  $jsonJadwal->data;
		$data['idKepegawaian'] =  $idPegawai;
		// dd($data['listJadwal']);

		render('sdm/kepegawaian/v_edit_pegawai', $data, 'sdm');
	}

	public function createPegawai()
	{
		$pegawai = [
			"nm_pegawai" => $this->input->post("nm_pegawai"),
			"nip" => $this->input->post("nip"),
			"jenis_kelamin" => $this->input->post("jenis_kelamin"),
			"email" => $this->input->post("email"),
			"tempat_lahir" => $this->input->post("tempat_lahir"),
			"password" => $this->input->post("password"),
			"id_user_inputer" => $this->input->post("id_user_inputer"),
			"id_mst_jenis_pegawai" => $this->input->post("id_mst_jenis_pegawai"),
			"id_mst_kategori" => $this->input->post("id_mst_kategori"),
			"id_mst_golongan" => $this->input->post("id_mst_golongan"),
			"id_mst_unit" => $this->input->post("id_mst_unit"),
			"gaji_pokok" => $this->input->post("gaji_pokok"),
			"no_tlp" => $this->input->post("no_tlp"),
			"ptkp" => $this->input->post("ptkp"),
			"nrk" => $this->input->post("nrk"),
			"tmt" => $this->input->post("tmt"),
			"no_str" => $this->input->post("no_str"),
			"exp_str" => $this->input->post("exp_str"),
			"no_sip" => $this->input->post("no_sip"),
			"exp_sip" => $this->input->post("exp_sip"),
		];

		$id = $this->sdm->createPegawai($pegawai);
		// dd($id);

		if ($id) {
			$this->ws->setToken($this->tokenAuth);
			// Create auth
			$response = $this->ws->setbaseurl('auth')
				->data([
					"no_hp" => $this->input->post("no_tlp"),
					"password" => $this->input->post("password"),
					"email" => $this->input->post("email"),
					"full_name" => $this->input->post("nm_pegawai"),
					"id_trx_kepegawaian" => $id
				])
				->showStatusCode()
				->post("/auth/users");
			$json = json_decode(json_encode($response));

			if ($json->statusCode === 201) {
				$this->session->set_flashdata('msg', 'Pegawai berhasil dibuat');
				redirect("sdm/C_kepegawaian/viewListPegawai");
			} else {

				$removePegawai = $this->sdm->deletePegawai($id);
				$this->session->set_flashdata('msg', 'Pegawai gagal dibuat, user auth sudah pernah terdaftar');
				redirect("sdm/C_kepegawaian/viewListPegawai");
			}
		} else {
			$this->session->set_flashdata('msg', 'Pegawai gagal dibuat, nomor telepon/email sudah pernah terdaftar');
			redirect("sdm/C_kepegawaian/viewListPegawai");
		}
	}

	public function updatePegawai()
	{
		$pegawai = [
			"id_trx_kepegawaian" => $this->input->post("id_trx_kepegawaian"),
			"nm_pegawai" => $this->input->post("nm_pegawai"),
			"nip" => $this->input->post("nip"),
			"jenis_kelamin" => $this->input->post("jenis_kelamin"),
			"email" => $this->input->post("email"),
			"tempat_lahir" => $this->input->post("tempat_lahir"),
			// "password" => $this->input->post("password"),
			"id_user_inputer" => $this->input->post("id_user_inputer"),
			"id_mst_jenis_pegawai" => $this->input->post("id_mst_jenis_pegawai"),
			"id_mst_kategori" => $this->input->post("id_mst_kategori"),
			"id_mst_golongan" => $this->input->post("id_mst_golongan"),
			"id_mst_unit" => $this->input->post("id_mst_unit"),
			"gaji_pokok" => $this->input->post("gaji_pokok"),
			"no_tlp" => $this->input->post("no_tlp"),
			"ptkp" => $this->input->post("ptkp"),
			"nrk" => $this->input->post("nrk"),
			"tmt" => $this->input->post("tmt"),
			"no_str" => $this->input->post("no_str"),
			"exp_str" => $this->input->post("exp_str"),
			"no_sip" => $this->input->post("no_sip"),
			"exp_sip" => $this->input->post("exp_sip"),
		];
		$id = $this->sdm->updatePegawai($pegawai);
		if ($id) {
			$this->session->set_flashdata('msg', 'Pegawai berhasil diupdate');
			redirect("sdm/C_kepegawaian/viewListPegawai");
		} else {
			$this->session->set_flashdata('msg', 'Pegawai gagal diupdate');
			redirect("sdm/C_kepegawaian/viewListPegawai");
		}
	}

	public function createJadwalPegawai()
	{
		$this->ws->setToken($this->tokenAuth);
		$response = $this->ws->setbaseurl('absen')
			->data([
				"id_mst_jam_kerja" => $this->input->post("id_mst_jam_kerja"),
				"tanggal_awal" => $this->input->post("tanggal_awal"),
				"tanggal_akhir" => $this->input->post("tanggal_akhir"),
				"id_auth_users" => $this->input->post("id_auth_users"),
			])
			->showStatusCode()
			->post("/schedule");

		$json = json_decode(json_encode($response));

		if ($json->statusCode === 201) {
			$this->session->set_flashdata('msg', 'Jadwal berhasil dibuat');
			redirect("sdm/C_kepegawaian/viewEditPegawai/{$this->input->post('id_trx_kepegawaian')}");
		} else {
			$this->session->set_flashdata('msg', "Create jadwal: " . $json->data->info->msg);
			redirect("sdm/C_kepegawaian/viewEditPegawai/{$this->input->post('id_trx_kepegawaian')}");
		}
	}

	public function updateJadwalPegawai()
	{
	}

	public function deletePegawai($id)
	{
		$this->ws->setToken($this->tokenAuth);
		$response = $this->ws->setbaseurl('auth')
			->delete("/auth/users/{$id}");

		$json = json_decode(json_encode($response));

		if ($json->statusCode === 201) {
			$this->session->set_flashdata('msg', 'Jadwal berhasil dibuat');
			redirect("sdm/C_kepegawaian/viewListPegawai");
		} else {
			$this->session->set_flashdata('msg', "Create jadwal: " . $json->data->info->msg);
			redirect("sdm/C_kepegawaian/viewListPegawai");
		}
	}
}
