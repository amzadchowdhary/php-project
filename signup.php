<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;}
$validation=false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
        if (!empty($_POST['name'])&&!empty($_POST['email'])&&!empty($_POST['userpassword'])&&!empty($_POST['cpassword'])) {
            $name = test_input($_POST['name']);
            $email =test_input($_POST['email']);
            $userpassword = test_input($_POST['userpassword']);
            $cpassword = test_input($_POST['cpassword']);
            $validation=true;
        } 
        else {
          $nameErr = "Name is required";
          $emailErr = "Email is required";
          $passErr = "Password is required";
          $confirmPassErr = "Please confirm your password";
            }
        }

if($validation){

include '_dbconnect.php';

  if($userpassword== $cpassword){
    $hash=password_hash($userpassword, PASSWORD_BCRYPT);
    $sql = "INSERT INTO `ads_users` ( `name`, `email`, `password`) VALUES ( '$name', '$email', '$hash');";
    $result = mysqli_query($conn, $sql);

 
   if ($result) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>Success!</strong> Thanks for Registering successfully!  Please login !
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
    } else {
  
     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> User not registered pleace try with other email address Or Try to login you may already have created account with us!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
   }
  
  
  }
  else { 
   echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
   <strong>Error!</strong> Password do not match..!
   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
   }
}

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>

        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
            integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="#">
        <style>
        .error {
            color: #FF0000;
        }
        </style>
    </head>

    <body>
        <div class="container mt-5">
            <h><b>Register</b> For Album of Ads</h>
            <div class="card">
                <div class="card-header">
                    <p class="login-box-msg">
                        <a href="signin.php" class="text-decoration-none">
                            If already registered please Signin here.
                        </a>

                    </p>
                </div>
                <div class="card-body register-card-body">
                    <p><span class="error">* required field</span></p>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Full name" required>
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                            <span class="error">* <?php echo $nameErr;?></span>

                        </div>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>

                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                            <span class="error">* <?php echo $emailErr;?></span>

                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="userpassword" placeholder="Password"
                                required>

                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                            <span class="error">* <?php echo $passErr;?></span>

                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="cpassword" placeholder="Retype password"
                                required>

                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                            <span class="error">* <?php echo $confirmPassErr;?></span>


                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit" name="submit" class="btn btn-dark btn-block">Register</button>
                            </div>
                            <div><a href="index.php" class="text-decoration-none">
                                    Back to Home Page
                                </a>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </body>

</html>