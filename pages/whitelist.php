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
$wl = $_SESSION['userData']['wlstatus'];
$username = $_SESSION['userData']['name'];
$avatar = $_SESSION['userData']['avatar'];
$steamhex = $_SESSION['userData']['steam_id'];
$ipaddr = $_SESSION['userData']['ip'];
$hex = base_convert($steamhex, 10, 16);
$steam = "steam:$hex";
$query2 = "SELECT wlstatus FROM users WHERE steamhex ='$steam'";
$result = mysqli_query($con, $query2);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $wl = $row["wlstatus"];
      $_SESSION['userData']['wlstatus'] = $row["wlstatus"];
    }
} 



?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth"> 
<head>

	<script src="https://cdn.jsdelivr.net/npm/javascript-obfuscator@4.1.0/dist/index.browser.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>   
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
    <title>WSRP</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script src="js/custom.js" type="text/javascript"></script>
    
</head>
<body>
    
<div class="px-4">
    <p class="text-2xl font-bold mb-4 text-center text-white underline">WHITELISTI TEGEMINE</p>
    <p class="text-xs font-bold mb-4 text-center text-red-500">NB! Whitelisti saad teha iga 24 tunni jooksul</p>
    <form id="whitelist_form" method="" class="text-center md:text-center items-center md:items-center">
        <div class="bg-white rounded-xl mb-4">
            <label class="text-xl underline">1. Mida teeksid järgnevalt kui näeksid et mängija tegeleb serveris kahtlustavate tegevustega nt (MODimine, VDM, RDM, COPBAIT, EMV)</label>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="24_answer_0" name="24_answer_0" value="24_1">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="24_answer_0"> Okei mis siis sellest</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="24_answer_1" name="24_answer_1" value="24_2">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="24_answer_1"> Võtan ja liitun ning elan kaasa</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="24_answer_2" name="24_answer_2" value="24_3">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="24_answer_2"> Leian lahenduse ning kaeban meeskonnale</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="24_answer_3" name="24_answer_3" value="24_4">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="24_answer_3"> Jätan selle tegevuse nende arutleda</label>
            </div>
        </div>
        <div class="bg-white rounded-xl mb-4">
            <label class="text-xl underline">2. VDM tähendab seda et</label>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="31_answer_0" name="31_answer_0" value="31_1">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="31_answer_0"> võin inimesi tühjendada</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="31_answer_1" name="31_answer_1" value="31_2">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="31_answer_1"> serveri kahjustamine on lubatud</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="31_answer_2" name="31_answer_2" value="31_3">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="31_answer_2"> tegemist on hea tahtliku tegevusega</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="31_answer_3" name="31_answer_3" value="31_4">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="31_answer_3"> ükskõik kes või mis sõidab autoga inimeste grupeeringust üle ning seab ohtu nende elu üle ning see on keelustatud rangelt!</label>
            </div>
        </div>
        <div class="bg-white rounded-xl mb-4">
            <label class="text-xl underline">3. Mis tähendab rollimängu osavõtt?</label>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="17_answer_0" name="17_answer_0" value="17_1">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="17_answer_0"> Seda et inimene mängib päriselu järgi</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="17_answer_1" name="17_answer_1" value="17_2">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="17_answer_1"> Seda et sa võtad rollimängust osa nagu päriselu ihaldab</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="17_answer_2" name="17_answer_2" value="17_3">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="17_answer_2"> Tähendab seda et sa teed freeroami</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="17_answer_3" name="17_answer_3" value="17_4">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="17_answer_3"> Osaled rollimängus kaasa</label>
            </div>
        </div>
        <div class="bg-white rounded-xl mb-4">
            <label class="text-xl underline">4. Mida teeksite kui teid tühjendab isik mõtte olekul?</label>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="10_answer_0" name="10_answer_0" value="10_1">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="10_answer_0"> Ei tee välja</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="10_answer_1" name="10_answer_1" value="10_2">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="10_answer_1"> Mõtlen ümber ning kaeban lähedale olevale isikule</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="10_answer_2" name="10_answer_2" value="10_3">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="10_answer_2"> Ei saa midagi teha kuna puudub informatsioon</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="10_answer_3" name="10_answer_3" value="10_4">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="10_answer_3"> Kaeban sellest meeskonnale</label>
            </div>
        </div>
        <div class="bg-white rounded-xl mb-4">
            <label class="text-xl underline">5. Mis käsuga ma alustan kaebuse tegemist?</label>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="13_answer_0" name="13_answer_0" value="13_1">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="13_answer_0"> /kaeban [pealkiri] [info]</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="13_answer_1" name="13_answer_1" value="13_2">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="13_answer_1"> Kasutan /kaebus</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="13_answer_2" name="13_answer_2" value="13_3">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="13_answer_2"> /me kaeban inimene tegi tühjaks</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="13_answer_3" name="13_answer_3" value="13_4">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="13_answer_3"> /help ja loon kaebuse</label>
            </div>
        </div>
        <div class="bg-white rounded-xl mb-4">
            <label class="text-xl underline">6. Mitu inimest võib röövil osavõtta ning keda pead valima pantvangiks?</label>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="30_answer_0" name="30_answer_0" value="30_1">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="30_answer_0"> Osaleda võib 3 inimest ja kõik enda sõbrad</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="30_answer_1" name="30_answer_1" value="30_2">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="30_answer_1"> Pantvangiks võib olla 2 isikut ning need ei tohi olla sõbrad kokku võib olla 4-5 isikut</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="30_answer_2" name="30_answer_2" value="30_3">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="30_answer_2"> Pantvangiks võib olla 2 inimest ja kaaslasteks peavad olema suvalised inimesed ning kokku peab olema 6 röövlit</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="30_answer_3" name="30_answer_3" value="30_4">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="30_answer_3"> Pantvangiks võivad olla 1 inimene ning kaaslaseks 1 sõber kokku võib olla 3 inimest</label>
            </div>
        </div>
        <div class="bg-white rounded-xl mb-4">
            <label class="text-xl underline">7. Kes serveris võib otseülekannet teha?</label>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="2_answer_0" name="2_answer_0" value="2_1">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="2_answer_0"> Inimene kellel on kuulsust</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="2_answer_1" name="2_answer_1" value="2_2">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="2_answer_1"> Inimene kes oskab teha</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="2_answer_2" name="2_answer_2" value="2_3">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="2_answer_2"> Inimene kellel on roll otseülekande jaoks</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="2_answer_3" name="2_answer_3" value="2_4">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="2_answer_3"> Ainult meeskond</label>
            </div>
        </div>
        <div class="bg-white rounded-xl mb-4">
            <label class="text-xl underline">8. Kas COMBATLOG on põhjus selleks et rollimängu osasalemisest loobuda või vältida seda et keegi ei saaks sinu asju varastada?</label>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="26_answer_0" name="26_answer_0" value="26_1">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="26_answer_0"> COMBATLOG on just eelnevalt mainitud tähendus</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="26_answer_1" name="26_answer_1" value="26_2">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="26_answer_1"> COMBATLOG tähendab seda et sa väljud riigist</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="26_answer_2" name="26_answer_2" value="26_3">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="26_answer_2"> Seda võib teha mis eales olukord seda lubab</label>
            </div>
            <div class="flex items-center gap-1 py-1 justify-center md:justify-start">
                <input class="w-4 h-4 text-sky-500 rounded" type="checkbox" id="26_answer_3" name="26_answer_3" value="26_4">
                <label class="ml-1 text-sm font-medium text-zinc-700" for="26_answer_3"> Mitte ükski asi pole sellega seotud</label>
            </div>
        </div>
        
    </form>
    <button id="submit_whitelist" onclick="handleAjax()" class="mt-1 w-auto ml-[42%] md:ml-[48%] px-2 py-2 shadow bg-green-700 hover:bg-green-800 text-white rounded">Kontrolli</button>
    


    <div id="status" class="mt-4">
        <?php   
            if ($wl == "true") {
                echo "<p class='text-green-500 text-center'>Sinu whitelisti taotlus on LUBATUD</p>";
            } 
            if ($wl == "false") {
                echo "<p class='text-red-300 text-center'>Sa pole vastanud või sinu vastused olid valed!</p>";
            }


        
        
        ?>


    </div>
            

       
    
    <div id="notification-container" class="fixed top-0 right-0 m-4"></div>    
</div>


</body>



</html>