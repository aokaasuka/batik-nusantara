<!-- # site-content
        ================================================== -->
<section id="content" class="s-content">


    <!-- hero -->
    <div class="hero">

        <div class="hero__slider swiper-container">

            <div class="swiper-wrapper">
                <?php foreach ($blog2 as $b) : ?>
                    <?php if ($b['slug'] == 'sejarah-batik') : ?>
                        <article class="hero__slide swiper-slide">
                            <a href="<?= base_url('blog/content/' . $b['slug']); ?>">
                                <div class="hero__entry-image" style="background-image: url('<?= base_url('./assets/images/post/' . $b['image']); ?>');"></div>
                            </a>
                            <div class="hero__entry-text">
                                <div class="hero__entry-text-inner">
                                    <h2 class="hero__entry-title">
                                        <a href="<?= base_url('blog/content/' . $b['slug']); ?>">
                                            <?= $b['blog_title']; ?>.
                                        </a>
                                    </h2>
                                    <p class="hero__entry-desc">
                                        <?= $b['preview']; ?>...
                                    </p>
                                    <a class="hero__more-link" href="<?= base_url('blog/content/' . $b['slug']); ?>">Read More</a>
                                </div>
                            </div>
                        </article>
                    <?php elseif ($b['slug'] == 'jenis-jenis-batik-di-indonesia') : ?>
                        <article class="hero__slide swiper-slide">
                            <a href="<?= base_url('blog/content/' . $b['slug']); ?>">
                                <div class="hero__entry-image" style="background-image: url('<?= base_url('./assets/images/post/' . $b['image']); ?>');"></div>
                            </a>
                            <div class="hero__entry-text">
                                <div class="hero__entry-text-inner">
                                    <h2 class="hero__entry-title">
                                        <a href="<?= base_url('blog/content/' . $b['slug']); ?>">
                                            <?= $b['blog_title']; ?>.
                                        </a>
                                    </h2>
                                    <p class="hero__entry-desc">
                                        <?= $b['preview']; ?>...
                                    </p>
                                    <a class="hero__more-link" href="<?= base_url('blog/content/' . $b['slug']); ?>">Read More</a>
                                </div>
                            </div>
                        </article>
                    <?php elseif ($b['slug'] == 'teknik-pembuatan-batik') : ?>
                        <article class="hero__slide swiper-slide">
                            <a href="<?= base_url('blog/content/' . $b['slug']); ?>">
                                <div class="hero__entry-image" style="background-image: url('<?= base_url('./assets/images/post/' . $b['image']); ?>');"></div>
                            </a>
                            <div class="hero__entry-text">
                                <div class="hero__entry-text-inner">
                                    <h2 class="hero__entry-title">
                                        <a href="<?= base_url('blog/content/' . $b['slug']); ?>">
                                            <?= $b['blog_title']; ?>.
                                        </a>
                                    </h2>
                                    <p class="hero__entry-desc">
                                        <?= $b['preview']; ?>...
                                    </p>
                                    <a class="hero__more-link" href="<?= base_url('blog/content/' . $b['slug']); ?>">Read More</a>
                                </div>
                            </div>
                        </article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div> <!-- swiper-wrapper -->

            <div class="swiper-pagination"></div>

        </div> <!-- end hero slider -->

        <a href="#bricks" class="hero__scroll-down smoothscroll">
            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.25 6.75L4.75 12L10.25 17.25"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.25 12H5"></path>
            </svg>
            <span>Scroll</span>
        </a>

    </div> <!-- end hero -->


    <!--  masonry -->
    <div id="bricks" class="bricks">

        <div class="masonry">

            <div class="bricks-wrapper" data-animate-block>

                <div class="grid-sizer"></div>


                <?php
                $i = 1;
                function format_date($timestamp)
                {
                    date_default_timezone_set('Asia/Jakarta');
                    $days_in_indonesian = array(
                        'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
                    );

                    $months_in_indonesian = array(
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    );

                    $day = $days_in_indonesian[date('w', $timestamp)];
                    $month = $months_in_indonesian[date('n', $timestamp) - 1];

                    return $day . ', ' . date('j', $timestamp) . ' ' . $month . ' ' . date('Y, H:i', $timestamp) . ' WIB';
                }

                ?>

                <?php foreach ($blog as $b) : ?>
                    <article class="brick entry" data-animate-el>

                        <div class="entry__thumb" style="height: 250px; overflow: hidden;">
                            <a href="<?= base_url('blog/content/' . $b['slug']); ?>" class="thumb-link" style="display: block; height: 100%;">
                                <img src="<?= base_url('assets/images/post/' . $b['image']); ?>" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                            </a>
                        </div> <!-- end entry__thumb -->


                        <div class="entry__text">
                            <div class="entry__header">
                                <div class="entry__meta">
                                    <span class="byline">
                                        <a href="#0"><?php echo format_date($b['date_post']); ?></a>
                                    </span>
                                </div>
                                <h1 class="entry__title"><a href="<?= base_url('blog/content/' . $b['slug']); ?>"><?= $b['blog_title']; ?>.</a></h1>
                            </div>
                            <div class="entry__excerpt">
                                <p><a href="<?= base_url('blog/content/' . $b['slug']); ?>" style="color: black"><?= $b['preview']; ?>...</a>
                                </p>
                            </div>
                            <a class="entry__more-link" href="<?= base_url('blog/content/' . $b['slug']); ?>">Read More</a>
                        </div> <!-- end entry__text -->

                    </article> <!-- end article -->
                <?php endforeach; ?>


            </div> <!-- end bricks-wrapper -->

        </div> <!-- end masonry-->

        <!-- pagination -->
        <div class="pagination">
            <?php echo $this->pagination->create_links(); ?>
        </div>
        <!-- end pagination -->

    </div> <!-- end bricks -->

</section> <!-- end s-content -->