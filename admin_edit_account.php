<?php
session_start();
// $DATABASE_HOST = 'localhost';
// $DATABASE_USER = 'root';
// $DATABASE_PASS = '';
// $DATABASE_NAME = 'accounts';

// $link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
// if (mysqli_connect_errno()) {
//     exit('Failed to connect to MySQL: ' . mysqli_connect_error());
// }

require("theaterDatabase.php");

// Define variables and initialize with empty values
$username = $password = $confirm_password = $email = $isAdmin = "";
$username_err = $password_err = $confirm_password_err = $email_err = $isAdmin_err = "";
$search = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["search"]) && !empty($_POST["search"])) {
        $search = trim($_POST['search']);
        $query = "SELECT * FROM accounts WHERE id = ? OR username = ?";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "ss", $search, $search);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
        } else {
            $search_err = "No user found with this ID or username.";
        }
    } elseif (isset($_POST["username"])) {
        // Validate username
        if (empty(trim($_POST["username"]))) {
            $username_err = "Please enter a username.";
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
            $username_err = "Username can only contain letters, numbers, and underscores.";
        } else {
            // Prepare a select statement
            $sql = "SELECT id FROM accounts WHERE username = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // Set parameters
                $param_username = trim($_POST["username"]);

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $username_err = "This username is already taken.";
                    } else {
                        $username = trim($_POST["username"]);
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }


        // Validate password only if it's not empty
        if (!empty(trim($_POST["password"]))) {
            if (strlen(trim($_POST["password"])) < 6) {
                $password_err = "Password must have atleast 6 characters.";
            } else {
                $password = trim($_POST["password"]);
            }

            // Validate confirm password only if password is not empty
            if (empty(trim($_POST["confirm_password"]))) {
                $confirm_password_err = "Please confirm password.";
            } else {
                $confirm_password = trim($_POST["confirm_password"]);
                if (empty($password_err) && ($password != $confirm_password)) {
                    $confirm_password_err = "Password did not match.";
                }
            }
        }

        // Validate email
        if (empty(trim($_POST["email"]))) {
            $email_err = "Please enter an email.";
        } else {
            $email = trim($_POST["email"]);
        }

        // Validate isAdmin
        $isAdmin = isset($_POST["isAdmin"]) ? 1 : 0;

        // Check input errors before inserting in database
        if (empty($username_err) && empty($email_err)) {
            // Check if ID is empty
            if (empty(trim($_POST["id"]))) {
                // Prepare an insert statement
                $sql = "INSERT INTO accounts (username, password, email, isAdmin) VALUES (?, ?, ?, ?)";
            } else {
                // Prepare an update statement
                $sql = "UPDATE accounts SET username = ?, email = ?, isAdmin = ? WHERE id = ?";
                if (!empty($password)) {
                    $sql = "UPDATE accounts SET username = ?, password = ?, email = ?, isAdmin = ? WHERE id = ?";
                }
            }
        
            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                if (empty(trim($_POST["id"]))) {
                    mysqli_stmt_bind_param($stmt, "sssi", $param_username, $param_password, $param_email, $param_isAdmin);
                    $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                } else {
                    if (!empty($password)) {
                        mysqli_stmt_bind_param($stmt, "ssssi", $param_username, $param_password, $param_email, $param_isAdmin, $param_id);
                        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                    } else {
                        mysqli_stmt_bind_param($stmt, "sssi", $param_username, $param_email, $param_isAdmin, $param_id);
                    }
                }
        
                // Set parameters
                $param_username = $username;
                $param_email = $email;
                $param_isAdmin = $isAdmin;
                $param_id = trim($_POST["id"]);
        
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Display success message and redirect to admin page
                    echo "<script type='text/javascript'>
                            alert('User information updated successfully');
                            window.location = 'admin_edit_account.php';
                          </script>";
                } else {
                    // Display error message
                    echo "<script type='text/javascript'>
                            alert('Oops! Something went wrong. Please try again later.');
                            window.location = 'admin_edit_account.php';
                          </script>";
                }
        
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        

        // Close connection
        mysqli_close($link);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            height: 100vh;
        }

        a {
            width: 100%;
        }

        .form-container {
            display: flex;
            padding: 10%;
            justify-content: space-evenly;
            align-items: baseline;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type='submit'],
        input[type='reset'] {
            width: 100%;
            align-items: center;
            text-align: center;
            margin: 3px;
        }

        a {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class='button-container'>
        <a href='admin.php' class='btn btn-primary'>Admin Home</a>
    </div>
    <div class='form-container'>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Search by ID or Username</label>
                <input type="text" name="search" class="form-control <?php echo (!empty($search_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $search_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Search">
            </div>
        </form>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>ID</label>
                    <input type="text" name="id" class="form-control" value="<?php if(isset($user['id'])) {echo $user['id'];}; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php if(isset($user['username'])) {echo $user['username'];}; ?>">
                    <span class="invalid-feedback"><?php echo $username_err;?></span>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php if(isset($user['email'])) {echo $user['email'];}; ?>">
                </div>
                <div class="form-group">
                    <label>Is Admin</label>
                    <input type="checkbox" name="isAdmin" class="form-control" <?php if(isset($user['isAdmin'])) {echo $user['isAdmin'] ? 'checked' : '';}; ?>>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
    </div>
</body>

</html>