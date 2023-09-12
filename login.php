<!-- Login Screen Code -->
<?php
include 'connect.php';

$user_not_exists_error = false;
$incorrect_password_error = false;
$inactive_user_error = false;

if (isset($_POST['login'])) {
    $mobile_no = trim($_POST['mobile_no']);
    $password = trim($_POST['password']);

    
    $sql = "SELECT * FROM ortask WHERE MobileNo = '$mobile_no'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $row = mysqli_fetch_array($result);
            if ($row['IsActive'] == 1) {
                
                if ($row['Password'] == $password) {
                    $user_id = $row['User_ID'];
                    echo "Login successful!";
                    session_start();
                    $_SESSION['user_id'] = $user_id;
                    header("Location:index.php");
                } else {
                    $incorrect_password_error = true;
                }
            } else {
                $inactive_user_error = true;
            }
        } else {
            $user_not_exists_error = true;
        }
    } else {
        die("Error: " . mysqli_error($conn));
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Screen</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!--Font Awesome CSS -->
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
          <h4 class="card-title text-center">Login</h4>
          <form method="post" action="">
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
            
            <!-- Error message -->
            <?php
            if ($user_not_exists_error) {
                echo "<div class='alert alert-danger'><strong>User Not exists!</strong></div>";
            } elseif ($inactive_user_error) {
                echo "<div class='alert alert-danger'><strong>This user is inactive!</strong></div>";
            } elseif ($incorrect_password_error) {
                echo "<div class='alert alert-danger'><strong>Wrong password!</strong></div>";
            }
            ?>

            <div class="mb-3">
              <input type="submit" class="btn btn-primary" name="login" value="Login">
            </div>
            <div class="text-center">
              <p>New user? <a href="register.php">Register here</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  
  const togglePasswordBtn = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');
  
  togglePasswordBtn.addEventListener('click', () => {
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
    }
  });
</script>
</body>
</html>
