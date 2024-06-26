<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Login</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('auth'); ?>">
                            <?= $this->session->flashdata('message');
                            ?>
                            <?php $this->session->unset_userdata('message'); ?>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" name="email" type="text" placeholder="your email" value="<?= set_value('email'); ?>" />
                                <label for="email">Email address</label>
                                <?= form_error('email', '<small class="text-danger ps-3">', '</small>'); ?>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="password" name="password" type="password" placeholder="your password" value="<?= set_value('password'); ?>" />
                                <label for="password">Password</label>
                                <?= form_error('password', '<small class="text-danger ps-3">', '</small>'); ?>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>