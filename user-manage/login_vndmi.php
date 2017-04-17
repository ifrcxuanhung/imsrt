<?php 

include_once('classes/login_vndmi.class.php'); 

$forgot = new Login;
if(isset($_POST['username']) || isset($_SESSION['imsrt']['username'])) {
	
	$forgot->login();
	
}
exit();
?>