<?php

function color($value) {
    if ($value == 1) {
        return "#0000FF";
    } else {
        return "#FF0000";
    }
}

function filterUserList($user_list, $username) {
    return array_filter($user_list, function($user) use ($username) {
        return $user->uplink === $username;
    });
}

?>

<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-dark" role="alert">
            <strong>INFO :</strong> Search specify user by their (username, fullname, saldo or uplink).
        </div>
    
            <div class="card-body">
                <?php 
                $filtered_user_list = filterUserList($user_list, $user->username);
                if ($filtered_user_list) : 
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="row">ID</th>
                                <th>Username</th>
                                <th>Fullname</th>
                                <th>Level</th>
                                <th>Saldo</th>
                                <th>Status</th>
                                <th>Uplink</th>
                                <th>Expiration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($filtered_user_list as $u) : ?>
                            <tr>
                                <td><?= $u->id_users ?></td>
                                <td><?= $u->username ?></td>
                                <td><?= $u->fullname ?></td>
                                <td style="color: <?= color($u->level) ?>;">
                                <?php if($u->level == 1) : ?>
                                     Owner
                                <?php elseif($u->level == 2) : ?>
                                     Admin
                                <?php else : ?>
                                     Reseller
                                <?php endif; ?>
                                </td>
                                <td style="color: <?= color($u->level) ?>;">
                                <?php if($u->level == 1) : ?>
                                     &mstpos;
                                <?php else : ?>
                                      <?= $u->saldo ?>
                                <?php endif; ?>
                                </td>
                                <td style="color: <?= color($u->status) ?>;">
                                <?php if($u->status == 1) : ?>
                                      Active
                                <?php elseif($u->status == 2) : ?>
                                      Banned/Blocked
                                <?php else : ?>
                                      Expired
                                <?php endif; ?>
                                </td>
                                <td><?= $u->uplink ?></td>
                                <td><?= $u->expiration_date ?></td>
                                <td>
                                <a href="user/<?php echo $u->id_users ?>" class="btn btn-dark btn-sm"><i class="bi bi-pencil-square"></i></a><br></br>
                                <button class="btn btn-dark btn-sm" data-user-id="<?php echo $u->id_users ?>" onclick="deleteUserKey(this)" ><i class="bi bi-trash"></i></button>
                                
                                </td>
                            </tr>
                            <?php endforeach; ?>
                       <tbody>
                    </table>
                </div>
                <?php else: ?>
                <p>No users found for your uplink.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
</br></br></br>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<?= link_tag("https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css") ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js") ?>

<?= script_tag("https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js") ?>
<script>

function deleteUserKey(button) {
    var userId = button.getAttribute("data-user-id");

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Delete'
    }).then((result) => {
        if (result.isConfirmed) {
            Toast.fire({
                icon: 'info',
                title: 'Please wait...'
            })

            var base_url = window.location.origin;
            var api_url = `user/delete/${userId}`;
            $.getJSON(api_url, {
                    userkey: userId 
                },
                function(data, textStatus, jqXHR) {
                    if (textStatus == 'success') {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'Your user has been deleted.',
                                'success'
                            )

                            setTimeout(
                                function() {
                                    location.reload();
                                }, 500);
                        } else {
                            Swal.fire(
                                'Failed!',
                                "User no longer exists.",
                                'error'
                            )
                        }
                    }
                }
            );
        }
    });
}

$(document).ready(function() {
    $('#searchButton').on('click', function() {
        var searchValue = $('#searchUsername').val().trim();
        if (searchValue !== '') {
            window.location.href = 'your_search_page.php?username=' + searchValue;
        }
    });
});

</script>
<?= $this->endSection() ?>
