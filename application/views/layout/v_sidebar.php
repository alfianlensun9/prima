<div class="sidebar">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="<?= $activePage == 'mainmenu' ? 'active' : '' ?>">
                <a href="<?= base_url('/welcome') ?>">
                    <i class="tim-icons icon-components"></i>
                    <p>Main Menu</p>
                </a>
            </li>
            <?php if (false) : ?>
                <li class="<?= $activePage == 'dashboard' ? 'active' : '' ?>">
                    <a href="<?= base_url('perencanaan/C_perencanaan/dashboard') ?>">
                        <i class="tim-icons icon-chart-pie-36"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
            <?php endif ?>
            <?php if (getUserGroup() == 2 || getUserGroup() == 1) : ?>
                <li class="<?= $activePage == 'perencanaan' ? 'active' : '' ?>">
                    <a href="<?= base_url('perencanaan/C_perencanaan') ?>">
                        <i class="tim-icons icon-atom"></i>
                        <p>Perencanaan</p>
                    </a>
                </li>
            <?php endif ?>
            <?php if (getUserGroup() == 4 || getUserGroup() == 1) : ?>
                <li class="<?= $activePage == 'persetujuan' ? 'active' : '' ?>">
                    <a href="<?= base_url('persetujuan/C_persetujuan') ?>">
                        <i class="tim-icons icon-pin"></i>
                        <p>Persetujuan</p>
                    </a>
                </li>
            <?php endif ?>
            <li class="<?= $activePage == 'panduan' ? 'active' : '' ?>">
                <a href="<?= base_url('perencanaan/C_perencanaan/panduan') ?>">
                    <i class="fa fa-clipboard-list"></i>
                    <p>Panduan</p>
                </a>
            </li>
            <?php if (getUserGroup() == 1) : ?>
                <li class="<?= $activePage == 'masteralkes' ? 'active' : '' ?>">
                    <a href="">
                        <i class="fa fa-database"></i>
                        <p>Master Kategori Alkes</p>
                    </a>
                </li>
            <?php endif ?>
            <?php if (getUserGroup() == 1) : ?>
                <li class="<?= $activePage == 'masteralkes' ? 'active' : '' ?>">
                    <a href="">
                        <i class="fa fa-database"></i>
                        <p>Master Alkes</p>
                    </a>
                </li>
            <?php endif ?>
            <?php if (getUserGroup() == 1) : ?>
                <li class="<?= $activePage == 'managementuser' ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/C_admin') ?>">
                        <i class="tim-icons icon-puzzle-10"></i>
                        <p>Management User</p>
                    </a>
                </li>
            <?php endif ?>
            <li class="<?= $activePage == 'laporan' ? 'active' : '' ?>">
                <a href="<?= base_url('perencanaan/C_perencanaan/laporan') ?>">
                    <i class="tim-icons icon-align-center"></i>
                    <p>Laporan</p>
                </a>
            </li>

            <li class="<?= $activePage == 'bpjs' ? 'active' : '' ?>">
                <a href="<?= base_url('bpjs/C_nav') ?>">
                    <i class="fa fa-clipboard-list"></i>
                    <p>BPJS V2</p>
                </a>
            </li>

            <li class="<?= $activePage == 'sdm' ? 'active' : '' ?>">
                <a href="<?= base_url('sdm/C_nav') ?>">
                    <i class="fa fa-clipboard-list"></i>
                    <p>SDM</p>
                </a>
            </li>

            <li class="<?= $activePage == 'antrean' ? 'active' : '' ?>">
                <a href="<?= base_url('antrean/C_nav_antrean') ?>">
                    <i class="fa fa-clipboard-list"></i>

                    <p>Antrean</p>
                </a>
            </li>

            <li class="<?= $activePage == 'master' ? 'active' : '' ?>">
                <a href="<?= base_url('master/C_nav') ?>">
                    <i class="fa fa-clipboard-list"></i>
                    <p>Master</p>
                </a>
            </li>

            <li class="<?= $activePage == 'setting' ? 'active' : '' ?>">
                <a href="<?= base_url('setting/C_setting/nav') ?>">
                    <i class="fa fa-clipboard-list"></i>
                    <p>Setting</p>
                </a>
            </li>
        </ul>
    </div>
</div>