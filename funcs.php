<?php 
    include ('db.php');

    function userIdcheck($con, $username, $steam) {

        $sql = "SELECT * FROM users WHERE username = ? AND steamhex = ?;";
        $stmt = mysqli_stmt_init($con);


        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('location: login.php');
        }

        mysqli_stmt_bind_param($stmt, "ss", $username, $steam);

        mysqli_stmt_execute($stmt);

        $resdata = mysqli_stmt_get_result($stmt);


        if ($row = mysqli_fetch_assoc($resdata)) {
            # code...
            return $row;
        } else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
        
    }

    function whitelistCheck($con, $steam, $status) {

        $sql = "SELECT * FROM whitelist WHERE status = ? AND steamhex = ?;";
        $stmt = mysqli_stmt_init($con);


        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('location: login.php');
        }

        mysqli_stmt_bind_param($stmt, "ss", $steam, $status);

        mysqli_stmt_execute($stmt);

        $resdata = mysqli_stmt_get_result($stmt);


        if ($row = mysqli_fetch_assoc($resdata)) {
            # code...
            return $row;
        } else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
        
    }



    
    function generateRandomString($length = 32){
        return bin2hex(random_bytes($length));
    }

    function getId($con, $username) {
        $query2 = "SELECT id FROM users WHERE username = '$username';";
        $id = mysqli_query($con, $query2);
        return $id;
    }

    function takeLog($con, $username, $type) {
        if ($type == 'login') {

            $query = "INSERT INTO web_logs (`username`, `desc`, `type`) VALUES ('$username', 'Logged in', '$type');";

            $con->query($query);
        }

        if ($type == 'reset') {

            $query = "INSERT INTO web_logs (`username`, `desc`, `type`) VALUES ('$username', 'Password reset', '$type');";

            $con->query($query);
        }


        if ($type == 'register') {

            $query = "INSERT INTO web_logs ('username', 'desc', 'type') VALUES ('$username', 'New account', '$type');";

            $con->query($query);
        }

        if ($type == 'delete') {

            $query = "INSERT INTO web_logs ('username', 'desc', 'type') VALUES ('$username', 'Deleted account', '$type');";

            $con->query($query);
        }






    }

    function DB($con, $query) {
        $con->query($query);
    }


     
  



?>