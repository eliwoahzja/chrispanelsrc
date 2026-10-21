<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center pt-3">
    <div class="col-lg-8">
        <?= $this->include('Layout/msgStatus') ?>
    </div>
    <div class="col-lg-8 mb-3">
        <div class="card mb-5">
            <div class="card-header p-3 bg-dark text-white">
                Account Info &middot; <?= getName($target) ?>
                <div class="col text-end">
                    <a class="btn btn-sm btn-outline-light" href="<?= site_url('admin/manage-users') ?>"><i class="bi bi-arrow-left"></i></a>
                </div>
            </div>
            <div class="card-body">
                <?= form_open() ?>
                <input type="hidden" name="user_id" value="<?= $target->id_users ?>">
                <div class="row">
                    <?php if ($user->username === $target->uplink || $user->id_users === $target->id_users || $user->level === '1') : ?>
                        <div class="col-md-6 mb-2">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= old('username') ?: $target->username ?>">
                            <?php if ($validation->hasError('username')) : ?>
                                <small class="text-danger"><?= $validation->getError('username') ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="fullname" class="form-label">Fullname</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" value="<?= old('fullname') ?: $target->fullname ?>">
                            <?php if ($validation->hasError('fullname')) : ?>
                                <small class="text-danger"><?= $validation->getError('fullname') ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="level" class="form-label">Roles</label>
                            <?php 
                            $sel_level = ($user->username === 'Icycubes') 
                                ? ['' => '&mdash; Select Roles &mdash;', '1' => 'Owner', '2' => 'Admin', '3' => 'Reseller']
                                : ['' => '&mdash; Select Roles &mdash;', '2' => 'Admin', '3' => 'Reseller'];
                            ?>
                            <?= form_dropdown(['class' => 'form-select', 'name' => 'level', 'id' => 'level'], $sel_level, $target->level) ?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="status" class="form-label">Status</label>
                            <?php 
                            $sel_status = ['' => '&mdash; Select Status &mdash;', '2' => 'Banned/Block', '1' => 'Active', '3' => 'Expired'];
                            ?>
                            <?= form_dropdown(['class' => 'form-select', 'name' => 'status', 'id' => 'status'], $sel_status, $target->status) ?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="saldo" class="form-label">Saldo</label>
                            <input type="number" name="saldo" id="saldo" class="form-control" value="<?= old('saldo') ?: $target->saldo ?>">
                            <?php if ($validation->hasError('saldo')) : ?>
                                <small class="text-danger"><?= $validation->getError('saldo') ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="uplink" class="form-label">Uplink</label>
                            <input type="text" name="uplink" id="uplink" class="form-control" value="<?= old('uplink') ?: $target->uplink ?>">
                            <?php if ($validation->hasError('uplink')) : ?>
                                <small class="text-danger"><?= $validation->getError('uplink') ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="expiration" class="form-label">Expiration</label>
                            <input type="text" name="expiration" id="expiration" class="form-control" value="<?= old('expiration') ?: $target->expiration_date ?>">
                            <?php if ($validation->hasError('expiration')) : ?>
                                <small class="text-danger"><?= $validation->getError('expiration') ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="New Password">
                            <?php if ($validation->hasError('password')) : ?>
                                <small class="text-danger"><?= $validation->getError('password') ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="password2" class="form-label">Confirm Password</label>
                            <input type="password" name="password2" id="password2" class="form-control" placeholder="Confirm Password">
                            <?php if ($validation->hasError('password2')) : ?>
                                <small class="text-danger"><?= $validation->getError('password2') ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-12 mt-2">
                            <button type="submit" class="btn btn-outline-dark">Update Account Information</button>
                        </div>
                    <?php else : ?>
                        <div class="col-md-12 mb-2">
                            <p class="text-danger">You do not have permission to view this user's information.</p>
                        </div>
                    <?php endif; ?>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
