<?php
include 'mail.php';
include 'db.php';
include 'funcs.php';
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
      $points = $row["punktid"];
    }
} 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
    <title>WSRP</title>
    <link rel="icon" type="image/x-icon" href="/images/logo.png">
    <script src="js/script.js" type="text/javascript"></script>
    
</head>
<body >
<div class="h-screen flex overflow-hidden bg-zinc-100" x-data="{ sidebarOpen: false, currentGame: 'gtav' }" @keydown.window.escape="sidebarOpen = false">
  <div x-show="sidebarOpen" class="md:hidden" style="display: none;">
  
    <div class="fixed inset-0 flex z-40">
      <div @click="sidebarOpen = false" x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0" style="display: none;">
        <div class="absolute inset-0 bg-cyan-900 opacity-75"></div>
      </div>
      <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="relative flex-1 flex flex-col max-w-xs w-full bg-sky-600/80" style="display: none;">
        <div class="absolute top-0 right-0 -mr-12 pt-2">
          <button x-show="sidebarOpen" @click="sidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded focus:outline-none" style="display: none;">
            <span class="sr-only">Close sidebar</span>
            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
          <div class="ml-auto mr-auto mb-1">
            <div class="flex-shrink-0 flex items-center justify-center mb-1">
              <h4 class="text-white font-bold text-2xl ml-2">WSRP</h4>
            </div>
            
          </div>
          <nav class="mt-1 px-2 space-y-1 bg-sky-600/80">
            <p class="text-zinc-300 uppercase text-xs font-semibold">Avasta</p>
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('hpage', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
              </svg> Avaleht </a>
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('hpage', '');" class="hidden text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"></path>
              </svg> Sissejuhatus </a>
            
            
            <a @click="sidebarOpen = false; setPageNew('rules', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path>
              </svg> Reeglid </a>
            <a @click="sidebarOpen = false; setPageNew('whitelist', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
              </svg> Rollimängutest </a>
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('donations', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
              </svg> Annetamine </a>
            
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('tellimused', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"></path>
              </svg> Eritellimused </a>
          </nav>
        </div>
        <div class="flex-shrink-0 flex bg-cyan-900  p-4 relative">
          <div class="flex items-center">
          <img class="h-10 w-10 rounded-full" src="<?php echo $avatar?>">
            <div class="ml-3">
              <p class="text-base font-medium text-white"><?php echo $username?></p>
              <p class="text-sm font-medium text-zinc-400 group-hover:text-zinc-300"><?php echo $steam?></p>
              <p class="text-sm font-medium text-zinc-400 group-hover:text-zinc-300"><?php echo "Punkte:$points"?></p>
            </div>
          </div>
          <a href='../logout.php' class="hover:animate-pulse m-auto mr-0 text-zinc-300 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-zinc-200">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"></path>
            </svg>
          </a>
        </div>
      </div>
      <div class="flex-shrink-0 w-14"></div>
    </div>
  </div>
  <div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64">
      <div class="flex flex-col h-0 flex-1 bg-sky-600/80">
        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
          <div class="ml-auto mr-auto mb-1">
            <div class="flex-shrink-0 flex items-center justify-center mb-1">
              <h4 class="text-white font-bold text-2xl ml-2">WSRP</h4>
            </div>
            
          </div>
          <nav class="mt-1 flex-1 px-2 bg-sky-600/80 space-y-1">
            <p class="text-zinc-300 uppercase text-xs font-semibold">Mängija valikud</p>
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('hpage', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
              </svg> Avaleht </a>
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('hpage', '');" class="hidden text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"></path>
              </svg> Sissejuhatus </a>
            
            <a @click="sidebarOpen = false; setPageNew('rules', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path>
              </svg> Reeglid </a>
            <a @click="sidebarOpen = false; setPageNew('whitelist', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
              </svg> Rollimängutest </a>
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('donations', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
              </svg> Annetamine </a>
            
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('addon_vehicles', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"></path>
              </svg> Eritellimused </a>
          </nav>
        </div>
        <div class="flex-shrink-0 flex bg-cyan-950 p-4 relative">
          <div class="flex items-center">
            <img class="h-10 w-10 rounded-full" src="<?php echo $avatar?>">
            <div class="ml-2">
              <p class="text-sm font-medium text-white"><?php echo $username?></p>
              <p class="text-xs font-medium text-zinc-300 group-hover:text-zinc-200"><?php echo $steam?></p>
              <p class="text-xs font-medium text-zinc-300 group-hover:text-zinc-200"><?php echo "Punkte:$points"?></p>
            </div>
          </div>
          <a href='../logout.php' class="hover:animate-pulse m-auto mr-0 text-zinc-300 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-zinc-200">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="flex flex-col w-0 flex-1 overflow-hidden">
    <div :class="{ 'md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3 z-10': !sidebarOpen, 'md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3 z-0' : sidebarOpen}" class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3 z-10">
      <button @click.stop="sidebarOpen = true" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded text-zinc-500 hover:text-zinc-900">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>
    <main id="content" class="flex-1 relative z-0 overflow-y-auto focus:outline-none py-6 bg-sky-600"></main>
    <div id="notify_container" class="absolute bottom-5 right-5 overflow-x-hidden overflow-y-hidden"></div>
    
  </div>
</div>


    
</body>











</html>

<script>
    function saada() {
        var formData = $("#questionForm").serialize();

        $.ajax({
            url: "pages/whitelist.php",
            type: "post",
            data: formData,
            success: function(response) {
                console.log('Raw response:', response);

                try {
                    response = JSON.parse(response);

                    if (response.status === 'success') {
                        $("#result").html('<p class="text-green-500 text-center">Whitelist has been successfully created!</p>');
                    } else {
                        $("#result").html('<p class="text-red-500 text-center">Whitelist creation failed. Details: ' + JSON.stringify(response.faults) + '</p>');
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', xhr.responseText);
                $("#result").html('<p class="text-red-500 text-center">An error occurred while creating the whitelist.</p>');
            }
        });
    }

    
    $(document).ready(function () {
      setPageNew('hpage', '');
    });
        
</script>


