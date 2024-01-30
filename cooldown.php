<?php
include 'db.php';
include 'funcs.php';

session_start();
$ipaddr = $_SESSION['userData']['ip'];
function forevercooldown($userId) {
    $cooldownFile = 'cooldowns.json';
    $cooldowns = json_decode(file_get_contents($cooldownFile), true);

    if (!isset($cooldowns[$userId])) {
        return false;
    }

    $cooldownTime = 864000000; // 5 seconds
    $currentTime = time();
    $cooldownEnd = $cooldowns[$userId] + $cooldownTime;

    return $currentTime < $cooldownEnd;
}
// Check if a user cooldown is active
function isUserCooldownActive($userId) {
    $cooldownFile = 'cooldowns.json';
    $cooldowns = json_decode(file_get_contents($cooldownFile), true);

    if (!isset($cooldowns[$userId])) {
        return false;
    }

    $cooldownTime = 86400; // 5 seconds
    $currentTime = time();
    $cooldownEnd = $cooldowns[$userId] + $cooldownTime;

    return $currentTime < $cooldownEnd;
}

// Set the user cooldown
function setUserCooldown($userId) {
    $cooldownFile = 'cooldowns.json';
    $cooldowns = json_decode(file_get_contents($cooldownFile), true);
    $cooldowns[$userId] = time();
    file_put_contents($cooldownFile, json_encode($cooldowns));
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userIp = $ipaddr;
    $userLoggedIn = false; // Set this to true if user is logged in
    $userId = $userLoggedIn ? 'logged_in_user_id' : $userIp;
    
    if (!isUserCooldownActive($userId)) {
        // Process the answers here
        $correctAnswers = [
            'q1' => 'a3',
            'q2' => 'a6',
            'q3' => 'a8',
            'q4' => 'a11',
            'q5' => 'a15',
        ];

        $correctCount = 0;

        foreach ($correctAnswers as $questionId => $correctAnswer) {
            $userAnswer = $_POST[$questionId] ?? '';

            if ($userAnswer === $correctAnswer) {
                $correctCount++;
            }
        }

        if ($correctCount == 5) {
            $query = "UPDATE users SET wlstatus = 1 WHERE wlstatus = 0;";
            DB($con, $query);
            echo "<p class='text-green-500 text-center'>Sa läbisid testi nüüd saad alustada rollimänguga. HEAD ROLLIMÄNGU!</p>";
            echo "<p class='text-red-400 text-center'>NB! Sa ei saa enam testi teisel korral uuesti sooritada kuna teie andmed on juba jäädvustatud!</p>";
            forevercooldown($userId);

        }

        $totalQuestions = count($correctAnswers);
        $percentageCorrect = ($correctCount / $totalQuestions) * 100;

        // Display the result
        echo '<p class="text-lg font-semibold mb-2 text-center text-gray-50">Tulemused:</p>';
        echo "<p class='text-green-500 text-center'>$correctCount - $totalQuestions õiged ($percentageCorrect%)</p>";

        // Set user cooldown after processing
        setUserCooldown($userId);
    } else {
        // User Cooldown is active, inform the user
        echo '<p class="text-red-500 text-center">Tule 24 tunni jooksul tagasi!.</p>';
    }

}
?>
