<?php
include('conn.php');

// Fetch all users details
$allUsersSql = "SELECT username, uplink, saldo, level, user_ip, logged_in FROM users";
$allUsersResult = mysqli_query($conn, $allUsersSql);

$sql2 = "SELECT keys_id FROM history";
$result2 = mysqli_query($conn, $sql2);
$totalKeys = mysqli_num_rows($result2);

function getUserKeysCount($conn, $username) {
    $sql = "SELECT COUNT(*) as keys_count FROM history WHERE user_do = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['keys_count'];
}
?>

<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>


<div class="container p-2 mb-3" id="content">
    <div class="card">
        <div class="card-header text-white bg-dark">
            ALL USERS
        </div>
        <div class="card-body">
            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($allUsersResult)): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 user-card"> 
                            <div class="card-header user-card-header">
                                <?= htmlspecialchars($row['username']); ?>
                            </div>
                            <div class="card-body user-card-body">
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <th>Uplink:</th>
                                            <td><?= htmlspecialchars($row['uplink']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Saldo:</th>
                                            <td><?= htmlspecialchars($row['saldo']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Role:</th>
                                            <td>
                                                <?php 
                                                switch ($row['level']) {
                                                    case 1: echo 'Owner'; break;
                                                    case 2: echo 'Admin'; break;
                                                    case 3: echo 'Reseller'; break;
                                                    default: echo 'Unknown';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Logins Today:</th>
                                            <td><?= htmlspecialchars($row['logged_in']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Keys Made:</th>
                                            <td><?= getUserKeysCount($conn, $row['username']); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <div class="card-footer text-center">
            <p>Total Keys in Database: <?= $totalKeys ?></p>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?= $this->endSection() ?>

