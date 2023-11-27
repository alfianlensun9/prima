<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="<?= base_url('antrean/C_nav_antrean') ?>">ANTREAN</a></li>
                <li class="breadcrumb-item active" aria-current="page">PEMANGGILAN ANTREAN</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="#" id="form-pemanggilan-antrean">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="kode_booking">Kode Booking</label>
                    <input type="text" class="form-control" name="kode_booking" value="angeal1707">
                </div>
                <div class="form-group col-md-4">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal" value="<?= date("Y-m-d") ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="kode_booking">Pilih Menu</label>
                    <select class="form-control" name="task_id">
                        <option disabled selected value="">Pilih Data</option>
                        <option value="0">Check in</option>
                        <option value="1">Mulai antrean admisi pasien baru</option>
                        <option value="2">Pemanggilan antrean admisi pasien baru</option>
                        <option value="3">Selesai pelayanan antrean admisi pasien baru / Mulai antrean pelayanan poli</option>
                        <option value="4">Pemanggilan antrean poli </option>
                        <option value="5">Selesai pelayanan antrean poli</option>
                        <option value="6">Pemanggilan antrean farmasi</option>
                        <option value="7">Selesai pelayanan antrean farmasi</option>
                        <option value="99">Antrean batal/tidak hadir</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_pemanggilan_antrean">Submit <i class="fa fa-paper-plane"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(".nav-link").click(function() {
        $("#err_msg").html("");
        $("#div_result").hide()
        $("#loader").hide()
    })
</script>