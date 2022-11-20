<?php
	session_start();
	
	if ($_SERVER['REQUEST_METHOD'] === "POST") {

		$email = sanitize($_POST['email']);
		$password = sanitize($_POST['password']);
		$isValid = true;
		if (isset($_SESSION['email'])) {		
			header("location: DashboardA.php");
		}
		if (empty($email)) {
			$_SESSION['email_msg'] = "Email cannot be empty";
			$isValid = false;
		}
		if (empty($password)) {
			$_SESSION['password_msg'] = "Password cannot be empty";
			$isValid = false;
		}

		if ($isValid === true) {
			$isValid = false;
			$conn = mysqli_connect("localhost", "root", "", "data", 3306);

			if (!$conn) {
			  die("Connection failed: " . mysqli_connect_error());
			}

			$stmt = mysqli_stmt_init($conn);
			mysqli_stmt_prepare($stmt, "Select id, email, password From data");
			mysqli_stmt_bind_param($stmt, "ss", $email, $password);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $id, $em, $pa);
			mysqli_stmt_fetch($stmt);

			if ($email === $em and $password === $pa) {
				$isValid = true;
			}
			else {
				$_SESSION['global_msg'] = "No record(s) found. Please contact with the administrator";
				header("Location: ../View/Login.php");
			}



			/*$sql = "Select id, email, password From User Where email = ? and password = ?";
			$res = mysqli_query($conn, $sql);

			if (mysqli_num_rows($res) === 1) {
				$isValid = true;
			}
			else {
				$_SESSION['global_msg'] = "No record(s) found. Please contact with the administrator";
				header("Location: ../views/login_view.php");
			}*/

			mysqli_close($conn);				

			if ($isValid) {
				$_SESSION['email'] = $email;
				header("Location: ../View/DashboardA.php");
			}
			else {
				$_SESSION['global_msg'] = "Email or password incorrect";
				header("Location: ../View/Login.php");
			}
		}
		else {
			header("Location: ../View/Login.php");
		}
	} 
	else {
		$_SESSION['global_msg'] = "Something went wrong";
		header("Location: ../View/Login.php");
	}


	function sanitize($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>