<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"></h1>

        <div class="card mb-4">
            <div class="card-body">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/addnewgallery'); ?>" class="btn btn-primary">Add New Gallery</a></li>
                </ol>
                <?= $this->session->flashdata('message');
                ?>
                <?php $this->session->unset_userdata('message'); ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        All Data
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Blog title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Blog title</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
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
                                <?php foreach ($galleries as $g) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $g['title']; ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/editgallery/' . $g['id']); ?>" class="btn btn-warning">Edit</a>
                                            <a href="<?= base_url('admin/deletegallery/' . $g['id']); ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>