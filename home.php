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

if($_SESSION['logged_in']){
   showNotification("success", "Logisid sisse.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<! Copyright
	   By
	   Hedge Studio
	   @
	   2024
	>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/javascript-obfuscator@4.1.0/dist/index.browser.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
    <title>WSRP</title>
	<link rel="icon" type="image/x-icon" href="/images/logo.png">
    <script src="js/script.js" type="text/javascript"></script>
	
    
</head>
<body class="bg-[#263c66] w-screen h-full md:w-full md:h-full">
<div class="h-screen flex overflow-hidden bg-[#263c66]" x-data="{ sidebarOpen: false, currentGame: 'gtav' }" @keydown.window.escape="sidebarOpen = false">
  <div x-show="sidebarOpen" class="md:hidden" style="display: none;">
  
    <div class="fixed inset-0 flex z-40">
      <div @click="sidebarOpen = false" x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0" style="display: none;">
        <div class="absolute inset-0 bg-[#111827] opacity-75"></div>
      </div>
      <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="relative flex-1 flex flex-col max-w-xs w-full bg-[#263c66] rounded-xl" style="display: none;">
        <div class="absolute top-0 right-0 -mr-12 pt-2">
          <button x-show="sidebarOpen" @click="sidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded focus:outline-none" style="display: none;">
            <span class="sr-only">Sulge</span>
            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
          <div class="ml-auto mr-auto mb-1">
            <div class="flex-shrink-0 flex items-center justify-center mb-1">
              <a class="text-white font-bold text-2xl ml-2" href="https://wsrpucp.optikl.ink/home.php">WSRP</a>
            </div>
            
          </div>
          <nav class="mt-1 px-2 space-y-1 bg-[#263c66] rounded-xl">
            <p class="text-zinc-300 uppercase text-xs font-semibold">Avasta</p>
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('hpage', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
              </svg> Avaleht 
            </a>
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('hpage', '');" class="hidden text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"></path>
              </svg> Sissejuhatus 
            </a>
            
            
            <a @click="sidebarOpen = false; setPageNew('rules', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path>
              </svg> Reeglid 
            </a>
            <a @click="sidebarOpen = false; setPageNew('whitelist', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
              </svg> Whitelist 
            </a>
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('donations', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
              </svg> Annetamine 
            </a>
            
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('tellimused', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"></path>
              </svg> Eritellimused 
            </a>
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('status', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.4" d="M6.87988 18.1501V16.0801" stroke="#a5acb6" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.4" d="M12 18.1498V14.0098" stroke="#a5acb6" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.4" d="M17.1201 18.1502V11.9302" stroke="#a5acb6" stroke-width="1.5" stroke-linecap="round"></path> <g opacity="0.4"> <path d="M17.1199 5.84961L16.6599 6.38961C14.1099 9.36961 10.6899 11.4796 6.87988 12.4296" stroke="#a5acb6" stroke-width="1.5" stroke-linecap="round"></path> <path d="M14.1904 5.84961H17.1204V8.76961" stroke="#a5acb6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g> <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#a5acb6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
              Serveri Staatus 
            </a>
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('tellimused', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5155 15.7248C3.78702 15.7062 4.13391 15.7059 4.63158 15.7059H19.3684C19.8661 15.7059 20.213 15.7062 20.4845 15.7248C20.7513 15.7431 20.9067 15.7774 21.0253 15.8268C21.4122 15.988 21.7196 16.2972 21.8798 16.6863C21.9289 16.8056 21.963 16.9619 21.9812 17.2303C21.9997 17.5034 22 17.8523 22 18.3529C22 18.8535 21.9997 19.2025 21.9812 19.4756C21.963 19.744 21.9289 19.9002 21.8798 20.0196C21.7196 20.4087 21.4122 20.7179 21.0253 20.8791C20.9067 20.9285 20.7513 20.9628 20.4845 20.9811C20.213 20.9997 19.8661 21 19.3684 21H4.63158C4.13391 21 3.78702 20.9997 3.5155 20.9811C3.2487 20.9628 3.09333 20.9285 2.97471 20.8791C2.58782 20.7179 2.28044 20.4087 2.12019 20.0196C2.07105 19.9002 2.03701 19.744 2.01881 19.4756C2.00028 19.2025 2 18.8535 2 18.3529C2 17.8523 2.00028 17.5034 2.01881 17.2303C2.03701 16.9619 2.07105 16.8056 2.12019 16.6863C2.28044 16.2972 2.58782 15.988 2.97471 15.8268C3.09333 15.7774 3.2487 15.7431 3.5155 15.7248ZM4.63158 19.4118C5.21293 19.4118 5.68421 18.9377 5.68421 18.3529C5.68421 17.7682 5.21293 17.2941 4.63158 17.2941C4.05023 17.2941 3.57895 17.7682 3.57895 18.3529C3.57895 18.9377 4.05023 19.4118 4.63158 19.4118Z" fill="#e3e3e3"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63158 8.29412C4.13391 8.29412 3.78702 8.29383 3.5155 8.2752C3.2487 8.25689 3.09333 8.22265 2.97471 8.17322C2.58782 8.01202 2.28044 7.70284 2.12019 7.31367C2.07105 7.19435 2.03701 7.03807 2.01881 6.7697C2.00028 6.49658 2 6.14765 2 5.64706C2 5.14647 2.00028 4.79753 2.01881 4.52441C2.03701 4.25605 2.07105 4.09977 2.12019 3.98044C2.28044 3.59128 2.58782 3.28209 2.97471 3.1209C3.09333 3.07147 3.2487 3.03723 3.5155 3.01892C3.78702 3.00029 4.13391 3 4.63158 3H19.3684C19.8661 3 20.213 3.00029 20.4845 3.01892C20.7513 3.03723 20.9067 3.07147 21.0253 3.1209C21.4122 3.28209 21.7196 3.59128 21.8798 3.98044C21.9289 4.09977 21.963 4.25605 21.9812 4.52441C21.9997 4.79753 22 5.14647 22 5.64706C22 6.14765 21.9997 6.49658 21.9812 6.7697C21.963 7.03807 21.9289 7.19435 21.8798 7.31367C21.7196 7.70284 21.4122 8.01202 21.0253 8.17322C20.9067 8.22265 20.7513 8.25689 20.4845 8.2752C20.213 8.29383 19.8661 8.29412 19.3684 8.29412H4.63158ZM4.63158 9.35294C4.13391 9.35294 3.78702 9.35323 3.5155 9.37186C3.2487 9.39017 3.09333 9.42441 2.97471 9.47384C2.58782 9.63503 2.28044 9.94422 2.12019 10.3334C2.07105 10.4527 2.03701 10.609 2.01881 10.8774C2.00028 11.1505 2 11.4994 2 12C2 12.5006 2.00028 12.8495 2.01881 13.1226C2.03701 13.391 2.07105 13.5473 2.12019 13.6666C2.28044 14.0558 2.58782 14.365 2.97471 14.5262C3.09333 14.5756 3.2487 14.6098 3.5155 14.6281C3.78702 14.6468 4.13391 14.6471 4.63158 14.6471H19.3684C19.8661 14.6471 20.213 14.6468 20.4845 14.6281C20.7513 14.6098 20.9067 14.5756 21.0253 14.5262C21.4122 14.365 21.7196 14.0558 21.8798 13.6666C21.9289 13.5473 21.963 13.391 21.9812 13.1226C21.9997 12.8495 22 12.5006 22 12C22 11.4994 21.9997 11.1505 21.9812 10.8774C21.963 10.609 21.9289 10.4527 21.8798 10.3334C21.7196 9.94422 21.4122 9.63503 21.0253 9.47384C20.9067 9.42441 20.7513 9.39017 20.4845 9.37186C20.213 9.35323 19.8661 9.35294 19.3684 9.35294H4.63158ZM5.68421 12C5.68421 12.5848 5.21293 13.0588 4.63158 13.0588C4.05023 13.0588 3.57895 12.5848 3.57895 12C3.57895 11.4152 4.05023 10.9412 4.63158 10.9412C5.21293 10.9412 5.68421 11.4152 5.68421 12ZM4.63158 6.70588C5.21293 6.70588 5.68421 6.23183 5.68421 5.64706C5.68421 5.06229 5.21293 4.58824 4.63158 4.58824C4.05023 4.58824 3.57895 5.06229 3.57895 5.64706C3.57895 6.23183 4.05023 6.70588 4.63158 6.70588Z" fill="#e3e3e3"></path> </g></svg>
              Serveriga liitumine 
            </a>
          </nav>
        </div>
        <div class="flex-shrink-0 flex bg-[#111824]  p-4 relative">
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
      <div class="flex flex-col h-0 flex-1 bg-[#263c66]">
        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
          <div class="ml-auto mr-auto mb-1">
            <div class="flex-shrink-0 flex items-center justify-center mb-1">
              <a class="text-white font-bold text-2xl ml-2" href="https://wsrpucp.optikl.ink/home.php">WSRP</a>
            </div>
            
          </div>
          <nav class="mt-1 flex-1 px-2 bg-[#263c66] space-y-1 rounded-xl">
            <p class="text-zinc-300 uppercase text-xs font-semibold text-center items-center">Mängija valikud</p>
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('hpage', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
              </svg> Avaleht </a>
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('hpage', '');" class="hidden text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"></path>
              </svg> Sissejuhatus 
            </a>
            
            <a @click="sidebarOpen = false; setPageNew('rules', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path>
              </svg> Reeglid 
            </a>
            <a @click="sidebarOpen = false; setPageNew('whitelist', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
              </svg> Whitelist 
            </a>
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('donations', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path>
              </svg> Annetamine 
            </a>
            
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('addon_vehicles', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              <svg class="text-zinc-300 mr-2 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"></path>
              </svg> Eritellimused 
            </a>
            <a x-show="currentGame === 'gtav'" @click="sidebarOpen = false; setPageNew('status', '');" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              
            <svg class="text-zinc-300 mr-2 h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.4" d="M6.87988 18.1501V16.0801" stroke="#a5acb6" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.4" d="M12 18.1498V14.0098" stroke="#a5acb6" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.4" d="M17.1201 18.1502V11.9302" stroke="#a5acb6" stroke-width="1.5" stroke-linecap="round"></path> <g opacity="0.4"> <path d="M17.1199 5.84961L16.6599 6.38961C14.1099 9.36961 10.6899 11.4796 6.87988 12.4296" stroke="#a5acb6" stroke-width="1.5" stroke-linecap="round"></path> <path d="M14.1904 5.84961H17.1204V8.76961" stroke="#a5acb6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g> <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#a5acb6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
              Serveri Staatus 
            </a>
            <a x-show="currentGame === 'gtav'" href="fivem://connect/cfx.re/join/mg7j9v" class="text-zinc-300 hover:bg-sky-950 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded text-white">
              
              <svg class="text-zinc-300 mr-2 h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5155 15.7248C3.78702 15.7062 4.13391 15.7059 4.63158 15.7059H19.3684C19.8661 15.7059 20.213 15.7062 20.4845 15.7248C20.7513 15.7431 20.9067 15.7774 21.0253 15.8268C21.4122 15.988 21.7196 16.2972 21.8798 16.6863C21.9289 16.8056 21.963 16.9619 21.9812 17.2303C21.9997 17.5034 22 17.8523 22 18.3529C22 18.8535 21.9997 19.2025 21.9812 19.4756C21.963 19.744 21.9289 19.9002 21.8798 20.0196C21.7196 20.4087 21.4122 20.7179 21.0253 20.8791C20.9067 20.9285 20.7513 20.9628 20.4845 20.9811C20.213 20.9997 19.8661 21 19.3684 21H4.63158C4.13391 21 3.78702 20.9997 3.5155 20.9811C3.2487 20.9628 3.09333 20.9285 2.97471 20.8791C2.58782 20.7179 2.28044 20.4087 2.12019 20.0196C2.07105 19.9002 2.03701 19.744 2.01881 19.4756C2.00028 19.2025 2 18.8535 2 18.3529C2 17.8523 2.00028 17.5034 2.01881 17.2303C2.03701 16.9619 2.07105 16.8056 2.12019 16.6863C2.28044 16.2972 2.58782 15.988 2.97471 15.8268C3.09333 15.7774 3.2487 15.7431 3.5155 15.7248ZM4.63158 19.4118C5.21293 19.4118 5.68421 18.9377 5.68421 18.3529C5.68421 17.7682 5.21293 17.2941 4.63158 17.2941C4.05023 17.2941 3.57895 17.7682 3.57895 18.3529C3.57895 18.9377 4.05023 19.4118 4.63158 19.4118Z" fill="#e3e3e3"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M4.63158 8.29412C4.13391 8.29412 3.78702 8.29383 3.5155 8.2752C3.2487 8.25689 3.09333 8.22265 2.97471 8.17322C2.58782 8.01202 2.28044 7.70284 2.12019 7.31367C2.07105 7.19435 2.03701 7.03807 2.01881 6.7697C2.00028 6.49658 2 6.14765 2 5.64706C2 5.14647 2.00028 4.79753 2.01881 4.52441C2.03701 4.25605 2.07105 4.09977 2.12019 3.98044C2.28044 3.59128 2.58782 3.28209 2.97471 3.1209C3.09333 3.07147 3.2487 3.03723 3.5155 3.01892C3.78702 3.00029 4.13391 3 4.63158 3H19.3684C19.8661 3 20.213 3.00029 20.4845 3.01892C20.7513 3.03723 20.9067 3.07147 21.0253 3.1209C21.4122 3.28209 21.7196 3.59128 21.8798 3.98044C21.9289 4.09977 21.963 4.25605 21.9812 4.52441C21.9997 4.79753 22 5.14647 22 5.64706C22 6.14765 21.9997 6.49658 21.9812 6.7697C21.963 7.03807 21.9289 7.19435 21.8798 7.31367C21.7196 7.70284 21.4122 8.01202 21.0253 8.17322C20.9067 8.22265 20.7513 8.25689 20.4845 8.2752C20.213 8.29383 19.8661 8.29412 19.3684 8.29412H4.63158ZM4.63158 9.35294C4.13391 9.35294 3.78702 9.35323 3.5155 9.37186C3.2487 9.39017 3.09333 9.42441 2.97471 9.47384C2.58782 9.63503 2.28044 9.94422 2.12019 10.3334C2.07105 10.4527 2.03701 10.609 2.01881 10.8774C2.00028 11.1505 2 11.4994 2 12C2 12.5006 2.00028 12.8495 2.01881 13.1226C2.03701 13.391 2.07105 13.5473 2.12019 13.6666C2.28044 14.0558 2.58782 14.365 2.97471 14.5262C3.09333 14.5756 3.2487 14.6098 3.5155 14.6281C3.78702 14.6468 4.13391 14.6471 4.63158 14.6471H19.3684C19.8661 14.6471 20.213 14.6468 20.4845 14.6281C20.7513 14.6098 20.9067 14.5756 21.0253 14.5262C21.4122 14.365 21.7196 14.0558 21.8798 13.6666C21.9289 13.5473 21.963 13.391 21.9812 13.1226C21.9997 12.8495 22 12.5006 22 12C22 11.4994 21.9997 11.1505 21.9812 10.8774C21.963 10.609 21.9289 10.4527 21.8798 10.3334C21.7196 9.94422 21.4122 9.63503 21.0253 9.47384C20.9067 9.42441 20.7513 9.39017 20.4845 9.37186C20.213 9.35323 19.8661 9.35294 19.3684 9.35294H4.63158ZM5.68421 12C5.68421 12.5848 5.21293 13.0588 4.63158 13.0588C4.05023 13.0588 3.57895 12.5848 3.57895 12C3.57895 11.4152 4.05023 10.9412 4.63158 10.9412C5.21293 10.9412 5.68421 11.4152 5.68421 12ZM4.63158 6.70588C5.21293 6.70588 5.68421 6.23183 5.68421 5.64706C5.68421 5.06229 5.21293 4.58824 4.63158 4.58824C4.05023 4.58824 3.57895 5.06229 3.57895 5.64706C3.57895 6.23183 4.05023 6.70588 4.63158 6.70588Z" fill="#e3e3e3"></path> </g></svg>
              Serveriga liitumine 
            </a>
          </nav>
        </div>
        <div class="flex-shrink-0 flex bg-[#111824] p-4 relative">
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
    <main id="content" class="flex-1 relative z-0 overflow-y-auto focus:outline-none py-6 bg-[#111829]"></main>
    <div id="notify_container" class="absolute bottom-5 right-5 overflow-x-hidden overflow-y-hidden"></div>
    
  </div>
</div>


<div id="copyright" class="bg-[#111829] w-full text-center items-center text-white">© 2016 - <?php echo date('Y'); ?> WSRP - All Rights Reserved.</div>  
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


