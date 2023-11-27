<div class="card-body">

	<div class="table-responsive">
		<table class="table tablesorter " id="">
			<thead class=" text-primary">
				<tr>
					<th>Tanggal</th>
					<th>Nama Jam Kerja</th>
					<th>Jam Masuk</th>
					<th>Jam Pulang</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($listJadwal as $jadwal) : ?>
					<tr>
						<td><?= $jadwal->tanggal; ?></td>

						<td>
							<?= $jadwal->mst_jam_kerja->nm_mst_jam_kerja ?>
						</td>

						<td>
							<?= $jadwal->mst_jam_kerja->jam_masuk ?>
						</td>

						<td>
							<?= $jadwal->mst_jam_kerja->jam_pulang ?>
						</td>
						<td>
							<button class="btn btn-primary btn_delete_jadwal" id_jadwal="<?= $jadwal->id_trx_jadwal_kerja ?>"><i class="fa fa-trash"></i></button>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<script>
	$(".btn_delete_jadwal").click(function(e) {
		e.preventDefault()
		const conf = confirm("Apakah Anda yakin akan menghapus jadwal?");
		if (conf) {
			const id = $(this).attr('id_jadwal')
			$("#modal_tbl_jadwal").html(`<?php $this->load->view('v_loader') ?>`);
			$.post("<?= base_url("sdm/C_jadwal/deleteJadwal/") ?>" + id, function(cb) {
				const response = JSON.parse(cb);
				console.log(response);
				$("#modal_tbl_jadwal").load(`<?= site_url("sdm/C_jadwal/getTabelJadwalByIDKepegawaian/") ?>${<?= $idKepegawaian ?>}`);
				// $(".btn_submit_noka").show()
			})
		}

	})
</script>