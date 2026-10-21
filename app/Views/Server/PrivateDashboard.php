<?php

include('conn.php');

    /*
    Keys Info
    */
    // all key counts
    $keyCountSql = "SELECT COUNT(*) as id_keys FROM keys_code";
    $keyCountResult = mysqli_query($conn, $keyCountSql);
    $keycount = mysqli_fetch_assoc($keyCountResult);
    
    // used key counts
    $activeCountSql = "SELECT COUNT(devices) as devices FROM keys_code";
    $activeCountResult = mysqli_query($conn, $activeCountSql);
    $active = mysqli_fetch_assoc($activeCountResult);
    
    // un used key counts
    $inactiveCountSql = "SELECT COUNT(*) as devices FROM keys_code WHERE devices IS NULL";
    $inactiveCountResult = mysqli_query($conn, $inactiveCountSql);
    $inactive = mysqli_fetch_assoc($inactiveCountResult);
    
    //all expired count
    $sql = "SELECT COUNT(*) as id_keys FROM keys_code WHERE expired_date < NOW()";
    $result = mysqli_query($conn, $sql);
    $expkeyCount = mysqli_fetch_assoc($result)['id_keys'];
    
     //blocked key count
    $sql = "SELECT COUNT(*) as id_keys FROM keys_code WHERE status = '0'";
    $result = mysqli_query($conn, $sql);
    $blockCount = mysqli_fetch_assoc($result)['id_keys'];
            
    //expired keygen count
    $sql = "SELECT COUNT(*) as id_keys FROM keys_code WHERE registrator = 'Keygen' AND expired_date < NOW()";
    $result = mysqli_query($conn, $sql);
    $expkeygenCount = mysqli_fetch_assoc($result)['id_keys'];
    
    //keygen count
    $sql = "SELECT COUNT(*) as id_keys FROM keys_code WHERE registrator = 'Keygen'";
    $result = mysqli_query($conn, $sql);
    $keygenCount = mysqli_fetch_assoc($result)['id_keys'];
    
    
    /*
    Users info
    */
    
    // user counts
    $userCountSql = "SELECT COUNT(*) as id_users FROM users";
    $userCountResult = mysqli_query($conn, $userCountSql);
    $users = mysqli_fetch_assoc($userCountResult);
    
    //EXP Users
    $sql = "SELECT COUNT(*) as id_users FROM users WHERE status = '3'";
    $result = mysqli_query($conn, $sql);
    $status_expusers = mysqli_fetch_assoc($result)['id_users'];
    
    //Banned/block
    $sql = "SELECT COUNT(*) as id_users FROM users WHERE status = '2'";
    $result = mysqli_query($conn, $sql);
    $banusers = mysqli_fetch_assoc($result)['id_users'];
    
    //Total Active users
    $sql = "SELECT COUNT(*) as id_users FROM users WHERE status = '1'";
    $result = mysqli_query($conn, $sql);
    $activeusers = mysqli_fetch_assoc($result)['id_users'];
    
    //Total Expired users
    $sql = "SELECT COUNT(*) as id_users FROM users WHERE expiration_date < NOW()";
    $result = mysqli_query($conn, $sql);
    $expusers = mysqli_fetch_assoc($result)['id_users'];
    
    //Total Owner
    $sql = "SELECT COUNT(*) as id_users FROM users WHERE level = '1'";
    $result = mysqli_query($conn, $sql);
    $ownerusers = mysqli_fetch_assoc($result)['id_users'];
    
    //Total Admin
    $sql = "SELECT COUNT(*) as id_users FROM users WHERE level = '2'";
    $result = mysqli_query($conn, $sql);
    $adminusers = mysqli_fetch_assoc($result)['id_users'];
    
    //Total Reseller
    $sql = "SELECT COUNT(*) as id_users FROM users WHERE level = '3'";
    $result = mysqli_query($conn, $sql);
    $resellerusers = mysqli_fetch_assoc($result)['id_users'];
    
    $totalExpiredUsers = $status_expusers + $expusers;
    
?>

<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>
   
    <div class="container p-3 py-4 mb-3" id="content">
            <!-- Your dynamic content here -->
            <div class="col-lg-8" style="padding: 15px;">
                <div class="card mb-3">
                    <div class="card-header text-white bg-dark">
                        Keys Details
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-hover mb-3">
                            
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Used Keys
                                <span class="badge text-dark"><?= $active['devices']; ?></span>
                            </li>
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Un-Used Keys
                                <span class="badge text-dark"><?= $inactive['devices']; ?></span>
                            </li>
                            
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Total Blocked Keys
                                <span class="badge text-dark"><?= $blockCount ?></span>
                            </li>
                            
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Total All Exp Keys
                                <span class="badge text-dark"><?= $expkeyCount ?></span>
                            </li>
                            
                            
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Total All Keys
                                <span class="badge text-dark"><?= $keycount['id_keys']; ?></span>
                            </li>
                            
                            </ul>
                            <ul class="list-group">  
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Total Exp Keygen Keys
                                <span class="badge text-dark"><?= $expkeygenCount ?></span>
                            </li> 
                            
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Total All Keygen Keys
                                <span class="badge text-dark"><?= $keygenCount ?></span>
                            </li>
                        </ul>
                    </div>
                          
                </div>
            </div>
        </div>
                    
                     </main>
                      <main>
                     
                    <div class="container p-3 py-4 mb-3" id="content">
            <!-- Your dynamic content here -->
            <div class="col-lg-8" style="padding: 15px;">
                <div class="card mb-3">
                    <div class="card-header text-white bg-dark">
                        Users Details
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-hover mb-3">
                                                    
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Total Banned/Block Users
                                <span class="badge text-dark"><?= $banusers ?></span>
                            </li>
                            
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Total Active Users
                                <span class="badge text-dark"><?= $activeusers ?></span>
                            </li>
                            
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Total Expired Users
                                <span class="badge text-dark"><?= $totalExpiredUsers ?></span>
                            </li>
                            
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Total Owner
                                <span class="badge text-dark"><?= $ownerusers ?></span>
                            </li>
                            
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Total Admin
                                <span class="badge text-dark"><?= $adminusers ?></span>
                            </li>
                            
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Total Reseller
                                <span class="badge text-dark"><?= $resellerusers ?></span>
                            </li>
                            
                            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                Total All Users
                                <span class="badge text-dark"><?= $users['id_users']; ?></span>
                            </li>
                            
                        </ul>
                    </div>                   
    
                </div>
            </div>
        </div>
       
<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>

<?= $this->endSection() ?>