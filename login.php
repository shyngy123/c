<?php
session_start();
require_once "bd.php";

$useremail=$_POST['useremail'];
$userpassword= $_POST['userpassword'];

function chek($useremail,$userpassword,$db){
  $sql = "SELECT*FROM `userss` WHERE `email` =?";
  $statement = $db->prepare($sql);
  $statement->execute([$useremail]);
  $user = $statement->fetch(PDO::FETCH_ASSOC);

     if($user && password_verify($userpassword, $user['password']) ) {

         $_SESSION['message'] = 'success';
         $_SESSION['id']=$user['id'];
         $_SESSION['auth'] ='user';
         $_SESSION['status'] = $user['role'];

         header('Location: users.php');
         exit;
     }else{
         $message = "Не правильный пароль или логин!";
         $_SESSION['message'] = 'danger';
         header('Location: page_login.php');
     }


}

chek($useremail,$userpassword,$db);















 ?>
