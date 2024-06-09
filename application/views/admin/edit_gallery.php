<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/managegalleries'); ?>">Back</a></li>
            <li class="breadcrumb-item active">Edit Gallery</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <?= form_open_multipart('admin/editsgallery'); ?>
                        <?= $this->session->flashdata('message');
                        ?>
                        <?php $this->session->unset_userdata('message'); ?>
                        <input type="text" class="form-control" id="id" name="id" value="<?= $gallery['id']; ?>" hidden>
                        <div class="mb-3">
                            <label for="blog_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= $gallery['title']; ?>">
                            <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" style="height: 200px"><?= $gallery['description']; ?></textarea>
                            <?= form_error('description', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <img src="<?= base_url('assets/images/galleries/' . $gallery['image']); ?>" alt="" width="100%">
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