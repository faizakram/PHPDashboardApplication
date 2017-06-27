<?php require("select.php"); ?>  
<?php
 if (isset($_GET['insertRandomNumber'])) {
        echo json_encode(insertRandomNumber($_GET['insertRandomNumber']));
    }
	 if (isset($_GET['passwordRest'])) {
        echo json_encode(passwordRest($_GET['passwordRest']));
    }
	 if (isset($_GET['clearall'])) {
        echo clearall($_GET['clearall']);
    }
	 if (isset($_GET['deleteuser'])) {
        echo deleteuser($_GET['deleteuser']);
    }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $name = test_input($_POST["name"]);
 $password = test_input($_POST["password"]);
 $userType = test_input($_POST["userType"]);
 echo addUser($name,$password,$userType);
}
?>