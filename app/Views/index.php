<?= $this->extend('layouts/master_utama2'); ?>

<?= $this->section('isi') ?>

<div class="container white-text ff-header-content">
    <div class="row ff-row">
        <div class="col s12 l7 right noselect">
            <div class="ff-header-bg">
                <img src="img/header/header-cso1.png">
            </div>
        </div>
        <div class="col s10 offset-s1 l4 offset-l1">
            <p class="primary center">CSO 2019</p>
            <div class="tagline-event center">
                "Maximize the Digital Potential as The Next Big Solution for Indonesia"
            </div>
            <span class="ff-header-button">
                <div class="countdown">
                    <div class="row">
                        <div class="col s3">
                            <font id="days" class="value">00</font>
                            <font class="desc center">Hari</font>
                        </div>
                        <div class="col s3">
                            <font id="hours" class="value">00</font>
                            <font class="desc center">Jam</font>
                        </div>
                        <div class="col s3">
                            <font id="minutes" class="value">00</font>
                            <font class="desc center">Menit</font>
                        </div>
                        <div class="col s3">
                            <font id="seconds" class="value">00</font>
                            <font class="desc center">Detik</font>
                        </div>
                        <div class="col s12 ff-progress">
                            <div class="ff-progress-layout">
                                <div class="filler teal">
                                    <div class="percentage">100%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="ff-header-button center">
                    <a class="waves-effect btn white akademik" onclick="scrollToElement('#about',true)">YUK IKUTAN!</a>
                    <a class="waves-effect btn white-text transparent download" href="file/panduan_cso_2019.pdf" target="_blank">DOWNLOAD PANDUAN</a>
                </span>
            </span>
        </div>
    </div>
</div>

<?= $this->endSection() ?>