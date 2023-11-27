<?php


class C_referensi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $allowedAccess = ['1', '3'];
        $this->middleware->canAccessBy($need_return = 0, $allowedAccess);
    }

    public function index()
    {
        render('bpjs/v_referensi', $data = [], 'bpjs');
    }

    public function getRefDiagnosa()
    {
        $diagnosa = $this->input->post('diagnosa');
        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/diagnosa?search=' . $diagnosa);

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getRefPoli()
    {
        $poli = $this->input->post('poli');
        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/poli?search=' . $poli);

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getRefFaskes()
    {
        $jenis_faskes = $this->input->post('jenis_faskes');
        $faskes = $this->input->post('faskes');
        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/faskes/' . $jenis_faskes . '?search=' . $faskes);

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getRefDpjp()
    {
        $jenis_pelayanan = $this->input->post('jenis_pelayanan');
        $kd_spesialis = $this->input->post('kd_spesialis');
        $tgl_pel = $this->input->post('tgl_pel');

        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/dokter/pelayanan/' . $jenis_pelayanan . '/spesialis/' . $kd_spesialis . '?tanggal=' . $tgl_pel);

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getRefPropinsi()
    {
        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/provinsi');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getRefKabupaten()
    {
        $propinsi = $this->input->post('propinsi');

        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/kabupaten/provinsi/'. $propinsi);

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getRefKecamatan()
    {
        $kabupaten = $this->input->post('kabupaten');

        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/kecamatan/kabupaten/'. $kabupaten);

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getRefDiagnosaprb()
    {
        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/diagnosa/prb');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getRefObatprb()
    {
        $obat = $this->input->post('obat') ?? $this->input->post('query');
        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/obat/prb?search='.$obat);

        if($this->input->post('query')){
            $res = $response['msg']['metaData']['code'] == 200 ?  $response['msg']['response']['list'] : [];

            $finalResult = array_map(function($item){
                return [
                    'id' => $item['kode'],
                    'text' => $item['nama'],
                    'label' => $item['nama'],
                ];
            }, $res);
            echo json_encode($finalResult);
        }else{
            $encoded = json_encode($response);
            $this->output->set_output($encoded);
        }
        
    }

    public function getRefProcedure()
    {
        $procedure = $this->input->post('procedure');

        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/procedure?search='.$procedure);

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getRefKelasRawat()
    {

        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/kelas-rawat');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getRefDokter()
    {
        $dokter = $this->input->post('dokter');
        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/dokter?search='.$dokter);

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getRefSpesialistik()
    {
        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/spesialistik');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getRefRuangRawat()
    {
        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/ruang-rawat');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getRefCaraKeluar()
    {
        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/cara-keluar');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getRefPascaPulang()
    {
        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/referensi/pasca-pulang');

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }
}
