<!-- Home Screen Code -->
<?php
include 'connect.php';

session_start();

if(!isset($_SESSION['user_id'])){
  header('Location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Screen</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar/Header Section -->
    <?php
    include 'navbar.php';
    ?>
<div class="container mt-5">
    <div class="row justify-content-between mb-3">
        <div class="col-md-6">
            <h4>Registered Users</h4>
        </div>
        <div class="col-md-6">
            <form class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search by name or mobile number">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </form>
        </div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Action</th>
            <th>IsActive</th>
            <th>DeletedOn</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT * FROM ortask ";
        $result = mysqli_query($conn,$sql);

        if($result){
            while($row = mysqli_fetch_array($result)){
                $id = $row['User_ID'];
                $name = $row['Name'];
                $mobile_no = $row['MobileNo'];
                $is_active = $row['IsActive'];
                $deleted_on = $row['DeletedOn'];

                if (!empty($deleted_on)) {
                    $is_active = 0; 
                }

                echo "<tbody>
                <tr>
                <td>".$name."</td>
                <td>".$mobile_no."</td>
                <td>";

                if ($_SESSION['user_id'] == $id) {
                    
                    echo "<span class='text-success'>Logged In</span>";
                } elseif ($is_active == 0) {
                    
                    echo "<span class='text-danger'>Deleted</span>";
                } else {
                    
                    echo "<a href='delete.php?delete_id=$id' class='btn btn-danger'>Delete</a>";
                }

                echo "</td>
                <td>".$is_active."</td>
                <td>".$deleted_on."</td>
                </tr>
            </tbody>";
            }
        }
        ?>
    </table>

    <a href="logout.php" class="btn btn-secondary">Logout</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
