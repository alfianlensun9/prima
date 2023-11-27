<div class="card">
    <div class="card-body">

        <form method="POST" action="<?= site_url('sdm/C_absensi/getAbsenManualById') ?>" id="filter_absen_manual">
            <div class="form-row">
                <input type="hidden" name="id_user" id="id_user_filter" value="<?= $id_user ?>">

                <div class="form-group col-md-4">
                    <label for="inputPassword4">Tgl Awal</label>
                    <input type="date" class="form-control" value="<?= $tgl_awal  ?>" name="tgl_awal" id="tgl_awal_filter">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Tgl Akhir</label>
                    <input type="date" class="form-control" value="<?= $tgl_akhir  ?>" name="tgl_akhir" id="tgl_akhir_filter">
                </div>

                <div class="form-group col-md-4">
                    <label for=" inputPassword4">&nbsp;</label><br>
                    <button type="submit" class="btn btn-primary btn-sm  btn_submit">Filter <i class="fa fa-filter"></i></button>
                </div>
            </div>
        </form>
        <table class="table">
            <thead>
                <th>Tanggal</th>
                <th>Jenis Absen</th>
                <th>Opsi</th>
            </thead>
            <tbody>
                <?php

                $absen = json_decode($list_absensi);


                if (isset($absen->data)) {
                    $allAbsen  = $absen->data;
                    foreach ($allAbsen as $item) {
                        $id_mst_jenis_absensi = $item->id_mst_jenis_absensi;
                        $filter = array_values(array_filter($listJenisAbsen, function ($item) use ($id_mst_jenis_absensi) {
                            return $item['id_mst_jenis_absensi'] == $id_mst_jenis_absensi;
                        }));
                        $jenis_absen = $filter[0]['nm_mst_jenis_absensi'];
                ?>
                        <tr>
                            <td><?= formatdmY($item->server_datetime) ?></td>
                            <td>
                                <?= $jenis_absen ?>

                            </td>
                            <td>
                                <button class="btn btn-sm btn-danger delete_this_manual" id="<?= $item->id_trx_absensi ?>"><i class="fa fa-times"></i></button>

                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>

        </table>

    </div>
</div>

<script>
    $(".delete_this_manual").click(function(e) {
        e.preventDefault()
        if (confirm('Apakah anda yakin ingin menghapus data ini?')) {


            const id = $(this).attr("id")
            const url = '<?= site_url('sdm/C_absensi/deleteAbsensiManual') ?>'
            const tgl_awal = $("#tgl_awal_filter").val();
            const tgl_akhir = $("#tgl_akhir_filter").val();
            const id_user_filter = $("#id_user_filter").val();
            $("#result_absen_manual").html(`<?php $this->load->view('v_loader') ?>`);


            $.post(url, {
                id: id
            }, function(cb) {
                $("#result_absen_manual").html("");
                $("#result_absen_manual").load(`<?= site_url("sdm/C_absensi/getAbsenManualById/") ?>${id_user_filter}/${tgl_awal}/${tgl_akhir}`);


            })
        }
    })
    $("#filter_absen_manual").submit(function(e) {
        e.preventDefault()

        $("#result_absen_manual").html(`<?php $this->load->view('v_loader') ?>`);

        const url = $(this).attr('action')
        const dataSubmit = $(this).serialize()

        $.post(url, dataSubmit, function(cb) {
            $("#result_absen_manual").html("");
            $("#result_absen_manual").append(cb);
        })


    })
</script>