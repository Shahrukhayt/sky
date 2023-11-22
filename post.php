<?php
	$to_email = "shahrukh_athar@outlook.com";
	$from_email = $_POST["from_email"];
    $subject = $_POST["subject"];
    $body = $_POST["message"];
	$name = $_POST["name"];
 
mail($to_email, $subject, $body, $headers, $name);
header("Location: https://lentrax.com/");
?>