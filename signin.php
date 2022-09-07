<?php
session_start();
session_destroy();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include '_dbconnect.php';
  $loginpassword = $_POST['loginpassword'];
  $loginemail = $_POST['loginemail'];
  $sqllogin= "SELECT * FROM `ads_users` WHERE  `email` LIKE '$loginemail'";
  $loginresult = mysqli_query($conn, $sqllogin);
  $num = mysqli_num_rows($loginresult);

  if ($num==1) {
    while($row=mysqli_fetch_assoc($loginresult)){
    if(password_verify($loginpassword,$row['password'])){
    session_start();
    $_SESSION['loggedin']=true;
    $_SESSION['email']= $loginemail;
    header("location:welcome.php");
  }}} else {
   
   echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Invalid Credentials!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
 }
 
  }
?>
<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
            integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="#">
    </head>

    <body>
        <div class="container mt-5">
            <h><b>Login</b> For Album of Ads.</h>
            <div class="login-box">
                <div class="card">
                    <div class="card-header">
                        <p class="login-box-msg">
                            <a href="signup.php" class="text-decoration-none">
                                If not registered, please Signup here.
                            </a>
                        </p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
                            <div class=" input-group mb-3 mt-2">
                                <input type="email" class="form-control" name="loginemail" placeholder="Email" required>

                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>

                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="loginpassword" placeholder="Password"
                                    required>

                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <button type="submit" class="btn btn-dark btn-block">Sign In</button>
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
        </div>

    </body>

</html>