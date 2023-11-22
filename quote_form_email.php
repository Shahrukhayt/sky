<?php

    // include('EMAIL/PHPMailer-master/src/Exception.php');
    // include('EMAIL/PHPMailer-master/src/PHPMailer.php');
    // include('EMAIL/PHPMailer-master/src/SMTP.php');
    
    
    use phpmailer\phpmailer\PHPMailer;
    use phpmailer\phpmailer\SMTP;
    use phpmailer\phpmailer\Exception;
    
    require 'vendor/autoload.php'


    if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["msg"])) {
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $msg = $_POST['msg'];
        
       
        $mail = new PHPMailer(true);
        echo 1; 
    }




?>