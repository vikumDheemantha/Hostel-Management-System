<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$DB_Name = "hostelms";
	// Create connection
	$ses_conn = new mysqli($servername, $username, $password, $DB_Name);
	// Check connection
	if ($ses_conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
	//sesson start
	session_start();
	$logedUser = $_SESSION['Loged_User'];
	$ses_sql = "SELECT * FROM user_Details WHERE UserName = '$logedUser'";

	$ses_result = $ses_conn->query($ses_sql);



	$ses_row = $ses_result->fetch_assoc();
	$ses_id=$ses_row['user_id'];
	$ses_conform = $ses_row['UserName'];
	$ses_name = $ses_row['Name'];
	$ses_type = $ses_row['type'];
	$ses_log=$ses_row['Frist_login'];
	$_SESSION['userState']=$ses_log;
	$_SESSION['usertype']=$ses_type;
	$_SESSION['user_id'] = $ses_id;
	if($ses_type!='admin')
	{
		$sql_hos="SELECT * FROM hostel_staff WHERE warden_id='$ses_id' OR subwarden_id='$ses_id';"; 
		$ses_result_hos = $ses_conn->query($sql_hos);
		$hos_row=$ses_result_hos->fetch_assoc();
		$hos=$hos_row['hostel_id'];
		$_SESSION['hostel_id']=$hos;
	}
	$ses_conn->close();
	// if(!isset($ses_conform))
	// {
	// 	$ses_conn->close();
	// 	header('Location: index.php');
	// }
?>