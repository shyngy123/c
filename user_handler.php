<?php
session_start();
require_once "bd.php";
//login fanction
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


//registration fanction
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

//create user fanction
function add(){
  $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
  $sql = "SELECT `email` FROM `userss` WHERE `email` = :email";
   $statement = $db->prepare($sql);
   $statement->execute(['email' => $email]);
   $task = $statement->fetch(PDO::FETCH_ASSOC);
   if($task) {
   $_SESSION['message']='уже есть такой логин!';
    header('Location: create_user.php');
    return false;
     }else {
       return true;
       }
}
add();
function addd(){
  if (add()) {


  $email=$_POST['email'];
  $password=$_POST['password'];
  $status=$_POST['status'];
  $name=$_POST['name'];
  $place=$_POST['place'];
  $number=$_POST['number'];
  $address=$_POST['address'];
  $insta=$_POST['insta'];
  $vk=$_POST['vk'];
  $telega=$_POST['telega'];
  $uploadname=$_FILES['image']['tmp_name'];
  $path='uploads/'.uniqid().'.jpeg';
  move_uploaded_file($uploadname,$path);
  $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
  $sql = "INSERT INTO userss (email,password,role,name,address,workplace,number,status,insta,vk,telega,image) VALUES (:email,:password,:role,:name,:address,:workplace,:number,:status,:insta,:vk,:telega,:image) ";
  $statment=$db->prepare($sql);
  $statment->execute([
                   'email' => $email,
                  'password'=>password_hash($password,PASSWORD_DEFAULT),
                   'role'=>'user',
                   'name' => $name,
                   'address' => $address,
                   'workplace' => $place,
                   'number' => $number,
                   'status' => $status,
                   'insta' => $insta,
                   'vk' => $vk,
                   'telega' => $telege,
                   'image' => $path
                   ]);
}
}
addd();
















//function add_user($db,$email,$password,$status,$path,$id){

   $sql = "INSERT INTO userss (email,password,role,status,image) VALUES (:email,:password,:role,:status,:image) WHERE id = :id ";
   $statment=$db->prepare($sql);
   $statment->execute([
                      'email' => $email,
                      'password'=>password_hash($password,PASSWORD_DEFAULT),
                      'role'=>'user',
                      'status' => $status,
                      'image' => $path,
                      'id' => $id,
                      ]);

 }








 ?>
