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

    function WLIDCheck($con, $steam) {

        $sql = "SELECT * FROM player_whitelists WHERE identifier = ?;";
        $stmt = mysqli_stmt_init($con);


        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('location: home.php');
        }

        mysqli_stmt_bind_param($stmt, "s", $steam);

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
    function showNotificationV2($message, $type) {
         // Set notification type classes
        $notificationContainer = '<div class="rounded p-4 mb-4 transition duration-300 ease-in-out transform';

        if ($type === 'success') {
            $notificationContainer .= ' bg-green-500 text-white';
        } elseif ($type === 'error') {
            $notificationContainer .= ' bg-red-500 text-white';
        }

        $notificationContainer .= '"><p>' . $message . '</p></div>';

        // Display the notification
        echo $notificationContainer;

        // Delayed redirection
        exit();
    }

    function showNotification($type, $message) {
        $notification = '';
    
        if ($type == 'success') {
            $notification = '
            <div class="flex min-w-96 break-all items-center p-4 text-zinc-500 bg-white rounded shadow mb-1" role="alert">
                <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded shadow">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Check icon</span>
                </div>
    
                <div class="ml-3 text-sm font-normal">'.$message.'</div>
    
                <button onclick="this.parentElement.remove();" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-zinc-400 hover:text-zinc-900 rounded focus:ring-2 focus:ring-zinc-300 p-1.5 hover:bg-zinc-100 inline-flex h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            ';
        } elseif ($type == 'info') {
            $notification = '
            <div class="flex min-w-96 break-all items-center p-4 text-zinc-500 bg-white rounded shadow mb-1" role="alert">
                <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-sky-500 bg-sky-100 rounded shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
                    <span class="sr-only">Info icon</span>
                </div>
    
                <div class="ml-3 text-sm font-normal">'.$message.'</div>
    
                <button onclick="this.parentElement.remove();" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-zinc-400 hover:text-zinc-900 rounded focus:ring-2 focus:ring-zinc-300 p-1.5 hover:bg-zinc-100 inline-flex h-8 w-8" data-dismiss-target="#toast-warning" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            ';
        } elseif ($type == 'error') {
            $notification = '
            <div class="flex min-w-96 break-all items-center p-4 text-zinc-500 bg-white rounded shadow mb-1" role="alert">
                <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-red-500 bg-red-100 rounded shadow">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Error icon</span>
                </div>
    
                <div class="ml-3 text-sm font-normal">'.$message.'</div>
    
                <button onclick="this.parentElement.remove();" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-zinc-400 hover:text-zinc-900 rounded focus:ring-2 focus:ring-zinc-300 p-1.5 hover:bg-zinc-100 inline-flex h-8 w-8" data-dismiss-target="#toast-danger" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            ';
        }
    
        echo $notification;
    
        echo '
        <script>
            setTimeout(function () {
                jQuery(".flex.min-w-96.break-all.items-center.p-4.text-zinc-500.bg-white.rounded.shadow.mb-1").fadeOut(300);
            }, 5000);
        </script>
        ';
    }
    
    // Example usage:
    // showNotification('success', 'This is a success message');
    // showNotification('info', 'This is an info message');
    // showNotification('error', 'This is an error message');
    
    function PointsRenew($con, $hex, $userpoints, $amount) {
        $query1 = "SELECT punktid FROM users WHERE steamhex = ?";
        $stmt1 = mysqli_prepare($con, $query1);
        mysqli_stmt_bind_param($stmt1, "s", $hex);
        mysqli_stmt_execute($stmt1);
        $result = mysqli_stmt_get_result($stmt1);
    
        $stmt2 = null; // Declaration here

        if ($amount == $userpoints) {
            echo '
            <script>
                alert("Ei saa eemaldada punkte sest kasutaja miinusesse lubamine on keelatud!");
            </script>';
            return false; // Indicate failure
        }
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $currentPoints = $row['punktid'];
            $newPoints = max(0, $currentPoints - $amount); // Ensure points don't go below zero
            $query2 = "UPDATE users SET punktid=? WHERE steamhex = ?";
            $stmt2 = mysqli_prepare($con, $query2);
            mysqli_stmt_bind_param($stmt2, "is", $newPoints, $hex);
            mysqli_stmt_execute($stmt2);
    
            $_SESSION['userData']['points'] = $newPoints;
        }
    
        mysqli_stmt_close($stmt1);
    
        // Close $stmt2 only if it has been initialized
        if ($stmt2) {
            mysqli_stmt_close($stmt2);
        }
    }

    

    function PointsAdd($con, $hex, $amount) {
        $query1 = "SELECT punktid FROM users WHERE steamhex = ?";
        $stmt1 = mysqli_prepare($con, $query1);
        mysqli_stmt_bind_param($stmt1, "s", $hex);
        mysqli_stmt_execute($stmt1);
        $result = mysqli_stmt_get_result($stmt1);
    
        if (!$result) {
            // Handle database error here
            return false;
        }
    
        $stmt2 = null; // Declaration here
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $currentPoints = $row['punktid'];
            $newPoints = $currentPoints + $amount; // Adding points
    
            $query2 = "UPDATE users SET punktid=? WHERE steamhex = ?";
            $stmt2 = mysqli_prepare($con, $query2);
    
            if (!$stmt2) {
                // Handle database error here
                return false;
            }
    
            mysqli_stmt_bind_param($stmt2, "is", $newPoints, $hex);
            mysqli_stmt_execute($stmt2);
    
            $_SESSION['userData']['points'] = $newPoints;
        }
    
        mysqli_stmt_close($stmt1);
    
        // Close $stmt2 only if it has been initialized
        if ($stmt2) {
            mysqli_stmt_close($stmt2);
        }
    
        return true; // Success
    }
    
    
    







?>