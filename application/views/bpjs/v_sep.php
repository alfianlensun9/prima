<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="<?= base_url('bpjs/C_nav') ?>">BPJS</a></li>
                <li class="breadcrumb-item active" aria-current="page">SEP</li>
            </ol>
        </nav>
    </div>

</div>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
            Create </a>
    </li>
    <li class="nav-item">
        <a class="nav-link ml-2" id="pills-home-tab" data-toggle="pill" href="#update_sep" role="tab" aria-controls="pills-home" aria-selected="true">
            Update </a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link " data-toggle="pill" href="#delete_sep" role="tab" aria-controls="delete_sep" aria-selected="true">
            Delete </a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link " data-toggle="pill" href="#delete_sep_internal" role="tab" aria-controls="delete_sep" aria-selected="true">
            Delete Internal</a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link " data-toggle="pill" href="#update_pulang" role="tab" aria-controls="delete_sep" aria-selected="true">
            Pulang </a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link " data-toggle="pill" href="#pengajuan_sep" role="tab" aria-controls="delete_sep" aria-selected="true">
            Pengajuan </a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link " data-toggle="pill" href="#approval_sep" role="tab" aria-controls="delete_sep" aria-selected="true">
            Approval </a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link " data-toggle="pill" href="#cari_sep" role="tab" aria-controls="delete_sep" aria-selected="true">
            Cari SEP </a>
    </li>

    <li class="nav-item ml-2">
        <a class="nav-link " data-toggle="pill" href="#all_sep" role="tab" aria-controls="delete_sep" aria-selected="true">
            All SEP </a>
    </li>

    <li class="nav-item ml-2">
        <a class="nav-link " data-toggle="pill" href="#monitoring_sep" role="tab">
            Monitoring </a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link " data-toggle="pill" href="#finger_print" role="tab">
            Finger </a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" aria-labelledby="pills-home-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_sep/create') ?>" id="form_create_sep">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Jenis Pelayanan</label>
                            <select name="jnsPelayanan" class="form-control" id="jenis_layanan">
                                <option value="2">Rawat Jalan</option>
                                <option value="1">Rawat Inap</option>

                            </select>
                        </div>

                        <script>
                            $("#jenis_layanan").change(function() {
                                const jenis = $(this).val()
                                if (jenis == 1) {
                                    $("#noRujukan").val("")
                                    $("#ppkRujukan").val("0461R001")
                                    $("#poli_tujuan").val("")
                                }
                            })
                        </script>

                        <div class="form-group col-md-3">
                            <label for="inputPassword4">Tanggal Pendaftaran</label>
                            <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl_pendaftaran">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPassword4">No RM</label>
                            <input type="text" class="form-control" value="001001001" name="noMR">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputPassword4">No Kartu</label>
                            <input type="text" class="form-control" value="0002064475326" name="no_kartu" id="no_kartu">
                        </div>
                        <div class=" form-group col-md-1">
                            <label for="inputPassword4">&nbsp;</label><br>
                            <button type="button" id="cari_rujukan" class="btn btn-sm btn-secondary"><i class="fa fa-search"></i></button>
                        </div>




                        <script>
                            $("#cari_rujukan").click(function(e) {
                                $(this).html('<i class="fa fa-spin fa-spinner"></i>')
                                const no_kartu = $("#no_kartu").val();
                                const faskes = 1
                                const datasubmit = {
                                    nokartu: no_kartu,
                                    faskes: faskes
                                }
                                const urlsubmit = '<?= site_url('bpjs/C_rujukan/getRujukan') ?>'

                                $.post(urlsubmit, datasubmit, function(cb) {
                                    const response = JSON.parse(cb)
                                    // console.log(response)
                                    $("#cari_rujukan").html('<i class="fa  fa-search"></i>')

                                    if (response.status == undefined) {
                                        if (response.msg.metaData.code != 200) {
                                            alert(response.msg.metaData.message)
                                        } else {
                                            const rujukan = response.msg.response.rujukan
                                            // console.log(response.msg.response.rujukan)
                                            $("#noRujukan").val(rujukan.noKunjungan)
                                            $("#tglRujukan").val(rujukan.tglKunjungan)
                                            $("#ppkRujukan").val(rujukan.provPerujuk.kode)
                                            $("#klsRawatHak").val(rujukan.peserta.hakKelas.kode)
                                            $("#diagAwal").val(rujukan.diagnosa.kode)
                                            $("#noTelp").val(rujukan.peserta.mr.noTelepon)

                                            $("#poli_tujuan").val(rujukan.poliRujukan.kode)
                                            $("#kd_spesialis_dpjp").val(rujukan.poliRujukan.kode)

                                            $("#jenis_pelayanan_dpjp").val(rujukan.pelayanan.kode)
                                            $(".btn_cri_dokter").show()
                                        }
                                    } else {
                                        alert(response.status.message)
                                    }

                                })
                            })
                        </script>


                        <!--===== RUJUKAN ======-->
                        <div class="form-group col-md-3">
                            <label for="inputPassword4">No Rujukan</label>
                            <input type="text" class="form-control" name="noRujukan" id="noRujukan">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputPassword4">Tgl Rujukan</label>
                            <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tglRujukan" id="tglRujukan">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputPassword4">Asal Rujukan</label>
                            <select name="asalRujukan" class="form-control">
                                <option value="1">Faskes 1</option>
                                <option value="2">Faskes 2 (RS)</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputPassword4">PPK Rujukan</label>
                            <input type="text" class="form-control" value="" name="ppkRujukan" id="ppkRujukan">
                        </div>
                        <!--===== RUJUKAN ======-->

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Kelas Rawat</label>
                            <select name="klsRawatHak" class="form-control" id="klsRawatHak">
                                <option value="1">Kelas 1</option>
                                <option value="2">Kelas 2</option>
                                <option value="3">Kelas 3</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Kelas Rawat Naik</label>
                            <select name="klsRawatNaik" class="form-control">
                                <option value="">-</option>
                                <option value="1">VVIP</option>
                                <option value="2">VIP</option>
                                <option value="3">Kelas 1</option>
                                <option value="4">Kelas 3</option>
                                <option value="5">Kelas 4</option>
                                <option value="6">ICCU</option>
                                <option value="7">ICU</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Pembiayaan</label>
                            <select name="pembiayaan" class="form-control">
                                <option value="">-</option>
                                <option value="1">Pribadi</option>
                                <option value="2">Pemberi Kerja</option>
                                <option value="3">Asuransi Kesehatan Tambahan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Penanggung Jawab</label>
                            <select name="penanggungJawab" class="form-control">
                                <option value="">-</option>
                                <option value="1">Pribadi</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputEmail4">COB</label>
                            <select name="cob" class="form-control">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>

                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Katarak</label>
                            <select name="katarak" class="form-control">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Lakalantas</label>
                            <select name="lakaLantas" class="form-control" id="select_lakalantas">
                                <option value="0">Bukan Kecelakaan lalu lintas</option>
                                <option value="1">KLL dan bukan kecelakaan Kerja</option>
                                <option value="2">KLL dan KK</option>
                                <option value="3">KK</option>
                            </select>
                        </div>

                        <script>
                            $("#select_lakalantas").change(function() {
                                const laka = $(this).val()
                                if (laka == 1) {
                                    $(".cl_kll").show()
                                } else {
                                    $(".cl_kll").hide()
                                }
                            })
                        </script>
                        <style>
                            .cl_kll {
                                display: none;
                            }
                        </style>

                        <div class="form-group col-md-3 cl_kll">
                            <label for="inputPassword4">Tanggal Lakalantas</label>
                            <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tglKejadian">
                        </div>
                        <div class="form-group col-md-3 cl_kll">
                            <label for="inputPassword4">Ket. Lakalantas</label>
                            <input type="text" class="form-control" value="" name="keterangan">
                        </div>
                        <div class="form-group col-md-3 cl_kll">
                            <label for="inputEmail4">Suplesi</label>
                            <select name="suplesi" class="form-control">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 cl_kll">
                            <label for="inputPassword4">No Suplesi</label>
                            <input type="text" class="form-control" value="" name="noSepSuplesi">
                        </div>

                        <div class="form-group col-md-4 cl_kll">
                            <label for="inputPassword4">Propinsi</label>
                            <input type="text" class="form-control" value="" name="kdPropinsi">
                        </div>
                        <div class="form-group col-md-4 cl_kll">
                            <label for="inputPassword4">Kabupaten</label>
                            <input type="text" class="form-control" value="" name="kdKabupaten">
                        </div>
                        <div class="form-group col-md-4 cl_kll">
                            <label for="inputPassword4">Kecamatan</label>
                            <input type="text" class="form-control" value="" name="kdKecamatan">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Catatan</label>
                            <input type="text" class="form-control" value="" name="catatan">
                        </div>


                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Poli</label>
                            <input type="text" class="form-control" value="INT" name="tujuan" id="poli_tujuan">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Eksekutif</label>
                            <select name="poli_eksekutif" class="form-control">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputPassword4">Kode Dokter</label>
                            <input type="text" class="form-control" id="dpjpLayan" name="dpjpLayan">
                        </div>
                        <div class=" form-group col-md-1">
                            <label for="inputPassword4">&nbsp;</label><br>
                            <button type="button" class="btn btn-sm btn-secondary btn_cri_dokter" style="display: none;" data-toggle="modal" data-target="#modalDokter"><i class="fa fa-users"></i></button>
                        </div>


                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Tujuan Kunjungan</label>
                            <select name="tujuanKunj" class="form-control">
                                <option value="0">Normal</option>
                                <option value="1">Prosedur</option>
                                <option value="2">Konsul</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Prosedur</label>
                            <select name="flagProcedure" class="form-control">
                                <option value="0">Prosedur Tidak Berkelanjutan</option>
                                <option value="1">Prosedur dan Terapi Berkelanjutan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Penunjang</label>
                            <select name="kdPenunjang" class="form-control">
                                <option value="1">Prosedur dan Terapi Berkelanjutan Radioterapi</option>
                                <option value="2">Kemoterapi</option>
                                <option value="3">Rehabilitasi Medik</option>
                                <option value="4">Rehabilitasi Psikososial</option>
                                <option value="5">Transfusi Darah</option>
                                <option value="6">Pelayanan Gigi</option>
                                <option value="7">Laboratorium</option>
                                <option value="8">USG</option>
                                <option value="9">Farmasi</option>
                                <option value="10">Lain-Lain</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Assesment</label>
                            <select name="assesmentPel" class="form-control">
                                <option value="1">Poli spesialis tidak tersedia pada hari sebelumnya</option>
                                <option value="2">Jam Poli telah berakhir pada hari sebelumnya</option>
                                <option value="3">Dokter Spesialis yang dimaksud tidak praktek pada hari sebelumnya</option>
                                <option value="4">Atas Instruksi RS</option>
                                <option value="5">Tujuan Kontrol</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputPassword4">Diagnosa Awal</label>
                            <input type="text" class="form-control" value="Z00" name="diagAwal" id="diagAwal">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputPassword4">No. Surat Kontrol</label>
                            <input type="text" class="form-control" value="" name="no_surat_kontrol">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputPassword4">DPJP Kontrol</label>
                            <input type="text" class="form-control" name="kodeDPJP">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputPassword4">No. Telp</label>
                            <input type="text" class="form-control" name="noTelp" id="noTelp" value="0811112">
                        </div>


                        <div class="form-group col-md-12">
                            <label for="inputPassword4">&nbsp;</label>
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_sep">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade show " id="update_sep">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_sep/update') ?>" id="form_update_sep">
                    <div class="form-row">


                        <div class="form-group col-md-11">
                            <label for="inputPassword4">No SEP</label>
                            <input type="text" class="form-control" value="0461R0010322V000014" name="noSep" id="upd_sep">
                        </div>

                        <div class=" form-group col-md-1">
                            <label for="inputPassword4">&nbsp;</label><br>
                            <button type="button" id="cari_sep_for_update" class="btn btn-sm btn-secondary"><i class="fa fa-search"></i></button>
                        </div>

                        <script>
                            $("#cari_sep_for_update").click(function() {
                                $("#cari_sep_for_update").html('<i class="fa fa-spin fa-spinner"></i>')


                                const url = '<?= site_url('bpjs/C_sep/find') ?>'
                                const body = {
                                    no_sep: $("#upd_sep").val()
                                }
                                if ($("#upd_sep").val() != "") {
                                    $.post(url, body, function(cb) {
                                        $("#cari_sep_for_update").html('<i class="fa fa-search"></i>')
                                        const response = JSON.parse(cb)
                                        console.log(response)
                                        if (response.msg.metaData.code == 201) {
                                            alert(response.msg.metaData.message)
                                        } else if (response.msg.metaData.code != 200) {
                                            alert(response.msg.metaData.code)
                                        } else {
                                            const bpjsResp = response.msg.response
                                            $("#upd_klsrawat").val(bpjsResp.klsRawat.klsRawatHak)
                                            $("#upd_klsNaik").val(bpjsResp.klsRawat.klsRawatNaik)
                                            $("#upd_klsPembiayaan").val(bpjsResp.klsRawat.pembiayaan)
                                            $("#upd_klsPJ").val(bpjsResp.klsRawat.penanggungJawab)

                                            $("#upd_cob").val(bpjsResp.cob)
                                            $("#upd_katarak").val(bpjsResp.katarak)
                                            $("#upd_laka").val(bpjsResp.kdStatusKecelakaan)
                                            $("#upd_catatan").val(bpjsResp.catatan)

                                            $("#upd_nomr").val(bpjsResp.peserta.noMr)
                                            $("#upd_diagnosa").val(bpjsResp.diagnosa)

                                            $("#upd_dpjpLayan").val(bpjsResp.dpjp.kdDPJP)

                                            $("#upd_poli").val(bpjsResp.poli)
                                            $("#upd_eksekutif").val(bpjsResp.poliEksekutif)





                                        }

                                    })
                                } else {
                                    $("#cari_sep_for_update").html('<i class="fa fa-search"></i>')
                                    alert("Data Tidak Ditemukan")
                                }

                            })
                        </script>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Kelas Rawat</label>
                            <select name="klsRawatHak" class="form-control" id="upd_klsrawat">
                                <option value="1">Kelas 1</option>
                                <option value="2">Kelas 2</option>
                                <option value="3">Kelas 3</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Kelas Rawat Naik</label>
                            <select name="klsRawatNaik" class="form-control" id="upd_klsNaik">
                                <option value="">-</option>
                                <option value="1">VVIP</option>
                                <option value="2">VIP</option>
                                <option value="3">Kelas 1</option>
                                <option value="4">Kelas 3</option>
                                <option value="5">Kelas 4</option>
                                <option value="6">ICCU</option>
                                <option value="7">ICU</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Pembiayaan</label>
                            <select name="pembiayaan" class="form-control" id="upd_klsPembiayaan">
                                <option value="">-</option>
                                <option value="1">Pribadi</option>
                                <option value="2">Pemberi Kerja</option>
                                <option value="3">Asuransi Kesehatan Tambahan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Penanggung Jawab</label>
                            <select name="penanggungJawab" class="form-control" id="upd_klsPJ">
                                <option value="">-</option>
                                <option value="1">Pribadi</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputEmail4">COB</label>
                            <select name="cob" class="form-control" id="upd_cob">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>

                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Katarak</label>
                            <select name="katarak" class="form-control" id="upd_katarak">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Lakalantas</label>
                            <select name="lakaLantas" class="form-control isLaka" id="upd_laka">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>

                        <script>
                            $(".isLaka").change(function() {
                                const laka = $(this).val()
                                if (laka == 1) {
                                    $(".cl_kll").show()
                                } else {
                                    $(".cl_kll").hide()
                                }
                            })
                        </script>

                        <div class="form-group col-md-3 cl_kll">
                            <label for="inputPassword4">Tanggal Lakalantas</label>
                            <input type="date" class="form-control" value="" name="tglKejadian">
                        </div>
                        <div class="form-group col-md-3 cl_kll">
                            <label for="inputPassword4">Ket. Lakalantas</label>
                            <input type="text" class="form-control" value="" name="keterangan">
                        </div>
                        <div class="form-group col-md-3 cl_kll">
                            <label for="inputEmail4">Suplesi</label>
                            <select name="suplesi" class="form-control">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 cl_kll">
                            <label for="inputPassword4">No Suplesi</label>
                            <input type="text" class="form-control" value="" name="noSepSuplesi">
                        </div>

                        <div class="form-group col-md-4 cl_kll">
                            <label for="inputPassword4">Propinsi</label>
                            <input type="text" class="form-control" value="" name="kdPropinsi">
                        </div>
                        <div class="form-group col-md-4 cl_kll">
                            <label for="inputPassword4">Kabupaten</label>
                            <input type="text" class="form-control" value="" name="kdKabupaten">
                        </div>
                        <div class="form-group col-md-4 cl_kll">
                            <label for="inputPassword4">Kecamatan</label>
                            <input type="text" class="form-control" value="" name="kdKecamatan">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Catatan</label>
                            <input type="text" class="form-control" id="upd_catatan" name="catatan">
                        </div>


                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Poli</label>
                            <input type="text" class="form-control" value="INT" name="tujuan" id="upd_poli">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Eksekutif</label>
                            <select name="poli_eksekutif" class="form-control" id="upd_eksekutif">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Kode Dokter</label>
                            <input type="text" class="form-control" name="dpjpLayan" id="upd_dpjpLayan">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputPassword4">Diagnosa Awal</label>
                            <input type="text" class="form-control" value="Z00" name="diagAwal" id="upd_diagnosa">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">No RM</label>
                            <input type="text" class="form-control" value="001001001" name="noMR" id="upd_nomr">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputPassword4">No. Telp</label>
                            <input type="text" class="form-control" name="noTelp" value="0811112" id="upd_tlp">
                        </div>


                        <div class="form-group col-md-12">
                            <label for="inputPassword4">&nbsp;</label>
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_sep">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="delete_sep">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_sep/delete') ?>" id="form_delete_sep">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">NO SEP</label>
                            <input type="text" class="form-control" name="no_sep" value="">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputPassword4">&nbsp;</label>
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_delete_sep">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <script>
            $("#form_delete_sep").submit(function(e) {
                e.preventDefault()
                $(".btn_delete_sep").hide()
                $("#loader").show()
                $("#err_msg").html("");
                $("#div_result").hide()

                // alert("test")
                const datasubmit = $(this).serialize()
                const urlsubmit = $(this).attr('action')
                $.post(urlsubmit, datasubmit, function(cb) {
                    $(".btn_delete_sep").show()
                    $("#loader").hide()
                    $("#div_result").show()
                    const response = JSON.parse(cb)
                    // console.log(response)

                    if (response.status != undefined) {
                        if (response.status.code == 200) {
                            succcessMessage(response.status.message)
                        } else {
                            failedMessage(response.status.message)
                        }


                    } else {
                        const bpjs_response = response.msg.metaData
                        if (bpjs_response.code == 200) {
                            succcessMessage(bpjs_response.message)
                        } else {
                            failedMessage(bpjs_response.message)
                        }
                    }




                })
            })
        </script>

    </div>

    <div class="tab-pane fade" id="delete_sep_internal">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_sep/deleteInternal') ?>" id="form_delete_sep_internal">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">NO SEP</label>
                            <input type="text" class="form-control" name="no_sep" value="">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">NO Surat</label>
                            <input type="text" class="form-control" name="no_surat" value="">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Tgl Rujukan</label>
                            <input type="text" class="form-control" name="tgl_rujukan" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Poli Tujuan</label>
                            <input type="text" class="form-control" name="poli_tujuan" value="">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputPassword4">&nbsp;</label>
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_delete_sep">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <script>
            $("#form_delete_sep_internal").submit(function(e) {
                e.preventDefault()
                $(".btn_delete_sep").hide()
                $("#loader").show()
                $("#err_msg").html("");
                $("#div_result").hide()

                // alert("test")
                const datasubmit = $(this).serialize()
                const urlsubmit = $(this).attr('action')
                $.post(urlsubmit, datasubmit, function(cb) {
                    $(".btn_delete_sep").show()
                    $("#loader").hide()
                    $("#div_result").show()
                    const response = JSON.parse(cb)
                    // console.log(response)

                    if (response.status != undefined) {
                        if (response.status.code == 200) {
                            succcessMessage(response.status.message)
                        } else {
                            failedMessage(response.status.message)
                        }


                    } else {
                        const bpjs_response = response.msg.metaData
                        if (bpjs_response.code == 200) {
                            succcessMessage(bpjs_response.message)
                        } else {
                            failedMessage(bpjs_response.message)
                        }
                    }




                })
            })
        </script>

    </div>

    <div class="tab-pane fade" id="update_pulang">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_sep/updatePulang') ?>" id="form_update_pulang_sep">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">NO SEP</label>
                            <input type="text" class="form-control" name="no_sep" value="" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Tgl Pulang</label>
                            <input type="date" class="form-control" name="tgl_pulang" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Status Pulang</label>
                            <select name="status_pulang" class="form-control" id="status_pulang">
                                <option value="1">Atas Persetujuan Dokter</option>
                                <option value="3">Atas Permintaan Sendiri</option>
                                <option value="4">Meninggal</option>
                                <option value="5">Lain-lain</option>

                            </select>
                        </div>

                        <script>
                            $("#status_pulang").change(function() {
                                const status = $(this).val()
                                if (status == 4) {
                                    $(".div_meninggal").show()
                                } else {
                                    $(".div_meninggal").hide()
                                }
                            })
                        </script>



                        <div class="form-group col-lg-4 div_meninggal" style="display:none">
                            <label for="inputEmail4">Tgl Meninggal</label>
                            <input type="date" class="form-control" name="tgl_meninggal" value="">
                        </div>
                        <div class="form-group col-lg-4 div_meninggal" style="display:none">
                            <label for="inputEmail4">NO Surat Meninggal</label>
                            <input type="text" class="form-control" name="no_surat_meninggal" value="">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="inputEmail4">NO LP Manual</label>
                            <input type="text" class="form-control" name="no_lpmanual" value="">
                        </div>


                        <div class="form-group col-md-12">
                            <label for="inputPassword4">&nbsp;</label>
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_delete_sep">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <script>
            $("#form_update_pulang_sep").submit(function(e) {
                e.preventDefault()
                $(".btn_delete_sep").hide()
                $("#loader").show()
                $("#err_msg").html("");
                $("#div_result").hide()

                // alert("test")
                const datasubmit = $(this).serialize()
                const urlsubmit = $(this).attr('action')
                $.post(urlsubmit, datasubmit, function(cb) {
                    $(".btn_delete_sep").show()
                    $("#loader").hide()
                    $("#div_result").show()
                    const response = JSON.parse(cb)
                    // console.log(response)

                    if (response.status != undefined) {
                        if (response.status.code == 200) {
                            succcessMessage(response.status.message)
                        } else {
                            failedMessage(response.status.message)
                        }


                    } else {
                        const bpjs_response = response.msg.metaData
                        if (bpjs_response.code == 200) {
                            succcessMessage(bpjs_response.message)
                        } else {
                            failedMessage(bpjs_response.message)
                        }
                    }




                })
            })
        </script>

    </div>

    <div class="tab-pane fade" id="pengajuan_sep">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_sep/pengajuanSEP') ?>" id="form_pengajuan_sep">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">No Kartu</label>
                            <input type="text" class="form-control" name="no_kartu" value="" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Tgl SEP</label>
                            <input type="date" class="form-control" name="tgl_sep" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Jenis Pelayanan</label>
                            <select name="jenis_pelayanan" class="form-control">
                                <option value="1">Rawat Inap</option>
                                <option value="2">Rawat Jalan</option>

                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Jenis Pengajuan</label>
                            <select name="jenis_pengajuan" class="form-control">
                                <option value="1">Pengajuan Backdate</option>
                                <option value="2">Pengajuan Finger Print</option>

                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">&nbsp;</label>
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_delete_sep">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <script>
            $("#form_pengajuan_sep").submit(function(e) {
                e.preventDefault()
                $(".btn_delete_sep").hide()
                $("#loader").show()
                $("#err_msg").html("");
                $("#div_result").hide()

                // alert("test")
                const datasubmit = $(this).serialize()
                const urlsubmit = $(this).attr('action')
                $.post(urlsubmit, datasubmit, function(cb) {
                    $(".btn_delete_sep").show()
                    $("#loader").hide()
                    $("#div_result").show()
                    const response = JSON.parse(cb)
                    console.log(response)

                    if (response.status != undefined) {
                        if (response.status.code == 200) {
                            succcessMessage(response.status.message)
                        } else {
                            failedMessage(response.status.message)
                        }


                    } else {
                        const bpjs_response = response.msg.metaData
                        if (bpjs_response.code == 200) {
                            succcessMessage(response.msg.response)
                        } else {
                            failedMessage(bpjs_response.message)
                        }
                    }




                })
            })
        </script>

    </div>

    <div class="tab-pane fade" id="approval_sep">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>No Kartu</th>
                        <th>Tgl SEP</th>
                        <th>Jenis Pelayanan</th>
                        <th>Keterangan</th>
                        <th>Approval</th>
                        <th>Opsi</th>
                    </thead>
                    <tbody>
                        <?php foreach ($all_pengajuan as $item) { ?>
                            <tr>
                                <td><?= $item->no_kartu ?></td>
                                <td><?= $item->tgl_sep ?></td>
                                <td><?= ($item->jenis_pelayanan == 1) ? "R. Inap" : "R. Jalan" ?></td>
                                <td><?= $item->keterangan ?></td>
                                <td><?= ($item->flag_approval == 1) ? "Approved" : "Pending" ?></td>
                                <td><button class="btn btn-sm btn-secondary approve_this" data-id="<?= $item->id ?>" data-no_kartu="<?= $item->no_kartu ?>" data-tgl_sep="<?= $item->tgl_sep ?>" data-jenis_pelayanan="<?= $item->jenis_pelayanan ?>" data-jenis_pengajuan="<?= $item->jenis_pengajuan ?>" data-keterangan="<?= $item->keterangan ?>">Approve <i class="fa fa-check"></i></button></td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>

            </div>
        </div>

        <script>
            $(".approve_this").click(function() {

                $(".btn_delete_sep").hide()
                $("#loader").show()
                $("#err_msg").html("");
                $("#div_result").hide()

                // alert("test")
                const datasubmit = {
                    id: $(this).data("id"),
                    no_kartu: $(this).data("no_kartu"),
                    tgl_sep: $(this).data("tgl_sep"),
                    jenis_pelayanan: $(this).data("jenis_pelayanan"),
                    jenis_pengajuan: $(this).data("jenis_pengajuan"),
                    keterangan: $(this).data("keterangan"),
                }

                const urlsubmit = '<?= site_url('bpjs/C_sep/approvePengajuan') ?>'
                $.post(urlsubmit, datasubmit, function(cb) {
                    $(".btn_delete_sep").show()
                    $("#loader").hide()
                    $("#div_result").show()
                    const response = JSON.parse(cb)
                    console.log(response)

                    if (response.status != undefined) {
                        if (response.status.code == 200) {
                            succcessMessage(response.status.message)
                        } else {
                            failedMessage(response.status.message)
                        }


                    } else {
                        const bpjs_response = response.msg.metaData
                        if (bpjs_response.code == 200) {
                            succcessMessage(response.msg.response)
                        } else {
                            failedMessage(bpjs_response.message)
                        }
                    }




                })



            })
        </script>



    </div>

    <div class="tab-pane fade" id="cari_sep">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_sep/find') ?>" id="form_find_sep">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="inputEmail4">NO SEP</label>
                            <input type="text" class="form-control" name="no_sep" value="0461R0010322V000014" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Internal</label>
                            <select name="status_internal" id="status_internal" class="form-control">
                                <option value="1">Tidak</option>
                                <option value="2">Ya</option>

                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputPassword4">&nbsp;</label>
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_find_sep">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <script>
            $("#status_internal").change(function() {
                const status = $(this).val()
                if (status == 2) {
                    $('#form_find_sep').attr('action', '<?= site_url('bpjs/C_sep/findInternal') ?>');
                } else {
                    $('#form_find_sep').attr('action', '<?= site_url('bpjs/C_sep/find') ?>');
                }
            })


            $("#form_find_sep").submit(function(e) {
                e.preventDefault()
                $(".btn_find_sep").hide()
                $("#loader").show()
                $("#err_msg").html("");
                $("#div_result").hide()

                // alert("test")
                const datasubmit = $(this).serialize()
                const urlsubmit = $(this).attr('action')
                $.post(urlsubmit, datasubmit, function(cb) {
                    $(".btn_find_sep").show()
                    $("#loader").hide()
                    $("#div_result").show()
                    const response = JSON.parse(cb)
                    console.log(response)

                    if (response.status != undefined) {
                        if (response.status.code == 200) {
                            succcessMessage("")
                        } else {
                            failedMessage(response.status.message)
                        }


                    } else {
                        const bpjs_response = response.msg.metaData
                        if (bpjs_response.code == 200) {
                            $("#hasil_kepesertaan").show()
                            succcessMessage()

                            const sep = response.msg.response
                            const peserta = response.msg.response.peserta

                            $("#noKartu").html(peserta.noKartu)
                            $("#nama").html(peserta.nama)
                            $("#hakKelas").html(peserta.hakKelas)
                            $("#tglLahir").html(peserta.tglLahir)
                            $("#jnsPeserta").html(peserta.jnsPeserta)


                            $("#noSep").html(sep.noSep)
                            $("#noRujukanFind").html(sep.noRujukan)
                            $("#tglSep").html(sep.tglSep)
                            $("#jnsPelayanan").html(sep.jnsPelayanan)
                            $("#poli").html(sep.poli)
                            $("#diagnosa").html(sep.diagnosa)
                            $("#nmDPJP").html(sep.dpjp.nmDPJP)


                        } else if (bpjs_response.code == 201) {
                            failedMessage(bpjs_response.message)
                        } else {
                            failedMessage(bpjs_response.code)
                        }
                    }




                })
            })
        </script>

    </div>

    <div class="tab-pane fade" id="all_sep">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>No SEP</th>
                        <th>Tgl Pendaftaran</th>
                        <th>No Kartu</th>
                        <th>No Rujukan</th>
                        <th>Nama Peserta</th>
                        <th>Jenis Pelayanan</th>
                        <th>Opsi</th>
                    </thead>
                    <tbody>
                        <?php foreach ($allsep as $item) { ?>
                            <tr>
                                <td><?= $item->no_sep ?></td>
                                <td><?= $item->tgl_pendaftaran ?></td>
                                <td><?= $item->no_kartu ?></td>
                                <td><?= $item->no_rujukan ?></td>
                                <td><?= $item->nm_peserta ?></td>
                                <td><?= $item->jenis_pelayanan ?></td>
                                <td><button class="btn btn-sm btn-primary"><i class="fa fa-print"></i></button></td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>

            </div>
        </div>



    </div>

    <div class="tab-pane fade" id="monitoring_sep">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_sep/monitoring') ?>" id="form_monitoring_sep">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="inputEmail4">Tgl SEP</label>
                            <input type="date" class="form-control" name="tgl_sep" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Jenis Pelayanan</label>
                            <select name="jenis_pelayanan" class="form-control">
                                <option value="1">Rawat Inap</option>
                                <option value="2">Rawat Jalan</option>

                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputPassword4">&nbsp;</label>
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_find_sep">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <script>
            $("#form_monitoring_sep").submit(function(e) {
                e.preventDefault()
                $(".btn_find_sep").hide()
                $("#loader").show()
                $("#err_msg").html("");
                $("#div_result").hide()
                $('#tbl_monitoring tbody').empty();

                // alert("test")
                const datasubmit = $(this).serialize()
                const urlsubmit = $(this).attr('action')
                $.post(urlsubmit, datasubmit, function(cb) {
                    $(".btn_find_sep").show()
                    $("#loader").hide()
                    $("#div_result").show()
                    const response_monitoring = JSON.parse(cb)
                    console.log(response_monitoring)

                    if (response_monitoring.status != undefined) {
                        if (response_monitoring.status.code == 200) {
                            succcessMessage("")
                        } else {
                            failedMessage(response_monitoring.status.message)
                        }


                    } else {
                        const bpjs_response = response_monitoring.msg.metaData
                        if (bpjs_response.code == 200) {
                            $("#hasil_monitoring").show()
                            succcessMessage()

                            const list = response_monitoring.msg.response.sep
                            $.each(list, function(i, l) {
                                $("#tbl_monitoring").find('tbody').append(`<tr><td>${list[i].noSep}</td><td>${list[i].noKartu}</td><td>${list[i].nama}</td><td>${list[i].kelasRawat}</td><td>${list[i].tglSep}</td><td>${list[i].jnsPelayanan}</td><td>${list[i].poli}</td><td>${list[i].diagnosa}</td></tr>`);

                            });

                        } else if (bpjs_response.code == 201) {
                            failedMessage(bpjs_response.message)
                        } else {
                            failedMessage(bpjs_response.code)
                        }
                    }




                })
            })
        </script>

    </div>

    <div class="tab-pane fade" id="finger_print">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_sep/getFinger') ?>" id="form_finger_sep">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Tgl Pelayanan</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">No. Kartu</label>
                            <input type="text" class="form-control" name="nokartu" value="0002064475326" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputPassword4">&nbsp;</label>
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_find_sep">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <script>
            $("#form_finger_sep").submit(function(e) {
                e.preventDefault()
                $(".btn_find_sep").hide()
                $("#loader").show()
                $("#err_msg").html("");
                $("#div_result").hide()

                // alert("test")
                const datasubmit = $(this).serialize()
                const urlsubmit = $(this).attr('action')
                $.post(urlsubmit, datasubmit, function(cb) {
                    $(".btn_find_sep").show()
                    $("#loader").hide()
                    $("#div_result").show()
                    const response_monitoring = JSON.parse(cb)
                    console.log(response_monitoring)

                    if (response_monitoring.status != undefined) {
                        if (response_monitoring.status.code == 200) {
                            succcessMessage("")
                        } else {
                            failedMessage(response_monitoring.status.message)
                        }


                    } else {
                        const bpjs_response = response_monitoring.msg.metaData
                        if (bpjs_response.code == 200) {
                            succcessMessage(response_monitoring.msg.response.status)



                        } else if (bpjs_response.code == 201) {
                            failedMessage(bpjs_response.message)
                        } else {
                            failedMessage(bpjs_response.code)
                        }
                    }




                })
            })
        </script>

    </div>

</div>



<div class="row">
    <div class="col-lg-12" id="loader" style="display: none;">
        <?php $this->load->view('v_loader'); ?>
    </div>
    <div class="col-lg-12" id="div_result" style="display: none;">
        <div class="card">
            <div class="card-body">
                <span class="badge" id="response_title">

                </span>
                <p id="err_msg"></p>

                <div id="hasil_kepesertaan" style="display: none;">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item"> <strong>No Kartu :</strong>
                                    <div id="noKartu"></div>
                                </li>

                                <li class="list-group-item"> <strong>Nama</strong> : <div id="nama"></div>
                                </li>
                                <li class="list-group-item"> <strong>Hak Kelas :</strong>
                                    <div id="hakKelas"></div>
                                </li>
                                <li class="list-group-item"> <strong>Tanggal Lahir :</strong>
                                    <div id="tglLahir"></div>
                                </li>

                                <li class="list-group-item"> <strong>Jenis Peserta :</strong>
                                    <div id="jnsPeserta"></div>
                                </li>



                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item"> <strong>No SEP :</strong>
                                    <div id="noSep"></div>
                                </li>
                                <li class="list-group-item"> <strong>No Rujukan :</strong>
                                    <div id="noRujukanFind"></div>
                                </li>
                                <li class="list-group-item"> <strong>Tgl SEP. :</strong>
                                    <div id="tglSep"></div>
                                </li>
                                <li class="list-group-item"> <strong>Jenis Pelayanan :</strong>
                                    <div id="jnsPelayanan"></div>
                                </li>
                                <li class="list-group-item"> <strong>Poli :</strong>
                                    <div id="poli"></div>
                                </li>
                                <li class="list-group-item"> <strong>Diagnosa. :</strong>
                                    <div id="diagnosa"></div>
                                </li>
                                <li class="list-group-item"> <strong>DPJP :</strong>
                                    <div id="nmDPJP"></div>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>

                <div id="hasil_monitoring" style="display: none;">
                    <table class="table" id="tbl_monitoring">
                        <thead>
                            <th>No Sep</th>
                            <th>No Kartu</th>
                            <th>Nama</th>
                            <th>Kelas Rawat</th>
                            <th>Tgl Sep</th>
                            <th>Jenis Pelayanan</th>
                            <th>Poli</th>
                            <th>Diagnosa</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modalDokter" tabindex="-1" role="dialog" aria-labelledby="modalDokterLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDokterLabel">Cari Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefDpjp') ?>" id="form_dpjp">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Jenis Pelayanan</label>
                            <select class="form-control" name="jenis_pelayanan" id="jenis_pelayanan_dpjp">
                                <option value="1" selected>Rawat Inap</option>
                                <option value="2">Rawat Jalan</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Tanggal Pelayanan</label>
                            <input type="date" class="form-control" name="tgl_pel" value="<?= date("Y-m-d") ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Kode Spesialis / Subspesialis</label>
                            <input type="text" class="form-control" name="kd_spesialis" id="kd_spesialis_dpjp">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_dpjp"> <i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footerx">

                <div class="row">
                    <div class="col-lg-12" id="div_result_dpjp" style="display: none;">
                        <div class="card">
                            <div class="card-body">
                                <span class="badge" id="response_title_dpjp"></span>
                                <p id="err_msg"></p>
                                <hr>
                                <div id="result_data">
                                    <table class="table" id="dpjp_tab">
                                        <thead>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Opsi</th>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <p id="hasil_dpjp"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $("#form_dpjp").submit(function(e) {
        e.preventDefault()
        $(".btn_submit_dpjp").html('<i class="fa fa-spin fa-spinner"></i>')
        $("#err_msg").html("");
        $("#div_result_dpjp").hide()
        $('#dpjp_tab tbody').empty();


        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function(cb) {
            $(".btn_submit_dpjp").html('<i class="fa fa-search"></i>')
            $("#div_result_dpjp").show()
            const resp_dpjp = JSON.parse(cb)
            $("#hasil_dpjp").html("");


            if (resp_dpjp.msg.metaData.code == 200) {
                $("#response_title_dpjp").addClass("badge-success");
                $("#response_title_dpjp").removeClass("badge-danger");
                $("#response_title_dpjp").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()


                const dpjp = resp_dpjp.msg.response.list
                $.each(dpjp, function(i, l) {
                    $("#dpjp_tab").find('tbody').append(`<tr><td>${dpjp[i].kode}</td><td>${dpjp[i].nama}</td><td><button class='btn btn-sm btn-secondary select_dpjp' kddpjp='${dpjp[i].kode}' > <i class="fa fa-hand-pointer"></i></button></td></tr>`);

                });

                $(".select_dpjp").click(function() {
                    const kd_dpjp = $(this).attr('kddpjp')
                    $("#dpjpLayan").val(kd_dpjp)
                    $('#modalDokter').modal('toggle');

                })

            } else {
                $("#response_title_dpjp").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title_dpjp").addClass("badge-danger");
                $("#response_title_dpjp").removeClass("badge-success");

                $("#err_msg").html(resp_dpjp.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })
</script>

<script>
    $(".nav-link").click(function() {
        $("#err_msg").html("");
        $("#div_result").hide()
        $("#loader").hide()
        $("#hasil_kepesertaan").hide()
        $("#hasil_monitoring").hide()
    })

    $("#form_update_sep").submit(function(e) {
        e.preventDefault()
        $(".btn_submit_sep").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()


        // alert("test")
        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function(cb) {
            $(".btn_submit_sep").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            // console.log(response)

            if (response.status != undefined) {
                if (response.status.code == 200) {
                    succcessMessage(response.status.message)
                } else {
                    failedMessage(response.status.message)
                }


            } else {
                const bpjs_response = response.msg.response
                if (bpjs_response.metaData.code == 200) {
                    succcessMessage(bpjs_response.response.sep.noSep)
                } else {
                    failedMessage(bpjs_response.metaData.message)
                }
            }




        })
    })

    $("#form_create_sep").submit(function(e) {
        e.preventDefault()
        $(".btn_submit_sep").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()


        // alert("test")
        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function(cb) {
            $(".btn_submit_sep").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            // console.log(response)

            if (response.status != undefined) {
                if (response.status.code == 200) {
                    succcessMessage(response.status.message)
                } else {
                    failedMessage(response.status.message)
                }


            } else {
                const bpjs_response = response.msg.response
                if (bpjs_response.metaData.code == 200) {
                    succcessMessage(bpjs_response.response.sep.noSep)
                } else {
                    failedMessage(bpjs_response.metaData.message)
                }
            }




        })
    })

    function succcessMessage(msg) {
        $("#response_title").addClass("badge-success");
        $("#response_title").removeClass("badge-danger");
        $("#response_title").html("Sukses <i class='fa fa-check '></i>");
        $("#err_msg").html(msg);
    }

    function failedMessage(msg) {
        $("#response_title").html("Gagal <i class='fa fa-times '></i>");
        $("#response_title").addClass("badge-danger");
        $("#response_title").removeClass("badge-success");

        $("#err_msg").html(msg);
        $("#hasil_kepesertaan").hide()
    }
</script>