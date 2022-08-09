<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<link type='text/css' href="<?= base_url()?>assets/front/css/slider.css" rel='Stylesheet' />
<script src="<?= base_url()?>assets/front/js/jquery.cycle2.caption2.min.js"></script>
<style type="text/css">
    #aparatur_desa .cycle-pager span {
        height: 10px;
        width: 10px;
    }

    .cycle-slideshow {
        max-height: none;
        margin-bottom: 0px;
        border: 0px;
    }

    .cycle-next, .cycle-prev {
        mix-blend-mode: difference;
    }
</style>

<div class="single_bottom_rightbar">
    <h2 class="box-title">
        <i class="fa fa-user"></i>&ensp;<?= $judul_widget ?>
    </h2>
    <div class="box-body">
        <div class="content_middle_middle">
            <div id="aparatur_desa" class="cycle-slideshow"
            data-cycle-pause-on-hover=true
            data-cycle-fx=scrollHorz
            data-cycle-timeout=2000
            data-cycle-caption-plugin=caption2
            data-cycle-overlay-fx-out="slideUp"
            data-cycle-overlay-fx-in="slideDown"
            data-cycle-auto-height=4:6
            >
            <?php if ($this->web_widget_model->get_setting('aparatur_desa', 'overlay') == true): ?>
                <span class="cycle-prev"><img src="<?= base_url()?>assets/images/back_button.png" alt="Back"></span>
                <span class="cycle-next"><img src="<?= base_url()?>assets/images/next_button.png" alt="Next"></span>
                <div class="cycle-caption"></div>
                <div class="cycle-overlay"></div>
                <?php else: ?>
                    <span class="cycle-pager"></span>  <!-- Untuk membuat tanda bulat atau link pada slider -->
                <?php endif; ?>

                <?php foreach(pemerintah_desa() as $data) : ?>
                    <img src="<?= AmbilFoto($data['foto'], 'besar', $data['id_sex'], true) ?>"
                    data-cycle-title="<span class='cycle-overlay-title'><?= $data['nama'] ?></span>
                        <span class='label label-success'><?= $data['status_kehadiran'] == 'hadir' ? 'Hadir' : '' ?></span>"
                    data-cycle-desc="<?= $data['jabatan'] ?>"
                    >
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
