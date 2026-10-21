<?php
if (isset($_GET['key']) && isset($_GET['token']) && isset($_GET['mail'])) {
    include('conn.php');
    
    $emailId = mysqli_real_escape_string($conn, $_GET['mail']);
    $token = mysqli_real_escape_string($conn, $_GET['token']);
    $password = mysqli_real_escape_string($conn, $_GET['key']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  // Hash the password

    date_default_timezone_set('Asia/Manila');
    $timestamp = date('Y-m-d H:i:s');

    $sql = "SELECT * FROM `users` WHERE `reset_link_token`=? AND `email`=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $token, $emailId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $res = $user['exp_date'];
        $exp = strtotime($res);
        $exp_time = date('Y-m-d H:i:s', $exp);

        if ($timestamp < $exp_time) {
            $update_sql = "UPDATE `users` SET `password`=?, `reset_link_token`=NULL, `exp_date`=NULL WHERE `reset_link_token`=? AND `email`=?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("sss", $hashedPassword, $token, $emailId);
            if ($update_stmt->execute()) {
                echo '<p>Congratulations! Your password has been updated successfully.</p>';
            } else {
                echo '<p>Something went wrong. Please try again.</p>';
            }
        } else {
            echo '<p>Link Expired. Request Again..!</p>';
        }
    } else {
        echo '<p>Invalid token or email.</p>';
    }
} else {
    echo '<p>Link Broken.</p>';
}
?>
