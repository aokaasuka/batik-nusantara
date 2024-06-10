<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/manageevents'); ?>">Back</a></li>
            <li class="breadcrumb-item active">Add New Event</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <?= form_open_multipart('admin/addnewevent'); ?>
                        <div class="mb-3">
                            <label for="event_name" class="form-label">Event Name</label>
                            <input type="text" class="form-control" id="event_name" name="event_name" value="<?= set_value('event_name'); ?>">
                            <?= form_error('event_name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label for="period" class="form-label">Period</label>
                            <input type="text" class="form-control" id="period" name="period" value="<?= set_value('period'); ?>">
                            <?= form_error('period', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" style="height: 150px"><?= set_value('description'); ?></textarea>
                            <?= form_error('description', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept=".png, .jpg, .jpeg, .gif">
                            <?= form_error('image', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>