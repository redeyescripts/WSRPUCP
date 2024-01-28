<?php      
    $host = "192.168.0.22";  // NEEDS FIREWALL INBOUND OR OUTBOUND CONFIGURATIONS
    $user = "fivem";  
    $password = 'Server2023.';  
    $db_name = "andmebaas";  
      
    $con = mysqli_connect($host, $user, $password, $db_name);
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error());  
    }
    $pdo = new PDO("mysql:host=$host; dbname=$db_name", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
?>  


