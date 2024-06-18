<?php
session_start();

if (!empty($_POST)) {
    $_SESSION['error'] = array();

    if (empty($_POST['fnm'])) {
        $_SESSION['error']['fnm'] = "Please enter Full Name";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $_POST['fnm'])) {
        $_SESSION['error']['fnm'] = "Full Name must contain only alphabetical characters and spaces";
    }

    if (empty($_POST['unm'])) {
        $_SESSION['error']['unm'] = "Please enter User Name";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $_POST['unm'])) {
        $_SESSION['error']['unm'] = "Username must contain only alphabetical characters";
    }

    if (empty($_POST['pwd']) || empty($_POST['cpwd'])) {
        $_SESSION['error']['pwd'] = "Please enter Password";
    } elseif ($_POST['pwd'] != $_POST['cpwd']) {
        $_SESSION['error']['pwd'] = "Password isn't Match";
    } elseif (strlen($_POST['pwd']) < 8) {
        $_SESSION['error']['pwd'] = "Please Enter Minimum 8 Digit Password";
    }

    if (empty($_POST['email'])) {
        $_SESSION['error']['email'] = "Please enter E-Mail Address";
    } elseif (!preg_match("/^[a-z0-9_]+[a-z0-9_.]*@[a-z0-9_-]+[a-z0-9_.-]*\.[a-z]{2,5}$/i", $_POST['email'])) {
        $_SESSION['error']['email'] = "Please Enter Valid E-Mail Address";
    }

    if (empty($_POST['answer'])){
        $_SESSION['error']['answer'] = "Please Enter Security Answer";
    }

    if (empty($_POST['cno'])){
        $_SESSION['error']['cno'] = "Please Enter Contact Number";
    } elseif (!is_numeric($_POST['cno']) || strlen($_POST['cno']) != 10) {
        $_SESSION['error']['cno'] = "Contact Number must be exactly 10 digits";
    }

    if (!empty($_SESSION['error'])){
        foreach ($_SESSION['error'] as $er) {
            echo '<font color="red">' . $er . '</font><br>';
        }
        header("location:register.php");
        exit;
    } else {
        include("includes/connection.php");

        $t = time();

        $q = "insert into register(r_fnm,r_unm,r_pwd,r_cno,r_email,r_question,r_answer,r_time) values(?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($link, $q);
        mysqli_stmt_bind_param($stmt, "sssssssi", $_POST['fnm'], $_POST['unm'], $_POST['pwd'], $_POST['cno'], $_POST['email'], $_POST['question'], $_POST['answer'], $t);
        mysqli_stmt_execute($stmt);

        if ($stmt) {
            header("location:register.php?register");
        } else {
            echo "Error: " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
        exit;
    }
} else {
    header("location:register.php");
    exit;
}
?>
