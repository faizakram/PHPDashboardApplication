<?php require("select.php"); ?>  
<?php 
 session_start();
 $result ="";
 if( isset($_SESSION['username'] ) ) {
				if( $_SESSION['role'] == "Admin"){
					 $result = findAllUserInfo();
				}
					else{
					header('Location: dashboard.php');}
					}
		else {
			header('Location: login.php');
		}
?> 
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Acer | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
	<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
    $('.button').click(function(){
       $.ajax({
        type: "GET",
        url: 'secure.php',
        data: { "insertRandomNumber": "<?= $_SESSION['username']?>"},
        success: function(response) {
            $("#random").html(response);
        }
    });});
	 $('#adduser').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'secure.php',
            data: $('#adduser').serialize(),
            success: function (response) {
               $("#addstatus").html(response);
			   location.reload(1000);
            }
          });
        });	
});
function functionReset(name)
{
		$.ajax({
        type: "GET",
        url: 'secure.php',
        data: { "passwordRest": name},
        success: function(response) {
           location.reload();
        }
    });
}


function functiondelete(name)
{
	if(name == "<?= $_SESSION['username']?>")
	{
		alert("This the Current User You Can not Deleted");
	}
	else{
		$.ajax({
        type: "GET",
        url: 'secure.php',
        data: {"deleteuser": name},
        success: function(response) {
           location.reload();
        }
    });
	}
}
	</script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b> B</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Acer</b> Business</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['username']?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $_SESSION['username']?>
                    </p>
                  </li>
                 
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border text-center" >
                  <h3 class="box-title" style="font-size:24px;">Create User</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="adduser" style="font-size:20px;" autocomplete="off">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">User Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Enter User Id">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
					<div class="form-group col-sm-6">
                      <div class="radio">
                        <label>
                          <input type="radio" name="userType" id="optionsRadios1" value="User" checked>
                          User
                        </label>
                      </div>
                    </div>
                   <div class="form-group col-sm-6">
                      <div class="radio">
                        <label>
                          <input type="radio" name="userType" id="optionsRadios1" value="Admin" >
                          Admin
                        </label>
                      </div>
                    </div>
					<label for="exampleInputPassword1" id="addstatus"></label>
				   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button class="btn btn-block btn-success btn-lg" style="font-size: 22px;">Add User</button>
                  </div>
                </form>
              </div><!-- /.box -->
			  
            </div><!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border text-center">
                  <h3 class="box-title" style="font-size:24px;">Genrate Code</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 
                  <div class="box-body">
                    <div class="form-group">
                      <div class="col-sm-12">
                        <button class="btn btn-block btn-success btn-lg button" style="height: 200px; font-size:40px;">Genrate Code</button>
                      </div>
                    </div>
					<div class="col-sm-12">
					 <div class="form-group text-center" style="font-size:40px;">
							<label id="random" for="exampleInputPassword1"></label>
					   </div>
					  </div>
                  </div><!-- /.box-body -->

              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
		  <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Table With Full Features</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>UserName</th>
                        <th>Password</th>
                        <th>Role</th>
						<th>More</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
              if($_SESSION['username'] == $row["username"])
                continue;
						?>
                      <tr>
                        <td class="username"><?php echo $row["username"]?></td>
                        <td class="password"><?php echo $row["password"]?></td>
                        <td class="role"><?php echo $row["role"]?></td>
						<td>
						<button type="button" onclick ="functionReset('<?php echo $row["username"]?>')" class="btn btn-success">Reset</button>


						<button type="button" onclick ="functiondelete('<?php echo $row["username"]?>')" class="btn btn-danger delete">Delete</button>
						</td>
                      </tr>
					<?php }}?>
					  
                      
                     
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>UserName</th>
                        <th>Password</th>
                        <th>Role</th>
						<th>More</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
		  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2016-2017 <a href="http://faizakram.com">Faiz Akram</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
	 <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
	 <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
