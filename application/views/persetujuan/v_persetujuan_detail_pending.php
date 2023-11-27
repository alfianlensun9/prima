<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('persetujuan/C_persetujuan') ?>">Persetujuan</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('persetujuan/C_persetujuan/persetujuanDetail/'.$header['id_trx_perencanaan']) ?>">Persetujuan Detail</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pending</li>
            </ol>
        </nav>
    </div>
    <div class="col-12">
        <div class="card p-4">
            <div class="row">
                <div class="col-12 pb-4">
                    <button class="btn btn-sm btn-danger">Pending</button>
                    <button id="btnmodal"  class="btn btn-sm btn-primary text-white" ids="<?= $header['id_trx_perencanaan_detail'] ?>">
                        Detail <i class="fa fa-info-circle"></i>
                    </button>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-12" style="font-size: 12px; ">
                            <i class="fa fa-circle mr-2 text-primary"> </i>Nama Barang
                        </div>
                        <div class="col-12 mt-2" style="font-size: 13px; font-weight: bold;">
                            <?= $header['nama_alat_kesehatan'] ?>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-12" style="font-size: 12px; ">
                            <i class="fa fa-circle mr-2 text-primary"> </i>Kuantitas
                        </div>
                        <div class="col-12 mt-2" style="font-size: 13px; font-weight: bold;">
                            <?= $header['kuantitas'] ?>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-12" style="font-size: 12px; ">
                            <i class="fa fa-circle mr-2 text-primary"> </i>harga
                        </div>
                        <div class="col-12 mt-2" style="font-size: 13px; font-weight: bold;">
                            <?= $header['harga'] ?>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-12" style="font-size: 12px; ">
                            <i class="fa fa-circle mr-2 text-primary"> </i>E-Planning
                        </div>
                        <div class="col-12 mt-2" style="font-size: 13px; font-weight: bold;">
                            <?= $header['eplanning'] == 1 ? '<i class="fa fa-check"></i>' : '-'?>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <div class="col-12">
        <div class="card p-4">
            <form action="<?= base_url('persetujuan/C_persetujuan/confirmPending/'.$header['id_trx_perencanaan'].'/'.$header['id_trx_perencanaan_detail']) ?>" method="post" class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label>Alasan Pending</label>
                        <select class="form-control" name="id_mst_alasan_pending" id="id_mst_alasan_pending">
                            <?php foreach ($alasanpending as $alasan): ?>
                                <option value="<?= $alasan['id_mst_alasan_pending'] ?>"><?= $alasan['nm_mst_alasan_pending'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group" >
                        <label>Detail </label>
                        <input type="text" class="form-control" name="detail_alasan_pending">
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <button id="btnmodal" style="width: fit-content;" class="btn mt-3 btn-primary text-white" ids="<?= $header['id_trx_perencanaan_detail'] ?>">
                        Simpan <i class="fa fa-save"></i>
                    </button>
                </div>
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
                        <iframe id="iframe" src="" style="width: 100%; height: 100%;" frameborder="0"></iframe>
                    </div>
                </div>          
            </div>
        </div>
    </div>
</div>


<script>
    $(function(){
        $('#id_mst_alasan_pending').select2()
        $('#indikator').select2()
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