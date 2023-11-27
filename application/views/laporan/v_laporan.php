<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan</li>
            </ol>
        </nav>
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
                                    <a class="btn btn-primary" href="<?= base_url('perencanaan/C_perencanaan/laporanDetail/'.$list['id_trx_perencanaan']) ?>">
                                        <i class="fa fa-list"></i>
                                    </a>
                                    <a class="btn btn-primary" href="<?= base_url('perencanaan/C_perencanaan/laporanDetailQr/'.$list['id_trx_perencanaan']) ?>">
                                        <i class="fa fa-qrcode"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>