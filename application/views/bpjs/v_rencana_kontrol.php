<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="<?= base_url('bpjs/C_nav') ?>">BPJS</a></li>
                <li class="breadcrumb-item active" aria-current="page">Rencana Kontrol</li>
            </ol>
        </nav>
    </div>

</div>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-createrencanakontrol-tab" data-toggle="pill" href="#pills-createrencanakontrol" role="tab" aria-controls="pills-createrencanakontrol" aria-selected="true">Insert Rencana Kontrol</a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link" id="pills-updaterencanakotrol-tab" data-toggle="pill" href="#pills-updaterencanakotrol" role="tab" aria-controls="pills-updaterencanakotrol" aria-selected="false">Update Rencana Kontrol</a>
    </li>

    <li class="nav-item ml-2">
        <a class="nav-link" id="pills-createspri-tab" data-toggle="pill" href="#pills-createspri" role="tab" aria-controls="pills-createspri" aria-selected="false">Insert SPRI</a>
    </li>

    <li class="nav-item ml-2">
        <a class="nav-link" id="pills-updatespri-tab" data-toggle="pill" href="#pills-updatespri" role="tab" aria-controls="pills-updatespri" aria-selected="false">Update SPRI</a>
    </li>

    <li class="nav-item ml-2">
        <a class="nav-link" id="pills-deleterencanakontrol-tab" data-toggle="pill" href="#pills-deleterencanakontrol" role="tab" aria-controls="pills-deleterencanakontrol" aria-selected="false">Delete Rencana Kontrol</a>
    </li>

    <li class="nav-item ml-2">
        <a class="nav-link" id="pills-getrencanakontrol-tab" data-toggle="pill" href="#pills-getrencanakontrol" role="tab" aria-controls="pills-getrencanakontrol" aria-selected="false">Get Rencana Kontrol</a>
    </li>
</ul>

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-createrencanakontrol" role="tabpanel" aria-labelledby="pills-createrencanakontrol-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_rencana_kontrol/createRencanaKontrol') ?>" id="form_create_rencana_kontrol">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">No SEP</label>
                            <input type="text" class="form-control" name="no_sep" value="0461R0010322V000014">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Kode Dokter</label>
                            <input type="text" class="form-control" name="kode_dokter" value="23472">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Poli Kontrol</label>
                            <input type="text" class="form-control" name="poli_kontrol" value="INT">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputPassword4">Tanggal Rencana</label>
                            <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl_rencana">
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

    <div class="tab-pane fade" id="pills-updaterencanakotrol" role="tabpanel" aria-labelledby="pills-updaterencanakotrol-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_rencana_kontrol/updateRencanaKontrol') ?>" id="form_update_rencana_kontrol">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">No Surat</label>
                            <input type="text" class="form-control" name="no_surat" value="0461R0010322K000001">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">No SEP</label>
                            <input type="text" class="form-control" name="no_sep" value="0461R0010322V000014">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="inputEmail4">Kode Dokter</label>
                            <input type="text" class="form-control" name="kode_dokter" value="23472">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="inputEmail4">Poli Kontrol</label>
                            <input type="text" class="form-control" name="poli_kontrol" value="INT">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="inputPassword4">Tanggal Rencana</label>
                            <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl_rencana">
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

    <div class="tab-pane fade" id="pills-deleterencanakontrol" role="tabpanel" aria-labelledby="pills-deleterencanakontrol-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_rencana_kontrol/deleteDataRencanaKotrol') ?>" id="form_delete_rencana_kontrol">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">No Surat</label>
                            <input type="text" class="form-control" value="2101R0010322K000516" name="no_surat">
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

    <div class="tab-pane fade" id="pills-createspri" role="tabpanel" aria-labelledby="pills-createspri-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_rencana_kontrol/createSpri') ?>" id="form_create_spri">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">No Kartu</label>
                            <input type="text" class="form-control" name="no_kartu" value="0002064475326">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Kode Dokter</label>
                            <input type="text" class="form-control" name="kode_dokter" value="23472">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Poli Kontrol</label>
                            <input type="text" class="form-control" name="poli_kontrol" value="INT">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputPassword4">Tanggal Rencana</label>
                            <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl_rencana">
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

    <div class="tab-pane fade" id="pills-updatespri" role="tabpanel" aria-labelledby="pills-updatespri-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_rencana_kontrol/updateSpri') ?>" id="form_update_spri">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputEmail4">No SPRI</label>
                            <input type="text" class="form-control" name="no_spri" value="0301R0110421K000116">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Kode Dokter</label>
                            <input type="text" class="form-control" name="kode_dokter" value="23472">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4">Poli Kontrol</label>
                            <input type="text" class="form-control" name="poli_kontrol" value="INT">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputPassword4">Tanggal Rencana</label>
                            <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl_rencana">
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

    <div class="tab-pane fade" id="pills-getrencanakontrol" role="tabpanel" aria-labelledby="pills-getrencanakontrol-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('bpjs/C_rencana_kontrol/getDataRencanaKotrol') ?>" id="form_get_rencana_kontrol">
                    <div class="form-row">
                    <div class="form-group col-md-2">
                            <label for="inputPassword4">Tanggal Awal</label>
                            <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl_awal">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="inputPassword4">Tanggal Akhir</label>
                            <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl_akhir">
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
                <span class="badge" id="response_title"></span>
                <p id="err_msg"></p>

                <div id="hasil_create_rencana_kontrol">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item"> <strong>No Surat Kontrol :</strong>
                                    <div id="noSuratKontrol"></div>
                                </li>
                                <li class="list-group-item"> <strong>Nama Dokter :</strong>
                                    <div id="namaDokter"></div>
                                </li>
                                <li class="list-group-item"> <strong>Nama</strong> : <div id="namaPeserta"></div>
                                </li>
                                <li class="list-group-item"> <strong>Tanggal Lahir :</strong>
                                    <div id="tglLahir"></div>
                                </li>


                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Tanggal Rencana Kontrol :</strong>
                                    <div id="tglRencanaKontrol"></div>
                                </li>
                                <li class="list-group-item">
                                    <strong>No Kartu :</strong> 
                                    <div id="noKartu"></div>
                                </li>
                                <li class="list-group-item"> <strong>Kelamin :</strong>
                                    <div id="kelaminPeserta"></div>
                                </li>

                            </ul>
                        </div>
                    </div>


                </div>

                <div id="hasil_create_spri">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item"> <strong>No SPRI :</strong>
                                    <div id="noSpri"></div>
                                </li>
                                <li class="list-group-item"> <strong>Nama Dokter :</strong>
                                    <div id="namaDokterSpri"></div>
                                </li>
                                <li class="list-group-item"> <strong>Nama</strong> : <div id="namaPesertaSpri"></div>
                                </li>
                                <li class="list-group-item"> <strong>Tanggal Lahir :</strong>
                                    <div id="tglLahirSpri"></div>
                                </li>


                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Tanggal Rencana Kontrol :</strong>
                                    <div id="tglRencanaKontrolSpri"></div>
                                </li>
                                <li class="list-group-item">
                                    <strong>No Kartu :</strong> 
                                    <div id="noKartuSpri"></div>
                                </li>
                                <li class="list-group-item"> <strong>Kelamin :</strong>
                                    <div id="kelaminPesertaSpri"></div>
                                </li>
                                <li class="list-group-item"> <strong>Nama Diagnosa :</strong>
                                    <div id="nmDiagnosaSpri"></div>
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>

                <div id="hasil_get_rencana_kontrol">
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Surat Kontrol / SPRI</th>
                                        <th>Tanggal Rencana Kontrol</th>
                                        <th>Nama Dokter</th>
                                        <th>Nomor Kartu</th>
                                        <th>Nama</th>
                                        <th>Poli Asal</th>
                                        <th>Poli Tujuan</th>
                                        <th>No SEP Asal</th>
                                    </tr>
                                </thead>
                                <tbody id="bodyRencanaKontrol"></tbody>
                            </table>
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

    $("#form_create_rencana_kontrol").submit(function(e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function(cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            console.log(response)

            $("#hasil_create_rencana_kontrol").hide();
            $("#hasil_create_spri").hide();
            $("#hasil_get_rencana_kontrol").hide();

            if (response.msg.rencana_kontrol_response.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#hasil_create_rencana_kontrol").show()
                const data = response.msg.rencana_kontrol_response.response
                $("#noSuratKontrol").html(data.noSuratKontrol)
                $("#namaDokter").html(data.namaDokter)
                $("#namaPeserta").html(data.nama)
                $("#tglLahir").html(data.tglLahir)
                $("#tglRencanaKontrol").html(data.tglRencanaKontrol)
                $("#noKartu").html(data.noKartu)
                $("#kelaminPeserta").html(data.kelamin)

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.rencana_kontrol_response.metaData.message);
                $("#hasil_create_rencana_kontrol").hide()
            }
        })
    })

    $("#form_update_rencana_kontrol").submit(function(e) {
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

            $("#hasil_create_rencana_kontrol").hide();
            $("#hasil_create_spri").hide();
            $("#hasil_get_rencana_kontrol").hide();

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#hasil_create_rencana_kontrol").show()
                const data = response.msg.response
                $("#noSuratKontrol").html(data.noSuratKontrol)
                $("#namaDokter").html(data.namaDokter)
                $("#namaPeserta").html(data.nama)
                $("#tglLahir").html(data.tglLahir)
                $("#tglRencanaKontrol").html(data.tglRencanaKontrol)
                $("#noKartu").html(data.noKartu)
                $("#kelaminPeserta").html(data.kelamin)

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#hasil_create_rencana_kontrol").hide()
            }
        })
    })

    $("#form_delete_rencana_kontrol").submit(function(e) {
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
            console.log(response)
            
            $("#hasil_create_rencana_kontrol").hide();
            $("#hasil_create_spri").hide();
            $("#hasil_get_rencana_kontrol").hide();


            if (response.msg.response_bpjs.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                const data = response.msg.response

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");
                $("#err_msg").html(response.msg.response_bpjs.metaData.message);
            }
        })
    })

    $("#form_create_spri").submit(function(e) {
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

            $("#hasil_create_rencana_kontrol").hide();
            $("#hasil_create_spri").hide();
            $("#hasil_get_rencana_kontrol").hide();

            if (response.msg.response.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#hasil_create_spri").show()
                const data = response.msg.response.response

                $("#noSpri").html(data.noSPRI)
                $("#namaDokterSpri").html(data.namaDokter)
                $("#namaPesertaSpri").html(data.nama)
                $("#tglLahirSpri").html(data.tglLahir)
                $("#tglRencanaKontrolSpri").html(data.tglRencanaKontrol)
                $("#noKartuSpri").html(data.noKartu)
                $("#kelaminPesertaSpri").html(data.kelamin)
                $("#nmDiagnosaSpri").html(data.namaDiagnosa)

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.response.metaData.message);
                $("#hasil_create_spri").hide()
            }
        })
    })

    $("#form_update_spri").submit(function(e) {
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
            $("#hasil_create_rencana_kontrol").hide();
            $("#hasil_create_spri").hide();
            $("#hasil_get_rencana_kontrol").hide();

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#hasil_create_spri").show()
                const data = response.msg.response
                $("#noSpri").html(data.noSPRI)
                $("#namaDokterSpri").html(data.namaDokter)
                $("#namaPesertaSpri").html(data.nama)
                $("#tglLahirSpri").html(data.tglLahir)
                $("#tglRencanaKontrolSpri").html(data.tglRencanaKontrol)
                $("#noKartuSpri").html(data.noKartu)
                $("#kelaminPesertaSpri").html(data.kelamin)
                $("#nmDiagnosaSpri").html(data.namaDiagnosa)

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#hasil_create_spri").hide()
            }
        })
    })

    $("#form_get_rencana_kontrol").submit(function(e) {
        e.preventDefault()
        $(".btn_submit_noka").hide()
        $("#loader").show()
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function(cb) {
            $(".btn_submit_noka").show()
            $("#loader").hide()
            $("#div_result").show()
            const response = JSON.parse(cb)
            
            $("#hasil_create_rencana_kontrol").hide();
            $("#hasil_create_spri").hide();
            $("#hasil_get_rencana_kontrol").hide();

            if (response.msg.metaData.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#hasil_get_rencana_kontrol").show()
                const data = response.msg.response.list

                $('#bodyRencanaKontrol').html('');                
                if (data.length > 0){                    
                    let no = 1; 
                    $.each(data,function(i, item){
                        $('#bodyRencanaKontrol').append(
                            '<tr>'+
                                '<td>'+no+'</td>'+
                                '<td>'+data[i].noSuratKontrol+'</td>'+
                                '<td>'+data[i].tglRencanaKontrol+'</td>'+
                                '<td>'+data[i].namaDokter+'</td>'+
                                '<td>'+data[i].noKartu+'</td>'+
                                '<td>'+data[i].nama+'</td>'+
                                '<td>'+data[i].namaPoliAsal+'</td>'+
                                '<td>'+data[i].namaPoliTujuan+'</td>'+
                                '<td>'+data[i].noSepAsalKontrol+'</td>'+
                            '</tr>'
                        )
                        no++;
                    });
                } else {
                    $('#bodyRencanaKontrol').html('<tr><td colspan="9">Tidak Ada Data</td></tr>');
                }

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");

                $("#err_msg").html(response.msg.metaData.message);
                $("#hasil_get_rencana_kontrol").hide()
            }
        })
    })
</script>