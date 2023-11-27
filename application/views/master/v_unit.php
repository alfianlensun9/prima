<div class="row">
	<div class="col-12">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
				<li class="breadcrumb-item " aria-current="page"><a href="<?= base_url('master/C_nav') ?>">Master</a></li>
				<li class="breadcrumb-item active" aria-current="page">Unit</li>
			</ol>
		</nav>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?= site_url('master/C_master/createMasterUnit') ?>">
					<h4>Unit Kerja</h4>
					<hr />
					<div class="form-row">
						<div class="form-group col-md-3">
							<label for="nm_unit">Nama Unit Kerja</label>
							<input type="text" class="form-control" name="nm_mst_unit" required>
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
					<table class="table tablesorter " id="">
						<thead class=" text-primary">
							<tr>
								<th>Nama Unit</th>
								<th>Option</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($listUnit as $unit) : ?>
								<tr>
									<td><?= $unit->nm_mst_unit; ?></td>
									<td>

										<a data-toggle="modal" data-target="#modalView" class="btn btn-secondary btn-sm btn_get_absen" id="<?= $unit->id_mst_unit ?>" nm_pegawai="<?= $unit->id_mst_unit ?>" href="#"><i class="fa fa-edit "></i> Edit</a>
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