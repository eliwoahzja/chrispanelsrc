<?php
include('conn.php');
//include('mail.php');
?>

<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center pt-5">
    <div class="col-lg-4">
        <?= $this->include('Layout/msgStatus') ?>

        <div class="card shadow-sm mb-5">
            <div class="card-header h5 p-3 bg-dark text-white">
                Register
            </div>
            <div class="card-body">
                <?= form_open() ?>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Current Mail" minlength="13" maxlength="40" value="<?= old('email') ?>" required>
                    <label for="email">Email</label>
                    <?php if ($validation->hasError('email')) : ?>
                        <small class="text-danger"><?= $validation->getError('email') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Your username" minlength="4" maxlength="24" value="<?= old('username') ?>" required>
                    <label for="username">Username</label>
                    <?php if ($validation->hasError('username')) : ?>
                        <small class="text-danger"><?= $validation->getError('username') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Your fullname" minlength="4" maxlength="24" value="<?= old('fullname') ?>" required>
                    <label for="fullname">Full Name</label>
                    <?php if ($validation->hasError('fullname')) : ?>
                        <small class="text-danger"><?= $validation->getError('fullname') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-floating mb-3 position-relative">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" minlength="6" maxlength="24" required>
                    <label for="password">Password</label>
                    <i class="fa fa-fw fa-eye field_icon toggle-password position-absolute end-0 top-50 translate-middle-y me-3"></i>
                    <?php if ($validation->hasError('password')) : ?>
                        <small class="text-danger"><?= $validation->getError('password') ?></small>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <input type="checkbox" id="showPassword" class="form-check-input">
                    <label for="showPassword" class="form-check-label">Show Password</label>
                </div>
                <div class="form-floating mb-3 position-relative">
                    <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirm Password" minlength="6" maxlength="24" required>
                    <label for="password2">Confirm Password</label>
                    <i class="fa fa-fw fa-eye field_icon toggle-password2 position-absolute end-0 top-50 translate-middle-y me-3"></i>
                    <?php if ($validation->hasError('password2')) : ?>
                        <small class="text-danger"><?= $validation->getError('password2') ?></small>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <input type="checkbox" id="showPassword2" class="form-check-input">
                    <label for="showPassword2" class="form-check-label">Show Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="referral" id="referral" placeholder="Your Referral Code" value="<?= old('referral') ?>" maxlength="25" required>
                    <label for="referral">Referral Code</label>
                    <?php if ($validation->hasError('referral')) : ?>
                        <small class="text-danger"><?= $validation->getError('referral') ?></small>
                    <?php endif; ?>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-outline-dark shadow-sm" onclick="popup()"><i class="bi bi-box-arrow-in-right"></i> Register</button>
                </div>
                <div class="d-grid mb-3">
                    <a href="<?= site_url('login') ?>" class="btn btn-outline-dark shadow-sm"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
    $(document).on('click', '.toggle-password', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#password");
        input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
    });
    $(document).on('click', '.toggle-password2', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#password2");
        input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
    });

    $(document).on('click', '#showPassword', function() {
        var input = $("#password");
        if ($(this).is(':checked')) {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    });

    $(document).on('click', '#showPassword2', function() {
        var input = $("#password2");
        if ($(this).is(':checked')) {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    });
</script>
<?= $this->endSection() ?>
