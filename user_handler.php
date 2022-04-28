<?php
session_start();
require_once "bd.php";
//login fanction
$useremail=$_POST['useremail'];
$userpassword= $_POST['userpassword'];
function chek_login($useremail,$userpassword,$db){
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
chek_login($useremail,$userpassword,$db);


//registration fanction
$useremail=$_POST['useremail'];
$userpassword=$_POST['userpassword'];
function check_email($useremail,$db){
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
check_email($useremail,$db);
add_user($useremail,$userpassword,$db);
//create user fanction
function check_email(){
  $sql = "SELECT `email` FROM `userss` WHERE `email` = :email";
  $statement = $db->prepare($sql);
  $statement->execute(['email' => $useremail]);
  $task = $statement->fetch(PDO::FETCH_ASSOC);
  if(!empty($task)) {
  $_SESSION['danger'] = false;
  $_SESSION['message']='уже есть такой логин!';
  header('Location: create_user.php');
  exit;
 }
}
add();
function add_users(){
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
//stATUS user fanction
$get_id = $_GET['id'];
function get_status($db,$get_id){
  $status=$_POST['status'];
  $sqll = "UPDATE userss SET status=? WHERE id=?";
  $querys = $db->prepare($sqll);
  $querys->execute([$status,$get_id]);

  if ($status=="online") {
  $_SESSION['STATUS']='success';
  }elseif ($status=="goout") {
  $_SESSION['STATUS']='warning';
  }elseif ($status=="bother") {
  $_SESSION['STATUS']='danger';
  }

}
get_status($db,$get_id);
//security
function security($db){
  $id = $_GET['id'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmation = $_POST['confirmation'];
  if ($confirmation==$password) {
    $sqll = "UPDATE userss SET email=?, password=?  WHERE id=?";
  	$querys = $db->prepare($sqll);
  	$querys->execute([$email, password_hash($password,PASSWORD_DEFAULT),$id]);
  }
  else {
    echo "string";
  }

}
security($db)
//edit
function edit($db){

	$edit_name = $_POST['name'];
	$edit_last_name = $_POST['workplace'];
	$edit_pos = $_POST['address'];
	$edit_num = $_POST['num'];
	$get_id = $_GET['id'];

		$sqll = "UPDATE userss SET name=?, workplace=?, address=?, number=? WHERE id=?";
		$querys = $db->prepare($sqll);
		$querys->execute([$edit_name, $edit_last_name, $edit_pos, $edit_num,$get_id]);



}
edit($db);
//PAGE PROF
$id=$_SESSION['id'];
function u($id){
  $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
    $sq = $db->prepare('SELECT*FROM userss WHERE id=:id ');
    $sq->execute([':id' =>$id]);

      $dat = $sq->fetch(PDO::FETCH_ASSOC);
    return $dat;
}
$dat = u($id);
//media
$get_id = $_GET['id'];

function u($db,$get_id){
  $sql = $db->prepare('SELECT*FROM userss WHERE id=:id ');
  $sql->execute([':id' => $get_id]);
  $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    $data = u($db,$get_id);
function upload($db){
     $uploadname=$_FILES['image']['tmp_name'];
     $path='uploads/'.uniqid().'.jpeg';
    move_uploaded_file($uploadname,$path);
     $sqll = "UPDATE userss SET image=? WHERE id=?";
        $querys = $db->prepare($sqll);
       $querys->execute([$path, $get_id]);
    }
    upload($db);
    //users
    $id=$_SESSION['id'];
    function user($db){
      $sql = "SELECT `role` FROM `regis` WHERE `role` = :role";
      $statement = $db->prepare($sql);
      $statement->execute(['role' => 'admin']);
      $user = $statement->fetch(PDO::FETCH_ASSOC);
       return $user;

    }
    function  b( $db ){
     $data = $db->query("SELECT * FROM `userss`")->fetchall(PDO::FETCH_ASSOC);
       return $data;
    }
    function u($id){
             $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
            $sq = $db->prepare('SELECT*FROM userss WHERE id=:id ');
            $sq->execute([':id' =>$id]);

              $dat = $sq->fetch(PDO::FETCH_ASSOC);
            return $dat;
        }
    $data=b( $db );
    $dat = u($id);
    user($db);
//users
$id=$_SESSION['id'];
function user($db){
  $sql = "SELECT `role` FROM `regis` WHERE `role` = :role";
  $statement = $db->prepare($sql);
  $statement->execute(['role' => 'admin']);
  $user = $statement->fetch(PDO::FETCH_ASSOC);
   return $user;

}
function  b( $db ){
 $data = $db->query("SELECT * FROM `userss`")->fetchall(PDO::FETCH_ASSOC);
   return $data;
}
function u($id){
      $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
        $sq = $db->prepare('SELECT*FROM userss WHERE id=:id ');
        $sq->execute([':id' =>$id]);

          $dat = $sq->fetch(PDO::FETCH_ASSOC);
        return $dat;
    }

$data=b( $db );
$dat = u($id);
user($db);



 ?>
