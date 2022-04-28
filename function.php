<?php
session_start();
include 'register.php';
$id = $_GET['id'];
$ip=$_SESSION['id'];
//variable
$email=$_POST['email'];
$password= $_POST['password'];



$confirmation = $_POST['confirmation'];
$edit_name = $_POST['name'];
$edit_last_name = $_POST['workplace'];
$edit_pos = $_POST['address'];
$edit_num = $_POST['number'];
$status=$_POST['status'];
$name=$_POST['name'];
$place=$_POST['place'];
$insta=$_POST['insta'];
$vk=$_POST['vk'];
$telega=$_POST['telega'];

//login fanction

//call function
//regis
check_email($email);

if(!empty(check_email($email))) {
  $_SESSION['danger'] = false;
  $_SESSION['message']='уже есть такой логин!';
  header('Location: page_register.php');
  exit;
  }else {
    
 $_SESSION['message']='Регистрация успешна!';
 header('Location: page_login.php');
}


add_user($email,$password);

//login
chek_login($emaill);
if($user && password_verify($passwordd, $user['password']) ) {
    $_SESSION['danger'] = 'success';
    $_SESSION['message'] = 'Успешная авторизация!';
    $_SESSION['id']=$user['id'];
    $_SESSION['auth'] ='user';
    $_SESSION['status'] = $user['role'];
    header('Location: users.php');
    exit;
 }else{
    $_SESSION['danger'] = "danger";
    $_SESSION['message'] = 'Не правильный пароль или логин!';
   header('Location: page_login.php');
    exit;
}
//users
/*
$data=view_all_user( );
$dat = view_id_user($id);
get_user();
//create_user
//check_email2($email);
add_users($email,$password,$status,$name,$place,$number,$edit_pos,$insta,$vk,$telega);
//security
security($email,$password,$confirmation);
//edit
edit_users($edit_name ,$edit_last_name,$edit_pos,$edit_num,$get_id );
//pageprof
$dat = veiw_prof($ip);

//media
 $data =view_media();
 upload_media();
 //status
 get_status($id,$status);
 ?>
