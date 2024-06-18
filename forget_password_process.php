<?php

	session_start();

	include("includes/connection.php");

	if (!empty($_POST)) {
		$_SESSION['error'] = array();
		extract($_POST);

		if (empty($unm)) {
			$_SESSION['error']['unm'] = "Please enter User Name";
		}

		if (empty($answer)) {
			$_SESSION['error']['answer'] = "Please enter Security Answer";
		}

		if (empty($pwd) || empty($cpwd)) {
			$_SESSION['error']['pwd'] = "Please enter New Password";
		} elseif ($pwd != $cpwd) {
			$_SESSION['error']['pwd'] = "Passwords don't match";
		}

		$q = "SELECT * FROM register WHERE r_unm='$unm'";
		$res = mysql_query($q, $link);

		if (mysql_num_rows($res) == 0) {
			$_SESSION['error']['unm'] = "User not found";
		}

		if (!empty($_SESSION['error'])) {
			header("Location: forget_password.php");
			exit; // Ensure script execution stops after redirect
		} else {
			echo "good"; // Placeholder for further action if no errors
		}
	} else {
		header("Location: forget_password.php");
		exit; // Ensure script execution stops after redirect
	}
?>
