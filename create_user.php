<?php


session_start();
/*
$email=$_POST['email'];
function add($db,$email){
  $sql = "SELECT `email` FROM `userss` WHERE `email` = :email";
  $statement = $db->prepare($sql);
  $statement->execute(['email' => $email]);
  $task = $statement->fetch(PDO::FETCH_ASSOC);
  if(!empty($task)) {
  return false;
}else {
  return true;
}
}
add($db,$email);



function addd($email){
  if (add($db,$email)) {
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
addd($db,$email);
*/
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="description" content="Chartist.html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
    <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-regular.css">
</head>
<body>
  <?php var_dump($task) ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-primary-gradient">
        <a class="navbar-brand d-flex align-items-center fw-500" href="users.html"><img alt="logo" class="d-inline-block align-top mr-2" src="img/logo.png"> ?????????????? ????????????</a> <button aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarColor02" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="users.php">?????????????? <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="page_login.php">??????????</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">??????????</a>
                </li>
            </ul>
        </div>
    </nav>
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-plus-circle'></i> ???????????????? ????????????????????????
            </h1>
        </div>
        <form action="function.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>?????????? ????????????????????</h2>
                            </div>
                            <div class="panel-content">
                                <!-- username -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">??????</label>
                                    <input type="text" name="name" id="simpleinput" class="form-control">
                                </div>

                                <!-- title -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">?????????? ????????????</label>
                                    <input type="text" name="place" id="simpleinput" class="form-control">
                                </div>

                                <!-- tel -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">?????????? ????????????????</label>
                                    <input type="text" name='number' id="simpleinput" class="form-control">
                                </div>

                                <!-- address -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">??????????</label>
                                    <input type="text" id="simpleinput"  name='address' class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>???????????????????????? ?? ??????????</h2>
                            </div>
                            <div class="panel-content">
                                <!-- email -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">Email</label>
                                    <input type="text" name="email" id="simpleinput" class="form-control">
                                </div>

                                <!-- password -->
                                <div class="form-group">
                                    <label class="form-label" for="simpleinput">????????????</label>
                                    <input type="password" name="password" id="simpleinput" class="form-control">
                                </div>


                                <!-- status -->
                                <div class="form-group">
                                    <label class="form-label" for="example-select">???????????????? ????????????</label>
                                    <select class="form-control" name="status" id="example-select">
                                        <option value="online">????????????</option>
                                        <option value="goout">????????????</option>
                                        <option value="bother">???? ????????????????????</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="example-fileinput">?????????????????? ????????????</label>
                                    <input type="file" name="image" id="example-fileinput" class="form-control-file">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xl-12">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>???????????????????? ????????</h2>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- vk -->
                                        <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="base-7 icon-stack-3x" style="color:#4680C2"></i>
                                                        <i class="fab fa-vk icon-stack-1x text-white"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" name="vk" class="form-control border-left-0 bg-transparent pl-0">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- telegram -->
                                        <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="base-7 icon-stack-3x" style="color:#38A1F3"></i>
                                                        <i class="fab fa-telegram icon-stack-1x text-white"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" name="telega" class="form-control border-left-0 bg-transparent pl-0">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <!-- instagram -->
                                        <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                    <span class="icon-stack fs-xxl">
                                                        <i class="base-7 icon-stack-3x" style="color:#E1306C"></i>
                                                        <i class="fab fa-instagram icon-stack-1x text-white"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <input type="text" name="insta" class="form-control border-left-0 bg-transparent pl-0">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                        <button type="submit" class="btn btn-success">????????????????</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </main>

    <script src="js/vendors.bundle.js"></script>
    <script src="js/app.bundle.js"></script>
    <script>

        $(document).ready(function()
        {


        });

    </script>
</body>
</html>
