<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="<?= base_url('sdm/C_nav') ?>">Absensi</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Pegawai</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-body">
            <?php if ($this->session->flashdata('msg')) : ?>
                <span class="badge badge-success badge-lg" id="response_title">
                    <?= $this->session->flashdata('msg'); ?>
                </span>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table tablesorter dtTableThis" id="">
                    <thead class=" text-primary">
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>NIP</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>Tempat Lahir</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listPegawai as $pegawai) : ?>
                            <tr>
                                <td><?= $pegawai->nm_pegawai; ?></td>
                                <td><?= $pegawai->nip; ?></td>
                                <td><?= $pegawai->jenis_kelamin == 1 ? "Laki-Laki" : "Perempuan"; ?></td>
                                <td><?= $pegawai->email; ?></td>
                                <td><?= $pegawai->tempat_lahir; ?></td>
                                <td>
                                    <a data-toggle="modal" data-target="#modalView" class="btn btn-secondary btn-sm btn_get_absen" id="<?= $pegawai->id_trx_kepegawaian ?>" nm_pegawai="<?= $pegawai->nm_pegawai ?>" href="#"><i class="fa fa-calendar "></i> Monitoring</a>
                                    <a data-toggle="modal" data-target="#modalManual" class="btn btn-secondary btn-sm btn_absen_manual" id="<?= $pegawai->id_trx_kepegawaian ?>" nm_pegawai="<?= $pegawai->nm_pegawai ?>" href="#"><i class="fa fa-cog fa-spin"></i> Manual</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="modalDokterLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="nmPegawai">Data Absen Pegawai</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="<?= site_url('sdm/C_absensi/monitoringAbsensi') ?>" id="form_absen">
                            <div class="form-row">
                                <input type="hidden" name="id_user" id="idPegawai">
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Tgl Awal</label>
                                    <input type="date" class="form-control" value="<?= date('Y-m') . '-01' ?>" name="tgl_awal" id="tgl_awal">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Tgl Akhir</label>
                                    <input type="date" class="form-control" value="<?= date('Y-m') . '-30' ?>" name="tgl_akhir" id="tgl_akhir">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">&nbsp;</label><br>
                                    <button type="submit" class="btn btn-primary  btn-sm btn_submit">Submit <i class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <div id="result_absen"></div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalManual" tabindex="-1" role="dialog" aria-labelledby="modalDokterLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Absen Manual <span id="lbl_pegawai"></span></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="<?= site_url('sdm/C_absensi/absensiManual') ?>" id="form_absen_manual">
                            <div class="form-row">
                                <input type="hidden" name="id_pegawai" id="id_pegawai">
                                <input type="hidden" name="nm_pegawai" id="nm_pegawai">

                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Tgl Awal</label>
                                    <input type="datetime-local" class="form-control" value="<?= date('Y-m-d') . 'T' . date('H:i')  ?>" name="tgl_awal" id="tgl_awal_manual">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPassword4">Tgl Akhir</label>
                                    <input type="datetime-local" class="form-control" value="<?= date('Y-m-d') . 'T' . date('H:i')  ?>" name="tgl_akhir" id="tgl_akhir_manual">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Jenis Absen</label>
                                    <select name="id_mst_jenis_absensi" class="form-control">
                                        <?php foreach ($listJenisAbsen as $itm) {
                                        ?>
                                            <option value="<?= $itm['id_mst_jenis_absensi'] ?>"><?= $itm['nm_mst_jenis_absensi'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputPassword4">&nbsp;</label><br>
                                    <button type="submit" class="btn btn-primary btn-sm pull-right btn_submit">Simpan <i class="fa fa-save"></i></button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <div id="result_absen_manual"></div>
            </div>

        </div>
    </div>
</div>

<script>
    $(".btn_get_absen").click(function(e) {
        e.preventDefault()
        const id = $(this).attr('id')
        const nm_pegawai = $(this).attr('nm_pegawai')

        $("#nmPegawai").html(nm_pegawai);
        $("#idPegawai").val(id);

    })

    $(".btn_absen_manual").click(function(e) {
        e.preventDefault()
        const id = $(this).attr('id')
        const nm_pegawai = $(this).attr('nm_pegawai')

        $("#id_pegawai").val(id);
        $("#nm_pegawai").val(nm_pegawai);
        $("#lbl_pegawai").html(nm_pegawai);

        $("#result_absen_manual").html(`<?php $this->load->view('v_loader') ?>`);
        $("#result_absen_manual").load(`<?= site_url("sdm/C_absensi/getAbsenManualById/") ?>${id}`);

    })
</script>

<script>
    $("#form_absen").submit(function(e) {
        e.preventDefault()
        $(".btn_submit").hide()
        const tgl_awal = $("#tgl_awal").val();
        const tgl_akhir = $("#tgl_akhir").val();

        var date1 = new Date(tgl_awal);
        var date2 = new Date(tgl_akhir);

        // To calculate the no. of days between two dates
        var Difference_In_Time = date2.getTime() - date1.getTime();
        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
        $("#result_absen").html(`<?php $this->load->view('v_loader') ?>`);


        if (Difference_In_Days > 31) {
            alert("Jumlah hari tidak bisa lebih dari 31")
            $("#result_absen").html(``);
            $(".btn_submit").show()

        } else {

            const url = $(this).attr('action')
            const data = $(this).serialize()
            $.post(url, data, function(cb) {
                $("#result_absen").html(``);
                $("#result_absen").append(cb)
                $(".btn_submit").show()
            })
        }
    })

    $("#form_absen_manual").submit(function(e) {
        e.preventDefault()
        $(".btn_submit").hide()
        $("#result_absen_manual").html(`<?php $this->load->view('v_loader') ?>`);

        const url = $(this).attr('action')
        const data = $(this).serialize()
        $.post(url, data, function(cb) {
            $("#result_absen_manual").html(``);
            $("#result_absen_manual").append(cb)
            $(".btn_submit").show()
        })


    })
</script>