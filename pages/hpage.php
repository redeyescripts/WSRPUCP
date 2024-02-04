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
$hex = base_convert($steamhex, 10, 16);
$steam = "steam:$hex";
$query2 = "SELECT punktid FROM users WHERE steamhex ='$steam'";
$query3 = "SELECT wlstatus FROM users WHERE steamhex ='$steam'";
$query4 = "SELECT * FROM users WHERE steamhex ='$steam'";
$result = mysqli_query($con, $query2);
$result2 = mysqli_query($con, $query3);
$result3 = mysqli_query($con, $query4);
$status = "";
$tunnid = "";
$ur = "";
if (mysqli_num_rows($result2) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result2)) {
    $wlstatus = $row["wlstatus"];
  }
}
 



if (mysqli_num_rows($result3) > 0) {
  // Output data of each row
  /*echo '<div x-data="{show: true}"><button onclick="location.href=\'fivem://connect/cfx.re/join/doxkdj\'" class="bg-sky-700 hover:bg-sky-800 px-4 text-white h-10 shadow rounded cursor-pointer ml-[35%]">Liitu serveriga</button></div>';
  echo '<div class="md:flex md:gap-1">';*/

  while ($row = mysqli_fetch_assoc($result3)) {
      $ur = $row["username"];
      $tunnid = $row["tunnid"];

      /*echo '
      <div class="md:w-3/12 mb-1 md:mb-0">
        <iframe class="w-full h-96 shadow mb-1" src="https://discord.com/widget?id=1073730363710521514&amp;theme=light" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
        <div class="shadow overflow-y-hidden overflow-x-auto rounded mb-1">
          <table class="min-w-full divide-y divide-zinc-200 text-zinc-700">
            <thead class="bg-zinc-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">NIMI</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">TUNNID</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-zinc-200">
              <tr class="hover:bg-zinc-100">
                <td class="text-sm px-6 py-4 whitespace-nowrap">' . $ur . '</td>
                <td class="text-sm px-6 py-4 whitespace-nowrap">' . $tunnid . '</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>';*/
      
      
  }

  
            

}
?>
<head>
  <script src="js/script.js" type="text/javascript"></script>

</head>
<body class="bg-sky-900/70 items-center">
<br>
<div id="items" class="md:gap-1 items-center ml-auto md:ml-[18%]">
  <p class="text-white text-2xl md:text-xl text-center gap-3 ml-auto md:mr-[53%] underline mb-0">TERE TULEMAST WSRP KODULEHELE</p>
  <br>
  <br>
  <div class="md:ml-[69%] w-screen md:w-2/12">
      <iframe class="md:w-auto w-screen mr-20 md:mr-20 h-96 shadow mb-1" src="https://discord.com/widget?id=1005098893698138136&theme=dark" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
  </div>
</div>


</body>

<div id="notification-container" class="fixed top-0 right-0 m-4"></div>