<?php
session_start(); 

if (isset($_POST['login'])) {
    $admin_name = $_POST['admin_name'];
    $admin_password = $_POST['admin_password']; 

  
    $conn = new mysqli("localhost", "root", "", "project2");

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   
    $sql = "SELECT * FROM admin WHERE user_name = ? AND deleted = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $admin_name); 
    $stmt->execute();
    $result = $stmt->get_result();

   
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        
      
        if ($admin['password'] == $admin_password) {
          
            $_SESSION['admin_name'] = $admin_name;
            
            
            header("Location: index.php");
            exit();
        } else {
           
            header("Location: login.php?login=false");
            exit();
        }
    } else {
       
        header("Location: login.php?login=false");
        exit();
    }

    
    $stmt->close();
    $conn->close();
}
?>
