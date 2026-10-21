<?php if (session()->getFlashdata('msgDanger')) : ?>
    <div class="alert alert-danger fade show" role="alert">
        <?= session()->getFlashdata('msgDanger') ?>
    </div>
<?php elseif (session()->getFlashdata('msgSuccess')) : ?>
    <div class="alert alert-success fade show" role="alert">
        <?= session()->getFlashdata('msgSuccess') ?>
    </div>
<?php elseif (session()->getFlashdata('msgWarning')) : ?>
    <div class="alert alert-warning fade show" role="alert">
        <?= session()->getFlashdata('msgWarning') ?>
    </div>
<?php else : ?>
    <?php if (session()->has('userid')) : ?>
        <?php if (isset($messages)) : ?>
            <div class="alert alert-<?= $messages[1] ?> fade show" role="alert">
                <?= $messages[0] ?>
            </div>
        <?php else : ?>
            <div class="alert alert-secondary fade show text-center shadow-sm" role="alert">
            Join Our Telegram Channel
            </div>
        <?php endif; ?>
    <?php else : ?>
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                    ‎ ‎ ‎ ‎ ‎ ‎    ‎ ‎ ‎  ‎ ‎      Join Our Telegram Channel
            
        </div>
    <?php endif; ?>
<?php endif; ?>