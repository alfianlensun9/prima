<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/C_admin') ?>">Management User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
    </div>
    <div class="col-12 mt-2">
        <div class="card p-4">
            <div class="row">
                <div class="col-12">
                    <div style="font-size: 16px; font-weight: bold;">
                        Edit User - <?= $header['fullname'] ?> (<?= $header['no_handphone'] ?>)
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card p-4">
            <div class="row">
                <div class="col-12">
                    <form class="row pt-4" method="post" action="<?= base_url('admin/C_admin/editUser/' . $header['id_auth_users']) ?>">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Nama Pegawai</label>
                                <input type="text" class="form-control" name="fullname" id="fullname" value="<?= $header['fullname'] ?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>ID Telegram</label>
                                <input type="text" class="form-control" name="id_telegram" id="id_telegram" value="<?= $header['id_telegram'] ?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>No Handphone</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= $header['no_handphone'] ?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Group User</label>
                                <select name="id_mst_group" id="group" class="form-control">
                                    <?php foreach ($group as $g) : ?>
                                        <option value="<?= $g['id_auth_group'] ?>" <?= $g['id_auth_group'] == $header['id_auth_group'] ? 'selected' : '' ?>><?= $g['nm_auth_group'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Set data Kepegawaian</label>
                                <select name="id_trx_kepegawaian" id="selectTrxKepegawaian" class="form-control">
                                    <option value="0">-</option>
                                    <?php foreach ($listPegawai as $g) : ?>
                                        <option value="<?= $g->id_trx_kepegawaian ?>" <?= $g->id_trx_kepegawaian == $header['id_trx_kepegawaian'] ? 'selected' : '' ?>><?= $g->nm_pegawai ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <div style="font-size: 12px;">
                                Masukan password untuk mengubah password lama (kosongkan jika tidak)
                            </div>

                        </div>
                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="" id="password" name="password">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="confirm_password">
                                    </div>
                                </div>
                                <div class="col-3 d-flex align-items-center">
                                    <button type="button" id="btnsimpan" class=" mt-2 btn btn-primary">Perbarui</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(function() {
        $('#btnsimpan').on('click', function() {
            if ($('#fullname').val().trim().length == 0) {
                customAlert(`Isi <b>Nama lengkap</b> terlebih dahulu`)
                return false
            }
            if ($('#no_telp').val().trim().length == 0) {
                customAlert(`Isi <b>No Handphone</b> terlebih dahulu`)
                return false
            }
            if ($('#password').val().trim().length > 0) {
                if ($('#confirm_password').val() == 0) {
                    customAlert(`<b>Konfirmasi Password</b> terlebih dahulu`)
                    return false
                }
                if ($('#confirm_password').val() != $('#password').val()) {
                    customAlert(`<b>Password</b> tidak cocok`)
                    return false
                }
            }
            $('form').submit();
        })
        $('#group').select2()
        $('#selectTrxKepegawaian').select2()
    })
</script>