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
                        Daftar Perencanaan 
                    </div>
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
                                    <a class="btn btn-primary" href="<?= base_url('persetujuan/C_persetujuan/persetujuanDetail/'.$list['id_trx_perencanaan']) ?>">
                                        Detail 
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