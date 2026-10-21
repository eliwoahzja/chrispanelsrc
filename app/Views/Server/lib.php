<?= $this->extend('Layout/Starter') ?>

<?php include('conn.php'); ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-header h6 p-3 bg-dark text-white">
                    Upload LIB
                </div>
                <div class="card-body">
                    <form action="upload.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <input type="submit" value="Upload File" name="submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white h6 p-3">
                    Manage <?= $title ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-hover text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="row">#</th>
                                    <th>File</th>
                                    <th>File Path</th>
                                    <th>File Size</th>
                                    <th>Created On</th>
                                    <?php if ($user->level == 1) : ?>
                                    <th>Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $fetchqry = "SELECT * FROM `lib`";
                                $result = mysqli_query($conn, $fetchqry);
                                $num = mysqli_num_rows($result);

                                if ($num > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>';
                                        echo '<td>' . $row['id'] . '</td>';
                                        echo '<td>' . $row['file'] . '</td>';
                                        echo '<td>' . $row['file_type'] . '</td>';
                                        echo '<td>' . $row['file_size'] . '</td>';
                                        echo '<td>' . $row['time'] . '</td>';
                    
                                        if ($user->level == 1) {
                                            echo '<td><button class="btn btn-dark btn-sm delete-btn" data-file-id="' . $row['id'] . '" onclick="deleteRecord(' . $row['id'] . ')">Delete</button></td>';
                                        }
                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('css') ?>
<?= link_tag("https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css") ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js") ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js") ?>

<script>
function deleteRecord(fileId) {
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
            var api_url = `${base_url}/del-lib-DB-Record.php`;
            $.post(api_url, { id: fileId }, function (data) {
                if (data.includes('successfully')) {
                    Swal.fire(
                        'Deleted!',
                        'Your Lib has been deleted.',
                        'success'
                    )

                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                } else {
                    Swal.fire(
                        'Failed!',
                        data,
                        'error'
                    )
                }
            });
        }
    });
}
</script>

<?= $this->endSection() ?>
