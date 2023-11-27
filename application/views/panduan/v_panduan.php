<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item active" aria-current="page">Panduan</li>
            </ol>
        </nav>
    </div>
    <?php if (getUserGroup() == 1): ?>
    <div class="col-12 mt-2">
        <div class="card p-4">
            <form class="row" action="<?= base_url('perencanaan/C_perencanaan/uploadPanduan') ?>" method="post" enctype="multipart/form-data">
                <div class="col-3">
                    <label>Nama Panduan</label>
                    <input type="text" class="form-control" name="nama_panduan" id="panduan" placeholder="Masukan Nama Panduan">
                </div>
                <div class="d-flex justify-content-start align-items-center">
                    <button type="button" class="btn btn-primary"  onclick="return $('#file').click()">Pilih File</button>
                    <input type="file" name="file" id="file" style="display:none">
                </div>
                <div class="col-3 d-flex justify-content-start align-items-center">
                    <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-save ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>
    <?php endif ?>
    <div class="col-12 mt-2">
        <div class="card p-4">
            <div class="row">
                <div class="col-3">
                    <label>Panduan</label>
                    <select class="form-control" name="jenis_panduan" id="jenis_panduan">
                        <?php foreach ($panduan as $pd): ?>
                            <option value="<?= $pd['filename'].'*-*'.$pd['id_trx_panduan'] ?>"><?= $pd['nm_trx_panduan'] ?></option>
                        <?php endforeach ?>
                    </select>   
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card p-4" style="height: 80vh;">
            <iframe id="iframe" src="" frameborder="0" style="height: 100%"></iframe>
        </div>
    </div>
</div>

<script>
    $('#jenis_panduan').select2()
    $(function(){
        const val = $('#jenis_panduan').val();
        const filename = val.split('*-*')[0]
        const idpanduan = val.split('*-*')[1]
        $('#iframe').attr('src', '/assets/uploaddata/panduan/'+filename)
    })
    $("#jenis_panduan").on('change', function(){
        const val = $(this).val();
        const filename = val.split('*-*')[0]
        const idpanduan = val.split('*-*')[1]
        console.log('/assets/uploaddata/panduan/'+filename)
        $('#iframe').attr('src', '/assets/uploaddata/panduan/'+filename)

    })
</script>