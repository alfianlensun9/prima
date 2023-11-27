<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('Welcome') ?>">Main Menu</a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="<?= base_url('antrean/C_nav_antrean') ?>">ANTREAN</a></li>
                <li class="breadcrumb-item active" aria-current="page">PENGAMBILAN ANTREAN ONSIDE</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
       
    </div>
</div>

<script>
    $(".nav-link").click(function() {
        $("#err_msg").html("");
        $("#div_result").hide()
        $("#loader").hide()
    })
</script>