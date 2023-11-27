<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('persetujuan/C_persetujuan') ?>">Persetujuan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Perencanaan</li>
            </ol>
        </nav>
    </div>
    <div class="col-12 mt-2">
        <div class="card p-4">
            <div class="row">
                <div class="col-12">
                    <div style="font-size: 16px; font-weight: bold;">
                        Detail Perencanaan Tahun <?= $header['tahun'] ?>
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
                                Status
                            </th>
                            <th style='text-align:center'>
                                Validasi
                            </th>
                            <th>
                                Opsi
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
                                    <?= $list['nama_alat_kesehatan'] ?>
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
                                    <?= $list['eplanning'] == '1' ? '<i class="fa fa-check"></i>' : '' ?>
                                </td>
                                <td>
                                    <?php if ($list['validate_status'] != 0 ): ?>
                                        <?= $list['validate_status'] == '1' ? '<b>Valid</b>' : '<b>Pending</b>' ?>
                                    <?php else: ?>
                                        -
                                    <?php endif ?>
                                </td>
                                <td style="text-align:center;">
                                    <?php if ($list['validate_status'] == 0): ?>
                                        <a id="btnmodal" style="width: fit-content;" class="btn btn-primary text-white" href="<?= base_url('/persetujuan/C_persetujuan/persetujuanDetailValidasi/'.$list['id_trx_perencanaan_detail']) ?>">
                                            Valid <i class="fa fa-check"></i>
                                        </a>
                                        <a id="btnmodal" style="width: fit-content;" class="btn btn-danger ml-2 text-white" href="<?= base_url('/persetujuan/C_persetujuan/persetujuanDetailPending/'.$list['id_trx_perencanaan_detail']) ?>">
                                            Pending <i class="fa fa-clock"></i>
                                        </a>
                                    <?php else: ?>
                                        <b>Sudah Di Validasi</b>
                                    <?php endif ?>
                                        
                                </td>
                                <td>
                                    <button id="btnmodal" style="width: fit-content;" class="btn btn-primary text-white" ids="<?= $list['id_trx_perencanaan_detail'] ?>">
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                </td>
                                
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>

<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title" id="exampleModalLabel">Detail </b>
                <div class="btn-close-modal" style="cursor:pointer"><i class="fa fa-times"></i></div>
            </div>
            <div class="modal-body" style="height: 70vh">
                <div class="row" style="height: 100%">
                    <div class="col-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12" style="font-size: 12px;">
                                        Nama Barang
                                    </div>
                                    <div class="col-12 mt-2" style="font-size: 12px; font-weight: bold" id="lbl_nm_barang">
                                        -
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="row">
                                    <div class="col-12" style="font-size: 12px;">
                                        Kategori
                                    </div>
                                    <div class="col-12 mt-2" style="font-size: 12px; font-weight: bold" id="lbl_kategori">
                                        -
                                    </div>
                                </div>
                            </div>
                            <div class="col-12  mt-4">
                                <div class="row">
                                    <div class="col-12" style="font-size: 12px;">
                                        Kuantitas
                                    </div>
                                    <div class="col-12 mt-2" style="font-size: 12px; font-weight: bold" id="lbl_kuantitas">
                                        -
                                    </div>
                                </div>
                            </div>
                            <div class="col-12  mt-4">
                                <div class="row">
                                    <div class="col-12" style="font-size: 12px;">
                                        Harga
                                    </div>
                                    <div class="col-12 mt-2" style="font-size: 12px; font-weight: bold" id="lbl_harga">
                                        -
                                    </div>
                                </div>
                            </div>
                            <div class="col-12  mt-4">
                                <div class="row">
                                    <div class="col-12" style="font-size: 12px;">
                                        Umur Aset
                                    </div>
                                    <div class="col-12 mt-2" style="font-size: 12px; font-weight: bold" id="lbl_umur">
                                        -
                                    </div>
                                </div>
                            </div>
                            <div class="col-12  mt-4">
                                <div class="row">
                                    <div class="col-12" style="font-size: 12px;">
                                        Mudah Rusak
                                    </div>
                                    <div class="col-12 mt-2" style="font-size: 12px; font-weight: bold" id="lbl_mdh_rusak">
                                        -
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8" style="height: 100%">
                        <iframe id="iframe" src="<?= base_url('assets/uploaddata/datapendukung/1611152647.png') ?>" style="width: 100%; height: 100%;" frameborder="0"></iframe>
                    </div>
                </div>          
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        
        $("#btnmodal").on('click',function(){
            $.ajax({
                url: '/perencanaan/C_perencanaan/getJsonDetailPerencanaanById/'+$(this).attr('ids'),
                dataType: 'json',
                success: (resp) => {
                    $('#modalDetail').modal()
                    $('#lbl_nm_barang').html(resp.nama_alat_kesehatan)
                    $('#lbl_kategori').html(resp.nm_mst_kategori)
                    $('#lbl_kuantitas').html(resp.kuantitas)
                    $('#lbl_harga').html(resp.harga)
                    $('#lbl_umur').html(resp.umur_aset)
                    $('#lbl_mdh_rusak').html(resp.mudah_rusak == '1' ? `Ya` : 'Tidak')
                    $('#iframe').attr('src', '/assets/uploaddata/datapendukung/'+resp.file_data_pendukung)
                },
                error: (err) => {
                    console.log(err)
                }
            })
            
        })    
    })
</script>