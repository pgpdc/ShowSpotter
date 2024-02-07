<?php
require_once "database.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$sql = "SELECT * FROM accounts WHERE username = ?";
	if ($stmt = mysqli_prepare($link, $sql)) {
		mysqli_stmt_bind_param($stmt, "s", $Check_Usernam);
		$Check_Username = $_POST["username"];
		if(mysqli_stmt_execute($stmt)) {
			mysqli_stmt_store_result($stmt);

			if(!mysqli_stmt_num_rows($stmt) == 1) {
				header("location: register.php");
			}
		}
	}
}
// // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
// if ($stmt = $link->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
// 	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
// 	$stmt->bind_param('s', $_POST['username']);
// 	$stmt->execute();
// 	// Store the result so we can check if the account exists in the database.
// 	$stmt->store_result();


// 	$stmt->close();
// }

// if ($stmt->num_rows > 0) {
// 	$stmt->bind_result($id, $password);
// 	$stmt->fetch();
// 	// Account exists, now we verify the password.
// 	// Note: remember to use password_hash in your registration file to store the hashed passwords.
// 	if ($_POST['password'] === $password) {
// 		// Verification success! User has logged-in!
// 		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
// 		session_regenerate_id();
// 		$_SESSION['loggedin'] = TRUE;
// 		$_SESSION['name'] = $_POST['username'];
// 		$_SESSION['id'] = $id;
// 		echo 'Welcome ' . $_SESSION['name'] . '!';
// 	} else {
// 		// Incorrect password
// 		echo 'Incorrect username and/or password!';
// 	}
// } else {
// 	// Incorrect username
// 	echo 'Incorrect username and/or password!';
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Don't have an account? <a href="register.php">Register here</a>.</p>
        </form>
    </div>
</body>