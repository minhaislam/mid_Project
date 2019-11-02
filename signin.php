<?php
	session_start();
if(isset($_POST['login'])){
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		
		
		if(empty($email) == true || empty($pass) == true){
			echo "fill all!";
		}
		else{
            $name='data.txt';
	$read = fopen($name, 'r');
	
		$fetch = fread($read, filesize($name));
	fclose($read);
	$lines=explode("\n", $fetch);
	foreach ($lines as $line) {
		$user = explode("|", $line);
	
		if($user[1] == $email && $user[2] == $pass){
				if($user[4]=='Admin'){
					setcookie("uname", $user[0], time()+3600, "/");
			$_SESSION['uname']=$user[0];
			header('location: AdminHome.php');
		}
		elseif($user[4]=='User')
			{
				setcookie("uname", $user[0], time()+3600, "/");
			$_SESSION['uname']=$user[0];
			header('location: UserHome.php');
		}
		}
		

	}	
	
	}
	
	
			}
		


?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" action="signin.php">
		<fieldset>	
			<legend><b>LOG IN</b></legend>
			<table cellpadding="5px">
			<tr>
				<td>
			Email:<br><input type="email" name="email" value="">
			</td>
			</tr>
			<tr>
				<td>
			Password <br><input type="password" name="pass" value="">
			</td>
			</tr>
			
			
			<td style="border-top:1px solid #888;">
			<input type="submit" name="login" value="Login"/><br>
			Haven't registered yet?<a href="Registration.php">Register</a>
			</td>
			</tr>
			
			</table>

		</fieldset>	


	</form>


</body>
</html>
