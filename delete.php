<!-- Code for setting IsActive = 0 -->
<?php
include 'connect.php';

if (isset($_GET['delete_id'])) {
    $user_id = $_GET['delete_id'];

    
    $sql = "UPDATE ortask SET IsActive = 0, DeletedOn = NOW() WHERE User_ID = $user_id";
    
    if (mysqli_query($conn, $sql)) {
        
        header('Location: index.php'); 
    } else {
        
        echo "Error: " . mysqli_error($conn);
    }
}
?>
