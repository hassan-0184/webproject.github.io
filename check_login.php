<?php 
	include_once('db.php'); 

	session_start(); 

	$d1 = new Database(); 

	$teacher_username = ''; 
	$teacher_password = ''; 
	$error_teacher_username = ''; 
	$error_teacher_password = ''; 
	$error = false; 

if (empty($_POST['t_username']))
{
	$error_teacher_username = "Username is required";
	$error = true;  
}
else 
	$teacher_username = $_POST['t_username'];
if (empty($_POST['t_password']))
{
	$error_teacher_password = "Password is required"; 
	$error = true; 
}
else 
	$teacher_password = $_POST['t_password'];
if ($error == false)
{
	$result = $d1->check_member_login($teacher_username); 
	if (!empty($result))
	{
		foreach($result as $row)
		{
			if ($teacher_password == $row['m_password'])
			{
				$_SESSION["member_id"] = $row['m_id'];
			}
			else 
			{
				$error_teacher_password = "Incorrect Password entered."; 
				$error = true; 
			}
		}
	}
	else 
	{
		$error_teacher_username = "Incorrect Username entered."; 
		$error = true; 
	}
}
if ($error == true)
{
	$output = array(
		'error' => true, 
		'error_teacher_username' => $error_teacher_username, 
		'error_teacher_password' => $error_teacher_password
	);
}
else 
{
	$output = array(
		'success' => true
	);
}

echo json_encode($output); 

?>