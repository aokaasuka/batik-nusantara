<!-- # site-content 
        ================================================== -->
<div id="content" class="s-content s-content--blog">

    <div class="row entry-wrap">
        <div class="column lg-12">

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
                return date('j', $timestamp) . ' ' . $month . ' ' . date('Y', $timestamp);
            }
            ?>

            <article class="entry format-standard2">

                <header class="entry__header">

                    <h1 class="entry__title">
                        <?= $blog['blog_title'] ?>.
                    </h1>

                    <div class="entry__meta">
                        <div class="entry__meta-author">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="3.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.8475 19.25H17.1525C18.2944 19.25 19.174 18.2681 18.6408 17.2584C17.8563 15.7731 16.068 14 12 14C7.93201 14 6.14367 15.7731 5.35924 17.2584C4.82597 18.2681 5.70558 19.25 6.8475 19.25Z">
                                </path>
                            </svg>
                            <a><?= $blog['writter']; ?></a>
                        </div>
                        <div class="entry__meta-date">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="7.25" stroke="currentColor" stroke-width="1.5">
                                </circle>
                                <path stroke="currentColor" stroke-width="1.5" d="M12 8V12L14 14"></path>
                            </svg>
                            <?php echo format_date($blog['date_post']); ?>
                        </div>
                    </div>
                </header>


                <div style="text-align: center;">
                    <img src="<?= base_url('assets/images/post/' . $blog['image']); ?>" style="max-height: 420px; width: auto; display: inline-block;" alt="image">
                </div>


                <div class="content-primary">

                    <div class="entry__content">

                        <?php
                        // Misalkan $blog['content'] berisi teks dari database
                        $content = $blog['content'];

                        // Konversi baris baru menjadi tag <br>
                        $content_with_br = nl2br(htmlspecialchars_decode($content, ENT_QUOTES));
                        ?>

                        <p class="drop-cap">
                            <?= $content_with_br; ?>
                        </p>



                    </div> <!-- end entry-content -->



                </div> <!-- end content-primary -->

            </article> <!-- end entry -->

            <!-- comments -->
            <div class="comments-wrap">

                <div class="comment-respond">

                    <!-- START respond -->
                    <div id="respond">

                        <h3>
                            Tambahkan Komentar
                        </h3>

                        <form name="commentForm" id="commentForm" method="post" action="<?= base_url('blog/content/' . $blog['slug']); ?>" autocomplete="off">
                            <fieldset class="row">

                                <div class="column lg-12 message form-field">
                                    <textarea name="comment" id="comment" class="u-fullwidth" placeholder="Komentar"></textarea>
                                </div>

                                <div class="column lg-12">
                                    <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large u-fullwidth" value="Tambahkan Komentar" type="submit">
                                </div>

                            </fieldset>
                        </form> <!-- end form -->

                    </div>
                    <!-- END respond-->

                </div> <!-- end comment-respond -->

                <div id="comments">
                    <div class="large-12">

                        <?php if (count($comments) == 0) : ?>
                            <h3>Belum ada komentar</h3>
                        <?php else : ?>
                            <h3><?= count($comments); ?> Komentar</h3>
                        <?php endif; ?>

                        <!-- START commentlist -->
                        <ol class="commentlist">

                            <?php foreach ($comments as $c) : ?>
                                <li class="depth-1 comment">

                                    <div class="comment__avatar">
                                        <img class="avatar" src="<?= base_url('assets/'); ?>images/avatars/default.jpg" alt="" width="50" height="50">
                                    </div>

                                    <div class="comment__content">

                                        <div class="comment__info">
                                            <div class="comment__author">Anonim</div>

                                            <div class="comment__meta">
                                                <div class="comment__time"><?php echo format_date($c['date_created']); ?></div>
                                            </div>
                                        </div>

                                        <div class="comment__text">
                                            <p><?= $c['comment']; ?></p>
                                        </div>

                                    </div>

                                </li> <!-- end comment level 1 -->


                            <?php endforeach; ?>

                        </ol>
                        <!-- END commentlist -->

                    </div> <!-- end col-full -->
                </div> <!-- end comments -->

            </div> <!-- end comments-wrap -->

        </div>
    </div> <!-- end entry-wrap -->
    </section> <!-- end s-content -->