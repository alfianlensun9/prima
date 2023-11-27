<div class="row">
	<div class="col-12">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
				<li class="breadcrumb-item " aria-current="page"><a href="<?= base_url('sdm/C_nav') ?>">SDM</a></li>
				<li class="breadcrumb-item active" aria-current="page">Jadwal</li>
			</ol>
		</nav>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">

				<?php if ($this->session->flashdata('msg')) : ?>
					<span class="badge badge-warning badge-lg" id="response_title" style="margin-bottom: 20px;">
						<?= $this->session->flashdata('msg'); ?>
					</span>
				<?php endif; ?>
				<form method="POST" action="<?= site_url('sdm/C_jadwal/createJadwal') ?>">
					<h4>Unit Kerja</h4>
					<hr />
					<div class="form-row">
						<div class="form-group col-md-3">
							<label for="inputEmail4">Jam Kerja</label>
							<select name="id_mst_jam_kerja" class="form-control">
								<?php foreach ($jamKerja as $jam) : ?>
									<option value="<?= $jam->id_mst_jam_kerja ?>"><strong><?= $jam->nm_mst_jam_kerja ?></strong> | Masuk: <?= $jam->jam_masuk ?> Pulang: <?= $jam->jam_pulang ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label for="inputEmail4">Unit Ruangan</label>
							<select name="id_mst_unit" id="id_mst_unit" class="form-control">
								<?php foreach ($unitRuangan as $unit) : ?>
									<option value="<?= $unit->id_mst_unit ?>"><?= $unit->nm_mst_unit ?></option>
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
							<button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i class="fa fa-paper-plane"></i></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table tablesorter dtTableThis" id="">
						<thead class=" text-primary">
							<tr>
								<th>Nama Pegawai</th>
								<th>NIP</th>
								<th>Unit</th>
								<th>Jenis Kelamin</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($listPegawai as $pegawai) :  ?>
								<tr>
									<td><?= $pegawai->nm_pegawai; ?></td>
									<td><?= $pegawai->nip; ?></td>
									<td><?= $pegawai->nm_mst_unit; ?></td>
									<td><?= $pegawai->jenis_kelamin == 1 ? "Laki-Laki" : "Perempuan"; ?></td>
									<td>
										<a data-toggle="modal" data-target="#modalView" class="btn btn-secondary btn-sm btn_jdwl" id="<?= $pegawai->id_trx_kepegawaian ?>" nm_pegawai="<?= $pegawai->nm_pegawai ?>" href="#"><i class="fa fa-calendar "></i> Set Jadwal</a>
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

<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="modalUnitKerjaEdit" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="nmPegawai">Set Jadwal</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="card-body">

						<?php if ($this->session->flashdata('msg')) : ?>
							<span class="badge badge-warning badge-lg" id="response_title" style="margin-bottom: 20px;">
								<?= $this->session->flashdata('msg'); ?>
							</span>
						<?php endif; ?>

						<form method="POST" action="<?= site_url('sdm/C_jadwal/createJadwalByIDAuth') ?>" id="form_create_jadwal">
							<h4 id="modal_nm_pegawai"></h4>
							<hr />
							<input type="hidden" class="form-control" name="id_trx_kepegawaian" id="modal_id_trx_kepegawaian">
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="inputEmail4">Jam Kerja</label>
									<select name="id_mst_jam_kerja" class="form-control">
										<?php foreach ($jamKerja as $jam) : ?>
											<option value="<?= $jam->id_mst_jam_kerja ?>"><strong><?= $jam->nm_mst_jam_kerja ?></strong> | Masuk: <?= $jam->jam_masuk ?> Pulang: <?= $jam->jam_pulang ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="form-group col-md-4">
									<label for="tanggal_awal">Tanggal Awal</label>
									<input type="date" class="form-control" name="tanggal_awal" required>
								</div>

								<div class="form-group col-md-4">
									<label for="tanggal_akhir">Tanggal Akhir</label>
									<input type="date" class="form-control" name="tanggal_akhir" required>
								</div>

								<div class="form-group col-md-12">
									<label for="submit">&nbsp;</label>
									<button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Submit <i class="fa fa-paper-plane"></i></button>
								</div>
							</div>
						</form>

						<div id="result_jadwal_after_create"></div>
						<div id="modal_tbl_jadwal"></div>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>

<script>
	$("#form_create_jadwal").submit(function(e) {
		e.preventDefault()
		$("#modal_tbl_jadwal").html(`<?php $this->load->view('v_loader') ?>`);
		$(".btn_submit_noka").hide()
		$("#result_absen_manual").html(`<?php $this->load->view('v_loader') ?>`);
		const url = $(this).attr('action')
		const data = $(this).serialize()
		$.post(url, data, function(cb) {
			const response = JSON.parse(cb);
			const idKepegawaian = $("#modal_id_trx_kepegawaian").val();
			$("#result_jadwal_after_create").html(``);
			$("#result_jadwal_after_create").append(response.data.info.msg)
			$("#modal_tbl_jadwal").load(`<?= site_url("sdm/C_jadwal/getTabelJadwalByIDKepegawaian/") ?>${idKepegawaian}`);
			$(".btn_submit_noka").show()
		})
	})

	$(".btn_jdwl").click(function(e) {
		e.preventDefault()
		const id = $(this).attr('id')
		const nm_pegawai = $(this).attr('nm_pegawai')
		$("#modal_nm_pegawai").html(nm_pegawai);
		$("#modal_id_trx_kepegawaian").val(id);
		$("#modal_tbl_jadwal").html(`<?php $this->load->view('v_loader') ?>`);
		$("#modal_tbl_jadwal").load(`<?= site_url("sdm/C_jadwal/getTabelJadwalByIDKepegawaian/") ?>${id}`);
	})
</script>