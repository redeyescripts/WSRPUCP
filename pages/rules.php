<?php
include './../mail.php';
include './../db.php';
include './../funcs.php';
session_start();
if(!$_SESSION['logged_in']){
  echo '<script>alert("Nah!")</script>'; 
  header("Location: ./../logout.php");
  exit();
}
$username = $_SESSION['userData']['name'];
$avatar = $_SESSION['userData']['avatar'];
$steamhex = $_SESSION['userData']['steam_id'];
$ipaddr = $_SESSION['userData']['ip'];
$hex = base_convert ($steamhex, 10, 16);
$steam = "steam:$hex";
$query2 = "SELECT wlstatus FROM users WHERE steamhex ='$steam'";
$result = mysqli_query($con, $query2);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $status = $row["wlstatus"];
    }
} else {
    echo "0 results";
}






?>

<head>
  <script src="js/script.js" type="text/javascript"></script>
</head>
<main id="content" class="flex-1 h-full w-full relative z-0 overflow-y-auto focus:outline-none py-6">
      <div class="px-4 w-full h-screen ">
        <h1 class="pb-5 text-2xl font-semibold text-white underline text-center">Reeglid</h1>
        <div class="flex justify-center w-auto h-full items-center">
            <iframe class="bg-sky-900/70 w-screen h-full" src="https://docs.google.com/document/d/e/2PACX-1vQ5wBX_db1NH9i5jg2PQXNXQDSTKcrIE_HCYOgLVeYH_L3rZSwLAp41hVnidea_W6X71_VUxyyL356N/pub?embedded=true"></iframe>
        </div>
      </div>
      
</main>
<div id="notify_container" class="absolute bottom-5 right-5 overflow-x-hidden overflow-y-hidden"></div>