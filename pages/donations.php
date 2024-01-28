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


?>

<h1 class="pb-5 text-2xl font-semibold text-white text-center underline">Annetamine ja heategu</h1>

    
   
<form action="https://www.paypal.com/donate" class="bg-black w-[48%] md:w-[10%] ml-[30%] md:ml-[45%]" method="post" target="_top">
    <input type="hidden" name="hosted_button_id" value="2HGSGKK68VXGE" />
    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
    <img alt="" border="0" src="https://www.paypal.com/en_EE/i/scr/pixel.gif" width="1" height="1" />
</form>

   
<div id="notify_container" class="absolute bottom-5 right-5 overflow-x-hidden overflow-y-hidden"></div>     



