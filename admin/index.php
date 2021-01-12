<?php 

  include "inc/connection.php";
  ob_start();
  session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Library Management</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style type="text/css">
    .site{
     background-color: #4158D0;
     background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
     height: 100vh;
     width: 100vw;
     vertical-align: middle;
     text-align: center;
    }
    .container{
      width: 1140px;
    }
    .container h1{
      text-align: center;
      margin-top: 200px;
      letter-spacing: 2px;
      color: #fff;
      font-weight: 600;
      font-size: 50px;
    }
    .site p{
      text-align: center;
      margin-top: 20px;
      letter-spacing: 2px;
      color: #fff;
      font-weight: 500;
      font-size: 30px;
    }
    .site .btn-modal{
      text-align: center;
      color: #fff;
      background-color: transparent;
      border: 1px solid #fff;
      border-radius:0px;
      font-size: 20px;
      padding: 15px 50px;
      transition: .5s ease-in-out;
      margin-top: 50px;
    }
    .site .btn-modal:hover{
      color: #202020;
      background-color: #fff;
    }
    .site .btn-modal:focus{
      outline: none;
    }
    .modal-header img{
      width: 150px;
    }
    form{
      padding: 20px 40px;
    }
    form input{
      margin-bottom: 20px;
    }

    form .login{
      background: linear-gradient(45deg, #4158D0, #C850C0, #FFCC70);
      color: #fff;
      border:1px solid transparent; 
      border-radius: 0px;
      transition: .5s ease-in-out;
      font-size: 18px;
      font-weight: 500;  
      vertical-align: middle;
    }
    form .login:focus{
      outline: none;
    }
    form .login:hover{
      background-color: #fff;
      color: #202020;
    }
  </style>
</head>
<body>
<div class="site">
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="title">
        <h1>Library Management System Website</h1>
        <p>This is a library management system website!</p>
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-modal btn-lg" data-toggle="modal" data-target="#myModal">Register</button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <img src="img/user-male.png">
              </div>
              <div class="modal-body">
                <form method="POST">                                              
                  <div class="form-group">  
                    <input type="email" name="email" placeholder="Your Email" class="form-control">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" placeholder="Your Password" class="form-control">
                  </div>
                  <input type="submit" class="form-control login" name="submit" value="Login">
                </form>
              </div>
              
            </div>
            
          </div>
        </div>

        <?php 

        if(isset($_POST['submit'])){

        $email    = $_POST['email'];
        $password = $_POST['password'];

        $hasspass = sha1($password);

        $query = "SELECT * FROM users WHERE u_mail = '$email'";
        $result = mysqli_query($db,$query);
        while($row = mysqli_fetch_assoc($result)){

          $_SESSION['u_id']       = $row['u_id'];
          $_SESSION['u_name']     = $row['u_name'];
          $_SESSION['u_mail']     = $row['u_mail'];
          $_SESSION['u_phone']    = $row['u_phone'];
          $_SESSION['u_pass']     = $row['u_pass'];
          $_SESSION['u_address']  = $row['u_address'];
          $_SESSION['u_photo']    = $row['u_photo'];
          $_SESSION['u_role']     = $row['u_role'];
        }

          if(($email == $_SESSION['u_mail']) && ($hasspass == $_SESSION['u_pass'])){

          header('Location: dashboard.php');
          }
          elseif(($email != $_SESSION['u_mail']) || ($hasspass != $_SESSION['u_pass'])){
          header('Location: index.php');
        }
        else{
          header('Location: index.php');
        }



        }

        ?>



      </div>
    </div>
  </div>
</div>
</div>

<?php 
  
  ob_end_flush();

?>
</body>
</html>
