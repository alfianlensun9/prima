<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('perencanaan/C_perencanaan') ?>">Perencanaan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Perencanaan Detail</li>
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
                <?php if ($header['confirm_status'] == 0): ?>
                    <div class="col-12 mt-4">
                        <form action="<?= base_url('perencanaan/C_perencanaan/createPerencanaanDetail/'.$header['id_trx_perencanaan']) ?>" method="post" id="form">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="form-check ">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="" id="e-planning" value="1" checked>
                                            <span class="form-check-sign">
                                                <span class="check">E-Planning</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3" id="wrappereplanning">
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <select class="form-control" name="mst_alkes" id="mst_alkes">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3" id="wrapperenonplanning" style="display:none">
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input class="form-control" placeholder="Ketik nama barang" name="nm_mst_barang_non_eplaning" id="nm_mst_barang_non_eplaning"/>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control" name="mst_kategori" id="mst_kategori">
                                            <?php foreach ($kategori as $ktg): ?>
                                                <option value="<?= $ktg['id_mst_kategori'] ?>"><?= $ktg['nm_mst_kategori'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Kuantitas</label>
                                        <input class="form-control" name="kuantitas" id="kuantitas"/>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input class="form-control" name="harga" id="harga"/>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Umur Aset</label>
                                        <select class="form-control" name="umur_aset" id="umur_aset">
                                            <option value="< 1 Tahun">< 1 Tahun</option>
                                            <option value="> 1 Tahun">> 1 Tahun</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Mudah Rusak</label>
                                        <select class="form-control" name="mudah_rusak" id="mudah_rusak">
                                            <option value="1">Ya</option>
                                            <option value="0">Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label>Justifikasi</label>
                                        <input class="form-control" name="justifikasi" id="justifikasi"/>
                                    </div>
                                </div>
                                <div class="col-3 d-flex justify-content-end align-items-end">
                                    <button type="button" id="btn-upload" class="btn btn-primary btn-block mb-3 d-flex align-items-center justify-content-center text-nowrap">Upload File Pendukung <i class="fa fa-upload ml-3"></i></button>
                                    <input type="file" class="btn btn-primary btn-block mb-3" style="display:none;" id="file"/>
                                </div>
                                <div class="col-3 pb-1 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php endif ?>
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
                                    <?= $list['eplanning'] == 1 ? $list['nama_alat_kesehatan'] : $list['nm_barang_non_eplanning'] ?>
                                </td>
                                <td>
                                    <?= $list['nm_mst_kategori'] ?>
                                </td>
                                <td>
                                    <?= $list['kuantitas'] ?>
                                </td>
                                <td>
                                    <?= rupiah($list['harga']) ?>
                                </td>
                                <td>
                                    <?= $list['eplanning'] == '1' ? '<i class="fa fa-check"></i>' : '<i class="fa fa-minus"></i>' ?>
                                </td>
                                <td>
                                    <button style="width: fit-content;" class="btn btn-primary text-white btnmodal" ids="<?= $list['id_trx_perencanaan_detail'] ?>">
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                    <?php if ($list['validate_status'] != 0): ?>
                                        <a style="width: fit-content;" class="btn btn-danger text-white" href="<?= base_url('perencanaan/C_perencanaan/deletePerencanaanDetail/'.$list['id_trx_perencanaan_detail']) ?>">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 d-flex justify-content-end">
        <?php if ($header['confirm_status'] == 0): ?>
            <button style="width: fit-content;" class="btn btn-primary text-white" id="confirm" url="<?= base_url('perencanaan/C_perencanaan/konfirmasiPerencanaan/'.$header['id_trx_perencanaan']) ?>">
                Konfirmasi <i class="fa fa-check"></i>
            </button>
        <?php endif ?>
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
                    <div class="col-8" style="height: 100%; display:flex; align-items:center; justify-content:center">
                        <iframe id="iframe" src="" style="width: 100%; height: 100%; display:none" frameborder="0"></iframe>
                        <a class="btn btn-primary" id="downloadbtn" style="display:none" href="#">Download <i class="fa fa-download"></i></a>
                    </div>
                </div>          
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        localStorage.clear()
        localStorage.setItem('eplanning', 1)
        $(".btnmodal").on('click',function(){
            $.ajax({
                url: '/perencanaan/C_perencanaan/getJsonDetailPerencanaanById/'+$(this).attr('ids'),
                dataType: 'json',
                success: (resp) => {
                    const iframeaccept = ['png', 'jpg', 'jpeg', 'pdf']
                    $('#modalDetail').modal()
                    $('#lbl_nm_barang').html(resp.eplanning == 1 ? resp.nama_alat_kesehatan : resp.nm_barang_non_eplanning)
                    $('#lbl_kategori').html(resp.nm_mst_kategori)
                    $('#lbl_kuantitas').html(resp.kuantitas)
                    $('#lbl_harga').html(resp.harga)
                    $('#lbl_umur').html(resp.umur_aset)
                    $('#lbl_mdh_rusak').html(resp.mudah_rusak == '1' ? `Ya` : 'Tidak')
                    if (iframeaccept.includes(resp.file_data_pendukung.split('.').pop())){
                        $("#downloadbtn").hide()
                        $("#iframe").show()
                        $('#iframe').attr('src', '<?= base_url() ?>/assets/uploaddata/datapendukung/'+resp.file_data_pendukung)
                    } else {
                        $("#downloadbtn").attr('href', '<?= base_url() ?>/assets/uploaddata/datapendukung/'+resp.file_data_pendukung)
                        $("#downloadbtn").show()
                        $("#iframe").hide()
                    }
                    
                },
                error: (err) => {
                    console.log(err)
                }
            })
            
        })    

        $('#confirm').on('click', function(){
            if (confirm('Apakah anda yakin ingin mengkonfirmasi data ini?')){
                $.ajax({
                    url: $('#confirm').attr('url'),
                    method: 'post',
                    success: () => {
                        window.location = ''
                    },
                    error: (err) => {
                        console.log(err)
                    }
                })
            }
        })
        $('#e-planning').on('change', function(){
            if ($('#e-planning').is(":checked")){
                $('#wrappereplanning').show()
                $('#wrapperenonplanning').hide()
                localStorage.setItem('eplanning', 1)
            } else {
                $('#wrappereplanning').hide()
                $('#wrapperenonplanning').show()
                localStorage.setItem('eplanning', 0)
            }
        })
        $('#btn-upload').on('click', function(){
            $('#file').click()
        })

        $('#file').on('change', function(){
            const oldhtml = $('#btn-upload').html()
            if ($('#file').val().length > 0){
                $('#btn-upload').html(`Ganti Data Pendukung <i class="fa fa-edit ml-2"></i>`)
            }
        })

        $('#form').on('submit',async function(e){
            const oldhtml = $('#btn-simpan').html()
            
            try {
                e.preventDefault()

                const file_data = $('#file').prop('files')[0];
                const formdata = new FormData();
                if ($('#file').val().length == 0){
                    customAlert(`Pilih <b>File Pendukung</b> terlebih dahulu`)
                    return false
                }
                formdata.append('file', file_data);
                $('#btn-simpan').html(`Mengupload File <i class="fa fa-spin fa-spinner"></i>`)
                // upload gambar
                const result = await new Promise((rs, rj) => {
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "/perencanaan/C_perencanaan/uploadDataPendukung",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: "json",
                        success: function ({dataupload, status = false}) {
                            if (status){
                                localStorage.setItem('filename', dataupload.file_name)
                                localStorage.setItem('ext', dataupload.file_ext)
                                rs(true)
                            } else {
                                rj(dataupload)
                            }
                        },
                        error: function (e) {
                            rj()
                        }
                    });
                })
                if (result){
                    
                    e.preventDefault()
                    $('#btn-simpan').html(`Menyimpan data <i class="fa fa-spin fa-spinner"></i>`)
                    const eplanning = localStorage.getItem('eplanning')
                    const filename = localStorage.getItem('filename')
                    const ext = localStorage.getItem('ext')
                    // upload gambar
                    const result = await new Promise((rs, rj) => {
                        $.ajax({
                            type: "POST",
                            url: $('#form').attr('action'),
                            data: $('#form').serialize()+'&eplanning='+eplanning+'&filename='+filename+'&ext='+ext,
                            dataType: "json",
                            success: function () {
                                window.location = ''
                            },
                            error: function (e) {
                                rj()
                            }
                        });
                    })   


                }
            } catch(err){
            
                customAlert(`Gagal Menyimpan data: ${err.message !== undefined ? err.message : err}`)
                $('#btn-simpan').html(oldhtml)
            }
        }) 
    })
    $('#harga').formatRupiah()
    $('#mst_kategori').select2()
    $('#umur_aset').select2()
    $('#mudah_rusak').select2()
    $('#mst_alkes').select2Ajax({
        url: '/master/C_master/getMasterAlkesSelectize'
    })
</script>