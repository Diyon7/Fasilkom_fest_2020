<?php $session = \Config\Services::session(); ?>
<!DOCTYPE HTML>
<html>

<head>
    <script>
        var text = "<?= $title; ?>    ";
        var speed = 350;
        var refresh = null;

        function action() {
            document.title = text;
            text = text.substring(1, text.length) + text.charAt(0);
            refresh = setTimeout("action()", speed)
        }
        action();
    </script>
    <meta charset="utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
    <meta name="theme-color" content="#3b4650">
    <link href="<?= base_url() ?>/upload/img/logo/logo-cso.png" rel="shortcut icon">
    <!-- <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/utama/style.css"> -->
    <link rel="stylesheet" text="text/css" href="<?= base_url() ?>/assets/plugins/utama/css/bootstrap.min.css" />
    <link rel="stylesheet" text="text/css" href="<?= base_url() ?>/assets/plugins/utama/css/fonts.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" text="text/css" href="<?= base_url() ?>/assets/plugins/utama/css/animate.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Condensed' rel='stylesheet'>
    <link rel="stylesheet" text="text/css" href="<?= base_url() ?>/assets/plugins/utama/css/styles.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" text="text/css" href="<?= base_url() ?>/assets/plugins/utama/css/timeline-cso.min.css">
    <link rel="stylesheet" text="text/css" href="<?= base_url() ?>/assets/plugins/utama/css/sweet.min.css">
    <link rel="stylesheet" text="text/css" href="<?= base_url() ?>/assets/plugins/utama/css/loader.css">
    <script src="<?= base_url() ?>/assets/plugins/utama/js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
    <!-- <script src="<?= base_url() ?>/assets/plugins/utama/js/loader.js"></script> -->
    <script src="<?= base_url() ?>/assets/plugins/utama/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/utama/js/timeline.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/utama/js/styles.cso.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/utama/js/faq.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/utama/js/sweet.min.js"></script>
</head>
<style type="text/css">
    .bg-modal {
        background-color: rgba(0, 0, 0, 0.8);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        display: none;
        -webkit-box-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        align-items: center;
        z-index: 999;
    }

    .modal-contents {
        height: 300px;
        width: 500px;
        background-color: white;
        text-align: center;
        padding: 20px;
        position: relative;
        border-radius: 4px;
    }
</style>

<style>
    .modal-open {
        overflow: hidden;
    }

    .modal-open .modal {
        overflow-x: hidden;
        overflow-y: auto;
    }

    .modal {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1050;
        display: none;
        width: 100%;
        height: 100%;
        overflow: hidden;
        outline: 0;
    }

    .modal-dialog {
        position: relative;
        width: auto;
        margin: 0.5rem;
        pointer-events: none;
    }

    .modal.fade .modal-dialog {
        transition: -webkit-transform 0.3s ease-out;
        transition: transform 0.3s ease-out;
        transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
        -webkit-transform: translate(0, -50px);
        transform: translate(0, -50px);
    }

    @media (prefers-reduced-motion: reduce) {
        .modal.fade .modal-dialog {
            transition: none;
        }
    }

    .modal.show .modal-dialog {
        -webkit-transform: none;
        transform: none;
    }

    .modal.modal-static .modal-dialog {
        -webkit-transform: scale(1.02);
        transform: scale(1.02);
    }

    .modal-dialog-scrollable {
        display: -ms-flexbox;
        display: flex;
        max-height: calc(100% - 1rem);
    }

    .modal-dialog-scrollable .modal-content {
        max-height: calc(100vh - 1rem);
        overflow: hidden;
    }

    .modal-dialog-scrollable .modal-header,
    .modal-dialog-scrollable .modal-footer {
        -ms-flex-negative: 0;
        flex-shrink: 0;
    }

    .modal-dialog-scrollable .modal-body {
        overflow-y: auto;
    }

    .modal-dialog-centered {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        min-height: calc(100% - 1rem);
    }

    .modal-dialog-centered::before {
        display: block;
        height: calc(100vh - 1rem);
        content: "";
    }

    .modal-dialog-centered.modal-dialog-scrollable {
        -ms-flex-direction: column;
        flex-direction: column;
        -ms-flex-pack: center;
        justify-content: center;
        height: 100%;
    }

    .modal-dialog-centered.modal-dialog-scrollable .modal-content {
        max-height: none;
    }

    .modal-dialog-centered.modal-dialog-scrollable::before {
        content: none;
    }

    .modal-content {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        width: 100%;
        pointer-events: auto;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 0.3rem;
        outline: 0;
    }

    .modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1040;
        width: 100vw;
        height: 100vh;
        background-color: #000;
    }

    .modal-backdrop.fade {
        opacity: 0;
    }

    .modal-backdrop.show {
        opacity: 0.5;
    }

    .modal-header {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: start;
        align-items: flex-start;
        -ms-flex-pack: justify;
        justify-content: space-between;
        padding: 1rem 1rem;
        border-bottom: 1px solid #dee2e6;
        border-top-left-radius: calc(0.3rem - 1px);
        border-top-right-radius: calc(0.3rem - 1px);
    }

    .modal-header .close {
        padding: 1rem 1rem;
        margin: -1rem -1rem -1rem auto;
    }

    .modal-title {
        margin-bottom: 0;
        line-height: 1.5;
    }

    .modal-body {
        position: relative;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1rem;
    }

    .modal-footer {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: end;
        justify-content: flex-end;
        padding: 0.75rem;
        border-top: 1px solid #dee2e6;
        border-bottom-right-radius: calc(0.3rem - 1px);
        border-bottom-left-radius: calc(0.3rem - 1px);
    }

    .modal-footer>* {
        margin: 0.25rem;
    }

    .modal-scrollbar-measure {
        position: absolute;
        top: -9999px;
        width: 50px;
        height: 50px;
        overflow: scroll;
    }

    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 500px;
            margin: 1.75rem auto;
        }

        .modal-dialog-scrollable {
            max-height: calc(100% - 3.5rem);
        }

        .modal-dialog-scrollable .modal-content {
            max-height: calc(100vh - 3.5rem);
        }

        .modal-dialog-centered {
            min-height: calc(100% - 3.5rem);
        }

        .modal-dialog-centered::before {
            height: calc(100vh - 3.5rem);
        }

        .modal-sm {
            max-width: 300px;
        }
    }

    @media (min-width: 992px) {

        .modal-lg,
        .modal-xl {
            max-width: 800px;
        }
    }

    @media (min-width: 1200px) {
        .modal-xl {
            max-width: 1140px;
        }
    }
</style>


<body>
    <div class="bg-modal">
        <div class="modal-contents">

            <div class="fas fa-plus close"></div>
            <img src="https://richardmiddleton.me/comic-100.png" alt="">

            <form action="">
                <input type="text" placeholder="Name">
                <input type="email" placeholder="E-Mail">
                <a href="#" class="button">Submit</a>
            </form>

        </div>
    </div>
    <div class="ff-row" id="body">
        <div class="col s12 ff-layout ff-theme" id="home">
            <div class="ff-header">
                <!-- Navigation bar content -->
                <!-- Navigation bar for PC -->
                <nav class="ff-navbar ff-theme noselect">
                    <a data-target="slide-out" class="ff-hamburger sidenav-trigger">
                        <i class="fas fa-bars fa-lg"></i> &nbsp;
                        <font class="ff-navbar-tittle">CSO 2020</font>
                    </a>
                    <div class="nav-wrapper">
                        <ul class="ff-navbar-tittle-pc hide-on-med-and-down">
                            <li><a onclick="location.reload()"><i><img src="<?= base_url() ?>/upload/img/logo/logo-cso.png"></i>CSO 2020</a></li>
                        </ul>
                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                            <li><a onclick="scrollToElement('#home')">Home</a></li>
                            <li><a onclick="scrollToElement('#timeline', true)">Timeline</a></li>
                            <li><a onclick="scrollToElement('#about', true)">About</a></li>
                            <li><a onclick="scrollToElement('#gift', true)">Prize</a></li>
                            <li><a onclick="scrollToElement('#faq', true)">FAQ</a></li>
                            <li><a onclick="scrollToElement('#contact', true)">Contact</a></li>
                        </ul>
                    </div>
                </nav>

                <!-- Navigation bar for Mobile -->
                <ul id="slide-out" class="sidenav noselect">
                    <li>
                        <div class="user-view">
                            <div class="background">
                                <div class="ff-doodle ff-theme"></div>
                            </div>
                            <a><img class="circle" src="<?= base_url() ?>/upload/img/logo/logo-cso.png"></a>
                            <a><span class="white-text name">CSO 2020</span></a>
                            <a><span class="white-text email">UPN "Veteran" Jawa Timur</span></a>
                        </div>
                    </li>
                    <li><a class="waves-effect sidenav-close" onclick="scrollToElement('#home')">Home</a></li>
                    <li><a class="waves-effect sidenav-close" onclick="scrollToElement('#timeline', true)">Timeline</a></li>
                    <li><a class="waves-effect sidenav-close" onclick="scrollToElement('#about', true)">About</a></li>
                    <li><a class="waves-effect sidenav-close" onclick="scrollToElement('#gift', true)">Prize</a></li>
                    <li><a class="waves-effect sidenav-close" onclick="scrollToElement('#faq', true)">FAQ</a></li>
                    <li><a class="waves-effect sidenav-close" onclick="scrollToElement('#contact', true)">Contact</a></li>
                </ul>

                <div class="vieweditdata" style="display: none;"></div>

                <!-- Header content -->
                <div class="container white-text ff-header-content">
                    <div class="row ff-row">
                        <div class="col s12 l7 right noselect">
                            <div class="ff-header-bg">
                                <img style="height: 310px;" src="<?= base_url() ?>/upload/img/logo/logo-cso.png">
                            </div>
                            <div class="loader">
                                <div class="ringOne ring">
                                    <img class="circle-ring" src="<?= base_url(); ?>/upload/img/logo/ring.png" alt="">
                                </div>
                                <div class="ringTwo ring">
                                    <img class="circle-ring" src="<?= base_url(); ?>/upload/img/logo/ring.png" alt="">
                                </div>
                                <!-- <div class="circlel" style="height: 310px;"> -->
                                <!-- </div> -->
                            </div>
                        </div>
                        <div class="col s10 offset-s1 l4 offset-l1">
                            <!-- <p class="primary center">CSO 2020</p> -->
                            <p class="primary center" data-shadow="FasilkomFest2020">FasilkomFest2020</p>
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
                                            <div class="center">
                                                <h5>21 dan 29 November 2020</h5>
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
            </div>
        </div>

        <div class="col s12 ff-layout secondary black" id="timeline">
            <div class="container" style="width: 100% !important">
                <div class="row ff-row">
                    <div class="col s12 ff-event-tittle">
                        TIMELINE
                    </div>
                </div>
                <div class="row ff-row ff-timeline">
                    <div class="col s12">
                        <div class="timeline" id="timeline-horizontal">
                            <div class="timeline__wrap">
                                <div class="timeline__items">
                                    <div class="timeline__item">
                                        <div class="timeline__content">
                                            <h2>September</h2>
                                            <p>Pembukaan pendaftaran CSO secara online</p>
                                        </div>
                                    </div>
                                    <div class="timeline__item">
                                        <div class="timeline__content">
                                            <h2>30 Oktober 2020</h2>
                                            <p>Penutupan pendaftaran online CSO</p>
                                        </div>
                                    </div>
                                    <div class="timeline__item">
                                        <div class="timeline__content">
                                            <h2>21 November 2020</h2>
                                            <p>Babak penyisihan CSO offline dan online (Peserta mengerjakan soal secara online dan offline serentak)</p>
                                        </div>
                                    </div>
                                    <div class="timeline__item">
                                        <div class="timeline__content">
                                            <h2>------------</h2>
                                            <p>Pengumuman finalis, pemberian silabus dan <i>Technical Meeting</i></p>
                                        </div>
                                    </div>
                                    <div class="timeline__item">
                                        <div class="timeline__content">
                                            <h2>00000000000</h2>
                                            <p><i>Technical Meeting</i> sebelum menuju ke babak final</p>
                                        </div>
                                    </div>
                                    <div class="timeline__item">
                                        <div class="timeline__content">
                                            <h2>29 November 2020</h2>
                                            <p>Babak Final yang di lakukan secara online</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 ff-layout secondary teal" id="about">
            <div class="container" style="width: 100% !important">
                <br>
                <div class="row ff-row">
                    <div class="col s12 m10 offset-m1">
                        <p class="ff-about-desc">
                            <b>CSO</b> atau <b>Computer Science Olympiad</b> merupakan kompetisi yang menguji wawasan
                            dan kemampuan dalam memecahkan masalah seputar ilmu komputer. Acara ini merupakan
                            bagian dari serangkaian acara <b>FASILKOM FEST 2020</b> yang diselenggarakan. <b>Computer
                                Science Olympiad</b> ditujukan untuk siswa SMA / SMK / MA / MAK dan sekolah
                            lain yang sederajat.
                        </p>
                    </div>
                    <div class="col s12 m10 offset-m1 ff-about-btn">
                        <button type="submit" class="btn waves-effect black-text white logincso">
                            MASUK
                        </button>
                        <a class="btn waves-effect white-text transparent register space-margin" href="<?= base_url('cso/masuk') ?>">DAFTAR</a>
                    </div>
                </div>
                <br>
                <div class="row ff-row">
                    <div class="col s12 m10 offset-m1">
                        <div class="row ff-row">
                            <div class="card red hoverable" id="contohSoal">
                                <div class="card-content">
                                    <h5 class="white-text center">CONTOH SOAL YANG DILOMBAKAN</h5>
                                </div>
                                <div class="card-tabs">
                                    <ul class="tabs tabs-fixed-width tabs-transparent">
                                        <li class="tab"><a class="active" href="#tab1">LOGIKA</a></li>
                                        <li class="tab"><a href="#tab2">MANAJEMEN BISNIS</a></li>
                                        <li class="tab"><a href="#tab3">PEMOGRAMAN</a></li>
                                        <li class="tab"><a href="#tab4">JARINGAN</a></li>
                                        <li class="tab"><a href="#tab5">KECERDASAN BUATAN</a></li>
                                    </ul>
                                </div>
                                <div class="card-content grey lighten-4">
                                    <div id="tab1">
                                        <p>Terdapat 40 orang di dalam sebuah ruangan yang sedang melangsungkan sebuah pertemuan.
                                            Setelah pertemuan selesai seluruh peserta berjabat tangan satu sama lain.
                                            Dengan asumsi satu orang berjabat tangan tepat satu kali dengan orang yang lain.
                                            Berapa banyak jabat tangan yang terjadi pada ruangan tersebut?<br>
                                            <br><b>a. 780</b>
                                            <br>b. 800
                                            <br>c. 720
                                            <br>d. 750
                                            <br>e. 820
                                        </p>
                                    </div>
                                    <div id="tab2">
                                        <p>Jenis biaya yang tidak perlu dikeluarkan oleh perusahaan ketika tidak berproduksi adalah<br>
                                            <br>a. Biaya tetap
                                            <br>b. Biaya total
                                            <br>c. Biaya marginal
                                            <br><b>d. Biaya variabel</b>
                                            <br>e. Biaya peluang
                                        </p>
                                    </div>
                                    <div id="tab3">
                                        <p>if (a > b):<br>
                                            &ensp; if (c > a):<br>
                                            &ensp; &ensp; tmp = c<br>
                                            &ensp; else:<br>
                                            &ensp; &ensp; tmp = a<br>
                                            else:<br>
                                            &ensp; if (c > b):<br>
                                            &ensp; &ensp; tmp = c<br>
                                            &ensp; else:<br>
                                            &ensp; &ensp; tmp = b<br>
                                            print(tmp)<br><br>
                                            Apabila diberikan nilai a = 3; b = 5; c = 8, berapakah output dari program tersebut?<br>
                                            <br>a. 5
                                            <br>b. 6
                                            <br>c. 9
                                            <br>d. 7
                                            <br><b>e. 8</b>
                                        </p>
                                    </div>
                                    <div id="tab4">
                                        <p>Satu model jaringan komputer yang terdiri dari dua atau beberapa komputer,
                                            dimana setiap komputer yang terdapat di dalam lingkungan jaringan tersebut
                                            bisa saling berbagi dan masing-masing komputer dapat menjadi client dan
                                            server disebut?<br>
                                            <br>a. Client-Server
                                            <br><b>b. Peer to peer</b>
                                            <br>c. Wireless
                                            <br>d. Distributed
                                            <br>e. LAN
                                        </p>
                                    </div>
                                    <div id="tab5">
                                        <p>Di antara berikut ini yang merupakan algoritma Deep Learning adalah?<br>
                                            <br>a. Support Vector Machine
                                            <br>b. Random Forest
                                            <br><b>c. Convolutional Neural Network</b>
                                            <br>d. Decision Tree
                                            <br>e. Gradient Boosting
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br class="hide-on-small-only">
            </div>
        </div>
    </div>
    </div>
    <!-- <a href="#" id="buttonlogina" class="button">Click Me</a> -->

    <div class="col s12 ff-layout secondary white" id="gift">
        <div class="container" style="width: 78% !important">
            <div class="row ff-row">
                <div class="col s12 ff-event-tittle" style="font-size: 25px">
                    HADIAH PEMENANG
                </div>
            </div>
            <div class="row ff-row" style="margin: 60px 0px 0px 0px !important">
                <div class="col l4 s12">
                    <div class="ff-gift pink">
                        <a class="fa fa-trophy"></a>
                        <p class="primary">Juara 1</p>
                        <div class="gift-list">
                            <ul>
                                <li>Rp 3.000.000</li>
                                <li>Sertifikat</li>
                                <li>Tropi</li>
                            </ul>
                        </div>
                    </div>
                    <br><br><br>
                </div>
                <div class="col l4 s12 center">
                    <div class="ff-gift deep-purple">
                        <a class="fa fa-trophy"></a>
                        <p class="primary">Juara 2</p>
                        <div class="gift-list">
                            <ul>
                                <li>Rp 2.000.000</li>
                                <li>Sertifikat</li>
                                <li>Tropi</li>
                            </ul>
                        </div>
                    </div>
                    <br><br><br>
                </div>
                <div class="col l4 s12 center">
                    <div class="ff-gift teal">
                        <a class="fa fa-trophy"></a>
                        <p class="primary">Juara 3</p>
                        <div class="gift-list">
                            <ul>
                                <li>Rp 1.000.000</li>
                                <li>Sertifikat</li>
                                <li>Tropi</li>
                            </ul>
                        </div>
                    </div>
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" class="form-control input-sm col-md-3" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />

    <div class="col s12 ff-layout secondary teal" id="faq">
        <div class="container">
            <div class="row ff-row">
                <div class="col s12 ff-event-tittle white-text">
                    FREQUENTLY ASKED QUESTION
                </div>
            </div>
            <br>
            <div class="row ff-row">
                <div class="col s12" id="faq-content">
                </div>
            </div>
            <br><br>
        </div>
    </div>

    <div class="col s12 ff-layout secondary ff-theme" id="contact">
        <?php
        // include("_include/contact.php");
        ?>
    </div>

    <div class="col s12 ff-layout secondary ff-theme-dark" id="footer">
        <?php
        // include("_include/footer.php");
        ?>
    </div>

    </div>


    <script>
        timeline(document.querySelectorAll('#timeline-horizontal'), {
            forceVerticalMode: 800,
            mode: 'horizontal',
            visibleItems: 4
        });
    </script>
    <!-- <div class="row ff-row loader-body valign-wrapper animated" id="loader-bg">
        <div class="col s12 m6 l4 offset-m3 offset-l4 center">
            <div class="logo" id="loader-logo">
                <img src="img/logo/logo-fasilkomfest0.png">
            </div>
            <br><br>
            <div class="progress center" id="loader-progress">
                <div class="indeterminate lighten-3"></div>
            </div>
        </div>
    </div> -->

    <script>
        document.getElementById('buttonlogina').addEventListener("click", function() {
            document.querySelector('.bg-modal').style.display = "flex";
        });

        document.querySelector('.close').addEventListener("click", function() {
            document.querySelector('.bg-modal').style.display = "none";
        });
    </script>

    <script type="text/javascript">
        $('.logincso').click(function(e) {
            $.ajax({
                url: "<?= site_url('cso/login') ?>",
                type: "POST",
                data: {
                    csrf_test_name: $('input[name=csrf_test_name]').val()
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.vieweditdata').html(response.sukses).show();
                        $('#tambahdata').modal('show');
                    }
                    $('input[name=csrf_test_name]').val(response.csrf_test_name);
                },
                // error: function(xhr, ajaxOption, thrownError) {
                //     alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                // }
            });
        });

        function forgotPassword() {
            $(document).ready(function() {
                $('.vieweditdata').html(response.sukses).hide();
                $('#tambahdata').modal().hide();
            });
        }
    </script>

    <script>
        let countDown = new Date('<<?= $time ?>').getTime();

        function setCountDownCSO(value) {

            const second = 1000,
                minute = second * 60,
                hour = minute * 60,
                day = hour * 24;

            // let countDown = waktuLomba.getTime(),

            let now = new Date().getTime(),
                distance = countDown - now;

            document.getElementById('days').innerText = Math.floor(distance / (day)),
                document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
                document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
                document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);

            // do something later when date is reached

            var date_string = "";

            if (distance < 0) {
                date_string = "Timer sudah berakhir, silahkan segera mengumpulkan jawaban";
                $('#days').text("0");
                $('#hours').text("0");
                $('#minutes').text("0");
                $('#seconds').text("0");
            } else {
                date_string = "Disarankan untuk mengirim jawaban 5 menit sebelum timer berakhir";
            }

        }

        setInterval(function(params) {
            setCountDownCSO();
        }, 1000)
    </script>
    <script>
        AOS.init();
    </script>
</body>

</html>