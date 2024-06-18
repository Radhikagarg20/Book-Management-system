<?php
	session_start();

	if (!empty($_POST)) {
		extract($_POST);
		$_SESSION['error'] = array();

		if (empty($fnm)) {
			$_SESSION['error']['fnm'] = "Please enter Full Name";
		}

		if (empty($mno)) {
			$_SESSION['error']['mno'] = "Please enter Mobile Number";
		} else if (!is_numeric($mno)) {
			$_SESSION['error']['mno'] = "Please Enter Numeric Mobile Number";
		}

		if (empty($msg)) {
			$_SESSION['error']['msg'] = "Please enter Message";
		}

		if (empty($email)) {
			$_SESSION['error']['email'] = "Please enter E-Mail ID";
		}

		if (!empty($_SESSION['error'])) {
			foreach ($_SESSION['error'] as $er) {
				echo '<font color="red">' . $er . '</font><br>';
			}
		} else {
			include("includes/connection.php");

			$t = time();

			$q = "INSERT INTO contact(c_fnm, c_mno, c_email, c_msg, c_time) VALUES ('$fnm', '$mno', '$email', '$msg', '$t')";

			$result = mysqli_query($link, $q);

			if (!$result) {
				echo "Error: " . mysqli_error($link);
			} else {
				header("location: contact.php");
			}
		}
	} else {
		header("location: contact.php");
	}
?>
