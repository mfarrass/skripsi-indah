<?php
require 'koneksi.php';
session_start();

// cek login, terdaftar atau tidak
if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $cekdatabase = mysqli_query($conn, "SELECT * from admin where username = '$email' and pass = '$password'");
    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung>0){
        $_SESSION['log'] = 'True';
        header ('location:index.php');
    } else {
        header ('location:login.php');
    };
};
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body style="background-color: #A3C1AD;">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method = "post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Username</label>
                                                <input class="form-control py-4" name = "email" id="inputEmailAddress" type="text" placeholder="Enter email address" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" name = "password" id="inputPassword" type="password" placeholder="Enter password" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html"></a>
                                                <button class="btn btn-primary" name = "login">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <!-- <div class="small"><a href="register.html">Need an account? Sign up!</a></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
            <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-light text-gray-50">
                <div class="container text-center">
                <small>Copyright &copy; 2023 Indah Tri Nur Azizah</small>
                </div>
            </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
