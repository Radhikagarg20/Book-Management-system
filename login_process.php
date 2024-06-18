<?php

session_start();

if (!empty($_POST)) {
    $unm = $_POST['unm'];
    $pwd = $_POST['pwd'];
    $_SESSION['error'] = array();

    if (empty($unm) || empty($pwd)) {
        $_SESSION['error'][] = "Please enter User Name and Password";
        header("location:login.php");
        exit;
    }

    include("includes/connection.php");

    // Using prepared statement to prevent SQL injection
    $q = "SELECT * FROM register WHERE r_unm=? AND r_pwd=?";
    $stmt = mysqli_prepare($link, $q);
    mysqli_stmt_bind_param($stmt, "ss", $unm, $pwd);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);

    if (!empty($row)) {
        $_SESSION['client']['unm'] = $row['r_fnm'];
        $_SESSION['client']['id'] = $row['r_id'];
        $_SESSION['client']['status'] = true;
        header("location:index.php");
        exit;
    } else {
        $_SESSION['error'][] = "Wrong Username or Password";
        header("location:login.php");
        exit;
    }
} else {
    header("location:login.php");
    exit;
}
?>
