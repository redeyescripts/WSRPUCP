<?php 
    // Import PHPMailer classes into the global namespace // These must be at the top of your script, not inside a function 
    use PHPMailer\PHPMailer\PHPMailer; 
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php'; 
    require 'PHPMailer/src/PHPMailer.php'; 
    require 'PHPMailer/src/SMTP.php';



    function sendmail($address, $subject, $body, $username) {
        $mail = new PHPMailer(true); // Passing `true` enables exceptions 
        try { 
        //Server settings 
            $mail->SMTPDebug = -1; // Enable verbose debug output 
            $mail->isSMTP(); // Set mailer to use SMTP 
            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers 
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username   = "pals.sten@gmail.com";
            $mail->Password   = "ejfh qcma ohfh yhpv";
            $mail->SMTPSecure = 'tls'; // Enable SSL encryption, TLS also accepted with port 465 
            $mail->Port = 587; // TCP port to connect to 

            //Recipients 
            $mail->setFrom($address, $username); //This is the email your form sends From 
            $mail->addAddress($address, $username); // Add a recipient address 
            //Content 
            $mail->isHTML(true); // Set email format to HTML 
            $mail->Subject = $subject;
            $mail->Body = $body; 

            $mail->send(); 
            echo '<script>alert("Meil saadetud!")</script>';
        } catch (Exception $e) { 
            /*echo 'Mailer Error: ' . $mail->ErrorInfo; */
            echo '<script>alert("Meili ei saadetud!")</script>';
        } 
    }

    
?>