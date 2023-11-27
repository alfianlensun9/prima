<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="<?= base_url('bpjs/C_nav') ?>">BPJS</a></li>
                <li class="breadcrumb-item active" aria-current="page">PRB</li>
            </ol>
        </nav>
    </div>

</div>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item ml-2 mt-2">
        <a class="nav-link active" id="pills-diagnosa-tab" data-toggle="pill" href="#pills-diagnosa" role="tab"
            aria-controls="pills-diagnosa" aria-selected="true"> Diagnosa</a>
    </li>
    <li class="nav-item ml-2 mt-2">
        <a class="nav-link" id="pills-poli-tab" data-toggle="pill" href="#pills-poli" role="tab"
            aria-controls="pills-poli" aria-selected="false">Poli</a>
    </li>

    <li class="nav-item ml-2 mt-2">
        <a class="nav-link" id="pills-faskes-tab" data-toggle="pill" href="#pills-faskes" role="tab"
            aria-controls="pills-faskes" aria-selected="false">Fasilitas Kesehatan</a>
    </li>

    <li class="nav-item ml-2 mt-2">
        <a class="nav-link" id="pills-dpjp-tab" data-toggle="pill" href="#pills-dpjp" role="tab"
            aria-controls="pills-dpjp" aria-selected="false">Dokter DPJP</a>
    </li>

    <li class="nav-item ml-2 mt-2">
        <a class="nav-link" id="pills-propinsi-tab" data-toggle="pill" href="#pills-propinsi" role="tab"
            aria-controls="pills-propinsi" aria-selected="false">Propinsi</a>
    </li>

    <li class="nav-item ml-2 mt-2">
        <a class="nav-link" id="pills-kabupaten-tab" data-toggle="pill" href="#pills-kabupaten" role="tab"
            aria-controls="pills-kabupaten" aria-selected="false">Kabupaten</a>
    </li>

    <li class="nav-item ml-2 mt-2">
        <a class="nav-link" id="pills-kecamatan-tab" data-toggle="pill" href="#pills-kecamatan" role="tab"
            aria-controls="pills-kecamatan" aria-selected="false">Kecamatan</a>
    </li>

    <li class="nav-item ml-2 mt-2">
        <a class="nav-link" id="pills-diagprb-tab" data-toggle="pill" href="#pills-diagprb" role="tab"
            aria-controls="pills-diagprb" aria-selected="false">Diagnosa PRB</a>
    </li>

    <li class="nav-item ml-2 mt-2">
        <a class="nav-link" id="pills-obatprb-tab" data-toggle="pill" href="#pills-obatprb" role="tab"
            aria-controls="pills-obatprb" aria-selected="false">Obat PRB</a>
    </li>

    <li class="nav-item ml-2 mt-2">
        <a class="nav-link" id="pills-procedure-tab" data-toggle="pill" href="#pills-procedure" role="tab"
            aria-controls="pills-procedure" aria-selected="false">Procedure</a>
    </li>

    <li class="nav-item ml-2 mt-2">
        <a class="nav-link" id="pills-kelasrawat-tab" data-toggle="pill" href="#pills-kelasrawat" role="tab"
            aria-controls="pills-kelasrawat" aria-selected="false">Kelas Rawat</a>
    </li>

    <li class="nav-item ml-2 mt-2">
        <a class="nav-link" id="pills-dokter-tab" data-toggle="pill" href="#pills-dokter" role="tab"
            aria-controls="pills-dokter" aria-selected="false">Dokter</a>
    </li>

    <li class="nav-item ml-2 mt-2">
        <a class="nav-link" id="pills-spesialistik-tab" data-toggle="pill" href="#pills-spesialistik" role="tab"
            aria-controls="pills-spesialistik" aria-selected="false">Spesialistik</a>
    </li>

    <li class="nav-item ml-2 mt-2">
        <a class="nav-link" id="pills-ruangrawat-tab" data-toggle="pill" href="#pills-ruangrawat" role="tab"
            aria-controls="pills-ruangrawat" aria-selected="false">Ruang Rawat</a>
    </li>

    <li class="nav-item ml-2 mt-2">
        <a class="nav-link" id="pills-carakeluar-tab" data-toggle="pill" href="#pills-carakeluar" role="tab"
            aria-controls="pills-carakeluar" aria-selected="false">Cara Keluar</a>
    </li>

    <li class="nav-item ml-2 mt-2">
        <a class="nav-link" id="pills-pascapulang-tab" data-toggle="pill" href="#pills-pascapulang" role="tab"
            aria-controls="pills-pascapulang" aria-selected="false">Pasca Pulang</a>
    </li>

</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-diagnosa" role="tabpanel" aria-labelledby="pills-diagnosa-tab">

        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefDiagnosa') ?>" id="form_diagnosa">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Kode atau Nama Diagnosa</label>
                            <input type="text" class="form-control" name="diagnosa" value="general exam">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-poli" role="tabpanel" aria-labelledby="pills-poli-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefPoli') ?>" id="form_poli">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Kode atau Nama Poli</label>
                            <input type="text" class="form-control" name="poli" value="bedah">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-faskes" role="tabpanel" aria-labelledby="pills-faskes-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefFaskes') ?>" id="form_faskes">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Jenis Faskes</label>
                            <select class="form-control" name="jenis_faskes">
                                <option value="2" selected>Faskes 2/RS</option>
                                <option value="1">Faskes 1</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Nama atau Kode Faskes</label>
                            <input type="text" class="form-control" name="faskes" value="0901R001">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-dpjp" role="tabpanel" aria-labelledby="pills-dpjp-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefDpjp') ?>" id="form_dpjp">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Jenis Pelayanan</label>
                            <select class="form-control" name="jenis_pelayanan">
                                <option value="1" selected>Rawat Inap</option>
                                <option value="2">Rawat Jalan</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Tanggal Pelayanan</label>
                            <input type="date" class="form-control" name="tgl_pel" value="<?=date("Y-m-d")?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Kode Spesialis / Subspesialis</label>
                            <input type="text" class="form-control" name="kd_spesialis" value="BED">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-propinsi" role="tabpanel" aria-labelledby="pills-propinsi-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefPropinsi') ?>" id="form_propinsi">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-kabupaten" role="tabpanel" aria-labelledby="pills-kabupaten-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefKabupaten') ?>" id="form_kabupaten">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Kode Propinsi</label>
                            <input type="text" class="form-control" name="propinsi" value="23">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-kecamatan" role="tabpanel" aria-labelledby="pills-kecamatan-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefKecamatan') ?>" id="form_kecamatan">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Kode Kabupaten</label>
                            <input type="text" class="form-control" name="kabupaten" value="0308">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-diagprb" role="tabpanel" aria-labelledby="pills-diagprb-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefDiagnosaprb') ?>" id="form_diagprb">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-obatprb" role="tabpanel" aria-labelledby="pills-obatprb-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefObatprb') ?>" id="form_obatprb">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Nama Obat Generik</label>
                            <input type="text" class="form-control" name="obat" value="analog">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-procedure" role="tabpanel" aria-labelledby="pills-procedure-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefProcedure') ?>" id="form_procedure">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Nama atau Kode Procedure</label>
                            <input type="text" class="form-control" name="procedure" value="382.2">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-kelasrawat" role="tabpanel" aria-labelledby="pills-kelasrawat-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefKelasRawat') ?>" id="form_kelasrawat">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-dokter" role="tabpanel" aria-labelledby="pills-dokter-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefDokter') ?>" id="form_dokter">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Nama Dokter/DPJP</label>
                            <input type="text" class="form-control" name="dokter" value="dr. Bobby Fred Paat, Sp. Rad">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-spesialistik" role="tabpanel" aria-labelledby="pills-spesialistik-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefSpesialistik') ?>" id="form_spesialistik">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-ruangrawat" role="tabpanel" aria-labelledby="pills-ruangrawat-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefRuangRawat') ?>" id="form_ruangrawat">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-carakeluar" role="tabpanel" aria-labelledby="pills-carakeluar-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefCaraKeluar') ?>" id="form_carakeluar">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-pascapulang" role="tabpanel" aria-labelledby="pills-pascapulang-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_referensi/getRefPascaPulang') ?>" id="form_pascapulang">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm btn_submit_noka">Submit <i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>




<div class="row">
    <div class="col-lg-12" id="loader" style="display: none;">
        <?php $this->load->view('v_loader'); ?>
    </div>
    <div class="col-lg-12" id="div_result" style="display: none;">
        <div class="card">
            <div class="card-body">
                <span class="badge" id="response_title"></span>
                <p id="err_msg"></p>
                <hr>
                    <div id="result_data">
                        <p id="hasil_diagnosa"></p>
                        <p id="hasil_poli"></p>
                        <p id="hasil_faskes"></p>
                        <p id="hasil_dpjp"></p>
                        <p id="hasil_propinsi"></p>
                        <p id="hasil_kabupaten"></p>
                        <p id="hasil_kecamatan"></p>
                        <p id="hasil_diag_prb"></p>
                        <p id="hasil_obat_prb"></p>
                        <p id="hasil_procedure"></p>
                        <p id="hasil_kelas_rawat"></p>
                        <p id="hasil_dokter"></p>
                        <p id="hasil_spesialistik"></p>
                        <p id="hasil_ruang_rawat"></p>
                        <p id="hasil_cara_keluar"></p>
                        <p id="hasil_pasca_pulang"></p>
                    </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".nav-link").click(function () {
        $("#err_msg").html("");
        $("#div_result").hide()
        $("#loader").hide()
    })

    $("#form_diagnosa").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const diagnosa = response.msg.response.diagnosa
                $.each( diagnosa, function( i, l ){
                    $("#hasil_diagnosa").append(diagnosa[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })

    $("#form_poli").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const poli = response.msg.response.poli
                $.each( poli, function( i, l ){
                    $("#hasil_poli").append(poli[i].kode + ' - ' + poli[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })

    $("#form_faskes").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const faskes = response.msg.response.faskes
                $.each( faskes, function( i, l ){
                    $("#hasil_faskes").append(faskes[i].kode + ' - ' + faskes[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })

    $("#form_dpjp").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");
            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const dpjp = response.msg.response.list
                $.each( dpjp, function( i, l ){
                    $("#hasil_dpjp").append(dpjp[i].kode + ' - ' + dpjp[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })

    $("#form_propinsi").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const propinsi = response.msg.response.list
                $.each( propinsi, function( i, l ){
                    $("#hasil_propinsi").append(propinsi[i].kode + ' - ' + propinsi[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })

    $("#form_kabupaten").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const kabupaten = response.msg.response.list
                $.each( kabupaten, function( i, l ){
                    $("#hasil_kabupaten").append(kabupaten[i].kode + ' - ' + kabupaten[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })

    $("#form_kecamatan").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");
            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const kecamatan = response.msg.response.list
                $.each( kecamatan, function( i, l ){
                    $("#hasil_kecamatan").append(kecamatan[i].kode + ' - ' + kecamatan[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })

    $("#form_diagprb").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const diagprb = response.msg.response.list
                $.each( diagprb, function( i, l ){
                    $("#hasil_diag_prb").append(diagprb[i].kode + ' - ' + diagprb[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })

    $("#form_obatprb").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const obat = response.msg.response.list
                $.each( obat, function( i, l ){
                    $("#hasil_obat_prb").append(obat[i].kode + ' - ' + obat[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })

    $("#form_procedure").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const procedure = response.msg.response.procedure
                $.each( procedure, function( i, l ){
                    $("#hasil_procedure").append(procedure[i].kode + ' - ' + procedure[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })

    $("#form_kelasrawat").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const kelas = response.msg.response.list
                $.each( kelas, function( i, l ){
                    $("#hasil_kelas_rawat").append(kelas[i].kode + ' - ' + kelas[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })

    $("#form_dokter").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const dokter = response.msg.response.list
                $.each( dokter, function( i, l ){
                    $("#hasil_dokter").append(dokter[i].kode + ' - ' + dokter[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })

    $("#form_spesialistik").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const spesialistik = response.msg.response.list
                $.each( spesialistik, function( i, l ){
                    $("#hasil_spesialistik").append(spesialistik[i].kode + ' - ' + spesialistik[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })

    $("#form_ruangrawat").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const rr = response.msg.response.list
                $.each( rr, function( i, l ){
                    $("#hasil_ruang_rawat").append(rr[i].kode + ' - ' + rr[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })

    $("#form_carakeluar").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const ck = response.msg.response.list
                $.each( ck, function( i, l ){
                    $("#hasil_cara_keluar").append(ck[i].kode + ' - ' + ck[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })

    $("#form_pascapulang").submit(function (e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function (cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            $("#hasil_diagnosa").html("");
            $("#hasil_poli").html("");
            $("#hasil_faskes").html("");
            $("#hasil_dpjp").html("");
            $("#hasil_propinsi").html("");
            $("#hasil_kabupaten").html("");
            $("#hasil_kecamatan").html("");
            $("#hasil_diag_prb").html("");
            $("#hasil_obat_prb").html("");
            $("#hasil_procedure").html("");
            $("#hasil_kelas_rawat").html("");
            $("#hasil_dokter").html("");
            $("#hasil_spesialistik").html("");
            $("#hasil_ruang_rawat").html("");
            $("#hasil_cara_keluar").html("");
            $("#hasil_pasca_pulang").html("");

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#res_ref").show()
                $("#result_data").show()

                const pp = response.msg.response.list
                $.each( pp, function( i, l ){
                    $("#hasil_pasca_pulang").append(pp[i].kode + ' - ' + pp[i].nama+ "<br>");
                });

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#res_ref").hide()
                $("#result_data").hide()
            }
        })
    })
</script>