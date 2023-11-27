<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="<?= base_url('antrean/C_nav_antrean') ?>">ANTREAN</a></li>
                <li class="breadcrumb-item active" aria-current="page">ANTREAN WS</li>
            </ol>
        </nav>
    </div>
</div>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-sisa-antrean-tab" data-toggle="pill" href="#pills-sisa-antrean" role="tab" aria-controls="pills-sisa-antrean" aria-selected="true"> Sisa Antrean</a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link" id="pills-ambil-antrean-tab" data-toggle="pill" href="#pills-ambil-antrean" role="tab" aria-controls="pills-ambil-antrean" aria-selected="false">Ambil Antrean</a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link" id="pills-status-antrean-tab" data-toggle="pill" href="#pills-status-antrean" role="tab" aria-controls="pills-status-antrean" aria-selected="false">Status Antrean</a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link" id="pills-batal-antrean-tab" data-toggle="pill" href="#pills-batal-antrean" role="tab" aria-controls="pills-batal-antrean" aria-selected="false">Batal Antrean</a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link" id="pills-ambil-jadwal-operasi-antrean-tab" data-toggle="pill" href="#pills-ambil-jadwal-operasi-antrean" role="tab" aria-controls="pills-ambil-jadwal-operasi-antrean" aria-selected="false">Ambil Jadwal Operasi</a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link" id="pills-jadwal-operasi-antrean-tab" data-toggle="pill" href="#pills-jadwal-operasi-antrean" role="tab" aria-controls="pills-jadwal-operasi-antrean" aria-selected="false">Jadwal Operasi</a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link" id="pills-jadwal-operasi-pasien-antrean-tab" data-toggle="pill" href="#pills-jadwal-operasi-pasien-antrean" role="tab" aria-controls="pills-jadwal-operasi-pasien-antrean" aria-selected="false">Jadwal Operasi Pasien</a>
    </li>
    <li class="nav-item ml-2">
        <a class="nav-link" id="pills-list-pasien-baru-antrean-tab" data-toggle="pill" href="#pills-pasien-baru-antrean" role="tab" aria-controls="pills-pasien-baru-antrean" aria-selected="false">Pasien Baru</a>
    </li>
</ul>

<!-- Sisa Antrean -->
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-sisa-antrean" role="tabpanel" aria-labelledby="pills-sisa-antrean-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('antrean/C_antrean_ws/getSisaAntrean') ?>" id="form-sisa-antrean">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="kode_booking">Kode Booking</label>
                            <input type="text" class="form-control" name="kodebooking" value="0002064475326ANA20220404001">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_sisa_antrean">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Ambil Antrean -->
    <div class="tab-pane fade" id="pills-ambil-antrean" role="tabpanel" aria-labelledby="pills-ambil-antrean-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('antrean/C_antrean_ws/getAmbilAntrean') ?>" id="form-ambil-antrean">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Nomor Kartu</label>
                            <input type="text" class="form-control" name="nomorkartu" value="0002064475326">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">NIK</label>
                            <input type="text" class="form-control" name="nik" value="3212345678987654">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">NORM</label>
                            <input type="text" class="form-control" name="norm" value="1648687185285">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">No HP</label>
                            <input type="text" class="form-control" name="nohp" value="081123456220">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" name="tanggalperiksa" value="<?= date("Y-m-d") ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Kode atau Nama Poli</label>
                            <input type="text" class="form-control" name="kodepoli" value="ANA">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Kode Dokter</label>
                            <input type="text" class="form-control" name="kodedokter" value="31789">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Jam Praktek</label>
                            <input type="text" class="form-control" name="jampraktek" value="08:00-12:00">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">No Rujukan</label>
                            <input type="text" class="form-control" name="nomorreferensi" value="2103R0081020B000075">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Jenis Kunjungan</label>
                            <input type="text" class="form-control" name="jeniskunjungan" value="1">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_ambil_antrean">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Status Antrean -->
    <div class="tab-pane fade" id="pills-status-antrean" role="tabpanel" aria-labelledby="pills-status-antrean-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('antrean/C_antrean_ws/getStatusAntrean') ?>" id="form-status-antrean">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" name="tanggalperiksa" value="<?= date("Y-m-d") ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Kode atau Nama Poli</label>
                            <input type="text" class="form-control" name="kodepoli" value="004">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Kode Dokter</label>
                            <input type="text" class="form-control" name="kodedokter" value="12345">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Jam Praktek</label>
                            <input type="text" class="form-control" name="jampraktek" value="08:00-16:00">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_status_antrean">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Batal Antrean -->
    <div class="tab-pane fade" id="pills-batal-antrean" role="tabpanel" aria-labelledby="pills-batal-antrean-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('antrean/C_antrean_ws/batalAntrean') ?>" id="form-batal-antrean">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="kode_booking">Kode Booking</label>
                            <input type="text" class="form-control" name="kodebooking" value="0002064475326ANA20220404001">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" value="alasan pasien membatalkan">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_batal_antrean">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Ambil Jadwal Operasi -->
    <div class="tab-pane fade" id="pills-ambil-jadwal-operasi-antrean" role="tabpanel" aria-labelledby="pills-ambil-jadwal-operasi-antrean-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('antrean/C_antrean_ws/ambilJadwalOperasi') ?>" id="form-ambil-jadwal-operasi-antrean">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Nomor Kartu</label>
                            <input type="text" class="form-control" name="nopeserta" value="012032030230">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="kode_booking">Kode Booking</label>
                            <input type="text" class="form-control" name="kodebooking" value="123456ZXC">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Tanggal Operasi</label>
                            <input type="date" class="form-control" name="tanggaloperasi" value="<?= date("Y-m-d") ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Jenis Tindakan</label>
                            <input type="text" class="form-control" name="jenistindakan" value="operasi gigi">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Kode atau Nama Poli</label>
                            <input type="hidden" class="form-control" name="kodepoli" value="001">
                            <input type="text" class="form-control" name="namapoli" value="Poli Bedah Mulut">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_ambil_jadwal_operasi_antrean">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jadwal Operasi -->
    <div class="tab-pane fade" id="pills-jadwal-operasi-antrean" role="tabpanel" aria-labelledby="pills-jadwal-operasi-antrean-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('antrean/C_antrean_ws/getJadwalOperasi') ?>" id="form-jadwal-operasi-antrean">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Tanggal Awal</label>
                            <input type="date" class="form-control" name="tanggalawal" value="<?= date("Y-m-d") ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="tanggalakhir" value="<?= date("Y-m-d") ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_jadwal_operasi_antrean">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jadwal Operasi Pasien -->
    <div class="tab-pane fade" id="pills-jadwal-operasi-pasien-antrean" role="tabpanel" aria-labelledby="pills-jadwal-operasi-pasien-antrean-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('antrean/C_antrean_ws/getJadwalOperasiPasien') ?>" id="form-jadwal-operasi-pasien-antrean">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Nomor Kartu</label>
                            <input type="text" class="form-control" name="nopeserta" value="0001570621882">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_jadwal_operasi_pasien_antrean">Submit <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Pasien Baru -->
    <div class="tab-pane fade" id="pills-pasien-baru-antrean" role="tabpanel" aria-labelledby="pills-pasien-baru-antrean-tab">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="<?= site_url('antrean/C_antrean_ws/createPasienBaru') ?>" id="form-pasien-baru-antrean">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="">Nomor Kartu</label>
                            <input type="text" class="form-control" name="nomorkartu" value="0002064475326">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">NIK</label>
                            <input type="text" class="form-control" name="nik" value="3212345678987654">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Nomor KK</label>
                            <input type="text" class="form-control" name="nomorkk" value="3212345678987654">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="nama" value="sumarsono">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Jenis Kelamin</label>
                            <select class="form-control" name="jeniskelamin">
                                <option value="L">L</option>
                                <option value="P">P</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggallahir" value="<?= date("Y-m-d") ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">No HP</label>
                            <input type="text" class="form-control" name="nohp" value="085635228888">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="alamat yang muncul merupakan alamat lengkap">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Propinsi</label>
                            <input type="hidden" class="form-control" name="kodeprop" value="11">
                            <input type="text" class="form-control" name="namaprop" value="Jawa Barat">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Kabupaten</label>
                            <input type="hidden" class="form-control" name="kodedati2" value="0120">
                            <input type="text" class="form-control" name="namadati2" value="Kab. Bandung">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Kecamatan</label>
                            <input type="hidden" class="form-control" name="kodekec" value="1319">
                            <input type="text" class="form-control" name="namakec" value="Soreang">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Kelurahan</label>
                            <input type="hidden" class="form-control" name="kodekel" value="D2105">
                            <input type="text" class="form-control" name="namakel" value="Cingcin">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">RT</label>
                            <input type="text" class="form-control" name="rt" value="013">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">RW</label>
                            <input type="text" class="form-control" name="rw" value="001">
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_pasien_baru_antrean">Submit <i class="fa fa-paper-plane"></i></button>
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

                <!-- sisa antrean result -->
                <div id="hasil_sisa_antrean" style="display: none;">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item"> <strong>Nomor Antrean :</strong>
                                    <div id="nomorAntrean"></div>
                                </li>
                                <li class="list-group-item"> <strong>Nama Poli :</strong>
                                    <div id="namaPoli"></div>
                                </li>
                                <li class="list-group-item"> <strong>Nama Dokter :</strong>
                                    <div id="namaDokter"></div>
                                </li>
                                <li class="list-group-item"> <strong>Sisa Antrean :</strong>
                                    <div id="sisaAntrean"></div>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item"> <strong>Antrean Panggil :</strong>
                                    <div id="antreanPanggil"></div>
                                </li>
                                <li class="list-group-item"> <strong>Waktu Tunggu :</strong>
                                    <div id="waktuTunggu"></div>
                                </li>
                                <li class="list-group-item"> <strong>Keterangan :</strong>
                                    <div id="keteranganAntrean"></div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- ambil antrean result -->
                <div id="hasil_ambil_antrean" style="display: none;">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item"> <strong>Nomor Antrean Anda :</strong>
                                    <div id="getNomorAntrean"></div>
                                </li>
                                <li class="list-group-item"> <strong>Angka Antrean :</strong>
                                    <div id="getAngkaAntrean"></div>
                                </li>
                                <li class="list-group-item"> <strong>Kode Booking :</strong>
                                    <div id="getKodeBookingAntrean"></div>
                                </li>
                                <li class="list-group-item"> <strong>Pasien Baru :</strong>
                                    <div id="getPasienBaruAntrean"></div>
                                </li>
                                <li class="list-group-item"> <strong>NORM :</strong>
                                    <div id="getNomorRmAntrean"></div>
                                </li>
                                <li class="list-group-item"> <strong>Nama Poli :</strong>
                                    <div id="getNamaPoliAntrean"></div>
                                </li>
                                <li class="list-group-item"> <strong>Nama Dokter :</strong>
                                    <div id="getNamaDokterAntrean"></div>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item"> <strong>Estimasi Dilayani :</strong>
                                    <div id="getEstimasiAntrean"></div>
                                </li>
                                <li class="list-group-item"> <strong>Sisa Kuota JKN :</strong>
                                    <div id="getSisaKuotaJknAntrean"></div>
                                </li>
                                <li class="list-group-item"> <strong>Kuota JKN :</strong>
                                    <div id="getKuotaJknAntrean"></div>
                                </li>
                                <li class="list-group-item"> <strong>Sisa Kuota Non JKN :</strong>
                                    <div id="getSisaKuotaNonJknAntrean"></div>
                                </li>
                                <li class="list-group-item"> <strong>Kuota Non JKN :</strong>
                                    <div id="getKuotaNonJknAntrean"></div>
                                </li>
                                <li class="list-group-item"> <strong>Keterangan :</strong>
                                    <div id="getKeteranganAntrean"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- status antrean result -->
                <div id="hasil_status_antrean" style="display: none;">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item"> <strong>Nama Poli :</strong>
                                    <div id="statusNamaPoli"></div>
                                </li>
                                <li class="list-group-item"> <strong>Nama Dokter :</strong>
                                    <div id="statusNamaDokter"></div>
                                </li>
                                <li class="list-group-item"> <strong>Total Antrean :</strong>
                                    <div id="statusTotalAntrean"></div>
                                </li>
                                <li class="list-group-item"> <strong>Sisa Antrean :</strong>
                                    <div id="statusSisaAntrean"></div>
                                </li>
                                <li class="list-group-item"> <strong>Antrean Panggil :</strong>
                                    <div id="statusAntreanPanggil"></div>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item"> <strong>Sisa Kuota JKN :</strong>
                                    <div id="statusSisaKuotaJkn"></div>
                                </li>
                                <li class="list-group-item"> <strong>Kuota JKN :</strong>
                                    <div id="statusKuotaJkn"></div>
                                </li>
                                <li class="list-group-item"> <strong>Sisa Kuota Non JKN :</strong>
                                    <div id="statusSisaKuotaNonJkn"></div>
                                </li>
                                <li class="list-group-item"> <strong>Kuota Non JKN :</strong>
                                    <div id="statusKuotaNonJkn"></div>
                                </li>
                                <li class="list-group-item"> <strong>Keterangan :</strong>
                                    <div id="statusKeterangan"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- batal antrean result -->
                <div id="hasil_batal_antrean" style="display: none;">
                    <div class="row">
                        <div id="batalAntrean"></div>
                    </div>
                </div>

                <!-- ambil jadwal operasi result -->
                <div id="hasil_ambil_jadwal_operasi_antrean" style="display: none;">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item"> <strong>Nomor Peserta :</strong>
                                    <div id="ambilJadwalNoka"></div>
                                </li>
                                <li class="list-group-item"> <strong>Kode Booking :</strong>
                                    <div id="ambilJadwalKodeBooking"></div>
                                </li>
                                <li class="list-group-item"> <strong>Nama Poli :</strong>
                                    <div id="ambilJadwalNamaPoli"></div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-group">

                                <li class="list-group-item"> <strong>Tanggal Operasi :</strong>
                                    <div id="ambilJadwalTglOperasi"></div>
                                </li>
                                <li class="list-group-item"> <strong>Jenis Tindakan :</strong>
                                    <div id="ambilJadwalJenisTindakan"></div>
                                </li>
                                <li class="list-group-item"> <strong>Terlaksana :</strong>
                                    <div id="ambilJadwalTerlaksana"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- jadwal operasi result -->
                <div id="hasil_jadwal_operasi_antrean" style="display: none;">
                    <div class="row">
                        <div class="col-lg-12" id="table-responsive">
                            <table class="table tablesorter">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Peserta</th>
                                        <th>Kode Booking</th>
                                        <th>Nama Poli</th>
                                        <th>Tanggal Operasi</th>
                                        <th>Jenis Tindakan</th>
                                        <th>Terlaksana</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- jadwal operasi pasien result -->
                <div id="hasil_jadwal_operasi_pasien_antrean" style="display: none;">
                    <div class="row">
                        <div id="jadwalOperasiPasienAntrean"></div>
                    </div>
                </div>

                <!-- pasien baru -->
                <div id="hasil_pasien_baru_antrean" style="display: none;">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-group">
                                <li class="list-group-item"> <strong>NORM :</strong>
                                    <div id="pasienBaruNorm"></div>
                                </li>
                                <li class="list-group-item"> <strong>Pesan :</strong>
                                    <div id="pasienBaruMessage"></div>
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

    $('#form-sisa-antrean').submit(function(e) {
        e.preventDefault()
        $(".btn_submit_sisa_antrean").hide()
        $("#loader").show()
        $("#response_title").html("");
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function(cb) {
            $(".btn_submit_sisa_antrean").show()
            $("#loader").hide()
            $("#div_result").show()
            $("#hasil_sisa_antrean").hide();
            $("#hasil_ambil_antrean").hide();
            $("#hasil_status_antrean").hide();
            $("#hasil_batal_antrean").hide();
            $("#hasil_ambil_jadwal_operasi_antrean").hide();
            $("#hasil_jadwal_operasi_antrean").hide();
            $("#hasil_pasien_baru_antrean").hide();
            const response = JSON.parse(cb)
            if (response == null) {
                $("#err_msg").html('GAGAL MENGAMBIL DATA');
                return false
            }

            if (response.metadata.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#hasil_sisa_antrean").show();
                const sisaAntrean = response.response
                const estimasi = new Date(sisaAntrean.waktutunggu * 1000)
                $("#nomorAntrean").html(sisaAntrean.nomorantrean)
                $("#sisaAntrean").html(sisaAntrean.sisaantrean)
                $("#namaPoli").html(sisaAntrean.namapoli)
                $("#namaDokter").html(sisaAntrean.namadokter)
                $("#antreanPanggil").html(sisaAntrean.antreanpanggil)
                $("#waktuTunggu").html(estimasi)
                $("#keteranganAntrean").html(sisaAntrean.keterangan)

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");
                $("#err_msg").html(response.metadata.message);
                $("#hasil_sisa_antrean").hide()
            }
        })
    })

    $('#form-ambil-antrean').submit(function(e) {
        e.preventDefault()
        $(".btn_submit_ambil_antrean").hide()
        $("#loader").show()
        $("#response_title").html("");
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function(cb) {
            $(".btn_submit_ambil_antrean").show()
            $("#loader").hide()
            $("#div_result").show()
            $("#hasil_sisa_antrean").hide();
            $("#hasil_ambil_antrean").hide();
            $("#hasil_status_antrean").hide();
            $("#hasil_batal_antrean").hide();
            $("#hasil_ambil_jadwal_operasi_antrean").hide();
            $("#hasil_jadwal_operasi_antrean").hide();
            $("#hasil_pasien_baru_antrean").hide();
            const response = JSON.parse(cb)
            if (response == null) {
                $("#err_msg").html('GAGAL MENGAMBIL DATA');
                $("#hasil_ambil_antrean").hide();
                return false
            }

            if (response.metadata.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#hasil_ambil_antrean").show();
                const ambilAntrean = response.response
                const estimasi = new Date(ambilAntrean.estimasidilayani * 1000)
                $("#getNomorAntrean").html(ambilAntrean.nomorantrean)
                $("#getAngkaAntrean").html(ambilAntrean.angkaantrean)
                $("#getKodeBookingAntrean").html(ambilAntrean.kodebooking)
                $("#getPasienBaruAntrean").html(ambilAntrean.pasienbaru == 0 ? 'Tidak' : 'Ya')
                $("#getNomorRmAntrean").html(ambilAntrean.norm)
                $("#getNamaPoliAntrean").html(ambilAntrean.namapoli)
                $("#getNamaDokterAntrean").html(ambilAntrean.namadokter)
                $("#getEstimasiAntrean").html(estimasi)
                $("#getSisaKuotaJknAntrean").html(ambilAntrean.sisakuotajkn)
                $("#getKuotaJknAntrean").html(ambilAntrean.kuotajkn)
                $("#getSisaKuotaNonJknAntrean").html(ambilAntrean.sisakuotanonjkn)
                $("#getKuotaNonJknAntrean").html(ambilAntrean.kuotanonjkn)
                $("#getKeteranganAntrean").html(ambilAntrean.keterangan)

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");
                $("#err_msg").html(response.metadata.message);
                $("#hasil_ambil_antrean").hide()
            }
        })
    })

    $('#form-status-antrean').submit(function(e) {
        e.preventDefault()
        $(".btn_submit_status_antrean").hide()
        $("#loader").show()
        $("#response_title").html("");
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function(cb) {
            $(".btn_submit_status_antrean").show()
            $("#loader").hide()
            $("#div_result").show()
            $("#hasil_sisa_antrean").hide();
            $("#hasil_ambil_antrean").hide();
            $("#hasil_status_antrean").hide();
            $("#hasil_batal_antrean").hide();
            $("#hasil_ambil_jadwal_operasi_antrean").hide();
            $("#hasil_jadwal_operasi_antrean").hide();
            $("#hasil_pasien_baru_antrean").hide();
            const response = JSON.parse(cb)
            if (response == null) {
                $("#err_msg").html('GAGAL MENGAMBIL DATA');
                $("#hasil_status_antrean").hide();
                return false
            }

            if (response.metadata.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#hasil_status_antrean").show();
                const statusAntrean = response.metadata.message
                $("#statusNamaPoli").html(statusAntrean.namapoli)
                $("#statusNamaDokter").html(statusAntrean.namadokter)
                $("#statusTotalAntrean").html(statusAntrean.totalantrean)
                $("#statusSisaAntrean").html(statusAntrean.sisaantrean)
                $("#statusAntreanPanggil").html(statusAntrean.antreanpanggil)
                $("#statusSisaKuotaJkn").html(statusAntrean.sisakuotajkn)
                $("#statusKuotaJkn").html(statusAntrean.kuotajkn)
                $("#statusSisaKuotaNonJkn").html(statusAntrean.sisakuotanonjkn)
                $("#statusKuotaNonJkn").html(statusAntrean.kuotanonjkn)
                $("#statusKeterangan").html(statusAntrean.keterangan)

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");
                $("#err_msg").html(response.metadata.message);
                $("#hasil_status_antrean").hide()
            }
        })
    })

    $('#form-batal-antrean').submit(function(e) {
        e.preventDefault()
        $(".btn_submit_batal_antrean").hide()
        $("#loader").show()
        $("#response_title").html("");
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function(cb) {
            $(".btn_submit_batal_antrean").show()
            $("#loader").hide()
            $("#div_result").show()
            $("#hasil_sisa_antrean").hide();
            $("#hasil_ambil_antrean").hide();
            $("#hasil_status_antrean").hide();
            $("#hasil_batal_antrean").hide();
            $("#hasil_ambil_jadwal_operasi_antrean").hide();
            $("#hasil_jadwal_operasi_antrean").hide();
            $("#hasil_pasien_baru_antrean").hide();
            const response = JSON.parse(cb)
            if (response == null) {
                $("#err_msg").html('GAGAL MENGAMBIL DATA');
                $("#hasil_batal_antrean").hide();
                return false
            }
            console.log(response)

            if (response.metadata.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#hasil_batal_antrean").show();
                const batalAntrean = response.response
                $("#batalAntrean").html(batalAntrean)

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");
                $("#err_msg").html(response.metadata.message);
                $("#hasil_batal_antrean").hide()
            }
        })
    })

    $('#form-ambil-jadwal-operasi-antrean').submit(function(e) {
        e.preventDefault()
        $(".btn_submit_ambil_jadwal_operasi_antrean").hide()
        $("#loader").show()
        $("#response_title").html("");
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function(cb) {
            $(".btn_submit_ambil_jadwal_operasi_antrean").show()
            $("#loader").hide()
            $("#div_result").show()
            $("#hasil_sisa_antrean").hide();
            $("#hasil_ambil_antrean").hide();
            $("#hasil_status_antrean").hide();
            $("#hasil_batal_antrean").hide();
            $("#hasil_ambil_jadwal_operasi_antrean").hide();
            $("#hasil_jadwal_operasi_antrean").hide();
            $("#hasil_pasien_baru_antrean").hide();
            const response = JSON.parse(cb)
            if (response == null) {
                $("#err_msg").html('GAGAL MENGAMBIL DATA');
                $("#hasil_ambil_jadwal_operasi_antrean").hide();
                return false
            }

            if (response.metadata.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#hasil_ambil_jadwal_operasi_antrean").show();
                const ambilJadwalOperasiAntrean = response.response
                $("#ambilJadwalNoka").html(ambilJadwalOperasiAntrean.nopeserta)
                $('#ambilJadwalKodeBooking').html(ambilJadwalOperasiAntrean.kodebooking)
                $('#ambilJadwalNamaPoli').html(ambilJadwalOperasiAntrean.namapoli)
                $('#ambilJadwalTglOperasi').html(ambilJadwalOperasiAntrean.tanggaloperasi)
                $('#ambilJadwalTerlaksana').html(ambilJadwalOperasiAntrean.terlaksana == 0 ? 'Tidak' : 'Ya')
                $('#ambilJadwalJenisTindakan').html(ambilJadwalOperasiAntrean.jenistindakan)

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");
                $("#err_msg").html(response.metadata.message);
                $("#hasil_ambil_jadwal_operasi_antrean").hide()
            }
        })
    })

    $('#form-jadwal-operasi-antrean').submit(function(e) {
        e.preventDefault()
        $(".btn_submit_jadwal_operasi_antrean").hide()
        $("#loader").show()
        $("#response_title").html("");
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function(cb) {
            $(".btn_submit_jadwal_operasi_antrean").show()
            $("#loader").hide()
            $("#div_result").show()
            $("#hasil_sisa_antrean").hide();
            $("#hasil_ambil_antrean").hide();
            $("#hasil_status_antrean").hide();
            $("#hasil_batal_antrean").hide();
            $("#hasil_ambil_jadwal_operasi_antrean").hide();
            $("#hasil_jadwal_operasi_antrean").hide();
            $("#hasil_pasien_baru_antrean").hide();
            const response = JSON.parse(cb)
            if (response == null) {
                $("#err_msg").html('GAGAL MENGAMBIL DATA');
                $("#hasil_jadwal_operasi_antrean").hide();
                return false
            }

            if (response.metadata.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#hasil_jadwal_operasi_antrean").show();
                const jadwalOperasiAntrean = response.response.list
                $("#tbody_data").html('')
                if (jadwalOperasiAntrean) {
                    let no = 1
                    $.each(jadwalOperasiAntrean, function(i, item) {
                        $('#tbody_data').append(`<tr>
                                <td>${no}</td>
                                <td>${item.nopeserta}</td>
                                <td>${item.kodebooking}</td>
                                <td>${item.namapoli}</td>
                                <td>${item.tanggaloperasi}</td>
                                <td>${item.jenistindakan}</td>
                                <td>${item.terlaksana == 0 ? 'Tidak' : 'Ya'}</td>
                            </tr>`)
                        no++
                    });
                } else {
                    $('#tbody_data').html('<tr><td colspan="6">Belum Ada Data</td></tr>');
                }

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");
                $("#err_msg").html(response.metadata.message);
                $("#hasil_jadwal_operasi_antrean").hide()
            }
        })
    })

    $('#form-jadwal-operasi-pasien-antrean').submit(function(e) {
        e.preventDefault()
        $(".btn_submit_jadwal_operasi_pasien_antrean").hide()
        $("#loader").show()
        $("#response_title").html("");
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function(cb) {
            $(".btn_submit_jadwal_operasi_pasien_antrean").show()
            $("#loader").hide()
            $("#div_result").show()
            $("#hasil_sisa_antrean").hide();
            $("#hasil_ambil_antrean").hide();
            $("#hasil_status_antrean").hide();
            $("#hasil_batal_antrean").hide();
            $("#hasil_ambil_jadwal_operasi_antrean").hide();
            $("#hasil_jadwal_operasi_antrean").hide();
            $("#hasil_pasien_baru_antrean").hide();
            const response = JSON.parse(cb)
            if (response == null) {
                $("#err_msg").html('GAGAL MENGAMBIL DATA');
                $("#hasil_jadwal_operasi_pasien_antrean").hide();
                return false
            }

            if (response.metadata.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#hasil_jadwal_operasi_pasien_antrean").show();
                const jadwalOperasiPasienAntrean = response.response.list
                $("#jadwalOperasiPasienAntrean").html(jadwalOperasiPasienAntrean.response)

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");
                $("#err_msg").html(response.metadata.message);
                $("#hasil_jadwal_operasi_pasien_antrean").hide()
            }
        })
    })

    $('#form-pasien-baru-antrean').submit(function(e) {
        e.preventDefault()
        $(".btn_submit_pasien_baru_antrean").hide()
        $("#loader").show()
        $("#response_title").html("");
        $("#err_msg").html("");
        $("#div_result").hide()

        const datasubmit = $(this).serialize()
        const urlsubmit = $(this).attr('action')
        $.post(urlsubmit, datasubmit, function(cb) {
            $(".btn_submit_pasien_baru_antrean").show()
            $("#loader").hide()
            $("#div_result").show()
            $("#hasil_sisa_antrean").hide();
            $("#hasil_ambil_antrean").hide();
            $("#hasil_status_antrean").hide();
            $("#hasil_batal_antrean").hide();
            $("#hasil_ambil_jadwal_operasi_antrean").hide();
            $("#hasil_jadwal_operasi_antrean").hide();
            $("#hasil_pasien_baru_antrean").hide();
            const response = JSON.parse(cb)
            if (response == null) {
                $("#err_msg").html('GAGAL MENGAMBIL DATA');
                $("#hasil_pasien_baru_antrean").hide();
                return false
            }

            if (response.metadata.code == 200) {
                $("#response_title").addClass("badge-success");
                $("#response_title").removeClass("badge-danger");
                $("#response_title").html("Sukses <i class='fa fa-check '></i>");
                $("#hasil_pasien_baru_antrean").show();
                const pasienBaruAntrean = response.response
                $("#pasienBaruNorm").html(pasienBaruAntrean.norm)
                $("#pasienBaruMessage").html(response.metadata.message)

            } else {
                $("#response_title").html("Gagal <i class='fa fa-times '></i>");
                $("#response_title").addClass("badge-danger");
                $("#response_title").removeClass("badge-success");
                $("#err_msg").html(response.metadata.message);
                $("#hasil_pasien_baru_antrean").hide();
            }
        })
    })
</script>