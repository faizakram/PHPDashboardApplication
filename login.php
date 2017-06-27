<?php require("select.php"); ?>  
<?php  
 session_start();
 $status ="";
 if( isset($_SESSION['username'] ) ) {
				if( $_SESSION['role'] == "Admin"){
				header('Location: Admindashboard.php');}
					else{
					header('Location: dashboard.php');}
		}
		else {
			if ($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
			if(test_input($_POST["Name"])!= "" &&  test_input($_POST["Password"]!=""))
			{
        
				$check = checklogin($_POST["Name"] , $_POST["Password"]);
				$row = $check->fetch_assoc();
				
        if($check == 1)
				{	
					$_SESSION['username'] = $row["username"];
					$_SESSION['role'] = $row["role"];
					if( $_SESSION['role'] == "Admin")
					header('Location: Admindashboard.php');
					else
					header('Location: dashboard.php');
				}
			}
    }catch(Exception $e) {
      echo 'Message: ' .$e->getMessage();
      }
			 
		}
		}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Acer Business | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index2.html"><b>Acer</b> Business</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="login.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="Name" placeholder="Enter User Name" required="required">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="Password" placeholder="Password" required="required">
          </div>
          <div class="row">
            
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
			  
            </div><!-- /.col -->
          </div>
        </form>
        <span class="btn-right" style="font-size:20px;color:red;"><?php echo $status;?></span>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
