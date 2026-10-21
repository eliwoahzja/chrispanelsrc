<?php
include('conn.php');
// Assuming conn.php fetches the user object and assigns it to $user
?>

<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->include('Layout/msgStatus') ?>
        </div>
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <div class="row">
                        <div class="col pt-1">
                            Keys Registered
                        </div>
                        <div class="col text-end">
                            <?php if (($user->level == 1) || ($user->level ==2) || ($user->level ==3)) : ?>
                                <div class="float-right">
                                    <a class="btn btn-outline-light btn-sm" href="<?= site_url('ExtendDuration') ?>"><i class="bi bi-calendar-plus"></i> Extend</a>
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-file-arrow-down-fill"></i> Menu
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="navbarDropdown">
                                                <div class="card-header bg-light text-black h6 p-3">
                                             
                                        <li>
                                            <a class="dropdown-item" href="<?= site_url('keys/generate') ?>">
                                                <i class="bi bi-people style="color: red"></i> Generate Keys
                                            
                                            </a>
                                        </li>
                                         <br>
                                        <li>
                                        <?php if (($user->level == 1) || ($user->level ==2)|| ($user->level ==3)) : ?>
                                              
                                        <a class="dropdown-item" href="<?= site_url('keys/start')  ?>">
                                            <i class="bi bi-trash-fill"></i> Del-Unused Keys
                                        </a>
                                    </li>
                                     <br>
                                    <li>
                                    
                                    <a class="dropdown-item" href="<?= site_url('keys/DelblockKeys')  ?>">
                                    <i class="bi bi-trash-fill"></i> Del-Banned/Blocked Keys
                                        </a>
                                    </li>
                                     <br>
                                    <li>
                                    
                                    <a class="dropdown-item" href="<?= site_url('keys/DelEXPKeys')  ?>">
                                    <i class="bi bi-trash-fill"></i> Del-Expired Keys
                                        </a>
                                    </li>
                                     <br>
                                    <li>
                                    
                                    <?php endif; ?>
                                        <?php if (($user->level == 1) || ($user->level ==2) || ($user->level ==3)) : ?>
                                        
                                        <a class="dropdown-item" href="<?= site_url('keys/download/all')  ?>">
                                            <i class="bi bi-arrow-down-circle"></i> Download All Key
                                        </a>
                                    </li>
                                     <br>
                                    <li>
                                    
                                    
                                          <a class="dropdown-item" href="<?= site_url('keys/resetAll') ?>">
                                                <i class="bi bi-bootstrap-reboot"></i> Reset All Keys
                                            </a>
                                            <?php endif; ?>
                                        </li>
                                         <br>
                                    <li>
                                                                  
                                </ul>
                            </li>
                        </ul>
          
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-light">
                    <?php if (is_array($keylist) && !empty($keylist)) : ?>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-hover text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Game</th>
                                        <th>User Keys</th>
                                        <th>Devices</th>
                                        <th>Duration</th>
                                        <th>Expired</th>
                                        <th>Registered To</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($keylist as $key) : ?>
                                        <?php if (is_object($key) && ($key->created_by == $user->id)) : ?>
                                            <tr>
                                                <td><?= $key->id ?></td>
                                                <td><?= $key->game ?></td>
                                                <td><span class="<?= ($key->status == 'Active') ? 'text-success' : 'text-danger' ?>"><?= $key->user_key ?: '&mdash;' ?></span></td>
                                                <td><span id="devMax-<?= $key->user_key ?>"><?= $key->devices ?: 0 ?>/<?= $key->max_devices ?></span></td>
                                                <td><?= $key->duration ?></td>
                                                <td><span id="exp-<?= $key->user_key ?>" class="badge text-dark"><?= $key->expired ?: '(not started yet)' ?></span></td>
                                                <td><?= $key->registrator ?: '&mdash;' ?></td>
                                                <td>
                                                    <div class="d-grid gap-2 d-md-block">
                                                        <button class="btn btn-outline-dark btn-sm" onclick="extendday('<?= $key->user_key ?>')" data-bs-toggle="tooltip" data-bs-placement="left" title="Extend key?"><i class="bi bi-plus-lg"></i></button>
                                                        <button class="btn btn-outline-danger btn-sm" onclick="resetUserKey('<?= $key->user_key ?>')" data-bs-toggle="tooltip" data-bs-placement="left" title="Reset key?"><i class="bi bi-bootstrap-reboot"></i></button>
                                                        <a href="<?= site_url('keys/' . $key->id) ?>" class="btn btn-outline-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit key information?"><i class="bi bi-person"></i></a>
                                                        <?php if ($key->user_key != $user->username) : ?>
                                                            <button class="btn btn-outline-danger btn-sm" onclick="deleteUserKey('<?= $key->user_key ?>')" data-bs-toggle="tooltip" data-bs-placement="left" title="Delete key?"><i class="bi bi-trash"></i></button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else : ?>
                        <p class="text-center">No keys to show</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<?= link_tag("https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css") ?>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= script_tag("https://code.jquery.com/jquery-3.5.1.js") ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js") ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js") ?>
<script>
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, "desc"]
            ],
            ajax: "<?= site_url('keys/api') ?>",
            columns: [
                { data: 'id', name: 'id_keys' },
                { data: 'game' },
                { data: 'user_key', render: function(data, type, row, meta) {
                    var is_valid = (row.status == 'Active') ? "text-success" : "text-danger";
                    return `<span class="${is_valid} ">${(row.user_key ? row.user_key : '&mdash;')}</span>`;
                }},
                { data: 'devices', render: function(data, type, row, meta) {
                    var totalDevice = (row.devices ? row.devices : 0);
                    return `<span id="devMax-${row.user_key}">${totalDevice}/${row.max_devices}</span>`;
                }},
                { data: 'duration' },
                { data: 'expired', name: 'expired_date', render: function(data, type, row, meta) {
                    return row.expired ? `<span id="exp-${row.user_key}" class="badge text-dark">${row.expired}</span>` : '(not started yet)';
                }},
                { data: 'registrator', render: function(data, type, row, meta) {
                    return row.registrator ? row.registrator : '&mdash;';
                }},
                { data: null, render: function(data, type, row, meta) {
                    var btnExtend = `<button class="btn btn-outline-dark btn-sm" onclick="extendday('${row.user_key}')" data-bs-toggle="tooltip" data-bs-placement="left" title="Extend key?"><i class="bi bi-plus-lg"></i></button>`;
                    var btnReset = `<button class="btn btn-outline-danger btn-sm" onclick="resetUserKey('${row.user_key}')" data-bs-toggle="tooltip" data-bs-placement="left" title="Reset key?"><i class="bi bi-bootstrap-reboot"></i></button>`;
                    var btnEdits = `<a href="${window.location.origin}/keys/${row.id}" class="btn btn-outline-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit key information?"><i class="bi bi-person"></i></a>`;
                    var btnDelete = row.user_key != '<?= $user->username ?>' ? `<button class="btn btn-outline-danger btn-sm" onclick="deleteUserKey('${row.user_key}')" data-bs-toggle="tooltip" data-bs-placement="left" title="Delete key?"><i class="bi bi-trash"></i></button>` : '';

                    return `<div class="d-grid gap-2 d-md-block">${btnExtend} ${btnReset} ${btnEdits} ${btnDelete}</div>`;
                }}
            ]
        });

        $("#blur-out").click(function() {
            if ($(".keyBlur").hasClass("key-sensi")) {
                $(".keyBlur").removeClass("key-sensi");
                $("#blur-out").html(`<i class="bi bi-eye"></i>`);
            } else {
                $(".keyBlur").addClass("key-sensi");
                $("#blur-out").html(`<i class="bi bi-eye-slash"></i>`);
            }
        });
    });

    function resetUserKey(keys) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, Reset'
        }).then((result) => {
            if (result.isConfirmed) {
                Toast.fire({
                    icon: 'info',
                    title: 'Please wait...'
                });
                var base_url = window.location.origin;
                var api_url = `${base_url}/keys/reset`;
                $.getJSON(api_url, {
                        userkey: keys,
                        reset: 1
                    },
                    function(data, textStatus, jqXHR) {
                        if (textStatus == 'success') {
                            if (data.registered) {
                                if (data.reset) {
                                    $(`#devMax-${keys}`).html(`0/${data.devices_max}`);
                                    Swal.fire(
                                        'Reset!',
                                        'Your device key has been reset.',
                                        'success'
                                    );
                                } else {
                                    Swal.fire(
                                        'Failed!',
                                        data.devices_total ? "You don't have any access to this user." : "User key devices already reset.",
                                        data.devices_total ? 'error' : 'warning'
                                    );
                                }
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    "User key no longer exists.",
                                    'error'
                                );
                            }
                        }
                    }
                );
            }
        });
    }

    function deleteUserKey(keys) {
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
                });

                var base_url = window.location.origin;
                var api_url = `${base_url}/keys/delete`;
                $.getJSON(api_url, {
                        userkey: keys
                    },
                    function(data, textStatus, jqXHR) {
                        if (textStatus == 'success') {
                            if (data.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your device key has been deleted.',
                                    'success'
                                );

                                setTimeout(function() {
                                    location.reload();
                                }, 500);
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    "User key no longer exists.",
                                    'error'
                                );
                            }
                        }
                    }
                );
            }
        });
    }

    function extendday(keys) {
        Swal.fire({
            title: 'Enter number of days to extend',
            input: 'number',
            inputAttributes: {
                min: 1,
                step: 1,
            },
            showCancelButton: true,
            confirmButtonText: 'Extend',
            showLoaderOnConfirm: true,
            preConfirm: (days) => {
                return new Promise((resolve) => {
                    setTimeout(() => {
                        resolve();
                    }, 500);
                });
            },
        }).then((result) => {
            if (result.isConfirmed) {
                const numberOfDays = result.value;

                Toast.fire({
                    icon: 'info',
                    title: 'Please wait...'
                });

                var base_url = window.location.origin;
                var api_url = `${base_url}/extend.php?action=extendKey&userkey=${keys}&days=${numberOfDays}`;

                $.getJSON(api_url, function(data, textStatus, jqXHR) {
                    if (textStatus == 'success') {
                        if (data.success) {
                            Swal.fire(
                                'Extended!',
                                `Your device key has been extended by ${numberOfDays} days.`,
                                'success'
                            );

                            setTimeout(function() {
                                location.reload();
                            }, 500);
                        } else {
                            Swal.fire(
                                'Failed!',
                                'Failed to extend device key.',
                                'error'
                            );
                        }
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>
