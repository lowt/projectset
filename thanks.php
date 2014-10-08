<?php  header('Content-type: text/html; charset=utf-8'); ?>
<?php
$name=$_POST["name"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$deliv_address=$_POST["deliv_address"];
$price = $_POST["price"];
$bag = $_POST["bag"];
$flash = $_POST["flash"];
$comment=$_POST["comment"];
$prod = $_POST["product"];
$message="From ".$name." Product ".$prod.". Email: ".$email.". Phone: ".$phone.". Delivery address ".$deliv_address." Comment ".$comment." Aksessuary ".$flash." and ".$bag." Price ".$price;

$to  = "photods@bk.ru" ; 
$subject = "Moving to ".$phone; 
mail($to, $subject, $message, "Content-Type: text/html; charset=UTF-8");
header('Location: index.php?option=com_content&view=article&id=26&phone='.$phone.'');
?>
