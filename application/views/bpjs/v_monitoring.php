<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="<?= base_url('bpjs/C_nav') ?>">BPJS</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kepesertaan</li>
            </ol>
        </nav>
    </div>

</div>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
            Data Kunjungan </a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_monitoring/getDataKunjungan') ?>" id="form_kunjungan">
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Tanggal Pelayanan</label>
                            <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl_pelayanan">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Jenis Pelayanan</label>
                            <select name="jenis_pelayanan" class="form-control">
                                <option value="1">Rawat Inap</option>
                                <option value="1">Rawat Jalan</option>
                            </select>

                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">&nbsp;</label>
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i class="fa fa-paper-plane"></i></button>
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
                <span class="badge" id="response_title">

                </span>
                <p id="err_msg"></p>

                <div id="hasil_kepesertaan">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item"> <strong>No Kartu :</strong>
                                    <div id="noKartu"></div>
                                </li>
                                <li class="list-group-item"> <strong>NIK :</strong>
                                    <div id="nik"></div>
                                </li>
                                <li class="list-group-item"> <strong>Nama</strong> : <div id="nama_peserta"></div>
                                </li>
                                <li class="list-group-item"> <strong>Hak Kelas :</strong>
                                    <div id="hakKelas"></div>
                                </li>

                                <li class="list-group-item"> <strong>Jenis Kelamin :</strong>
                                    <div id="sex"></div>
                                </li>
                                <li class="list-group-item"> <strong>Tanggal Lahir :</strong>
                                    <div id="tglLahir"></div>
                                </li>
                                <li class="list-group-item"> <strong>Umur :</strong>
                                    <div id="umur"></div>
                                </li>


                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>COB</strong> <br>
                                    Nama Asuransi : <a id="nmAsuransi"></a> <br>
                                    No Asuransi : <a id="noAsuransi"></a><br>
                                    Tgl TAT : <a id="tglTAT"></a><br>
                                    Tgl TMT : <a id="tglTMT"></a><br>
                                </li>
                                <li class="list-group-item">
                                    <strong>Informasi</strong> <br>
                                    Dinsos : <a id="dinsos">123</a> <br>
                                    No SKTM : <a id="noSKTM"></a><br>
                                    prolanis PRB: <a id="prolanisPRB"></a><br>
                                </li>
                                <li class="list-group-item"> <strong>Jenis Peserta. :</strong>
                                    <div id="jenisPeserta"></div>
                                </li>
                                <li class="list-group-item"> <strong>Prov. Umum :</strong>
                                    <div id="provUmum"></div>
                                </li>
                                <li class="list-group-item"> <strong>No. MR :</strong>
                                    <div id="noMR"></div>
                                </li>
                                <li class="list-group-item"> <strong>No. Tlp. :</strong>
                                    <div id="noTelepon"></div>
                                </li>
                                <li class="list-group-item"> <strong>Status Kepesertaan :</strong>
                                    <div class="alert" id="statusPeserta">
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(".nav-link").click(function() {
        $("#err_msg").html("");
        $("#div_result").hide()
        $("#loader").hide()
    })

    $("#form_kunjungan").submit(function(e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        // alert("test")
        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function(cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#hasil_kepesertaan").show()
                const peserta = response.msg.response.peserta
                console.log(peserta)




            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#hasil_kepesertaan").hide()
            }
        })
    })
</script>