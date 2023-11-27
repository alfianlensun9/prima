<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item active" aria-current="page">Management User</li>
            </ol>
        </nav>
    </div>
    <div class="col-12 mt-2">
        <div class="card p-4">
            <div class="row">
                <div class="col-12">
                    <div style="font-size: 16px; font-weight: bold;">
                        Management User
                    </div>
                </div>
                <div class="col-12">
                    <form class="row pt-4" method="post" action="<?= base_url('admin/C_admin/createUser') ?>">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" name="fullname" id="fullname">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>ID Telegram</label>
                                <input type="text" class="form-control" name="id_telegram" id="id_telegram">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>No Handphone</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Group User</label>
                                <select name="id_mst_group" id="group" class="form-control">
                                    <?php foreach ($group as $g): ?>
                                        <option value="<?= $g['id_auth_group'] ?>" <?= $g['id_auth_group'] == 2 ? 'selected' : '' ?>><?= $g['nm_auth_group'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="password" class="form-control" id="confirm_password">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end align-items-end">
                            <button type="button" id="btnsimpan" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card p-4">
            <div class="table-responsive">
                <table class="table tablesorter" id="">
                    <thead class=" text-primary">
                        <tr>
                            <th>
                                No
                            </th>
                            <th>
                                Nama pegawai
                            </th>
                            <th>
                                ID Telegram
                            </th>
                            <th>
                                No Handphone
                            </th>
                            <th>
                                Group User
                            </th>
                            <th>
                                Opsi
                            </th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php if (count($users) == 0): ?>
                            <td colspan="6">Belum ada user terdaftar</td>
                        <?php endif ?>
                        <?php foreach ($users as $key => $user ): ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $user['fullname'] ?></td>
                            <td><?= $user['id_telegram'] ?></td>
                            <td><?= $user['no_handphone'] ?></td>
                            <td><?= $user['nm_auth_group'] ?></td>
                            <td>
                                <a class="btn btn-primary" href="<?= base_url('admin/C_admin/viewEditUser/'.$user['id_auth_users']) ?>"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-danger" href="<?= base_url('admin/C_admin/deleteUser/'.$user['id_auth_users']) ?>"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#btnsimpan').on('click', function(){
            if ($('#fullname').val().trim().length == 0){
                customAlert(`Isi <b>Nama lengkap</b> terlebih dahulu`)
                return false
            }
            if ($('#no_telp').val().trim().length == 0){
                customAlert(`Isi <b>No Handphone</b> terlebih dahulu`)
                return false
            }
            if ($('#password').val().trim().length == 0){
                customAlert(`Isi <b>Password</b> terlebih dahulu`)
                return false
            }
            if ($('#confirm_password').val() == 0){
                customAlert(`<b>Konfirmasi Password</b> terlebih dahulu`)
                return false
            }
            if ($('#confirm_password').val() != $('#password').val()){
                customAlert(`<b>Password</b> tidak cocok`)
                return false
            }
            $('form').submit();
        })
        $('#group').select2()
    })
</script>