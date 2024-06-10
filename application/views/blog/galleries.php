<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri Batik - BatikNusantara</title>

    <script>
        document.documentElement.classList.remove('no-js');
        document.documentElement.classList.add('js');
    </script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="<?= base_url('vendor/batikNusantara/'); ?>css/vendor.css">
    <link rel="stylesheet" href="<?= base_url('vendor/batikNusantara/'); ?>css/styles.css">

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

</head>

<body id="top">


    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader" class="dots-fade">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>


    <!-- page wrap
    ================================================== -->
    <div id="page" class="s-pagewrap">


        <!-- # site header 
        ================================================== -->
        <header id="masthead" class="s-header">

            <div class="s-header__branding">
                <p class="site-title">
                    <a href="<?= base_url('blog'); ?>" rel="home">BatikNusantara.</a>
                </p>
            </div>

            <div class="row s-header__navigation">

                <nav class="s-header__nav-wrap">

                    <h3 class="s-header__nav-heading">Navigate to</h3>

                    <ul class="s-header__nav">
                        <li><a href="<?= base_url('blog'); ?>" title="">Beranda</a></li>
                        <li class="has-children">
                            <a href="#0" title="" class="">Kategori</a>
                            <ul class="sub-menu">
                                <li>
                                    <?php foreach ($blog2 as $b) : ?>
                                        <?php if ($b['slug'] == 'sejarah-batik') : ?>
                                            <a href="<?= base_url('blog/content/' . $b['slug']); ?>">Sejarah Batik</a>
                                        <?php elseif ($b['slug'] == 'jenis-jenis-batik-di-indonesia') : ?>
                                            <a href="<?= base_url('blog/content/' . $b['slug']); ?>">Jenis-Jenis Batik</a>
                                        <?php elseif ($b['slug'] == 'teknik-pembuatan-batik') : ?>
                                            <a href="<?= base_url('blog/content/' . $b['slug']); ?>">Teknik Pembuatan Batik</a>
                                        <?php elseif ($b['slug'] == 'motif-batik') : ?>
                                            <a href="<?= base_url('blog/content/' . $b['slug']); ?>">Motif Batik</a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </li>
                                <li>
                                    <a href="#">Event Batik</a>
                                </li>
                                <li>
                                    <a href="#">Berita Batik</a>
                                </li>
                            </ul>
                        </li>
                        <li class="current-menu-item"><a href="<?= base_url('blog/galleries'); ?>" title="">Galeri Batik</a></li>
                        <!-- Galeri Batik adalah tempat di mana Anda dapat menampilkan koleksi gambar-gambar batik secara visual. Ini bisa menjadi galeri foto atau gambar-gambar yang menampilkan berbagai jenis batik, motif-motif yang beragam, serta contoh-contoh batik yang unik dan menarik. Galeri Batik ini dapat menjadi sarana untuk menginspirasi pengunjung dengan keindahan dan keragaman batik.

                        Sementara itu, submenu seperti "Jenis-jenis Batik" atau "Seni dan Desain Batik" cenderung lebih fokus pada penjelasan dan informasi tertulis tentang jenis-jenis batik, motif-motif yang ada, atau tren desain batik. Ini mungkin termasuk deskripsi tekstual, sejarah, atau konteks budaya di balik berbagai jenis batik dan motif.

                        Jadi, sementara Galeri Batik menampilkan batik dalam bentuk gambar-gambar, submenu yang lain memberikan informasi lebih mendalam dan kontekstual tentang berbagai aspek batik, seperti sejarah, teknik pembuatan, jenis-jenis, dan desain. -->
                    </ul> <!-- end s-header__nav -->

                </nav> <!-- end s-header__nav-wrap -->

            </div> <!-- end s-header__navigation -->

            <div class="s-header__search">

                <div class="s-header__search-inner">
                    <div class="row">

                        <form role="search" method="get" class="s-header__search-form" action="#">
                            <label>
                                <span class="u-screen-reader-text">Search for:</span>
                                <input type="search" class="s-header__search-field" placeholder="Search for..." value="" name="s" title="Search for:" autocomplete="off">
                            </label>
                            <input type="submit" class="s-header__search-submit" value="Search">
                        </form>

                        <a href="#0" title="Close Search" class="s-header__search-close">Close</a>

                    </div> <!-- end row -->
                </div> <!-- s-header__search-inner -->

            </div> <!-- end s-header__search -->

            <a class="s-header__menu-toggle" href="#0"><span>Menu</span></a>
            <a class="s-header__search-trigger" href="#">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 19.25L15.5 15.5M4.75 11C4.75 7.54822 7.54822 4.75 11 4.75C14.4518 4.75 17.25 7.54822 17.25 11C17.25 14.4518 14.4518 17.25 11 17.25C7.54822 17.25 4.75 14.4518 4.75 11Z">
                    </path>
                </svg>
            </a>

        </header> <!-- end s-header -->


        <!-- # site-content
        ================================================== -->
        <section id="content" class="s-content">


            <!-- pageheader -->
            <div class="s-pageheader">
                <div class="row">
                    <div class="column large-12">
                        <h1 class="page-title pt-5">
                            Galeri Batik
                        </h1>
                    </div>
                </div>
            </div> <!-- end s-pageheader-->



            <!--  masonry -->
            <div id="bricks" class="bricks">

                <div class="masonry">

                    <div class="bricks-wrapper" data-animate-block>

                        <div class="grid-sizer"></div>

                        <?php foreach ($galleries as $index => $g) : ?>
                            <article class="brick entry" data-animate-el>

                                <div class="entry__thumb" style="height: 300px; overflow: hidden;">
                                    <a href="#" class="thumb-link" style="display: block; height: 100%;" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $index; ?>">
                                        <img src="<?= base_url('assets/images/galleries/' . $g['image']); ?>" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                    </a>
                                </div> <!-- end entry__thumb -->

                                <div class="entry__text">
                                    <div class="entry__header">
                                        <h1 class="entry__title"><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $index; ?>"><?= $g['title']; ?>.</a></h1>
                                    </div>
                                </div> <!-- end entry__text -->

                            </article> <!-- end article -->



                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?= $index; ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $index; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex align-items-center">
                                            <h5 class="modal-title"><?= $g['title']; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">

                                                <img src="<?= base_url('assets/images/galleries/' . $g['image']); ?>" alt="" width="100%">

                                                <?php
                                                // Misalkan $blog['description'] berisi teks dari database
                                                $description = $g['description'];

                                                // Konversi baris baru menjadi tag <br>
                                                $description_with_br = nl2br($description);
                                                ?>

                                                <p style="text-align: justify;"><?= $description_with_br; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div> <!-- end bricks-wrapper -->

                </div> <!-- end masonry-->


                <!-- pagination -->
                <div class="row pagination">
                    <div class="column lg-12">
                        <nav class="pgn">
                            <ul>
                                <li>
                                    <a class="pgn__prev" href="#0">
                                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li><a class="pgn__num" href="#0">1</a></li>
                                <li><span class="pgn__num current">2</span></li>
                                <li><a class="pgn__num" href="#0">3</a></li>
                                <li><a class="pgn__num" href="#0">4</a></li>
                                <li><a class="pgn__num" href="#0">5</a></li>
                                <li><span class="pgn__num dots">…</span></li>
                                <li><a class="pgn__num" href="#0">8</a></li>
                                <li>
                                    <a class="pgn__next" href="#0">
                                        <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.75 6.75L19.25 12L13.75 17.25"></path>
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 12H4.75"></path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </nav> <!-- end pgn -->
                    </div> <!-- end column -->
                </div> <!-- end pagination -->

            </div> <!-- end bricks -->

        </section> <!-- end s-content -->