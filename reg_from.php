<?php
  $message=false;


  if(isset($_POST['register'])) {

      $fulName = $_POST['fullName'];
      $email = $_POST['email'];
      $phoneNumber = $_POST['phoneNumber'];
      $presentAddress = $_POST['presentAddress'];
      $permanentAddress = $_POST['permanentAddress'];
      $nidNumber = $_POST['nidNumber'];
      $password=$_POST['password'];
      $password=password_hash($password,PASSWORD_BCRYPT);

      if (!empty($_FILES['photo']['tmp_name'])) {
          $name = $_FILES['photo']['name'];
          $filename_parts = explode('.', $name);
          $extension = end($filename_parts);
          $new_filename = uniqid('Register', true) . '.' . $extension;
          move_uploaded_file($_FILES['photo']['tmp_name'], 'photo/upphoto/' .$new_filename);

      }
     require_once 'connection.php';
      $sql="INSERT INTO register(`fullName`,`email`,`phoneNumber`,`presentAddress`,`permanentAddress`,`nidNumber`,`password`,`photo`)values (:fullName,:email,:phoneNumber,:presentAddress,:permanentAddress,:nidNumber,:password,:photo)";
      $stm=$connection->prepare($sql);
      $stm->bindParam(':fullName',$fulName);
      $stm->bindParam(':email',$email);
      $stm->bindParam(':phoneNumber',$phoneNumber);
      $stm->bindParam(':presentAddress',$presentAddress);
      $stm->bindParam(':permanentAddress',$permanentAddress);
      $stm->bindParam(':nidNumber',$nidNumber);
      $stm->bindParam(':password',$password);
      $stm->bindParam(':photo',$photo);
     $responsne= $stm->execute();
      if($responsne){
        $message= 'Register is ok';
      }else{
          $message='Register is not ok ';
      }
  }
?>




<!doctype html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo $title ?? 'PPI Ecommerce'; ?></title>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/Reg_from.css">
    </head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">Laravel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Register</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<main class="my-form">
    <div class="cotainer">
        <?php
          if ($message):
        ?>
        <div class="alert alert-success">
            <?php
              echo $message;
            ?>
        </div>
        <?php endif;?>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form name="my-form" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="full_name" class="form-control" name="fullName">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="form-control" name="email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_name" class="col-md-4 col-form-label text-md-right">User Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="user_name" class="form-control" name="username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                                <div class="col-md-6">
                                    <input type="text" id="phone_number" class="form-control" name="phoneNumber">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="present_address" class="col-md-4 col-form-label text-md-right">Present Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="present_address" class="form-control" name="presentAddress">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="permanent_address" class="col-md-4 col-form-label text-md-right">Permanent Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="permanent_address" class="form-control" name="permanentAddress">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nid_number" class="col-md-4 col-form-label text-md-right"><abbr
                                        title="National Id Card">NID</abbr> Number</label>
                                <div class="col-md-6">
                                    <input type="text" id="nid_number" class="form-control" name="nidNumber">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                    password   </label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="input photo" class="col-md-4 col-form-label text-md-right">
                                     Photo   </label>
                                <div class="col-md-6">
                                    <input type="file" id="photo" class="form-control" name="photo">
                                </div>
                            </div>


                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" name="register">
                                    Register
                                </button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>

