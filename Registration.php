<?php
if(isset($_POST['signup'])){
		$uname = $_POST['uname'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$cpass = $_POST['cpass'];
		$utype =$_POST["utype"];
		
		
		if(empty($uname)==true || empty($email)==true || empty($pass) == true ||empty($cpass) == true ||empty($utype) == true){
			echo "fill all!";
		}
		elseif ($pass!=$cpass) {
		echo "password doesn't match";	
		} else{
			if (checkUniqueValue($uname, 'username')) {
				header('location: Registration.php');
				//echo "Sorry. This username is already taken.";
			
				exit();
			}

			if (checkUniqueValue($email, 'email')) {
				header('location: Registration.php');
				//echo "Sorry. This email has been used already.";
				exit();
			}
		

		
            //$_POST['name'] = $name;

			$user = fopen('data.txt', 'a+');
			$data=fwrite($user, "$uname"."|"."$email"."|"."$pass"."|"."$cpass"."|"."$utype"."\n");
			
	fclose($user);
		header('location: signin.php');
	}
			}


			function checkUniqueValue($value, $type){
			$dataFromUserFile ='data.txt';
			$read = fopen($dataFromUserFile, 'r');
	
			$fetch = fread($read, filesize($dataFromUserFile));
			
			$lines=explode("\n", $fetch);

			$found = 0;

			foreach ($lines as $line) {				
				if (! empty($line)) {
					$user = explode("|", $line);

					if ($type == 'username') {
						if($user[0] == $value){
							$found = 1;
						}
					} else {
						if($user[1] == $value){
							$found = 1;
						}
					}	
				}
			}

			return $found;
		}
		

	
		
		
		
		


?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
	<form method="POST" action="Registration.php">
			
			<legend><b>REGISTRATION<br><hr width="150"></b></legend>
			<table cellpadding="5px">
			<tr>
				<td>
			Username:<br><input type="text" name="uname" value="">
			</td>
			</tr>
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
			<tr>
				<td>
			Confirm Password<br><input type="password" name="cpass" value="">
			</td>
			</tr>

			<tr>
			<td style="border-top:1px solid #888;">
			<input type="radio" name="utype" value="User"/>User
			<input type="radio" name="utype" value="Admin"/>Admin
			
			</td>
			
			</tr>
			
			<tr>
			<td style="border-top:1px solid #888;">
			<input type="submit" name="signup" value="Sign Up"/><br>

			Already a menmber? <a href="signin.php">Sign In</a>
			</td>
			</tr>
			
			</table>

			


	</form>


</body>
</html>