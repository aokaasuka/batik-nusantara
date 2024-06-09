<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/managegalleries'); ?>">Back</a></li>
            <li class="breadcrumb-item active">Add New Gallery</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <?= form_open_multipart('admin/addnewgallery'); ?>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= set_value('title'); ?>">
                            <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" style="height: 200px"><?= set_value('description'); ?></textarea>
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