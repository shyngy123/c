<?php
session_start();
include_once "bd.php";
//include_once "allfunction.php";
$useremail=$_POST['useremail'];
$userpassword=$_POST['userpassword'];


function check($useremail,$db){
 $sql = "SELECT `email` FROM `userss` WHERE `email` = :email";
 $statement = $db->prepare($sql);
 $statement->execute(['email' => $useremail]);
 $task = $statement->fetch(PDO::FETCH_ASSOC);
 if(!empty($task)) {
 $_SESSION['danger'] = false;
 $_SESSION['message']='уже есть такой логин!';
 header('Location: page_register.php');
 exit;
}
}
function add_user($useremail,$userpassword,$db){
  $sql = 'INSERT INTO userss(email,password,role) VALUES (:email,:password,:role)';
  $statment=$db->prepare($sql);
  $statment->execute(['email' => $useremail,'password'=>password_hash($userpassword,PASSWORD_DEFAULT),'role'=>'user']);

  $_SESSION['danger'] = true;
  $_SESSION['message']='регистрация успешна!';
  //var_dump($statment->errorinfo());
  header('Location: page_login.php');

}




check($useremail,$db);
add_user($useremail,$userpassword,$db);
















 ?>
