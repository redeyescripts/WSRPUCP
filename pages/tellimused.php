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
<body>
	<main id="content" class="flex-1 relative z-0 overflow-y-auto focus:outline-none py-6">
		<p class="pb-5 text-2xl md:text-2xl md:text-white font-semibold text-white text-center underline">Import autode tellimine</p>  
	</main>
</body>





