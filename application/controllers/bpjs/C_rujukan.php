<?php

class C_rujukan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$allowedAccess = ['1', '3'];
		$this->middleware->canAccessBy($need_return = 0, $allowedAccess);
	}

	public function index()
	{
		$responseProgramPrb = $this->ws->setbaseurl('bpjs')
			->get('/bpjs/v2/referensi/diagnosa/prb');

		$data['program_prb'] = $responseProgramPrb['msg']['metaData']['code'] == 200 ?  $responseProgramPrb['msg']['response']['list'] : [];

		render('bpjs/v_rujukan', $data, 'rujukan');
	}

	public function getRujukan()
	{
		$tipe_pencarian = $this->input->post("tipe_pencarian");

		$nokartu = $this->input->post("nokartu");
		$norujukan = $this->input->post("norujukan");
		$faskes = $this->input->post("faskes");

		if ($tipe_pencarian == 2) {
			$response = $this->ws->setbaseurl('bpjs')->get("/bpjs/v2/peserta/rujukan/faskes/{$faskes}/norujukan/{$norujukan}");
		} else {
			$response = $this->ws->setbaseurl('bpjs')->get("/bpjs/v2/peserta/rujukan/faskes/{$faskes}/nokartu/{$nokartu}");
		}


		$encoded = json_encode($response);
		$this->output->set_output($encoded);
	}

	public function getRujukanKonsul()
	{
		$nokartu = $this->input->post("nokartu");
		$faskes = $this->input->post("faskes");

		$response = $this->ws->setbaseurl('bpjs')
			->get("/bpjs/v2/peserta/rujukan/konsul/faskes/{$faskes}/nokartu/{$nokartu}");

		$encoded = json_encode($response);
		$this->output->set_output($encoded);
	}

	public function getListRujukan()
	{
		$nokartu = $this->input->post("nokartu");

		$response = $this->ws->setbaseurl('bpjs')
			->get('/bpjs/v2/peserta/rujukan/faskes/2/nokartu/' + $nokartu);

		$encoded = json_encode($response);
		$this->output->set_output($encoded);
	}

	public function createRujukan()
	{
		$data = [
			"tgl_rujukan" => $this->input->post('tgl_rujukan'),
			"tgl_rencana_kunjungan" => $this->input->post('tgl_rencana_kunjungan'),
			"no_sep" => $this->input->post('no_sep'),
			"ppk_dirujuk" => $this->input->post('ppk_dirujuk'),
			"jns_pelayanan" => $this->input->post('jns_pelayanan'),
			"catatan" => $this->input->post('catatan'),
			"diagnosa" => $this->input->post('diagnosa'),
			"tipe_rujukan" => $this->input->post('tipe_rujukan'),
			"poli_rujukan" => $this->input->post('poli_rujukan'),
			"id_user_inputer" => $this->input->post('id_user_inputer')
		];

		$response = $this->ws->setbaseurl('bpjs')
			->data($data)
			->post('/bpjs/v2/rujukan');

		$encoded = json_encode($response);
		$this->output->set_output($encoded);
	}

	public function updateRujukan()
	{
		$data = [
			"tgl_rujukan" => $this->input->post('tgl_rujukan'),
			"tgl_rencana_kunjungan" => $this->input->post('tgl_rencana_kunjungan'),
			"no_sep" => $this->input->post('no_sep'),
			"ppk_dirujuk" => $this->input->post('ppk_dirujuk'),
			"jns_pelayanan" => $this->input->post('jns_pelayanan'),
			"catatan" => $this->input->post('catatan'),
			"diagnosa" => $this->input->post('diagnosa'),
			"tipe_rujukan" => $this->input->post('tipe_rujukan'),
			"poli_rujukan" => $this->input->post('poli_rujukan'),
			"id_user_inputer" => $this->input->post('id_user_inputer')
		];

		$response = $this->ws->setbaseurl('bpjs')
			->data($data)
			->patch('/bpjs/v2/rujukan');

		$encoded = json_encode($response);
		$this->output->set_output($encoded);
	}

	public function deleteRujukan()
	{
		$data = [
			"no_rujukan" => $this->input->post('no_rujukan'),
			"id_user_inputer" => $this->input->post('id_user_inputer')
		];

		$response = $this->ws->setbaseurl('bpjs')
			->data($data)
			->delete('/bpjs/rujukan');

		$encoded = json_encode($response);
		$this->output->set_output($encoded);
	}

	public function createRujukanKhusus()
	{
		$data = [
			"no_rujukan" => $this->input->post('no_rujukan'),
			"diagnosa" => [["kode" => $this->input->post('diagnosa')]],
			"procedure" => [["kode" => $this->input->post('procedure')]],
			"id_user_inputer" => $this->input->post('id_user_inputer')
		];
		// dd($data);

		$response = $this->ws->setbaseurl('bpjs')
			->data($data)
			->post('/bpjs/rujukan/khusus');

		$encoded = json_encode($response);
		$this->output->set_output($encoded);
	}

	public function createRujukanPrb()
	{
		$dataObat = json_decode(base64_decode($this->input->post('table_obat_prb')), true);
		$obat = array_map(function ($item) {
			return [
				'kdObat' => $item['kdObat'],
				'signa1' => $item['signa1'],
				'signa2' => $item['signa2'],
				'jmlObat' => $item['jumlahObat'],
			];
		}, $dataObat ?? []);

		$data = [
			"no_sep" => $this->input->post('no_sep'),
			"no_kartu" => $this->input->post('no_kartu'),
			"alamat" => $this->input->post('alamat'),
			"email" => $this->input->post('email'),
			"program_prb" => $this->input->post('program_prb'),
			"kode_dpjp" => $this->input->post('kode_dpjp'),
			"keterangan" => $this->input->post('keterangan'),
			"saran" => $this->input->post('saran'),
			'id_user_inputer' => $this->session->userdata['auth_users']['id_auth_users'],
			"obat" => $obat
		];

		$response = $this->ws->setbaseurl('bpjs')
			->data($data)
			->post('/bpjs/v2/prb');

		$encoded = json_encode($response);
		$this->output->set_output($encoded);
	}

	public function deleteRujukanKhusus()
	{
		$data = [
			"id_rujukan" => $this->input->post('id_rujukan'),
			"no_rujukan" => $this->input->post('no_rujukan'),
			"id_user_inputer" => $this->input->post('id_user_inputer')
		];

		$response = $this->ws->setbaseurl('bpjs')
			->data($data)
			->delete('/bpjs/rujukan/khusus');

		$encoded = json_encode($response);
		$this->output->set_output($encoded);
	}

	public function getRujukanKhusus()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$response = $this->ws->setbaseurl('bpjs')
			->get("/bpjs/rujukan/khusus?bulan={$bulan}&tahun={$tahun}");

		$encoded = json_encode($response);
		$this->output->set_output($encoded);
	}

	public function getSpesialistikRujukan()
	{
		$response = $this->ws->setbaseurl('bpjs')
			->get('/bpjs/rujukan/spesialistik');

		$encoded = json_encode($response);
		$this->output->set_output($encoded);
	}

	public function getSpesialistikSarana()
	{
		$response = $this->ws->setbaseurl('bpjs')
			->get('/bpjs/rujukan/sarana');

		$encoded = json_encode($response);
		$this->output->set_output($encoded);
	}
}
