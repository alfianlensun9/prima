<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item active" aria-current="page">Perencanaan</li>
            </ol>
        </nav>
    </div>
    <div class="col-12 mt-2">
        <div class="card p-4">
            <div class="row">
                <div class="col-12">
                    <div style="font-size: 16px; font-weight: bold;">
                        Buat Perencanaan Baru
                    </div>
                </div>
                <div class="col-12 mt-4">
                
                    <form action="<?= base_url('perencanaan/C_perencanaan/createPerencanaan') ?>" method="post">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <select class="form-control" name="tahun">
                                        <?php foreach ($tahun as $thn ):  ?>
                                            <option value="<?= $thn ?>" <?= $thn == date('Y') ? 'selected' : '' ?>><?= $thn ?></option>
                                        <?php endforeach  ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3 pb-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
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
                                Tahun Perencanaan
                            </th>
                            <th>
                                Opsi
                            </th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php if (count($listperencanaan) == 0): ?>
                            <tr>
                                <td
                                    colspan="2"
                                    align="center"
                                >
                                    Belum ada perencanaan
                                </td>
                            </tr>
                        <?php endif ?>
                        <?php foreach ($listperencanaan as $list): ?>
                            <tr>
                                <td>
                                    <?= $list['tahun'] ?>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="<?= base_url('perencanaan/C_perencanaan/perencanaanDetail/'.$list['id_trx_perencanaan']) ?>">
                                        Detail 
                                    </a>
                                    <?php if ($list['confirm_status'] == 0): ?>
                                        <a class="btn btn-danger text-white" href="<?= base_url('perencanaan/C_perencanaan/deletePerencanaan/'.$list['tahun']) ?>">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>