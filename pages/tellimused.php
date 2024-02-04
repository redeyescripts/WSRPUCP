<?php
include './../mail.php';
include './../db.php';
include './../funcs.php';
include './../config.php';
session_start();
if(!$_SESSION['logged_in']){
    echo '<script>alert("Nah!")</script>'; 
    header("Location: ./../logout.php");
    exit();
}

$import = $settings['order']['import'];
$plate = $settings['order']['plate'];
$userpoints = $_SESSION['userData']['points'];
$username = $_SESSION['userData']['name'];
$avatar = $_SESSION['userData']['avatar'];
$steamhex = $_SESSION['userData']['steam_id'];
$ipaddr = $_SESSION['userData']['ip'];
$hex = base_convert($steamhex, 10, 16);
$steam = "steam:$hex";
$query2 = "SELECT punktid FROM users WHERE steamhex ='$steam'";
$result = mysqli_query($con, $query2);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $userpoints = $row["punktid"];
    }
} 


?>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
	
        <form method="post" action="pages/tellimused.php">
            <div class="mb-4 bg-stone-200 w-auto md:w-60 md:ml-[40%] h-auto md:h-[25%] items-center text-center rounded-xl">
                <label for="dropdown" class="block text-sm font-medium text-gray-600 underline">Autode tellimine HIND: <?php echo $import;?>p</label>
                
                
                <label for="inputField" class="block text-sm font-medium text-gray-600">Link autole:</label>
                <input name="link" type="text" id="link" class="w-screen md:w-60 mt-1 p-2 border rounded-xl text-center">
                <?php
                    

                    if ($userpoints >= $import) {
                        echo "<button class='bg-slate-700 hover:bg-cyan-700 text-white px-4 py-2 rounded-md mt-3 md:mt-6'>Telli</button>";
                    } else {
                        echo "<label name='import' type='submit' value='5000' class='pb-5 text-xl font-semibold text-red text-center'>Sinul pole hetkel 5000p et seda sooritada!</label>";
                    }

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Get values from the form
                        $link = $_POST["link"];
                        $resultlink = trim($link);
                        $text = "
                            \n Soovin tellida autot: 
                            <br> 
                          
                            \n HEX:  $steam 
                            <br> 
                            \n Kasutajanimi: $username
                            <br> 
                            \n Link autole: $resultlink 
                            
                        ";
                        // Use the values as needed (for example, you can echo them)
                        PointsRenew($con, $steam, $userpoints, $import);
                        sendmail('pals.sten@gmail.com', 'AUTO TELLIMUS', $text, $username);
                    }

                    
                ?>
            </div>
        </form>
        <br> 
        <br>
        <br>
        <form  method="post"  action="pages/tellimused.php">
            <div class="mb-4 bg-stone-200 w-screen md:w-60 md:ml-[40%] h-auto md:h-auto items-center text-center rounded-xl">
                <label for="dropdown" class="block text-sm font-medium text-gray-600 underline">Eriline numbrimärk HIND:  <?php echo $plate;?>p</label>
                
                
                <label for="inputField" class="block text-sm font-medium text-gray-600">Numbrimärk:</label>
                <input name="number" type="text" id="link" class="w-screen md:w-60 mt-1 p-2 border rounded-xl text-center">
                <?php
                    

                    if ($userpoints >= $plate) {
                        echo "<button type='submit' name='plate' value='2000' class='bg-slate-700 hover:bg-cyan-700 text-white px-4 py-2 rounded-md mt-3 md:mt-6'>Telli</button>";
                    } else {
                        echo "<label class='pb-5 text-xl font-semibold text-red text-center'>Sinul pole hetkel 2000p et seda sooritada!</label>";
                    }

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        // Get values from the form
                        
                        $link = $_POST["link"];
                        $resultlink = trim($link);
                        $text = "
                            Soovin tellida erilist numbrimärki:
                            <br> 
                            \n HEX: $steam
                            <br> 
                            \n Kasutajanimi: $username
                            <br> 
                            \n Numbrimärk: $resultlink 
                            
                        ";
                        // Use the values as needed (for example, you can echo them)
                        PointsRenew($con,  $steam, $userpoints, $plate);
                        sendmail('pals.sten@gmail.com', 'AUTO NUMBRI TELLIMINE', $text, $username);
                    }

                    
                ?>
            </div>
        </form>
        <div id="notification-container" class="fixed top-0 right-0 m-4"></div>
        
        



</body>





