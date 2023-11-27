<div class="row">
	<div class="col-12">

		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
				<li class="breadcrumb-item " aria-current="page"><a href="<?= base_url('bpjs/C_nav') ?>">BPJS</a></li>
				<li class="breadcrumb-item active" aria-current="page">Rujukan</li>
			</ol>
		</nav>

	</div>
</div>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

	<li class="nav-item mb-2">
		<a class="nav-link active" id="pills-insert-rujukan-tab" data-toggle="pill" href="#pills-insert-rujukan" role="tab" aria-controls="pills-insert-rujukan" aria-selected="true">Create</a>
	</li>

	<li class="nav-item mb-2 ml-2">
		<a class="nav-link" id="pills-update-rujukan-tab" data-toggle="pill" href="#pills-update-rujukan" role="tab" aria-controls="pills-update-rujukan" aria-selected="true">Update</a>
	</li>

	<li class="nav-item mb-2 ml-2">
		<a class="nav-link" id="pills-delete-rujukan-tab" data-toggle="pill" href="#pills-delete-rujukan" role="tab" aria-controls="pills-delete-rujukan" aria-selected="true">Delete</a>
	</li>

	<li class="nav-item mb-2 ml-2">
		<a class="nav-link" id="pills-get-rujukan-tab" data-toggle="pill" href="#pills-get-rujukan" role="tab" aria-controls="pills-get-rujukan" aria-selected="true">Get</a>
	</li>

	<li class="nav-item mb-2 ml-2">
		<a class="nav-link" id="pills-create-rujukan-khusus-tab" data-toggle="pill" href="#pills-create-rujukan-khusus" role="tab" aria-controls="pills-create-rujukan-khusus" aria-selected="true">Create Rujukan Khusus</a>
	</li>

	<li class="nav-item mb-2 ml-2">
		<a class="nav-link" id="pills-create-rujukan-prb-tab" data-toggle="pill" href="#pills-create-rujukan-prb" role="tab" aria-controls="pills-create-rujukan-prb" aria-selected="true">Create Rujukan PRB</a>
	</li>

	<li class="nav-item mb-2 ml-2">
		<a class="nav-link" id="pills-get-rujukan-konsul-tab" data-toggle="pill" href="#pills-get-rujukan-konsul" role="tab" aria-controls="pills-get-rujukan-konsul" aria-selected="true">Get Rujukan Konsul</a>
	</li>

	<li class="nav-item mb-2 ml-2">
		<a class="nav-link" id="pills-get-rujukan-khusus-tab" data-toggle="pill" href="#pills-get-rujukan-khusus" role="tab" aria-controls="pills-get-rujukan-khusus" aria-selected="true">Get Rujukan Khusus</a>
	</li>

	<li class="nav-item mb-2 ml-2">
		<a class="nav-link" id="pills-get-spesialistik-rujukan-tab" data-toggle="pill" href="#pills-get-spesialistik-rujukan" role="tab" aria-controls="pills-get-spesialistik-rujukan" aria-selected="true">Get Spesialistik Rujukan</a>
	</li>

	<li class="nav-item mb-2 ml-2">
		<a class="nav-link" id="pills-get-spesialistik-sarana-tab" data-toggle="pill" href="#pills-get-spesialistik-sarana" role="tab" aria-controls="pills-get-spesialistik-sarana" aria-selected="true">Get Spesialistik Sarana</a>
	</li>
</ul>

<div class="tab-content" id="pills-tabContent">

	<!-- Insert Rujukan -->
	<div class="tab-pane fade show active" id="pills-insert-rujukan" role="tabpanel" aria-labelledby="pills-insert-rujukan-tab">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?= site_url('bpjs/C_rujukan/createRujukan') ?>" id="form_update_rujukan">
					<div class="form-row">
						<div class="form-group col-md-3">
							<label for="tgl_rujukan">Rujukan</label>
							<input type="date" class="form-control" name="tgl_rujukan" value="<?= date('Y-m-d') ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="tgl_rencana_kunjungan">Tanggal Rencana Rujukan</label>
							<input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl_rencana_kunjungan">
						</div>

						<div class="form-group col-md-3">
							<label for="no_sep">Nomor SEP</label>
							<input type="text" class="form-control" value="2101R0011221V000017" name="no_sep">
						</div>

						<div class="form-group col-md-3">
							<label for="ppk_dirujuk">PPK Dirujuk</label>
							<input type="text" class="form-control" value="0901R001" name="ppk_dirujuk">
						</div>

						<div class="form-group col-md-3">
							<label for="jns_pelayanan">Jenis Pelayanan</label>
							<input type="text" class="form-control" value="0901R001" name="jns_pelayanan">
						</div>

						<div class="form-group col-md-3">
							<label for="catatan">Catatan</label>
							<input type="text" class="form-control" value="testing" name="catatan">
						</div>

						<div class="form-group col-md-3">
							<label for="diagnosa">Diagnosa</label>
							<input type="text" class="form-control" value="testing" name="diagnosa">
						</div>

						<div class="form-group col-md-3">
							<label for="tipe_rujukan">Tipe Rujukan</label>
							<input type="text" class="form-control" value="0" name="tipe_rujukan">
						</div>

						<div class="form-group col-md-3">
							<label for="poli_rujukan">Tipe Rujukan</label>
							<input type="text" class="form-control" value="017" name="poli_rujukan">
						</div>

						<input type="hidden" class="form-control" value="2206" name="id_user_inputer">

						<div class="form-group col-md-12">
							<label for="submit">&nbsp;</label>
							<button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i class="fa fa-paper-plane"></i></button>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Update Rujukan -->
	<div class="tab-pane fade" id="pills-update-rujukan" role="tabpanel" aria-labelledby="pills-update-rujukan-tab">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?= site_url('bpjs/C_rujukan/updateRujukan') ?>" id="form_insert_rujukan">
					<div class="form-row">
						<div class="form-group col-md-3">
							<label for="tgl_rujukan">Rujukan</label>
							<input type="date" class="form-control" name="tgl_rujukan" value="<?= date('Y-m-d') ?>">
						</div>
						<div class="form-group col-md-3">
							<label for="tgl_rencana_kunjungan">Tanggal Rencana Rujukan</label>
							<input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl_rencana_kunjungan">
						</div>

						<div class="form-group col-md-3">
							<label for="no_sep">Nomor SEP</label>
							<input type="text" class="form-control" value="2101R0011221V000017" name="no_sep">
						</div>

						<div class="form-group col-md-3">
							<label for="ppk_dirujuk">PPK Dirujuk</label>
							<input type="text" class="form-control" value="0901R001" name="ppk_dirujuk">
						</div>

						<div class="form-group col-md-3">
							<label for="jns_pelayanan">Jenis Pelayanan</label>
							<input type="text" class="form-control" value="0901R001" name="jns_pelayanan">
						</div>

						<div class="form-group col-md-3">
							<label for="catatan">Catatan</label>
							<input type="text" class="form-control" value="testing" name="catatan">
						</div>

						<div class="form-group col-md-3">
							<label for="diagnosa">Diagnosa</label>
							<input type="text" class="form-control" value="testing" name="diagnosa">
						</div>

						<div class="form-group col-md-3">
							<label for="tipe_rujukan">Tipe Rujukan</label>
							<input type="text" class="form-control" value="0" name="tipe_rujukan">
						</div>

						<div class="form-group col-md-3">
							<label for="poli_rujukan">Tipe Rujukan</label>
							<input type="text" class="form-control" value="017" name="poli_rujukan">
						</div>

						<input type="hidden" class="form-control" value="2206" name="id_user_inputer">

						<div class="form-group col-md-12">
							<label for="submit">&nbsp;</label>
							<button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i class="fa fa-paper-plane"></i></button>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Delete Rujukan -->
	<div class="tab-pane fade" id="pills-delete-rujukan" role="tabpanel" aria-labelledby="pills-delete-rujukan-tab">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?= site_url('bpjs/C_rujukan/deleteRujukan') ?>" id="form_delete_rujukan">
					<div class="form-row">
						<div class="form-group col-md-3">
							<label for="tgl_rujukan">Nomor Rujukan</label>
							<input type="text" class="form-control" name="no_rujukan" value="2101R0011221V000053">
						</div>

						<input type="hidden" class="form-control" value="2206" name="id_user_inputer">

						<div class="form-group col-md-12">
							<label for="submit">&nbsp;</label>
							<button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i class="fa fa-paper-plane"></i></button>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Get Rujukan -->
	<div class="tab-pane fade" id="pills-get-rujukan" role="tabpanel" aria-labelledby="pills-get-rujukan-tab">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?= site_url('bpjs/C_rujukan/getRujukan') ?>" id="form_get_rujukan">
					<div class="form-row">

						<div class="form-group col-md-4">
							<label for="inputEmail4">Tipe Pencarian</label>
							<select name="tipe_pencarian" id="tipe_pencarian" class="form-control">
								<option value="1">By No. Kartu</option>
								<option value="2">By No. Rujukan</option>
							</select>
						</div>

						<div class="form-group col-md-4">
							<label for="inputEmail4">Faskes Tingkat</label>
							<select name="faskes" class="form-control">
								<option value="1">Faskes Tingkat 1</option>
								<option value="2">Faskes Tingkat 2</option>
							</select>
						</div>

						<div class="form-group col-md-3" id="div_noka">
							<label for="nokartu">Nomor Kartu</label>
							<input type="text" class="form-control" name="nokartu" value="0002064475326">
						</div>

						<div class="form-group col-md-3" id="div_norujuk" style="display: none;">
							<label for="nokartu">Nomor Rujukan</label>
							<input type="text" class="form-control" name="norujukan" value="2103R0081220B000013">
						</div>

						<script>
							$("#tipe_pencarian").change(function(e) {
								const tipe = $(this).val()
								if (tipe == 2) {
									$("#div_noka").hide()
									$("#div_norujuk").show()


								} else {
									$("#div_noka").show()
									$("#div_norujuk").hide()
								}

							})
						</script>

						<input type="hidden" class="form-control" value="2206" name="id_user_inputer">

						<div class="form-group col-md-12">
							<label for="submit">&nbsp;</label>
							<button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i class="fa fa-paper-plane"></i></button>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Get Rujukan Konsul -->
	<div class="tab-pane fade" id="pills-get-rujukan-konsul" role="tabpanel" aria-labelledby="pills-rujukan-konsul-tab">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?= site_url('bpjs/C_rujukan/getRujukanKonsul') ?>" id="form_get_rujukan_konsul">
					<div class="form-row">

						<div class="form-group col-md-4">
							<label for="inputEmail4">Faskes Tingkat</label>
							<select name="tujuan_kunjungan" class="form-control">
								<option value="1">Faskes Tingkat 1</option>
								<option value="2">Faskes Tingkat 2</option>
							</select>
						</div>

						<div class="form-group col-md-3">
							<label for="nokartu">Nomor Kartu</label>
							<input type="text" class="form-control" name="nokartu" value="0002057146446">
						</div>

						<input type="hidden" class="form-control" value="2206" name="id_user_inputer">

						<div class="form-group col-md-12">
							<label for="submit">&nbsp;</label>
							<button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i class="fa fa-paper-plane"></i></button>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Create Rujukan Khusus -->
	<div class="tab-pane fade" id="pills-create-rujukan-khusus" role="tabpanel" aria-labelledby="pills-create-rujukan-khusus-tab">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?= site_url('bpjs/C_rujukan/createRujukanKhusus') ?>" id="form_create_rujukan_konsul">
					<div class="form-row">
						<div class="form-group col-md-3">
							<label for="no_rujukan">Nomor Rujukan</label>
							<input type="text" class="form-control" name="no_rujukan" value="0301U0331019P003283">
						</div>

						<div class="form-group col-md-3">
							<label for="diagnosa">Diagnosa</label>
							<input type="text" class="form-control" name="diagnosa" value="N18">
						</div>

						<div class="form-group col-md-3">
							<label for="procedure">Procedure</label>
							<input type="text" class="form-control" name="procedure" value="39.95">
						</div>

						<input type="hidden" class="form-control" value="2206" name="id_user_inputer">

						<div class="form-group col-md-12">
							<label for="submit">&nbsp;</label>
							<button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i class="fa fa-paper-plane"></i></button>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Create Rujukan Prb -->
	<div class="tab-pane fade" id="pills-create-rujukan-prb" role="tabpanel" aria-labelledby="pills-create-rujukan-prb-tab">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?= site_url('bpjs/C_rujukan/createRujukanPrb') ?>" id="form_create_rujukan_prb">
					<input type="hidden" class="form-control" id="table_obat_prb" name="table_obat_prb">

					<div class="form-row">
						<div class="form-group col-md-4">
							<label for="no_sep">Nomor SEP</label>
							<input type="text" class="form-control" name="no_sep" value="0301U0331019P003283">
						</div>

						<div class="form-group col-md-4">
							<label for="no_kartu">No Kartu</label>
							<input type="text" class="form-control" name="no_kartu" value="0002064475326">
						</div>

						<div class="form-group col-md-4">
							<label for="email">Email</label>
							<input type="text" class="form-control" name="email" value="test@gmail.com">
						</div>

						<div class="form-group col-md-12">
							<label for="alamat">Alamat</label>
							<input type="text" class="form-control" name="alamat" value="test alamat">
						</div>

						<div class="form-group col-md-4">
							<label for="program_prb">Program PRB</label>
							<select name="program_prb" class="form-control">
								<?php foreach ($program_prb as $prb) : ?>
									<option value="<?= $prb['kode'] ?>"><?= $prb['nama'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class=" form-row col-lg-4">
							<div class="form-group col-md-10">
								<label for="kd_dpjp">Kode DPJP</label>
								<input type="text" class="form-control" id="dpjpLayan" name="kode_dpjp" value="27590">
							</div>
							<div class="form-group col-md-2">
								<label for="inputPassword4">&nbsp;</label><br>
								<button type="button" class="btn btn-sm btn-secondary btn_cri_dokter" style="display: show;" data-toggle="modal" data-target="#modalDokter"><i class="fa fa-users"></i></button>
							</div>
						</div>

						<div class="form-group col-md-4">
							<label for="keterangan">Keterangan</label>
							<input type="text" class="form-control" name="keterangan" value="Kecapekan kerja">
						</div>

						<div class="form-group col-md-12">
							<label for="saran">Saran</label>
							<input type="text" class="form-control" name="saran" value="Pasien harus olahraga bersama setiap minggu dan cuti, edukasi agar jangan disuruh kerja terus, lama lama stress.">
						</div>

						<div class="row col-md-12">
							<div class="form-group col-md-5">
								<label for="kdObat">Nama Obat</label>
								<select class="form-control pilih_obat" id="obatPrb" style="width: 100%"></select>
							</div>
							<div class="form-group col-md-2">
								<label for="signa1">Signa 1</label>
								<input type="text" class="form-control signa1" value="2">
							</div>
							<div class="form-group col-md-2">
								<label for="signa2">Signa 2</label>
								<input type="text" class="form-control signa2" value="1">
							</div>
							<div class="form-group col-md-2">
								<label for="jmlObat">Jumlah Obat</label>
								<input type="text" class="form-control jmlObat" value="2">
							</div>
							<div class="col-md-1">
								<button type="button" class="btn btn-primary" style="margin-top : 30px" id="tambah_obat_prb">
									<i class="fa fa-plus"></i></button>
							</div>
							<div class="col-md-12 table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Obat</th>
											<th>Signa 1</th>
											<th>Signa 2</th>
											<th>Jumlah Obat</th>
											<th>Opsi</th>
										</tr>
									</thead>
									<tbody id="body-table-prb"></tbody>
								</table>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="submit">&nbsp;</label>
							<button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i class="fa fa-paper-plane"></i></button>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		$('#obatPrb').select2Ajax({
			url: '/bpjs/C_referensi/getRefObatprb'
		})
	</script>

	<!-- Get Rujukan Khusus -->
	<div class="tab-pane fade" id="pills-get-rujukan-khusus" role="tabpanel" aria-labelledby="pills-get-rujukan-khusus-tab">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?= site_url('bpjs/C_rujukan/getRujukanKhusus') ?>" id="form_get_rujukan_khusus">
					<div class="form-row">

						<div class="form-group col-md-4">
							<label for="inputEmail4">Bulan</label>
							<select name="bulan" class="form-control">
								<option value="1">Januari</option>
								<option value="2">Februari</option>
								<option value="3">Maret</option>
								<option value="4">April</option>
								<option value="5">Mei</option>
								<option value="6">Juni</option>
								<option value="7">July</option>
								<option value="8">Agustus</option>
								<option value="9">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
						</div>

						<div class="form-group col-md-3">
							<label for="no_rujukan">Tahun</label>
							<select name="tahun" class="form-control">
								<option value="2020">2020</option>
								<option value="2021">2021</option>
								<option value="2021">2022</option>
							</select>
						</div>

						<input type="hidden" class="form-control" value="2206" name="id_user_inputer">

						<div class="form-group col-md-12">
							<label for="submit">&nbsp;</label>
							<button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i class="fa fa-paper-plane"></i></button>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Get Spesialistik Rujukan -->
	<div class="tab-pane fade" id="pills-get-spesialistik-rujukan" role="tabpanel" aria-labelledby="pills-get-spesialistik-rujukan-tab">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?= site_url('bpjs/C_rujukan/getSpesialistikRujukan') ?>" id="form_get_spesialistik_rujukan">
					<div class="form-row">

						<input type="hidden" class="form-control" value="2206" name="id_user_inputer">

						<div class="form-group col-md-12">
							<label for="submit">&nbsp;</label>
							<button type="submit" class="btn btn-primary btn-sm btn_submit_noka">Load Spesialistik Rujukan <i class="fa fa-paper-plane"></i></button>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Get Spesialistik Sarana -->
	<div class="tab-pane fade" id="pills-get-spesialistik-sarana" role="tabpanel" aria-labelledby="pills-get-spesialistik-sarana-tab">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?= site_url('bpjs/C_rujukan/getSpesialistikSarana') ?>" id="form_get_spesialistik_sarana">
					<div class="form-row">

						<input type="hidden" class="form-control" value="2206" name="id_user_inputer">

						<div class="form-group col-md-12">
							<label for="submit">&nbsp;</label>
							<button type="submit" class="btn btn-primary btn-sm btn_submit_noka">Load Spesialistik Sarana <i class="fa fa-paper-plane"></i></button>
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

				<div id="hasil_kepesertaan" style="display: none;">
					<div class="row">
						<div class="col-lg-4">
							<ul class="list-group">
								<li class="list-group-item"> <strong>Asal Faskes :</strong>
									<div id="asalFaskess"></div>
								</li>

								<li class="list-group-item"> <strong>Rujukan Pelayanan :</strong>
									<div id="rujukanPelayanan"></div>
								</li>

								<li class="list-group-item"> <strong>Keluhan</strong> : <div id="keluhan"></div>
								</li>
								<li class="list-group-item"> <strong>Diagnosa :</strong>
									<div id="diagnosa"></div>
								</li>

								<li class="list-group-item"> <strong>Nomor Kunjungan :</strong>
									<div id="noKunjungan"></div>
								</li>
								<li class="list-group-item"> <strong>Poli Rujukan :</strong>
									<div id="poliRujukan"></div>
								</li>
								<li class="list-group-item"> <strong>Prov Perujuk :</strong>
									<div id="provPerujuk"></div>
								</li>

								<li class="list-group-item"> <strong>Tanggal Kunjungan :</strong>
									<div id="tanggalKunjungan"></div>
								</li>
							</ul>
						</div>
						<div class="col-lg-4">
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
						<div class="col-lg-4">
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

				<div id="hasil_list_spesialistik_sarana" style="display: none;">
					<div class="row">
						<div class="col-lg-6">
							<ul class="list-group" id="container_list_spesialistik_sarana">
								<li class="list-group-item"> <strong>No Kartu :</strong>
									<div id="noKartu"></div>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div id="hasil_list_spesialistik_rujukan" style="display: none;">
					<div class="row">
						<div class="col-lg-6">
							<ul class="list-group" id="container_list_spesialistik_rujukan">
								<li class="list-group-item"> <strong>No Kartu :</strong>
									<div id="noKartu"></div>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<div id="hasil_rujukan_prb" style="display: none;">
					<div class="row">
						<div class="col-lg-6">
							<ul class="list-group">
								<li class="list-group-item"> <strong>Nama Peserta :</strong>
									<div id="nmPesertaPrb"></div>
								</li>
								<li class="list-group-item"> <strong>alamat :</strong>
									<div id="alamatPrb"></div>
								</li>
								<li class="list-group-item"> <strong>No Kartu</strong> :
									<div id="noKartuPrb"></div>
								</li>
								<li class="list-group-item"> <strong>No Telp :</strong>
									<div id="noTelpPrb"></div>
								</li>
								<li class="list-group-item"> <strong>Tanggal Lahir :</strong>
									<div id="tglLahirPrb"></div>
								</li>
								<li class="list-group-item"> <strong>Asal Faskes :</strong>
									<div id="asalfaskesPrb"></div>
								</li>
							</ul>
						</div>
						<div class="col-lg-6">
							<ul class="list-group">
								<li class="list-group-item"> <strong>Dpjp :</strong>
									<div id="dpjpPrb"></div>
								</li>
								<li class="list-group-item"> <strong>No SRB :</strong>
									<div id="noSrbPrb"></div>
								</li>
								<li class="list-group-item"> <strong>Program PRB</strong> : <div id="programPrb"></div>
								</li>
								<li class="list-group-item"> <strong>Saran :</strong>
									<div id="saranPrb"></div>
								</li>

								<li class="list-group-item"> <strong>Tanggal SRB :</strong>
									<div id="tglSrbPrb"></div>
								</li>
							</ul>
						</div>
						<div class="col-lg-12 mt-4">
							<ul class="list-group">
								<li class="list-group-item"> <strong>List Obat :</strong>
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Obat</th>
													<th>Signa</th>
													<th>Jumlah Obat</th>
												</tr>
											</thead>
											<tbody id="tbodyTampilObatPrb"></tbody>
										</table>
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
							<label for="a">Tanggal Pelayanan</label>
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
	$(".nav-link").click(function() {
		$("#err_msg").html("");
		$("#div_result").hide()
		$("#loader").hide()
	})

	$("#form_insert_rujukan").submit(function(e) {
		e.preventDefault()
		$(".form_insert_rujukan").hide()
		$("#loader").show()
		$("#err_msg").html("");
		$("#div_result").hide()
		$("#hasil_list_spesialistik_sarana").hide()
		$("#hasil_list_spesialistik_rujukan").hide()

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

				if (response.msg.response) {
					const peserta = response.msg.response
					console.log(peserta)
					$("#hasil_kepesertaan").show()
				}


			} else {
				$("#response_title").html("Gagal <i class='fa fa-times '></i>");
				$("#response_title").addClass("badge-danger");
				$("#response_title").removeClass("badge-success");

				$("#err_msg").html(response.msg.metaData.message);
				$("#hasil_kepesertaan").hide()
			}
		})
	})

	$("#form_update_rujukan").submit(function(e) {
		e.preventDefault()
		$(".form_insert_rujukan").hide()
		$("#loader").show()
		$("#err_msg").html("");
		$("#div_result").hide()
		$("#hasil_list_spesialistik_sarana").hide()
		$("#hasil_list_spesialistik_rujukan").hide()

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

				if (response.msg.response) {
					const peserta = response.msg.response
					console.log(peserta)
					$("#hasil_kepesertaan").show()
				}
			} else {
				$("#response_title").html("Gagal <i class='fa fa-times '></i>");
				$("#response_title").addClass("badge-danger");
				$("#response_title").removeClass("badge-success");

				$("#err_msg").html(response.msg.metaData.message);
				$("#hasil_kepesertaan").hide()
			}
		})
	})

	$("#form_delete_rujukan").submit(function(e) {
		e.preventDefault()
		$(".form_insert_rujukan").hide()
		$("#loader").show()
		$("#err_msg").html("");
		$("#div_result").hide()
		$("#hasil_list_spesialistik_sarana").hide()
		$("#hasil_list_spesialistik_rujukan").hide()

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

				if (response.msg.response) {
					const peserta = response.msg.response
					console.log(peserta)
					$("#hasil_kepesertaan").show()
				}
			} else {
				$("#response_title").html("Gagal <i class='fa fa-times '></i>");
				$("#response_title").addClass("badge-danger");
				$("#response_title").removeClass("badge-success");

				$("#err_msg").html(response.msg.metaData.message);
				$("#hasil_kepesertaan").hide()
			}
		})
	})

	$("#form_get_rujukan").submit(function(e) {
		e.preventDefault()
		$(".form_insert_rujukan").hide()
		$("#loader").show()
		$("#err_msg").html("");
		$("#div_result").hide()
		$("#hasil_list_spesialistik_sarana").hide()
		$("#hasil_list_spesialistik_rujukan").hide()

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

				if (response.msg.response) {
					const res = response.msg.response
					console.log({
						res
					})
					const peserta = res.rujukan.peserta;
					const asalFaskes = res.asalFaskes;
					updateViewDetail(peserta, res.rujukan, asalFaskes);
					$("#hasil_kepesertaan").show()
				}
			} else {
				$("#response_title").html("Gagal <i class='fa fa-times '></i>");
				$("#response_title").addClass("badge-danger");
				$("#response_title").removeClass("badge-success");

				$("#err_msg").html(response.msg.metaData.message);
				$("#hasil_kepesertaan").hide()
			}
		})
	})

	$("#form_get_rujukan_konsul").submit(function(e) {
		e.preventDefault()
		$(".form_insert_rujukan").hide()
		$("#loader").show()
		$("#err_msg").html("");
		$("#div_result").hide()
		$("#hasil_list_spesialistik_sarana").hide()
		$("#hasil_list_spesialistik_rujukan").hide()

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

				if (response.msg.response) {
					const peserta = response.msg.response
					console.log(peserta)
					$("#hasil_kepesertaan").show()
				}
			} else {
				$("#response_title").html("Gagal <i class='fa fa-times '></i>");
				$("#response_title").addClass("badge-danger");
				$("#response_title").removeClass("badge-success");

				$("#err_msg").html(response.msg.metaData.message);
				$("#hasil_kepesertaan").hide()
			}
		})
	})

	$("#form_create_rujukan_konsul").submit(function(e) {
		e.preventDefault()
		$(".form_insert_rujukan").hide()
		$("#loader").show()
		$("#err_msg").html("");
		$("#div_result").hide()
		$("#hasil_list_spesialistik_sarana").hide()
		$("#hasil_list_spesialistik_rujukan").hide()

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

				if (response.msg.response) {
					const peserta = response.msg.response
					console.log(peserta)
					$("#hasil_kepesertaan").show()
				}
			} else {
				$("#response_title").html("Gagal <i class='fa fa-times '></i>");
				$("#response_title").addClass("badge-danger");
				$("#response_title").removeClass("badge-success");

				$("#err_msg").html(response.msg.metaData.message);
				$("#hasil_kepesertaan").hide()
			}
		})
	})

	$("#form_get_rujukan_khusus").submit(function(e) {
		e.preventDefault()
		$(".form_insert_rujukan").hide()
		$("#loader").show()
		$("#err_msg").html("");
		$("#div_result").hide()
		$("#hasil_list_spesialistik_sarana").hide()
		$("#hasil_list_spesialistik_rujukan").hide()

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

				if (response.msg.response) {
					const peserta = response.msg.response
					console.log(peserta)
					$("#hasil_kepesertaan").show()
				}
			} else {
				$("#response_title").html("Gagal <i class='fa fa-times '></i>");
				$("#response_title").addClass("badge-danger");
				$("#response_title").removeClass("badge-success");

				$("#err_msg").html(response.msg.metaData.message);
				$("#hasil_kepesertaan").hide()
			}
		})
	})

	$("#form_create_rujukan_prb").submit(function(e) {
		e.preventDefault()
		$(".form_insert_rujukan").hide()
		$("#loader").show()
		$("#err_msg").html("");
		$("#div_result").hide()
		$("#hasil_list_spesialistik_sarana").hide()
		$("#hasil_list_spesialistik_rujukan").hide()
		$("#hasil_rujukan_prb").hide()

		const datasubmit = $(this).serialize()
		const urlsubmit = $(this).attr('action')

		$.post(urlsubmit, datasubmit, function(cb) {
			$(".btn_submit_noka").show()
			$("#loader").hide()
			$("#div_result").show()
			const response = JSON.parse(cb)
			console.log(response)

			if (response.msg.response.metaData.code == 200) {
				$("#response_title").addClass("badge-success");
				$("#response_title").removeClass("badge-danger");
				$("#response_title").html("Sukses <i class='fa fa-check '></i>");
				$("#hasil_rujukan_prb").show()

				const resData = response.msg.response.response
				$("#nmPesertaPrb").html(resData.peserta.nama);
				$("#alamatPrb").html(resData.peserta.alamat);
				$("#noKartuPrb").html(resData.peserta.noKartu);
				$("#noTelpPrb").html(resData.peserta.noTelepon);
				$("#tglLahirPrb").html(resData.peserta.tglLahir);
				$("#asalfaskesPrb").html(resData.peserta.asalFaskes.nama);

				$("#dpjpPrb").html(resData.DPJP.nama);
				$("#noSrbPrb").html(resData.noSRB);
				$("#programPrb").html(resData.programPRB);
				$("#saranPrb").html(resData.saran);
				$("#tglSrbPrb").html(resData.tglSRB);

				const obat = resData.obat.list
				$('#tbodyTampilObatPrb').html('');
				if (obat.length > 0) {
					let no = 1;
					$.each(obat, function(i, item) {
						$('#tbodyTampilObatPrb').append(
							'<tr>' +
							'<td>' + no + '</td>' +
							'<td>' + obat[i].nmObat + '</td>' +
							'<td>' + obat[i].signa + '</td>' +
							'<td>' + obat[i].jmlObat + '</td>' +
							'</tr>'
						)
						no++;
					});
				} else {
					$('#tbodyTampilObatPrb').html('<tr><td colspan="9">Tidak Ada Data</td></tr>');
				}

			} else {
				$("#response_title").html("Gagal <i class='fa fa-times '></i>");
				$("#response_title").addClass("badge-danger");
				$("#response_title").removeClass("badge-success");

				$("#err_msg").html(response.msg.response.metaData.message);
				$("#hasil_rujukan_prb").hide()
			}
		})
	})

	$("#form_get_spesialistik_rujukan").submit(function(e) {
		e.preventDefault()
		$(".form_insert_rujukan").hide()
		$("#loader").show()
		$("#err_msg").html("");
		$("#div_result").hide()
		$("#hasil_list_spesialistik_sarana").hide()
		$("#hasil_list_spesialistik_rujukan").hide()
		$("#hasil_kepesertaan").hide()

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

				if (response.msg.response) {
					const peserta = response.msg.response
					console.log(peserta.list)

					const listFragment = (li) => {
						const f = `
							<li class="list-group-item">
								<div style="display: flex; justify-content: space-between"><span>Kode Spesialis:</span> <span>${li.kodeSpesialis} </span></div>
								<div style="display: flex; justify-content: space-between"><span>Nama Spesialis:</span> <span>${li.namaSpesialis} </span></div>
								<div style="display: flex; justify-content: space-between"><span>Jumlah Rujukan:</span> <span>${li.jumlahRujukan} </span></div>
								<div style="display: flex; justify-content: space-between"><span>Kapasitas:</span> <span>${li.kapasitas} </span></div>
								<div style="display: flex; justify-content: space-between"><span>Presentase:</span> <span>${li.persentase} </span></div>
							</li>
						`;
						// console.log(f);
						return f;
					}

					let listPesertaElements = [];

					peserta.list.forEach((l) => {
						listPesertaElements.push(listFragment(l));
					})

					const joinFragment = listPesertaElements.join("");

					$("#container_list_spesialistik_rujukan").html(joinFragment);

					$("#hasil_list_spesialistik_rujukan").show()
				}
			} else {
				$("#response_title").html("Gagal <i class='fa fa-times '></i>");
				$("#response_title").addClass("badge-danger");
				$("#response_title").removeClass("badge-success");

				$("#err_msg").html(response.msg.metaData.message);
				$("#hasil_list_spesialistik_rujukan").hide()
			}
		})
	})

	$("#form_get_spesialistik_sarana").submit(function(e) {
		e.preventDefault()
		$(".form_insert_rujukan").hide()
		$("#loader").show()
		$("#err_msg").html("");
		$("#div_result").hide()
		$("#hasil_list_spesialistik_sarana").hide()
		$("#hasil_list_spesialistik_rujukan").hide()
		$("#hasil_kepesertaan").hide()

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

				if (response.msg.response) {
					const peserta = response.msg.response
					console.log(peserta)

					const listFragment = (li) => {
						const f = `
							<li class="list-group-item">
								<div style="display: flex; justify-content: space-between"><span>Kode Sarana</span> <span>${li.kodeSarana} </span></div>
								<div style="display: flex; justify-content: space-between"><span>Nama Sarana:</span> <span>${li.namaSarana} </span></div>
							</li>
						`;
						// console.log(f);
						return f;
					}

					let listPesertaElements = [];

					peserta.list.forEach((l) => {
						listPesertaElements.push(listFragment(l));
					})

					const joinFragment = listPesertaElements.join("");

					$("#container_list_spesialistik_sarana").html(joinFragment);

					$("#hasil_list_spesialistik_sarana").show()
				}
			} else {
				$("#response_title").html("Gagal <i class='fa fa-times '></i>");
				$("#response_title").addClass("badge-danger");
				$("#response_title").removeClass("badge-success");

				$("#err_msg").html(response.msg.metaData.message);
				$("#hasil_list_spesialistik_sarana").hide()
			}
		})
	})
</script>

<script>
	function updateViewDetail(peserta = "", rujukan = "", asalFaskes = "") {
		$("#noKartu").html(peserta.noKartu)
		$("#nik").html(peserta.nik)
		$("#nama_peserta").html(peserta.nama)
		$("#hakKelas").html(peserta.hakKelas.keterangan)
		$("#sex").html((peserta.sex == "P") ? "Perempuan" : "Laki-laki")
		$("#statusPeserta").html(peserta.statusPeserta.keterangan)

		if (peserta.statusPeserta.keterangan == "AKTIF") {
			$("#statusPeserta").addClass("alert-success");
			$("#statusPeserta").removeClass("alert-danger");

		} else {
			$("#statusPeserta").addClass("alert-danger");
			$("#statusPeserta").removeClass("alert-success");
		}

		$("#asalFaskess").html(asalFaskes == "1" ? "Faskes Tingkat 1" : "Faskes Tingkat 2");
		$("#rujukanPelayanan").html(rujukan.pelayanan.nama)
		$("#keluhan").html(rujukan.keluhan)
		$("#diagnosa").html(`${rujukan.diagnosa.kode} ${rujukan.diagnosa.nama}`)
		$("#noKunjungan").html(`${rujukan.noKunjungan}`)
		$("#poliRujukan").html(`${rujukan.poliRujukan.kode} ${rujukan.poliRujukan.nama}`)
		$("#provPerujuk").html(`${rujukan.provPerujuk.kode} ${rujukan.provPerujuk.nama}`)
		$("#tanggalKunjungan").html(`${rujukan.tglKunjungan}`)

		$("#tglLahir").html(peserta.tglLahir)
		$("#umur").html(peserta.umur.umurSekarang)
		$("#noMR").html(peserta.mr.noMR)


		$("#noTelepon").html(peserta.mr.noTelepon)


		$("#nmAsuransi").html(peserta.cob.nmAsuransi)
		$("#noAsuransi").html(peserta.cob.noAsuransi)
		$("#tglTAT").html(peserta.cob.tglTAT)
		$("#tglTMT").html(peserta.cob.tglTMT)

		$("#dinsos").html(peserta.informasi.dinsos)
		$("#noSKTM").html(peserta.informasi.noSKTM)
		$("#prolanisPRB").html(peserta.informasi.tglTMT)

		$("#jenisPeserta").html(peserta.jenisPeserta.keterangan)
		$("#provUmum").html(peserta.provUmum.nmProvider)
	}
</script>

<script>
	window.listObatPrb = [];

	function GenerateTablePrb() {

		document.getElementById("body-table-prb").innerHTML = "";

		let tableLayout = "";
		let no = 1;
		window.listObatPrb.forEach((x, index) => {
			console.log(x)
			tableLayout += `
		<tr>
			<td>${no++}</td>
			<td>${x.kdObat} - ${x.obat}</td>
			<td>${x.signa1}</td>
			<td>${x.signa2}</td>
			<td>${x.jumlahObat}</td>
			<td><button type="button" class="btn btn-danger btn-sm" onclick="hapusRiwayatObatPrb(${index})">Hapus</button></td>
		<tr>
	`
		})
		document.getElementById("body-table-prb").insertAdjacentHTML('afterbegin', tableLayout);
		$("#table_obat_prb").val(btoa(JSON.stringify(window.listObatPrb)))
	}

	$("#tambah_obat_prb").unbind().on('click', function() {
		let obat = $(".pilih_obat").find("option:selected").text();
		let kdObat = $(".pilih_obat").find("option:selected").val();
		let signa1 = $(".signa1").val();
		let signa2 = $(".signa2").val();
		let jumlahObat = $(".jmlObat").val();


		if ($(".pilih_obat").find("option:selected").text() == '') {
			customAlert(`Pilih <b>Obat</b> terlebih dahulu`)
			return false;
		}

		window.listObatPrb.push({
			obat: obat,
			kdObat: kdObat,
			signa1: signa1,
			signa2: signa2,
			jumlahObat: jumlahObat,
		});
		GenerateTablePrb();
	})

	function hapusRiwayatObatPrb(id) {
		let ln = listObatPrb.filter((x, index) => index !== id);
		window.listObatPrb = ln;
		GenerateTablePrb();
	}
</script>

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