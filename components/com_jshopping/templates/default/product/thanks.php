<?php
$login=$_POST["name"];
$mail=$_POST["email"];
$phone=$_POST["phone"];
$addr=$_POST["deliv_address"];
$comment=$_POST["comment"];
$prod=$_POST["product"];

$email="From ".$login.". Email: ".$mail.". Phone: ".$phone.". Product: ".$prod.". Comment: ".$comment.". Adres dostavki: ".$addr;

$to  = "ih@soft-enot.com" ; 
$subject = "Moving to ".$mail; 
mail($to, $subject, $email);
?>