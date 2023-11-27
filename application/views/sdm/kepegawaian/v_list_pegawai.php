<div class="row">
	<div class="col-12">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
				<li class="breadcrumb-item " aria-current="page"><a href="<?= base_url('sdm/C_nav') ?>">SDM</a></li>
				<li class="breadcrumb-item active" aria-current="page">List Kepegawaian</li>
			</ol>
		</nav>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<a href="/sdm/C_kepegawaian/viewAddPegawai" class="btn btn-fill btn-sm btn-primary">Tambah Pegawai</a>
		<button class="btn btn-fill btn-sm btn-secondary">Cetak Pegawai</button>
	</div>

	<div class="col-lg-12">
		<div class="card-body">
			<?php if ($this->session->flashdata('msg')) : ?>
				<span class="badge badge-warning badge-lg" id="response_title">
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
									<a class="btn btn-primary" href="<?= base_url("sdm/C_kepegawaian/viewEditPegawai/{$pegawai->id_trx_kepegawaian}") ?>"><i class="fa fa-edit"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>