<?php
include('conn.php');

// Determine if the user is 'Icycubes'
$is_admin = $user->username === 'Icycubes';

// Adjust the SQL query based on user role
if ($is_admin) {
    $sql = "SELECT * FROM referral_code ORDER BY id_reff DESC";
} else {
    $sql = "SELECT * FROM referral_code WHERE created_by = ? ORDER BY id_reff DESC";
}

// Prepare and execute the SQL statement
$stmt = mysqli_prepare($conn, $sql);

if (!$is_admin) {
    mysqli_stmt_bind_param($stmt, 's', $user->username);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$codes = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_stmt_close($stmt);

?>

<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<div class="row">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <div class="col-lg-12">
        <?= $this->include('Layout/msgStatus') ?>
    </div>
    <div class="col-lg-4 mb-3">
        <div class="card">
            <div class="card-header bg-dark text-white p-3">
                Generate <?= $title ?>
            </div>
            <div class="card-body">
                <?= form_open() ?>

                <div class="form-group mb-3">
                    <label for="set_saldo">You can set with multiple saldo</label>
                    <div class="input-group mt-2">
                        <span class="input-group-text"><i class="bi bi-currency-peso"></i></span>
                        <input type="number" class="form-control" name="set_saldo" id="set_saldo" minlength="1" maxlength="11" value="999999999">
                    </div>
                    <?php if ($validation->hasError('set_saldo')) : ?>
                        <small id="help-saldo" class="text-danger"><?= $validation->getError('set_saldo') ?></small>
                    <?php endif; ?>
                </div>
                
                <div class="form-group mb-3">
                    <label for="accExpire" class="form-label">Account Expiration</label>
                    <?= form_dropdown(['class' => 'form-select', 'name' => 'accExpire', 'id' => 'accExpire'], $accExpire, old('accExpire') ?: '') ?>
                    <?php if ($validation->hasError('accExpire')) : ?>
                        <small id="help-accExpire" class="text-danger"><?= $validation->getError('accExpire') ?></small>
                    <?php endif; ?>
                </div>
                
                <div class="form-group mb-3">
                    <label for="accLevel" class="form-label">Account Level</label>
                    <?php 
                    if ($user->username === 'Icycubes') {
                        $accLevelOptions = ['' => '&mdash; Select Level &mdash;', '1' => 'Owner', '2' => 'Admin', '3' => 'Reseller'];
                    } else {
                        $accLevelOptions = ['' => '&mdash; Select Level &mdash;', '2' => 'Admin', '3' => 'Reseller'];
                    }
                    ?>
                    <?= form_dropdown(['class' => 'form-select', 'name' => 'accLevel', 'id' => 'accLevel'], $accLevelOptions, old('accLevel') ?: '') ?>
                    <?php if ($validation->hasError('accLevel')) : ?>
                        <small id="help-accLevel" class="text-danger"><?= $validation->getError('accLevel') ?></small>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-dark">Create Code</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <?php if (!empty($codes)) : ?>
            <div class="card">
                <div class="card-header bg-dark text-white p-3">
                    History Generate - Total <?= count($codes) ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Referral</th>                                   
                                    <th>Saldo</th>
                                    <th>Level</th>
                                    <th>Expiration</th>
                                    <th>Used by</th>
                                    <th>Create by</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($codes as $code) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($code['id_reff']) ?></td>
                                        <td><?= htmlspecialchars($code['Referral']) ?></td>
                                        <td>₱<?= htmlspecialchars($code['set_saldo']) ?></td>
                                        <td><?= htmlspecialchars($code['level']) ?></td>
                                        <td><?= htmlspecialchars($code['acc_expiration']) ?></td>
                                        <td><?= htmlspecialchars($code['used_by']) ?></td>
                                        <td><?= htmlspecialchars($code['created_by']) ?></td>
                                        <td>
                                            <button class="btn btn-dark btn-sm" data-user-id="<?= htmlspecialchars($code['id_reff']) ?>" onclick="deleteUserKey(this)"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <p>No referral codes found.</p>
        <?php endif; ?>
    </div>
</div>
<br><br>

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
            var api_url = `${base_url}/DELETEREFF.php?id=${userId}`;
            $.getJSON(api_url, {
                    userkey: userId 
                },
                function(data, textStatus, jqXHR) {
                    if (textStatus === 'success') {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'Your user has been deleted.',
                                'success'
                            )

                            setTimeout(function() {
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

// Disable delete button for codes not created by the user
document.querySelectorAll('[data-user-id]').forEach(button => {
    const createdBy = button.closest('tr').querySelector('td:nth-child(7)').innerText.trim();
    if (createdBy !== '<?= $user->username ?>' && '<?= $user->username ?>' !== 'Icycubes') {
        button.disabled = true;
    }
});
</script>
<?= $this->endSection() ?>