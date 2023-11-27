<div class="row">
	<div class="col-12">

		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
				<li class="breadcrumb-item " aria-current="page"><a href="<?= base_url('sdm/C_nav') ?>">SDM</a></li>
				<li class="breadcrumb-item " aria-current="page"><a href="<?= base_url('sdm/C_kepegawaian/viewListPegawai') ?>">Kepegawaian</a></li>
				<li class="breadcrumb-item active" aria-current="page">Tambah Pegawai</li>
			</ol>
		</nav>
	</div>
</div>



<?php if (!$pegawai['status']) : ?>
	<div class="card">
		<div class="card-body">
			<?= $pegawai['msg'] ?>
			<p><a class="btn btn-danger" href="<?= base_url("admin/C_admin") ?>">Tambah user dalam otentikasi</a></p>
		</div>
	</div>
<?php else : ?>

	<?php $pegawai = $pegawai['msg']; ?>

	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
		<li class="nav-item mb-2 mr-2">
			<a class="nav-link active" id="pills-update-pegawai-tab" data-toggle="pill" href="#pills-update-pegawai" role="tab" aria-controls="pills-update-pegawai" aria-selected="true">Update Pegawai</a>
		</li>

		<li class="nav-item mb-2 mr-2">
			<a class="nav-link" id="pills-update-jadwal-tab" data-toggle="pill" href="#pills-update-jadwal" role="tab" aria-controls="pills-update-jadwal" aria-selected="true">Update Jadwal Pegawai</a>
		</li>
	</ul>


	<div class="tab-content" id="pills-tabContent">

		<!-- Update Pegawai -->
		<div class="tab-pane fade show active" id="pills-update-pegawai" role="tabpanel" aria-labelledby="pills-update-pegawai-tab">
			<div class="card">
				<div class="card-body">
					<?php if ($this->session->flashdata('msg')) : ?>
						<span class="badge badge-warning badge-lg" id="response_title">
							<?= $this->session->flashdata('msg'); ?>
						</span>
					<?php endif; ?>

					<form method="POST" action="<?= site_url('sdm/C_kepegawaian/updatePegawai') ?>" id="form_update_rujukan">

						<h4>Data Diri</h4>
						<hr />
						<div class="form-row">

							<input type="hidden" class="form-control" name="id_trx_kepegawaian" value="<?= $pegawai->id_trx_kepegawaian ?>" required>
							<div class="form-group col-md-3">
								<label for="nm_pegawai">Nama Pegawai</label>
								<input type="text" class="form-control" name="nm_pegawai" value="<?= $pegawai->nm_pegawai ?>" required>
							</div>

							<div class="form-group col-md-3">
								<label for="nip">NIP</label>
								<input type="text" class="form-control" name="nip" value="<?= $pegawai->nip ?>" required>
							</div>

							<div class="form-group col-md-3">
								<label for="jenis_kelamin">Jenis Kelamin</label>
								<select name="jenis_kelamin" class="form-control" required>
									<option value="1">Laki-Laki</option>
									<option value="2">Perempuan</option>
								</select>
							</div>

							<div class="form-group col-md-3">
								<label for="email">Email</label>
								<input type="text" class="form-control" name="email" value="<?= $pegawai->email ?>">
							</div>

							<div class="form-group col-md-3">
								<label for="no_tlp">Nomor Telepon</label>
								<input type="text" class="form-control" name="no_tlp" required value="<?= $pegawai->no_tlp ?>">
							</div>

							<div class="form-group col-md-3">
								<label for="tempat_lahir">Tempat Lahir</label>
								<input type="text" class="form-control" name="tempat_lahir" required value="<?= $pegawai->tempat_lahir ?>">
							</div>

							<input type="hidden" class="form-control" value="2206" name="id_user_inputer">
						</div>

						<h4>Data Kepegawaian</h4>
						<hr />

						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="id_mst_jenis_pegawai">Jenis Pegawai</label>
								<select name="id_mst_jenis_pegawai" class="form-control">
									<?php foreach ($listJenisPegawai as $jenis) : ?>
										<option value="<?= $jenis->id_mst_jenis_pegawai ?>" <?= $jenis->id_mst_jenis_pegawai == $pegawai->id_mst_jenis_pegawai ? "selected" : ""; ?>><?= $jenis->nm_mst_jenis_pegawai ?></option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="form-group col-md-3">
								<label for="id_mst_kategori">Kategori Pegawai</label>
								<select name="id_mst_kategori" class="form-control">
									<?php foreach ($listKategoriPegawai as $kategori) : ?>
										<option value="<?= $kategori->id_mst_kategori ?>" <?= $kategori->id_mst_kategori == $pegawai->id_mst_kategori ? "selected" : ""; ?>><?= $kategori->nm_mst_kategori ?></option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="form-group col-md-3">
								<label for="id_mst_golongan">Golongan</label>
								<select name="id_mst_golongan" class="form-control">
									<?php foreach ($listGolonganPegawai as $golongan) : ?>
										<option value="<?= $golongan->id_mst_golongan ?>" <?= $golongan->id_mst_golongan == $pegawai->id_mst_golongan ? "selected" : ""; ?>><?= $golongan->nm_mst_golongan ?></option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="form-group col-md-3">
								<label for="id_mst_unit">Unit</label>
								<select name="id_mst_unit" class="form-control">
									<?php foreach ($listUnit as $unit) : ?>
										<option value="<?= $unit->id_mst_unit ?>" <?= $unit->id_mst_unit == $pegawai->id_mst_unit ? "selected" : ""; ?>><?= $unit->nm_mst_unit ?></option>
									<?php endforeach; ?>
								</select>
							</div>

						</div>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="gaji_pokok">Gaji Pokok</label>
								<input type="number" class="form-control" name="gaji_pokok" value="<?= $pegawai->gaji_pokok ?>">
							</div>
							<div class="form-group col-md-3">
								<label for="ptkp">Penghasilan Tidak Kena Pajak (PTKP)</label>
								<input type="number" class="form-control" name="ptkp" value="<?= $pegawai->ptkp ?>">
							</div>
							<div class="form-group col-md-3">
								<label for="nrk">Nomor Registrasi Kepegawaian (NRK)</label>
								<input type="number" class="form-control" name="nrk" value="<?= $pegawai->nrk ?>">
							</div>
							<div class="form-group col-md-3">
								<label for="tmt">Terhitung Mulai Tanggal (TMT)</label>
								<input type="date" class="form-control" name="tmt" value="<?= $pegawai->tmt ?>">
							</div>
							<div class="form-group col-md-3">
								<label for="no_str">Nomor Surat Tanda Registrasi (STR)</label>
								<input type="text" class="form-control" name="no_str" value="<?= $pegawai->no_str ?>">
							</div>
							<div class="form-group col-md-3">
								<label for="exp_str">Tanggal Kadaluarsa STR</label>
								<input type="date" class="form-control" name="exp_str" value="<?= $pegawai->exp_str ?>">
							</div>
							<div class="form-group col-md-3">
								<label for="no_sip">Nomor Surat Izin Praktek (SIP)</label>
								<input type="text" class="form-control" name="no_sip" value="<?= $pegawai->no_sip ?>">
							</div>
							<div class="form-group col-md-3">
								<label for="exp_sip">Tanggal Kadaluarsa SIP</label>
								<input type="date" class="form-control" name="exp_sip" value="<?= $pegawai->exp_sip ?>">
							</div>
							<div class="form-group col-md-12">
								<label for="submit">&nbsp;</label>
								<button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Update <i class="fa fa-paper-plane"></i></button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>

		<!-- Update Jadwal Pegawai -->
		<div class="tab-pane fade" id="pills-update-jadwal" role="tabpanel" aria-labelledby="pills-update-jadwal-tab">
			<div class="card">
				<div class="card-body">

					<form method="POST" action="<?= site_url('sdm/C_kepegawaian/createJadwalPegawai') ?>" id="form_update_rujukan">

						<h4>Jadwal</h4>
						<hr />
						<div class="form-row">
							<input type="hidden" class="form-control" name="id_trx_kepegawaian" value="<?= $pegawai->id_trx_kepegawaian ?>" required>
							<input type="hidden" class="form-control" name="id_auth_users" value="<?= $pegawai->id_auth_users ?>" required>

							<div class="form-group col-md-4">
								<label for="inputEmail4">Jam Kerja</label>
								<select name="id_mst_jam_kerja" class="form-control">
									<?php foreach ($jamKerja as $jam) : ?>
										<option value="<?= $jam->id_mst_jam_kerja ?>"><strong><?= $jam->nm_mst_jam_kerja ?></strong> | Masuk: <?= $jam->jam_masuk ?> Pulang: <?= $jam->jam_pulang ?></option>
									<?php endforeach; ?>
								</select>
							</div>

							<div class="form-group col-md-3">
								<label for="tanggal_awal">Tanggal Awal</label>
								<input type="date" class="form-control" name="tanggal_awal" required>
							</div>

							<div class="form-group col-md-3">
								<label for="tanggal_akhir">Tanggal Akhir</label>
								<input type="date" class="form-control" name="tanggal_akhir" required>
							</div>

							<div class="form-group col-md-12">
								<label for="submit">&nbsp;</label>
								<button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Update <i class="fa fa-paper-plane"></i></button>
							</div>
						</div>

					</form>
				</div>
			</div>

			<div id="modal_tbl_jadwal">
				<div class="row">
					<div class="col-lg-12">
						<div class="card-body">

							<div class="table-responsive">
								<table class="table tablesorter " id="">
									<thead class=" text-primary">
										<tr>
											<th>Tanggal</th>
											<th>Detail</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($listJadwal as $jadwal) : ?>
											<tr>
												<td><?= $jadwal->tanggal; ?></td>
												<td>
													<div>
														<?= $jadwal->mst_jam_kerja->nm_mst_jam_kerja; ?>
													</div>
													<div>
														Jam masuk: <?= $jadwal->mst_jam_kerja->jam_masuk ?>
													</div>
													<div>
														Jam masuk terhitung: <?= $jadwal->mst_jam_kerja->jam_masuk_terhitung; ?>
													</div>
													<div>
														Jam masuk terlambat: <?= $jadwal->mst_jam_kerja->jam_masuk_terlambat; ?>
													</div>
													<div>
														Jam pulang: <?= $jadwal->mst_jam_kerja->jam_pulang ?>
													</div>
													<div>
														Jam pulang terhitung: <?= $jadwal->mst_jam_kerja->jam_pulang_terhitung ?>
													</div>
												</td>
												<td>
													<a class="btn btn-primary btn_delete_jadwal" id_jadwal="<?= $jadwal->id_trx_jadwal_kerja ?>"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
<?php endif; ?>

<script>
	$(".btn_delete_jadwal").click(function(e) {
		e.preventDefault()
		const id = $(this).attr('id_jadwal')
		$("#modal_tbl_jadwal").html(`<?php $this->load->view('v_loader') ?>`);
		$.post("<?= base_url("sdm/C_jadwal/deleteJadwal/") ?>" + id, function(cb) {
			const response = JSON.parse(cb);
			console.log(response);
			$("#modal_tbl_jadwal").load(`<?= site_url("sdm/C_jadwal/getTabelJadwalByIDKepegawaian/") ?>${<?= $idKepegawaian ?>}`);
			// $(".btn_submit_noka").show()
		})
	})
</script>