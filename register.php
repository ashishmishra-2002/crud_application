<?php
include 'connect.php';

$invalid_name_error = false;
$invalid_mobile_no_error = false;
$invalid_pass_error = false;
$confirm_pass_error = false;
$user_exists_error = false;
$register_success = false;

// function to check name is valid or not
function is_valid_name($name) {
    
    if (empty($name)) {
        return false;
    }

    if (!preg_match('/[A-Z]/', $name)) {
        return false;
    }

    if (preg_match('/[0-9]/', $name)) {
        return false;
    }

    if (preg_match('/[^a-zA-Z0-9]/', $name)) {
        return false;
    }
    
    $name = trim($name);

    
    if (strlen($name) > 100 || strlen($name) < 1) {
        return false;
    }

    
    $name_part = explode(' ', $name);

    
    if (count($name_part) !== 2) {
        return false;
    }

    $name_part0 = trim($name_part[0]);
    $name_part1 = trim($name_part[1]);
    
    if (empty($name_part0) || empty($name_part1)) {
        return false;
    }

    return true;
}


// function to check mobile number is valid or not
function is_valid_mobile_number($mobile_number) {
    
    if (preg_match('/^\d{10}$/', $mobile_number) && preg_match('/^[6-9]/', $mobile_number)) {
        return true;
    }
    return false;
}


// function to check password is valid or not
function is_valid_password($password) {
    
    if (strlen($password) < 8 || strlen($password) > 16) {
        return false;
    }

    
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }

    
    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }

    
    if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        return false;
    }

    
    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }

    return true;
}

if (isset($_POST['submit'])) {
  $name = trim($_POST['name']);
  $mobile_no = trim($_POST['mobile_no']);
  $password = trim($_POST['password']);
  $confirm_password = trim($_POST['confirm_password']);

  if (is_valid_name($name) && is_valid_mobile_number($mobile_no) && is_valid_password($password)) {
        $check_sql = "SELECT * FROM ortask WHERE MobileNo = '$mobile_no'";
        $check_result = mysqli_query($conn, $check_sql);

        if ($check_result) {
            $num = mysqli_num_rows($check_result);
            if ($num > 0) {
                $user_exists_error = true;
            } else {
                if ($password == $confirm_password) {
                    $sql = "INSERT INTO ortask (Name,MobileNo,Password) 
                            VALUES('$name','$mobile_no','$password')";

                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $register_success = true;
                        header('Location: login.php');
                    } else {
                        die(mysqli_error($conn));
                    }
                } else {
                    $confirm_pass_error = true;
                }
            }
        } else {
            die(mysqli_error($conn));
        }
    } else {
      if (!is_valid_name($name)) {
          $invalid_name_error = true;
      }
      if (!is_valid_mobile_number($mobile_no)) {
          $invalid_mobile_no_error = true;
      }
      if (!is_valid_password($password)) {
          $invalid_pass_error = true;
      }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Screen</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar/Header Section -->
<?php
include 'navbar.php';
?>

<div class="container mt-5">
    
    

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Register</h4>
                    
                    <!-- Error Messages -->
                    <?php
                    if ($user_exists_error) {
                        echo "<div class='alert alert-danger'><strong>User already exists!</strong></div>";
                    }
                    if ($confirm_pass_error) {
                      echo "<div class='alert alert-danger'><strong>Passwords do not match!</strong></div>";
                    }
                    if ($invalid_pass_error) {
                        echo "<div class='alert alert-danger'><strong>Invalid Password!</strong></div>";
                    }
                    if ($invalid_mobile_no_error) {
                        echo "<div class='alert alert-danger'><strong>Invalid Mobile number!</strong></div>";
                    }
                    if ($invalid_name_error) {
                        echo "<div class='alert alert-danger'><strong>Invalid Name! Name must be in 'First Last' format.</strong></div>";
                    }
                    ?>

                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="mobileNumber" class="form-label">Mobile Number</label>
                            <input type="tel" class="form-control" id="mobileNumber" placeholder="Enter your mobile number" name="mobile_no" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password" name="confirm_password" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle password visibility
    const togglePasswordBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePasswordBtn.addEventListener('click', () => {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });

    // Toggle confirm password visibility
    const toggleConfirmPasswordBtn = document.getElementById('toggleConfirmPassword');
    const confirmPasswordInput = document.getElementById('confirmPassword');

    toggleConfirmPasswordBtn.addEventListener('click', () => {
        if (confirmPasswordInput.type === 'password') {
            confirmPasswordInput.type = 'text';
        } else {
            confirmPasswordInput.type = 'password';
        }
    });
</script>
</body>
</html>
