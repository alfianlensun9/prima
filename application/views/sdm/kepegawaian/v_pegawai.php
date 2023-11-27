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

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<form method="POST" action="<?= site_url('sdm/C_kepegawaian/createPegawai') ?>" id="form_update_rujukan">
					<h4>Data Diri</h4>
					<hr />
					<div class="form-row">

						<div class="form-group col-md-3">
							<label for="nm_pegawai">Nama Pegawai</label>
							<input type="text" class="form-control" name="nm_pegawai" required>
						</div>

						<div class="form-group col-md-3">
							<label for="nip">NIP</label>
							<input type="text" class="form-control" name="nip" required>
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
							<input type="text" class="form-control" name="email">
						</div>

						<div class="form-group col-md-3">
							<label for="no_tlp">Nomor Telepon</label>
							<input type="text" class="form-control" name="no_tlp" required>
						</div>

						<div class="form-group col-md-3">
							<label for="tempat_lahir">Tempat Lahir</label>
							<input type="text" class="form-control" name="tempat_lahir" required>
						</div>

						<div class="form-group col-md-3">
							<label for="password">Password</label>
							<input type="password" class="form-control" name="password" required>
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
									<option value="<?= $jenis->id_mst_jenis_pegawai ?>"><?= $jenis->nm_mst_jenis_pegawai ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group col-md-3">
							<label for="id_mst_kategori">Kategori Pegawai</label>
							<select name="id_mst_kategori" class="form-control">
								<?php foreach ($listKategoriPegawai as $kategori) : ?>
									<option value="<?= $kategori->id_mst_kategori ?>"><?= $kategori->nm_mst_kategori ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group col-md-3">
							<label for="id_mst_golongan">Golongan</label>
							<select name="id_mst_golongan" class="form-control">
								<?php foreach ($listGolonganPegawai as $golongan) : ?>
									<option value="<?= $golongan->id_mst_golongan ?>"><?= $golongan->nm_mst_golongan ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group col-md-3">
							<label for="id_mst_unit">Unit</label>
							<select name="id_mst_unit" class="form-control">
								<?php foreach ($listUnit as $unit) : ?>
									<option value="<?= $unit->id_mst_unit ?>"><?= $unit->nm_mst_unit ?></option>
								<?php endforeach; ?>
							</select>
						</div>

					</div>

					<div class="form-row">
						<div class="form-group col-md-3">
							<label for="gaji_pokok">Gaji Pokok</label>
							<input type="number" class="form-control" name="gaji_pokok">
						</div>
						<div class="form-group col-md-3">
							<label for="ptkp">Penghasilan Tidak Kena Pajak (PTKP)</label>
							<input type="number" class="form-control" name="ptkp">
						</div>
						<div class="form-group col-md-3">
							<label for="nrk">Nomor Registrasi Kepegawaian (NRK)</label>
							<input type="number" class="form-control" name="nrk">
						</div>
						<div class="form-group col-md-3">
							<label for="tmt">Terhitung Mulai Tanggal (TMT)</label>
							<input type="date" class="form-control" name="tmt">
						</div>
						<div class="form-group col-md-3">
							<label for="no_str">Nomor Surat Tanda Registrasi (STR)</label>
							<input type="text" class="form-control" name="no_str">
						</div>
						<div class="form-group col-md-3">
							<label for="exp_str">Tanggal Kadaluarsa STR</label>
							<input type="date" class="form-control" name="exp_str">
						</div>
						<div class="form-group col-md-3">
							<label for="no_sip">Nomor Surat Izin Praktek (SIP)</label>
							<input type="text" class="form-control" name="no_sip">
						</div>
						<div class="form-group col-md-3">
							<label for="exp_sip">Tanggal Kadaluarsa SIP</label>
							<input type="date" class="form-control" name="exp_sip">
						</div>
						<div class="form-group col-md-12">
							<label for="submit">&nbsp;</label>
							<button type="submit" class="btn btn-primary pull-right btn-sm btn_submit_noka">Simpan <i class="fa fa-paper-plane"></i></button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>