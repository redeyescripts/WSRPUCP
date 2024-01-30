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
$query2 = "SELECT wlstatus FROM users WHERE steamhex ='$steam'";
$result = mysqli_query($con, $query2);
$status = 0;
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $status = $row["wlstatus"];
    }
} 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form data and generate a response
    $response = array();
  
    // Define correct answers
    $correctAnswers = array(
        'q1' => array('a1'),
        'q2' => array('a6'),
        'q3' => array('a8'),
        'q4' => array('a10'),
        'q5' => array('a13')
    );
  
    // Validate each question
    foreach ($correctAnswers as $question => $correctOptions) {
        if (!isset($_POST[$question]) || !is_array($_POST[$question]) || count($_POST[$question]) === 0) {
            $response['status'] = 'error';
            $response['faults'][$question] = 'Please answer this question.';
        } else {
            // Check if selected options are correct
            $selectedOptions = $_POST[$question];
            if (array_diff($selectedOptions, $correctOptions) || array_diff($correctOptions, $selectedOptions)) {
                $response['status'] = 'error';
                $response['faults'][$question] = 'Incorrect answer for this question.';
            }
        }
    }
  
    // Your additional validation logic goes here...
  
    // If all validations pass, send success response
    if (!isset($response['status'])) {
        $response['status'] = 'success';
    }
  
    sendResponse($response);
  }
  
  function sendResponse($response) {
    header('Content-Type: application/json');
    echo json_encode($response);
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
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
    <title>WSRP</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2"></script>
    <!--<script src="js/script.js" type="text/javascript"></script>-->
    
    
</head>
<body>
    
<div class="px-4">
    <p class="text-2xl font-bold mb-4 text-center text-white underline">WHITELISTI TEGEMINE</p>
    <p class="text-xs font-bold mb-4 text-center text-red-500">NB! Whitelisti saad teha iga 24 tunni jooksul</p>
    <p class="text-xl font-bold mb-4 text-center text-red-500">WHITELISTI SAATMINE ON HETKEL ARENDUSES!</p>
    <form id="questionForm" class="space-y-4 text-black text-xs ml-8 md:ml-6">
        <!-- Question 1 -->
        <div class="mb-4 bg-white text-black rounded-sm">
            <label class="block text-xl font-medium">1: Mida tähendab VDM ning kas see on siin serveris lubatud?</label>
            <div class="space-y-2">
                <input type="checkbox" id="vdm1" name="q1" value="a1" class="mr-2">
                <label for="q1" class="text-sm">Tähendab seda et sa võid teha kõike mida õeldakse</label><br>
                <input type="checkbox" id="vdm2" name="q1" value="a2" class="mr-2">
                <label for="q2" class="text-sm">Võid serverit DDOSida</label><br>
                <input type="checkbox" id="vdm3" name="q1" value="a3" class="mr-2">
                <label for="q3" class="text-sm">See on enda valikuline kas sõidad mendist üle või jätad järele ning see on õigemini rangelt keelatud</label><br>
            </div>
        </div>

        <!-- Question 2 -->
        <div class="mb-4 bg-white text-black rounded-sm">
            <label class="block text-xl font-medium">2: Mida sa teeksid kui sind tühjendatakse mõtte olekul?</label>
            <div class="space-y-2">
                <input type="checkbox" id="rob1" name="q2" value="a4" class="mr-2">
                <label for="q4" class="text-sm">Lasen tal asju võtta</label><br>
                <input type="checkbox" id="rob2" name="q2" value="a5" class="mr-2">
                <label for="q5" class="text-sm">Ei tee välja</label><br>
                <input type="checkbox" id="rob3" name="q2" value="a6" class="mr-2">
                <label for="q6" class="text-sm">Edastan kaebuse mis sisaldab antud isiku andmeid nagu ID ja NIMI</label><br>
            </div>
        </div>

        <div class="mb-4 bg-white text-black rounded-sm">
            <label class="block text-xl font-medium">3: Mida tähendab COPBAIT?</label>
            <div class="space-y-2">
                <input type="checkbox" id="bait1" name="q3" value="a7" class="mr-2">
                <label for="q7" class="text-sm">Igapäevane tegevus kus mma sõiman politseinikuid</label><br>
                <input type="checkbox" id="bait2" name="q3" value="a8" class="mr-2">
                <label for="q8" class="text-sm">Rikkun ametnikude töö tegevusi ning sõiman ametnike täierauaga kasutades sõidukit</label><br>
                <input type="checkbox" id="bait3" name="q3" value="a9" class="mr-2">
                <label for="q9" class="text-sm">Politsei jaoskonnas passimine iga jumala päev</label><br>
            </div>
        </div>

        <div class="mb-4 bg-white text-black rounded-sm">
            <label class="block text-xl font-medium">4: Kas sa tohid combatlogida keset rollimängu tegevust?</label>
            <div class="space-y-2">
                
                <input type="checkbox" id="cl1" name="q4" value="a10" class="mr-2">
                <label for="q10" class="text-sm">Jah ma tohin sest mul on kiire</label><br>
                <input type="checkbox" id="cl2" name="q4" value="a11" class="mr-2">
                <label for="q11" class="text-sm">Kindlasti võin kui tegemist pole süsteemi veaga</label><br>
                <input type="checkbox" id="cl3" name="q4" value="a12" class="mr-2">
                <label for="q12" class="text-sm">Võin seda teha igahetk kui soov</label><br>
            </div>
        </div>

        <div class="mb-4 bg-white text-black rounded-sm">
            <label class="block text-xl font-medium">5: Kas serveris modimine on lubatud?</label>
            <div class="space-y-2">
                
                <input type="checkbox" id="mod1" name="q5" value="a13" class="mr-2">
                <label for="q13" class="text-sm">Hahahah mul jumala pohhui</label><br>

                <input type="checkbox" id="mod2" name="q5" value="a14" class="mr-2">
                <label for="q14" class="text-sm">Niigi mingi lamp server ikkagi kasutan</label><br>

                <input type="checkbox" id="mod3" name="q5" value="a15" class="mr-2">
                <label for="q15" class="text-sm">Oleks tore kui ei kasutaks</label><br>

                <input type="checkbox" id="mod4" name="q5" value="a16" class="mr-2">
                <label for="q16" class="text-sm">Võin seda teha igahetk kui soov</label><br>

            </div>
        </div>

        <button id="submitAnswers" onclick="saada()" class="w-full bg-slate-700 hover:bg-cyan-700 text-white p-2 rounded">Kontrolli vastuseid</button>
    </form>

    <div id="result" class="mt-4"></div>

    <div id="status" class="mt-4">
        <?php   
            if ($status == "1") {
                echo "<p class='text-green-500 text-center'>Sinu whitelisti taotlus on '$status' ehk ligipääs lubatud</p>";
            } elseif (!$status == "1") {
                echo "<p class='text-white text-center'>Proovi uuesti vastata mida sa saad teha ainult iga 24h tagant kui sinu vastuste tulemus on vale!</p>";
            }


        
        
        ?>


    </div>
            

       
    
    <div id="notify_container" class="absolute bottom-5 right-5 overflow-x-hidden overflow-y-hidden"></div>     
</div>


</body>



</html>


<script>
    function saada() {
        var formData = $("#questionForm").serialize();

        $.ajax({
            url: "/pages/whitelist.php",
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
    setPageNew = function(page, params) {
        var contentContainer = document.getElementById('content');
        contentContainer.innerHTML = ''; // Clear existing content
    
        // Use AJAX to load content from an external file
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                contentContainer.innerHTML = xhr.responseText;
            } else if (xhr.readyState == 4 && xhr.status != 200) {
                console.error("Error loading page: " + xhr.status + " " + xhr.statusText);
                // Handle error, display a message, or redirect to an error page
            }
        };
        xhr.open('GET', 'pages/' + page + '.php' + params, true);
        xhr.send();
    }
</script>



