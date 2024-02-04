<?php
include './../db.php';
include './../funcs.php';

session_start();
if(!$_SESSION['logged_in']){
    echo '<script>alert("Nah!")</script>'; 
    header("Location: ./../logout.php");
    exit();
}
$cooldown = $_SESSION['userData']['cooldown'];
$wl = $_SESSION['userData']['wlstatus'];
$userpoints = $_SESSION['userData']['points'];
$username = $_SESSION['userData']['name'];
$avatar = $_SESSION['userData']['avatar'];
$steamhex = $_SESSION['userData']['steam_id'];
$ipaddr = $_SESSION['userData']['ip'];
$hex = base_convert($steamhex, 10, 16);
$steam = "steam:$hex";
$query3 = "SELECT wlstatus FROM users WHERE steamhex ='$steam'";
$result2 = mysqli_query($con, $query3);
if (mysqli_num_rows($result2) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result2)) {
    $wlstatus = $row["wlstatus"];
    $wl = $row["wlstatus"];
  }
} 

$query2 = "SELECT punktid FROM users WHERE steamhex ='$steam'";
$result = mysqli_query($con, $query2);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $userpoints = $row["punktid"];
    }
} 


// Set the cooldown period in seconds (e.g., 300 seconds = 5 minutes)
$cooldownPeriod = 86400;

// Function to get the user's IP address
function getUserIP()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    return $ip;
}

// Function to get or create the cooldown JSON file
function getCooldownFile()
{
    $cooldownFile = 'cooldown.json';
    if (!file_exists($cooldownFile)) {
        file_put_contents($cooldownFile, json_encode(array()));
    }
    return $cooldownFile;
}

// Response array to be sent back to the client
$response = array();

// Define correct answers for each question
$correctAnswers = array(
    '24' => array('24_3'),
    '31' => array('31_4'),
    '17' => array('17_2'),
    '10' => array('10_4'),
    '13' => array('13_2'),
    '30' => array('30_3'),
    '2' => array('2_3'),
    '26' => array('26_4')
);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userIP = getUserIP();
    $cooldownFile = getCooldownFile();

    // Read the cooldown data from the JSON file
    $cooldownData = json_decode(file_get_contents($cooldownFile), true);

    // Check if the cooldown period has passed for the user's IP
    if (!isset($cooldownData[$userIP]) || (time() - $cooldownData[$userIP]) > $cooldownPeriod) {
        // Update the last submission time for the user's IP
        $cooldownData[$userIP] = time();
        file_put_contents($cooldownFile, json_encode($cooldownData));

        // Initialize an array to store answers for each question
        $allAnswers = array();

        // Iterate through each question in the form
        $questions = array('24', '31', '17', '10', '13', '30', '2', '26');

        foreach ($questions as $question) {
            // Check if checkboxes for the current question are set
            if (isset($_POST[$question . '_answer_0']) || isset($_POST[$question . '_answer_1']) || isset($_POST[$question . '_answer_2']) || isset($_POST[$question . '_answer_3'])) {
                $answers = array();

                // Check and store each checkbox value for the current question
                if (isset($_POST[$question . '_answer_0'])) {
                    $answers[] = $_POST[$question . '_answer_0'];
                }
                if (isset($_POST[$question . '_answer_1'])) {
                    $answers[] = $_POST[$question . '_answer_1'];
                }
                if (isset($_POST[$question . '_answer_2'])) {
                    $answers[] = $_POST[$question . '_answer_2'];
                }
                if (isset($_POST[$question . '_answer_3'])) {
                    $answers[] = $_POST[$question . '_answer_3'];
                }

                // Store answers for the current question
                $allAnswers[$question] = $answers;
            }
        }

        // Process answers and check correctness
        $correct = $wrong = array();

        foreach ($correctAnswers as $question => $correctAnswer) {
            if (isset($allAnswers[$question])) {
                // Check if user's answers match the correct answers
                if (array_diff($allAnswers[$question], $correctAnswer) === array_diff($correctAnswer, $allAnswers[$question])) {
                    $correct[] = $question;
                } else {
                    $wrong[] = $question;
                }
            } else {
                $wrong[] = $question; // User didn't answer this question
            }
        }

        // Add correctness information to the response
        $response['allcorrect'] = false;
        $response['status'] = true;
        $response['message'] = "Kõik vastused on õiged!";
        $response['correct'] = $correct;
        $response['wrong'] = $wrong;

        
    } else {
        // Display a message if the cooldown period is still active for the user's IP
        $response['invalid'] = 'false';
        $response['message'] = "Puhka rahus.";
    }

    if (empty($wrong)) {
        // All answers are correct, perform your action here

        $response['allcorrect'] = true;
        $response['message'] = "Kõik vastused olid õiged";
        $response['action_result'] = "All answers are correct. Performing the action...";
        echo "<p class='text-green-500 text-center'>Hea töö sinu whitelist on läbitud</p>";
        $sql = "UPDATE users SET wlstatus='true' WHERE steamhex='$steam' AND wlstatus='false';";
        DB($con, $sql);
        PointsAdd($con, $hex, "1000");
        echo '<script>showNotification("Said punkte juurde!", "success");</script>';
        // Add a flag to indicate that all answers are correct

        if(WLIDCheck($con, $steam) !== false){
            echo '<script>showNotification("Sinu andmed on juba olemas!", "success");</script>';
        } else {

            $sql2 = "INSERT INTO player_whitelists (identifier) VALUES ('$steam')";
            DB($con, $sql2);
        
        }
        $_SESSION['userData']['cooldown'] = true;
      
        
    } else {
        // Display a message if there are incorrect answers
        $response['status'] = false;
        $response['message'] = "Puhka rahus!";
    
        // Add a flag to indicate that not all answers are correct
        $response['allcorrect'] = false;
    }

    // Send the JSON response back to the client
    header('Content-Type: application/json');
    echo json_encode($response);

    exit();
    
}
?>


