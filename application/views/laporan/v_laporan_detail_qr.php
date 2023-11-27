<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('perencanaan/C_perencanaan/laporan') ?>">Laporan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Perencanaan Detail Qr</li>
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
                                No
                            </th>
                            <th>
                                Nama Barang
                            </th>
                            <th>
                                Kategori
                            </th>
                            <th>
                                Kuantitas
                            </th>
                            <th>
                                Harga
                            </th>
                            <th>
                                E-Planning
                            </th>
                            <th>
                                Qr
                            </th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php if (count($detail) == 0): ?>
                            <tr>
                                <td
                                    colspan="9"
                                    align="center"
                                >
                                    Belum ada perencanaan
                                </td>
                            </tr>
                        <?php endif ?>
                        <?php foreach ($detail as $key => $list): ?>
                            <tr>
                                <td>
                                    <?= $key+1 ?>
                                </td>
                                <td style="width: 20%">
                                    <?= $list['eplanning'] == 1 ? $list['nama_alat_kesehatan'] : $list['nm_barang_non_eplanning'] ?>
                                </td>
                                <td>
                                    <?= $list['nm_mst_kategori'] ?>
                                </td>
                                <td>
                                    <?= $list['kuantitas'] ?>
                                </td>
                                <td>
                                    <?= $list['harga'] ?>
                                </td>
                                <td>
                                    <?= $list['eplanning'] == '1' ? '<i class="fa fa-check"></i>' : '<i class="fa fa-minus"></i>' ?>
                                </td>
                                <td>
                                    <div class="qrcode" ids="<?= $list['id_trx_perencanaan_detail'] ?>"></div>
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

<script src="<?= base_url('assets/js/qrcode.js') ?>"></script>

<script>
    $(function(){
        const listqr = document.querySelectorAll('.qrcode')

        if (listqr.length > 0){
            for (const el of listqr){
                let thisval = $(el).attr('ids')
                
                var qrcode = new QRCode(el, {
                    text: thisval,
                    width: 128,
                    height: 128,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H
                });
            }
        }
        
    })
</script>