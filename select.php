<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function databaseConnection()
{
$servername = "localhost";
$username = "pyramcro_root";
$password = "Faiz@#123";
$dbname = "pyramcro_root";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
return $conn;
}

function checkVerificationCode($verificationCode)
{ 
$conn = databaseConnection();
$sql = "SELECT * FROM randomtable where random = '$verificationCode'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$randomNumber = rand();
	$sql = "UPDATE randomtable set random= '$randomNumber' where random = '$verificationCode'";
	$conn->query($sql);
	$conn->close(); 
	return "Success";
}
else{
$conn->close(); 
return "Failed";
}
}

function checklogin($uname , $upassword)
{
$conn = databaseConnection();
$sql = "SELECT * FROM login where username = '$uname' and password = '$upassword' and status = 'Enable'";	
$result = $conn->query($sql);
$conn->close();
return $result;
}
function findAllUserInfo()
{
$conn = databaseConnection();
$sql = "SELECT *FROM login";	
$result = $conn->query($sql);
$conn->close();
return $result;
}
function passwordRest($uname)
{
$conn = databaseConnection();
$randomNumber = rand();
$sql = "UPDATE login SET password= '$randomNumber' WHERE username='$uname'";	
if ($conn->query($sql) === TRUE) {
$conn->close();
return $randomNumber;
}
else{
	return "Error";
}
}
function clearall($uname)
{
$status ='Disable';
$conn = databaseConnection();
$sql = "UPDATE randomtable SET status = '$status' WHERE uname='$uname'";
if ($conn->query($sql) === TRUE) {
	$conn->close();
return "0";
}
else{
	return "not Wroking";
}
}
function deleteuser($uname)
{
$conn = databaseConnection();
$sql = "DELETE FROM randomtable WHERE uname='$uname'";
$conn->query($sql);
$sql = "DELETE FROM login WHERE username='$uname'";
if ($conn->query($sql) === TRUE) {
	$conn->close();
return "Successfully Deleted";
}
else{
	return "not Wroking";
}
}
function insertRandomNumber($uname)
{
$randomNumber = rand();
$status ='Enable';
$conn = databaseConnection();
$sql = "UPDATE randomtable SET random= '$randomNumber' WHERE uname='$uname'";
if ($conn->query($sql) === TRUE) {
	$conn->close();
return $randomNumber;
}
}

function addUser($uname , $upassword, $role)
{
$randomNumber = rand();
$status ='Enable';
$conn = databaseConnection();
$sql = "INSERT INTO login VALUES('$uname','$upassword','$role','$status')";
if ($conn->query($sql) === TRUE) {
$sql = "INSERT INTO randomtable VALUES('$randomNumber','$uname')";
$conn->query($sql);
	$conn->close();
return 'User Added Successfully';
}
else{
return 'Duplicate Entry';
}
}
?>