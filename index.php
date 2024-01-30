<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" type="image/x-icon" href="/images/logo.png">
  <script src="https://cdn.jsdelivr.net/npm/javascript-obfuscator@4.1.0/dist/index.browser.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body class="bg-cover bg-center bg-no-repeat" style="background-image: url('images/background1.png')">
    <div class="flex items-center justify-center h-screen bg-gray-600/10 text-white">
        <button id="loginButton" onclick="loadlogin()" class="text-center items-center bg-gray-900 py-2 px-4 w-72 rounded text-white hover:bg-gray-700 hover:cursor-pointer">
            <i id="steamIcon" class="fab fa-steam text-2xl"></i>
            <span id="loginText">Logi Sisse</span>
            <span id="loadingIndicator" class="hidden ml-2 animate-spin">&#9696;</span>
        </button>
    </div>
	<div id="notify_container" class="absolute bottom-5 right-5 overflow-x-hidden overflow-y-hidden"></div>
</body>
<script src="js/custom.js" type="text/javascript"></script>
</html>
