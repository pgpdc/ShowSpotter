<?php
require_once "accounts_database.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$isAdmin = 0;

// Check to see if there is a current session and the user is logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("location: /ShowSpotter/index.php");
}

//Only execute when the submit button is pressed
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Display errors for password if not set 
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    }

    //Display errors if username is not set or username contains invalid characters
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        //Determine whether the username is in the database
	    $sql = "SELECT id, password, isAdmin FROM accounts WHERE username = ?";
	    if ($stmt = mysqli_prepare($link, $sql)) {
		    mysqli_stmt_bind_param($stmt, "s", $Check_Username);
		    $Check_Username = $_POST["username"];
        
		    if(mysqli_stmt_execute($stmt)) {
			    mysqli_stmt_store_result($stmt);
            
                // If the user is not in the database go to register
                // Else determine if their password is correct
			    if(mysqli_stmt_num_rows($stmt) == 0) {
				    header("location: register.php");
                } else {
                    mysqli_stmt_bind_result($stmt, $id, $confirm_password, $isAdmin);
                    mysqli_stmt_fetch($stmt);
                    if(password_verify($_POST["password"], $confirm_password)) {
                        $_SESSION["loggedin"] = TRUE;
                        $_SESSION["name"] = $_POST["username"];
                        if($isAdmin == 1) {
                            $_SESSION["admin"] = TRUE;
                        }
                        header("location: /ShowSpotter/index.php");
                    } else {
                        $password_err = "Incorrect Password";
                    }
                }
		    }
	    }
    }

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/ShowSpotter/Styles/login.css">
</head>

<body>
<?php require("../navbar.php"); ?>

    <div class="wrapper">
        <h2>Login</h2>
        <p>Please enter your username and password!</p>
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