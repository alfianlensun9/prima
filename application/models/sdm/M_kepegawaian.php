<?php

class M_kepegawaian extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->sdm = $this->load->database('sdm', TRUE);
		$this->auth = $this->load->database('auth', TRUE);
	}

	public function createPegawai($pegawai)
	{

		$checkPegawai = $this->sdm->select('*')
			->from("trx_kepegawaian")
			->where("deletedAt", null)
			->where("email", $pegawai['email'])
			->or_where("no_tlp", $pegawai['no_tlp'])
			->get()->row();

		// dd($checkPegawai);

		if ($checkPegawai) {
			return false;
		}

		$this->sdm->insert('trx_kepegawaian', $pegawai);

		return $this->sdm->insert_id();
	}

	public function updatePegawai($pegawai)
	{
		$result = $this->sdm->where('id_trx_kepegawaian', $pegawai['id_trx_kepegawaian'])
			->update('trx_kepegawaian', $pegawai);
		return $result;
	}

	public function getListPegawai()
	{
		$this->sdm->select('a.*, b.nm_mst_unit')
			->from("trx_kepegawaian as a")
			->join("mst_unit as b", "b.id_mst_unit = a.id_mst_unit")
			->where("a.deletedAt", null);
		return $this->sdm->get()->result_object();
	}

	public function deletePegawai($idTrxKepegawaian)
	{
		$update = ["deletedAt" => null];
		$result = $this->sdm->where('id_trx_kepegawaian', $idTrxKepegawaian)
			->update('trx_kepegawaian', $update);
		return $result;
	}

	public function getPegawaiByID($idPegawai)
	{

		$this->auth->select('*')
			->from("db_auth.auth_users")
			->where("id_trx_kepegawaian", $idPegawai);
		$authPegawai = $this->auth->get()->row();

		if (!$authPegawai) {
			return ["status" => false, "msg" => "Pegawai belum terdaftar dalam user otentikasi"];
		}

		$this->sdm->select('*')
			->from("trx_kepegawaian")
			->where("id_trx_kepegawaian", $idPegawai);
		$pegawai = $this->sdm->get()->row();

		$pegawai->id_auth_users = $authPegawai->id_auth_users;

		return ["status" => true, "msg" => $pegawai];
	}

	public function getListIDAuthPegawaiByIDUnit($idUnit)
	{

		$this->sdm->select('id_trx_kepegawaian')
			->from("trx_kepegawaian")
			->where("id_mst_unit", $idUnit);
		$listPegawai = $this->sdm->get()->result_array();

		if (!$listPegawai) {
			return false;
		}

		$listIDPegaawai = array_map(function ($pegawai) {
			return $pegawai['id_trx_kepegawaian'];
		}, $listPegawai);

		$this->auth->select('id_auth_users')
			->from("auth_users")
			->where_in("id_trx_kepegawaian", $listIDPegaawai);

		$listPegawaiAuth = $this->auth->get()->result_array();

		$listIDAuthPegawai = array_map(function ($pegawai) {
			return $pegawai['id_auth_users'];
		}, $listPegawaiAuth);

		return $listIDAuthPegawai;
	}

	public function getIDAuthByIDKepegawaian($idKepegawaian)
	{
		$this->auth->select('*')
			->from("db_auth.auth_users")
			->where("id_trx_kepegawaian", $idKepegawaian);
		$authPegawai = $this->auth->get()->row();
		return $authPegawai;
	}
}
