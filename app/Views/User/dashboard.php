<?php

include('conn.php');

// Assume you have a session started and a valid user ID
$userid = $_SESSION['userid'];

// First, select the expiration date for the user
$sql_select = "SELECT `expiration_date`, `username` FROM `users` WHERE `id_users` = '".$userid."'";
$query_select = mysqli_query($conn, $sql_select);
$period = mysqli_fetch_assoc($query_select);

// Increment the logged_in column for the user
$sql_update = "UPDATE `users` SET `logged_in` = `logged_in` + 1 WHERE `id_users` = '".$userid."'";
mysqli_query($conn, $sql_update);

$dateTime = strtotime($period['expiration_date']);
$getDateTime = date("F d, Y", $dateTime);

?>

<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>
<style>
    @import 'https://fonts.googleapis.com/css?family=Nova+Mono|Eczar';
    
    #exp {
        font-family: 'Nova Mono', monospace;
        font-size: 0.875em; /* Smaller font size */
        color: #333;
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <?= $this->include('Layout/msgStatus') ?>
    </div> 
   
    <div class="col-lg-8" style="padding:15px;">
        <div class="card mb-3">
            <div class="card-header text-white bg-dark">
                History
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover text-center">
                        <tbody>
                            <?php foreach ($history as $h) : ?>
                                <?php $in = explode("|", $h->info) ?>
                                <tr>
                                    <td><span class="align-middle badge text-dark">#3812<?= $h->id_history ?></span></td>
                                    <td><?= $in[0] ?></td>
                                    <td><span class="align-middle badge text-dark"><?= $in[1] ?>**</span></td>
                                    <td><span class="align-middle badge text-dark"><?= $in[2] ?> Days</span></td>
                                    <td><span class="align-middle badge text-primary"><?= $in[3] ?> Devices</span></td>
                                    <td><i class="align-middle badge text-muted"><?= $time::parse($h->created_at)->humanize() ?></i></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>                            
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4" style="padding:15px;">
        <div class="card mb-3">
            <div class="card-header text-center text-white bg-dark">
                Information
            </div>
            <div class="card-body">
                <ul class="list-group list-hover mb-3">
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Role
                        <span class="badge text-dark">
                            <?= getLevel($user->level) ?>
                        </span>
                    </li>
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Balance
                        <span class="badge text-dark">
                            ₱<?= $user->saldo ?>
                        </span>
                    </li>
                </ul>
                <ul class="list-group mb-3">
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Login Time
                        <span class="badge text-dark">
                            <?= $time::parse(session()->time_since)->humanize() ?>
                        </span>
                    </li>
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Auto Logout
                        <span class="badge text-dark">
                            <?= $time::now()->difference($time::parse(session()->time_login))->humanize() ?>
                        </span>
                    </li>
                </ul>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    Expiration
                    <span id="exp" class="badge text-dark"><?= $getDateTime ?></span>
                </div>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    Join our Telegram
                    <a href="https://t.me/icy_cracks" target="_blank" class="badge text-dark">Click Here</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>
