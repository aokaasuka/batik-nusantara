<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/manageevents'); ?>">Back</a></li>
            <li class="breadcrumb-item active">Edit Event</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <?= form_open_multipart('admin/editsevent'); ?>
                        <?= $this->session->flashdata('message');
                        ?>
                        <?php $this->session->unset_userdata('message'); ?>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $event['id']; ?>" hidden>
                        <div class="mb-3">
                            <label for="event_name" class="form-label">Event Name</label>
                            <input type="text" class="form-control" id="event_name" name="event_name" value="<?= $event['event_name']; ?>">
                            <?= form_error('event_name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label for="period" class="form-label">Period</label>
                            <input type="text" class="form-control" id="period" name="period" value="<?= $event['period']; ?>">
                            <?= form_error('period', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" style="height: 200px"><?= $event['description']; ?></textarea>
                            <?= form_error('description', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="<?= base_url('assets/images/events/' . $event['image']); ?>" alt="" width="100%">
                                </div>
                                <div class="col-md-7">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept=".png, .jpg, .jpeg, .gif">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>