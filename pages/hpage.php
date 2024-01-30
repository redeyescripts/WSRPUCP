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
<div id="items" class="md:gap-1 items-center ml-auto md:ml-[40%]">
  <div class="md:ml-[69%] w-screen md:w-2/12">
      <iframe class="md:w-auto w-screen mr-20 md:mr-20 h-96 shadow mb-1" src="https://discord.com/widget?id=1083831868299956305&theme=dark" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
  </div>
</div>
<div id="items" class="md:gap-1 items-center ml-auto md:ml-[40%]">
    <div id="characters" class="md:w-10/12 md:mr-20 mb-1 md:mb-0"></div>
    
    
    <div class="md:w-3/12 mb-1 md:mb-20">
      
      <div class="shadow overflow-y-hidden overflow-x-auto rounded mb-1">
        <table class="min-w-full divide-y bg-stone-300 text-zinc-700">
          <h1 class="pb-5 text-2xl font-semibold text-white text-center underline">Kasutajad</h1>
          <thead class="bg-stone-300 rounded-xl">
            <tr class="rounded-xl">
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">NIMI</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">TUNNID</th>
            </tr>
          </thead>
          
            
            
            <?php
            // Assuming you have a valid database connection ($conn)

            $query = "SELECT * FROM users";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo '<tbody class="bg-white divide-y divide-zinc-200 rounded-xl">';
                
                while ($rows = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td class="text-sm px-6 py-4 whitespace-nowrap">' . $rows['username'] . '</td>';
                    echo '<td class="text-sm px-6 py-4 whitespace-nowrap">' . $rows['tunnid'] . '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                
                // Free result set
                mysqli_free_result($result);
            } else {
                // Handle query error
                echo "Error: " . mysqli_error($con);
            }

            // Close the connection
            //mysqli_close($con);
          ?>
          
        </table>
      </div>
    </div>
</div>
<div id="items" class="md:gap-1 ml-auto md:ml-[30%]">
    <div id="characters" class="md:w-9/12 mb-1 md:mb-0"></div>
    
    <div class="md:w-[50%] mb-10 md:mb-0">
      <div class="shadow overflow-y-hidden overflow-x-auto rounded mb-1">
        <table class="min-w-full divide-y bg-stone-300 text-zinc-700">
          <h1 class="pb-5 text-2xl font-semibold text-white text-center underline">Import autod</h1>
          <thead class="bg-stone-300 rounded-xl">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">NIMI</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">MUDEL</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">KESTVUS</th>
            </tr>
          </thead>
          <?php
            // Assuming you have a valid database connection ($conn)

            $query = "SELECT * FROM player_imports";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo '<tbody class="bg-white divide-y divide-zinc-200 rounded-xl">';
                
                while ($rows = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td class="text-sm px-6 py-4 whitespace-nowrap">' . $rows['citizenid'] . '</td>';
                    echo '<td class="text-sm px-6 py-4 whitespace-nowrap">' . $rows['vehicle'] . '</td>';
                    echo '<td class="text-sm px-6 py-4 whitespace-nowrap">' . $rows['date'] . '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                
                // Free result set
                mysqli_free_result($result);
            } else {
                // Handle query error
                echo "Error: " . mysqli_error($con);
            }

            // Close the connection
            //mysqli_close($con);
          ?>
          
        </table>
      </div>
    </div>
</div>

</body>

<div id="notify_container" class="absolute bottom-5 right-5 overflow-x-hidden overflow-y-hidden"></div>