<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manage Events</h1>

        <div class="card mb-4">
            <div class="card-body">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/addnewevent'); ?>" class="btn btn-primary">Add New Event</a></li>
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
                                    <th>Poster image</th>
                                    <th>Event name</th>
                                    <th>Period</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Poster image</th>
                                    <th>Event name</th>
                                    <th>Period</th>
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
                                <?php foreach ($events as $e) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td>
                                            <img src="<?= base_url('assets/images/events/' . $e['image']); ?>" alt="" class="img-fluid" style="max-width: 200px; width: 100%; height: auto;">
                                        </td>
                                        <td><?= $e['event_name']; ?></td>
                                        <td><?= $e['period']; ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/editevent/' . $e['id']); ?>" class="btn btn-warning">Edit</a>
                                            <a href="<?= base_url('admin/deleteevent/' . $e['id']); ?>" class="btn btn-danger">Delete</a>
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