<div class="row">
	<div class="col-12">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
				<li class="breadcrumb-item " aria-current="page"><a href="<?= base_url('master/C_nav') ?>">Master</a></li>
				<li class="breadcrumb-item active" aria-current="page">Jam kerja</li>
			</ol>
		</nav>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?= site_url('master/C_master/createMasterJamKerja') ?>">
					<h4>Unit Kerja</h4>
					<hr />

					<?php if ($this->session->flashdata('msg')) : ?>
						<span class="badge badge-warning badge-lg" id="response_title" style="margin-bottom: 20px;">
							<?= $this->session->flashdata('msg'); ?>
						</span>
					<?php endif; ?>
					<div class="form-row">
						<div class="form-group col-md-4">
							<label for="nm_mst_jam_kerja">Nama Jam Kerja</label>
							<input type="text" class="form-control" name="nm_mst_jam_kerja" required>
						</div>

						<div class="form-group col-md-4">
							<label for="jam_masuk">Jam Masuk</label>
							<input type="time" class="form-control" name="jam_masuk" required>
						</div>

						<div class="form-group col-md-4">
							<label for="jam_pulang">Jam Pulang</label>
							<input type="time" class="form-control" name="jam_pulang" required>
						</div>

						<div class="form-group col-md-4">
							<label for="jam_masuk_terhitung">Jam Masuk Terhitung</label>
							<input type="number" class="form-control" name="jam_masuk_terhitung" required>
						</div>

						<div class="form-group col-md-4">
							<label for="jam_pulang_terhitung">Jam Pulang Terhitung</label>
							<input type="number" class="form-control" name="jam_pulang_terhitung" required>
						</div>

						<div class="form-group col-md-4">
							<label for="jam_masuk_terlambat">Jam Masuk Terlambat</label>
							<input type="number" class="form-control" name="jam_masuk_terlambat" required>
						</div>

					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-sm">Simpan <i class="fa fa-paper-plane"></i></button>
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
								<th>Nama Jam Kerja</th>
								<th>Jam Masuk Terhitung</th>
								<th>Jam Masuk Terlambat</th>
								<th>Jam Masuk</th>
								<th>Jam Pulang</th>
								<th>Jam Pulang Terhitung</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($listJamKerja as $jamKerja) : ?>
								<tr>
									<td><?= $jamKerja->nm_mst_jam_kerja; ?></td>
									<td><?= $jamKerja->jam_masuk_terhitung; ?></td>
									<td><?= $jamKerja->jam_masuk_terlambat; ?></td>
									<td><?= $jamKerja->jam_masuk; ?></td>
									<td><?= $jamKerja->jam_pulang; ?></td>
									<td><?= $jamKerja->jam_pulang_terhitung; ?></td>
									<td>
										<a class="btn btn-secondary btn-sm btn_delete_jam_kerja" id="<?= $jamKerja->id_mst_jam_kerja ?>" nm_pegawai="<?= $jamKerja->id_mst_jam_kerja ?>" href="#"><i class="fa fa-trash "></i></a>
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
				<h3 class="modal-title" id="nmPegawai">Edit</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="card">
					<div class="card-body">
						<form method="POST" action="<?= site_url('sdm/C_kepegawaian/updateUnitKerja') ?>" id="form_edit_unit_kerja">
							<div class="form-row">

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

<script>
	$(".btn_delete_jam_kerja").click(function(e) {
		e.preventDefault()
		const conf = confirm("Apakah Anda yakin akan menghapus jam kerja?");
		if (conf) {
			const id = $(this).attr('id')
			$("#modal_tbl_jadwal").html(`<?php $this->load->view('v_loader') ?>`);
			$.post("<?= base_url("master/C_master/deleteJamKerja/") ?>" + id, function(cb) {
				const response = JSON.parse(cb);
				location.reload();
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