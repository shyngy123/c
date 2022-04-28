<?php
session_start();

//login fanction
if ( $_SESSION['message']=='Регистрация успешна!') {
  function chek_login($email){
    $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
    $sql = "SELECT*FROM `userss` WHERE `email` =?";
    $statement = $db->prepare($sql);
    $statement->execute([$email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return   $user;
  }
}

//registration fanction
function check_email($email){
  $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
  $sql = "SELECT `email` FROM `userss` WHERE `email` = :email";
  $statement = $db->prepare($sql);
  $statement->execute(['email' => $email]);
  $task = $statement->fetch(PDO::FETCH_ASSOC);
    return $task;
  }

function add_user($email,$password){
  $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
  $sql = 'INSERT INTO userss(email,password,role) VALUES (:email,:password,:role)';
  $statment=$db->prepare($sql);
  $statment->execute(['email' => $email,'password'=>password_hash($password,PASSWORD_DEFAULT),'role'=>'user']);
  $_SESSION['danger'] = true;
  $_SESSION['message']='регистрация успешна!';
  header('Location: page_login.php');
  exit;
}
//create user fanction
/*function check_email2($email){
  $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
  $sql = "SELECT `email` FROM `userss` WHERE `email` = :email";
  $statement = $db->prepare($sql);
  $statement->execute(['email' => $email]);
  $task = $statement->fetch(PDO::FETCH_ASSOC);
  if(!empty($task)) {
  $_SESSION['danger'] = false;
  $_SESSION['message']='уже есть такой логин!';
  header('Location: create_user.php');
  exit;
 }
}*/
function add_users($email,$password,$status,$name,$place,$number,$edit_pos,$insta,$vk,$telega){

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
                   'number' => $edit_num ,
                   'status' => $status,
                   'insta' => $insta,
                   'vk' => $vk,
                   'telega' => $telege,
                   'image' => $path
                   ]);

}
//stATUS user fanction
function get_status($id,$status){
    $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
  $sqll = "UPDATE userss SET status=? WHERE id=?";
  $querys = $db->prepare($sqll);
  $querys->execute([$status,$id]);

  if ($status=="online") {
  $_SESSION['STATUS']='success';
  }elseif ($status=="goout") {
  $_SESSION['STATUS']='warning';
  }elseif ($status=="bother") {
  $_SESSION['STATUS']='danger';
  }

}
//security
function security($email,$password,$confirmation ){
    $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');

  if ($confirmation==$password) {
    $sqll = "UPDATE userss SET email=?, password=?  WHERE id=?";
  	$querys = $db->prepare($sqll);
  	$querys->execute([$email, password_hash($password,PASSWORD_DEFAULT),$id]);
  }
  else {
    echo "string";
  }

}
//edit
function edit_users($edit_name ,$edit_last_name,$edit_pos,$edit_num,$get_id ){
 $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
		$sqll = "UPDATE userss SET name=?, workplace=?, address=?, number=? WHERE id=?";
		$querys = $db->prepare($sqll);
		$querys->execute([$edit_name, $edit_last_name, $edit_pos, $edit_num,$get_id]);



}
//PAGE PROF
function veiw_prof($ip){
    $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
    $sq = $db->prepare('SELECT*FROM userss WHERE id=:id ');
    $sq->execute([':id' =>$ip]);

      $dat = $sq->fetch(PDO::FETCH_ASSOC);
    return $dat;
}
//media
function view_media($id){
  $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
  $sql = $db->prepare('SELECT*FROM userss WHERE id=:id ');
  $sql->execute([':id' => $id]);
  $data = $sql->fetch(PDO::FETCH_ASSOC);
    return $data;
    }
function upload_media(){
  $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
     $uploadname=$_FILES['image']['tmp_name'];
     $path='uploads/'.uniqid().'.jpeg';
    move_uploaded_file($uploadname,$path);
     $sqll = "UPDATE userss SET image=? WHERE id=?";
        $querys = $db->prepare($sqll);
       $querys->execute([$path, $get_id]);
    }

    //users
//users
function get_user(){
  $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
  $sql = "SELECT `role` FROM `regis` WHERE `role` = :role";
  $statement = $db->prepare($sql);
  $statement->execute(['role' => 'admin']);
  $user = $statement->fetch(PDO::FETCH_ASSOC);
   return $user;

}
function view_all_user(){
  $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
 $data = $db->query("SELECT * FROM `userss`")->fetchall(PDO::FETCH_ASSOC);
   return $data;
}
function view_id_user($id){
      $db = new PDO('mysql:host=localhost;dbname=regis', 'root', '');
        $sq = $db->prepare('SELECT*FROM userss WHERE id=:id ');
        $sq->execute([':id' =>$id]);

          $dat = $sq->fetch(PDO::FETCH_ASSOC);
        return $dat;
    }













 ?>
