<?php


class C_sep extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $allowedAccess = ['1', '3'];
        $this->middleware->canAccessBy($need_return = 0, $allowedAccess);
        $this->load->model('bpjs/M_sep');
    }

    public function index()
    {
        $data['allsep'] =  $this->M_sep->allSEP();
        $data['all_pengajuan'] =  $this->M_sep->allPengajuanSEP();
        render('bpjs/v_sep', $data, 'bpjs');
    }

    public function create()
    {
        if ($this->input->post('tujuan_kunjungan') == 0) {
            $flag_procedure = "";
            $kd_penunjang = "";
            $assesmentPel = "";
        } else {
            $flag_procedure = $this->input->post('flag_procedure');
            $kd_penunjang = $this->input->post('kd_penunjang');
            $assesmentPel =  $this->input->post('assesmentPel');
        }


        $body_request = '{
                    "request": {
                        "t_sep": {
                            "noKartu": "' . $this->input->post('no_kartu')  . '",
                            "tglSep":  "' . $this->input->post('tgl_pendaftaran')  . '",
                            "ppkPelayanan":  "' . PPK_PELAYANAN_BPJS  . '",
                            "jnsPelayanan":  "' . $this->input->post('jnsPelayanan')  . '",
                            "klsRawat": {
                                "klsRawatHak":  "' . $this->input->post('klsRawatHak')  . '",
                                "klsRawatNaik": "' . $this->input->post('klsRawatNaik')  . '",
                                "pembiayaan":  "' . $this->input->post('pembiayaan')  . '",
                                "penanggungJawab": "' . $this->input->post('penanggungJawab')  . '"
                            },
                            "noMR":  "' . $this->input->post('noMR')  . '",
                            "rujukan": {
                                "asalRujukan":  "' . $this->input->post('asalRujukan')  . '",
                                "tglRujukan":  "' . $this->input->post('tglRujukan')  . '",
                                "noRujukan":  "' . $this->input->post('noRujukan')  . '",
                                "ppkRujukan": "' . $this->input->post('ppkRujukan')  . '"
                            },
                            "catatan": "' . $this->input->post('catatan')  . '",
                            "diagAwal":  "' . $this->input->post('diagAwal')  . '",
                            "poli": {
                                "tujuan": "' . $this->input->post('tujuan')  . '",
                                "eksekutif":  "' . $this->input->post('poli_eksekutif')  . '"
                            },
                            "cob": {
                                "cob":  "' . $this->input->post('cob')  . '"
                            },
                            "katarak": {
                                "katarak":  "' . $this->input->post('katarak')  . '"
                            },
                            "jaminan": {
                                "lakaLantas": "' . $this->input->post('lakaLantas')  . '",
                                "penjamin": {
                                    "tglKejadian":  "' . $this->input->post('tglKejadian')  . '",
                                    "keterangan":  "' . $this->input->post('keterangan')  . '",
                                    "suplesi": {
                                        "suplesi":  "' . $this->input->post('suplesi')  . '",
                                        "noSepSuplesi":  "' . $this->input->post('noSepSuplesi')  . '",
                                        "lokasiLaka": {
                                            "kdPropinsi":  "' . $this->input->post('kdPropinsi')  . '",
                                            "kdKabupaten":  "' . $this->input->post('kdKabupaten')  . '",
                                            "kdKecamatan":  "' . $this->input->post('kdKecamatan')  . '"
                                        }
                                    }
                                }
                            },
                            "tujuanKunj":  "' . $this->input->post('tujuanKunj')  . '",
                            "flagProcedure":  "' . $flag_procedure  . '",
                            "kdPenunjang":  "' . $kd_penunjang  . '",
                            "assesmentPel":  "' . $assesmentPel  . '",
                            "skdp": {
                                "noSurat":  "' . $this->input->post('no_surat_kontrol')  . '",
                                "kodeDPJP":  "' . $this->input->post('kodeDPJP')  . '"
                            },
                            "dpjpLayan":  "' . $this->input->post('dpjpLayan')  . '",
                            "noTelp":  "' . $this->input->post('noTelp')  . '",
                            "user": "UAT"
                        }
                    }
                }';



        $response = $this->ws->setbaseurl('bpjs')
            ->data($body_request, $uat = 1)
            ->post("/bpjs/v2/sep/uat", $uat = 1);

        if ($response['msg']['response']['metaData']['code'] == 200) {

            $data_insert = [
                'no_sep' => $response['msg']['response']['response']['sep']['noSep'],
                'no_rujukan' => $response['msg']['response']['response']['sep']['noRujukan'],
                'no_kartu' => $response['msg']['response']['response']['sep']['peserta']['noKartu'],
                'nm_peserta' => $response['msg']['response']['response']['sep']['peserta']['nama'],
                'tgl_pendaftaran' => $response['msg']['response']['response']['sep']['tglSep'],
                'jenis_pelayanan' => $response['msg']['response']['response']['sep']['jnsPelayanan'],
            ];

            $this->M_sep->createSEPUAT($data_insert);
        }



        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function update()
    {
        if ($this->input->post('tujuan_kunjungan') == 0) {
            $flag_procedure = "";
            $kd_penunjang = "";
            $assesmentPel = "";
        } else {
            $flag_procedure = $this->input->post('flag_procedure');
            $kd_penunjang = $this->input->post('kd_penunjang');
            $assesmentPel =  $this->input->post('assesmentPel');
        }


        $body_request = '{
            "request": {
                "t_sep": {
                    "noSep": "' . $this->input->post('noSep')  . '",
                    "klsRawat": {
                        "klsRawatHak": "' . $this->input->post('no_kartu')  . '",
                        "klsRawatNaik": "' . $this->input->post('klsRawatNaik')  . '",
                        "pembiayaan": "' . $this->input->post('pembiayaan')  . '",
                        "penanggungJawab": "' . $this->input->post('penanggungJawab')  . '"
                    },
                    "noMR": "' . $this->input->post('noMR')  . '",
                    "catatan": "' . $this->input->post('catatan')  . '",
                    "diagAwal": "' . $this->input->post('diagAwal')  . '",
                    "poli": {
                        "tujuan": "' . $this->input->post('tujuan')  . '",
                        "eksekutif": "' . $this->input->post('poli_eksekutif')  . '"
                    },
                    "cob": {
                        "cob": "' . $this->input->post('cob')  . '"
                    },
                    "katarak": {
                        "katarak": "' . $this->input->post('katarak')  . '"
                    },
                    "jaminan": {
                        "lakaLantas": "' . $this->input->post('lakaLantas')  . '",
                        "penjamin": {
                            "tglKejadian": "' . $this->input->post('tglKejadian')  . '",
                            "keterangan": "' . $this->input->post('keterangan')  . '",
                            "suplesi": {
                                "suplesi": "' . $this->input->post('suplesi')  . '",
                                "noSepSuplesi": "' . $this->input->post('noSepSuplesi')  . '",
                                "lokasiLaka": {
                                    "kdPropinsi": "' . $this->input->post('kdPropinsi')  . '",
                                    "kdKabupaten": "' . $this->input->post('kdKabupaten')  . '",
                                    "kdKecamatan": "' . $this->input->post('kdKecamatan')  . '"
                                }
                            }
                        }
                    },
                    "dpjpLayan": "' . $this->input->post('dpjpLayan')  . '",
                    "noTelp": "' . $this->input->post('noTelp')  . '",
                    "user": "USER UAT"
                }
            }
        }';



        $response = $this->ws->setbaseurl('bpjs')
            ->data($body_request, $uat = 1)
            ->patch("/bpjs/v2/sep/uat", $uat = 1);

        // if ($response['msg']['response']['metaData']['code'] == 200) {

        //     $data_insert = [
        //         'no_sep' => $response['msg']['response']['response']['sep']['noSep'],
        //         'no_rujukan' => $response['msg']['response']['response']['sep']['noRujukan'],
        //         'no_kartu' => $response['msg']['response']['response']['sep']['peserta']['noKartu'],
        //         'nm_peserta' => $response['msg']['response']['response']['sep']['peserta']['nama'],
        //         'tgl_pendaftaran' => $response['msg']['response']['response']['sep']['tglSep'],
        //         'jenis_pelayanan' => $response['msg']['response']['response']['sep']['jnsPelayanan'],
        //     ];

        //     $this->M_sep->createSEPUAT($data_insert);
        // }



        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function delete()
    {
        $body_request = [
            "no_sep" => $this->input->post('no_sep'),
            "id_user_inputer" => "UAT",
        ];
        $response = $this->ws->setbaseurl('bpjs')
            ->data($body_request)
            ->delete("/bpjs/v2/sep");


        if ($response['msg']['metaData']['code'] == 200) {
            $this->M_sep->deleteSEPUAT($this->input->post('no_sep'));
        }


        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function deleteInternal()
    {
        $body_request = [
            "no_sep" => $this->input->post('no_sep'),
            "no_surat" => $this->input->post('no_surat'),
            "tgl_rujukan" => $this->input->post('tgl_rujukan'),
            "poli_tujuan" => $this->input->post('poli_tujuan'),
            "id_user_inputer" => "UAT",
        ];
        $response = $this->ws->setbaseurl('bpjs')
            ->data($body_request)
            ->delete("/bpjs/v2/sep");


        if ($response['msg']['metaData']['code'] == 200) {
            $this->M_sep->deleteSEPUAT($this->input->post('no_sep'));
        }


        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function updatePulang()
    {
        $body_request = [
            "no_sep" => $this->input->post('no_sep'),
            "status_pulang" => $this->input->post('status_pulang'),
            "no_surat_meninggal" => $this->input->post('no_surat_meninggal'),
            "tgl_meninggal" => $this->input->post('tgl_meninggal'),
            "tgl_pulang" => $this->input->post('tgl_pulang'),
            "no_lpmanual" => $this->input->post('no_lpmanual'),
            "nama_user" => "INI USER UAT",
        ];
        $response = $this->ws->setbaseurl('bpjs')
            ->data($body_request)
            ->patch("/bpjs/v2/sep/tanggal-pulang");




        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function pengajuanSEP()
    {
        $body_request = [
            "no_kartu" => $this->input->post('no_kartu'),
            "tgl_sep" => $this->input->post('tgl_sep'),
            "jenis_pelayanan" => $this->input->post('jenis_pelayanan'),
            "jenis_pengajuan" => $this->input->post('jenis_pengajuan'),
            "keterangan" => $this->input->post('keterangan'),
            "id_user_inputer" => "INI USER UAT",
        ];
        $response = $this->ws->setbaseurl('bpjs')
            ->data($body_request)
            ->post("/bpjs/sep/pengajuan");


        if ($response['msg']['metaData']['code'] == 200) {
            $this->M_sep->createPengajuanSEP($body_request);
        }


        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function approvePengajuan()
    {
        $body_request = [
            "no_kartu" => $this->input->post('no_kartu'),
            "tgl_sep" => $this->input->post('tgl_sep'),
            "jenis_pelayanan" => $this->input->post('jenis_pelayanan'),
            "jenis_pengajuan" => $this->input->post('jenis_pengajuan'),
            "keterangan" => $this->input->post('keterangan'),
            "id_user_inputer" => "INI USER UAT",
        ];
        $response = $this->ws->setbaseurl('bpjs')
            ->data($body_request)
            ->post("/bpjs/sep/aproval-pengajuan");


        if ($response['msg']['metaData']['code'] == 200) {
            $this->M_sep->updatePengajuanSEP($body_request);
        }


        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function find()
    {
        $no_sep = $this->input->post('no_sep');
        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/sep/' . $no_sep);

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function findInternal()
    {
        $no_sep = $this->input->post('no_sep');
        $response = $this->ws->setbaseurl('bpjs')
            ->get('/bpjs/v2/sep/internal/' . $no_sep);

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function monitoring()
    {
        $tgl_sep = $this->input->post('tgl_sep');
        $jenis_pelayanan = $this->input->post('jenis_pelayanan');
        $response = $this->ws->setbaseurl('bpjs')
            ->get("/bpjs/v2/monitoring/kunjungan/pelayanan/$jenis_pelayanan?tanggal=$tgl_sep");

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }

    public function getFinger()
    {
        $tanggal = $this->input->post('tanggal');
        $nokartu = $this->input->post('nokartu');
        $response = $this->ws->setbaseurl('bpjs')
            ->get("/bpjs/sep/fingerprint?tanggal=$tanggal&nokartu=$nokartu");

        $encoded = json_encode($response);
        $this->output->set_output($encoded);
    }
}
