<?php
include './../mail.php';
include './../db.php';
include './../funcs.php';
session_start();
if(!$_SESSION['logged_in']){
  header("Location: ./../logout.php");
  exit();
}


$username = $_SESSION['userData']['name'];
$avatar = $_SESSION['userData']['avatar'];
$steamhex = $_SESSION['userData']['steam_id'];
$ipaddr = $_SESSION['userData']['ip'];
$hex = base_convert ($steamhex, 10, 16);
$steam = "steam:$hex";
$query2 = "SELECT punktid FROM users WHERE steamhex ='$steam'";
$query3 = "SELECT wlstatus FROM users WHERE steamhex ='$steam'";
$result = mysqli_query($con, $query2);
$result2 = mysqli_query($con, $query3);
$status = 0;
if (mysqli_num_rows($result2) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result2)) {
    $wlstatus = $row["wlstatus"];
  }
} 

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $_SESSION['userData']['points'] = $row["punktid"];
  }
} 


$points = $_SESSION['userData']['points']

?>
<script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js" charset="UTF-8"></script>
<h1 class="pb-5 text-2xl font-semibold text-white text-center underline">Annetamine ja heategu</h1>

    
   
<div class="bg-green-900 rounded shadow p-2 mb-1 text-zinc-900 md:w-96 ml-auto md:ml-[38%] text-center items-center">
  <div class="break-all md:text-center text-center items-center text-white">
    <h1 class="text-xl font-semibold underline">Annetamine</h1>
    <p class="text-md">- Teil on <b><?php echo "$points"?></b> aktiivsuspunkti. </p>
    <p class="text-md">- Üks serveris veedetud tund on <b>15</b> aktiivsuspunkti. </p>
  </div>
  
  <form action="https://www.paypal.com/donate" method="post" target="_top">
    <input type="hidden" name="hosted_button_id" value="2HGSGKK68VXGE" />
    <input type="hidden" name="steam" data="<?php json_encode($steam); ?>"/>
    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
    <img alt="" border="0" src="https://www.paypal.com/en_EE/i/scr/pixel.gif" width="1" height="1" />
    </form>
  
</div>



</script>
</div>





   
<div id="notify_container" class="absolute bottom-5 right-5 overflow-x-hidden overflow-y-hidden"></div>     



