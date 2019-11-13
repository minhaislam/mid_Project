<?php
		
		if(isset($_POST['Add'])){
		
		$uname = $_POST['uname'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$cpass = $_POST['cpass'];
		$utype =$_POST["utype"];

		
		if(empty($uname)==true || empty($email)==true || empty($pass) == true ||empty($cpass) == true ||empty($utype) == true){
			echo "fill all!";
		} elseif ($pass!=$cpass) {
			echo "password doesn't match";	
		} else{
			if (checkUniqueValue($uname, 'username')) {
				echo "Sorry. This username is already taken.";
				exit();
			}

			if (checkUniqueValue($email, 'email')) {
				echo "Sorry. This email has been used already.";
				exit();
			}

            //$_POST['name'] = $name;
			$user = fopen('data.txt', 'a+');
			$data=fwrite($user, "$uname"."|"."$email"."|"."$pass"."|"."$cpass"."|"."$utype"."\n");
			
	fclose($user);
		header('location: ViewInfo.php');
	
			}
		}
		elseif (isset($_POST['Back'])) {
			header('location: AdminHome.php');
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
		
		session_start();
if(isset($_COOKIE['uname'])){

?>



<!DOCTYPE html>
<html>
<head>
	<title>
		Info table
	</title>
</head>
<body>
	<table>
	<center>
	<tr>
						<td width="150px"><h2><i><font color="Red">Freelance</font></i></h2></td>
						<td  width="100px"><a href="profile.php">Profile</a></td>
						<td width="100px"><a href="viewinfo.php">View Info</a></td>
						<td width="100px"><a href="logout.php">Logout</a></td>
						<td width="100px"><a href="Jobreq.php">Job Requests</a></td>
						<td width="100px"><a href="FreelancerDetails.php">Freelancer Details</a></td>
						<td width="100px"><a href="Analytics.php">Analytics</a></td>
						<td width="100px"><a href="UserAnalysis.php">User Analysis</a></td>
						<td width="80px"><a href="Message.php">Message</a></td>
						<td width="100px"><a href="Notification.php">Notificstion</a></td>
						<td width="80px"><a href="home.php"><img src="a.jpg" width="40px" height="40px"></a>
						<br>
						<a href = "logout.php"><h3>LogOut</h3></a></td>
					</tr>
					
					 <tr>
                        <td colspan="11" style="border-top:4px solid #888;"></td>
                    </tr>
					
		
	
	</table></center>

<center>
	<table border="1">
		<thead>
		<tr>
			<th>User Name</th>
			<th>Email</th>
			<th>Password</th>			
			<th>User Type</th>
		</tr>	
          </thead>

          <tbody>
          	   <?php
         
	$read = fopen('data.txt', 'r');
	$fetch='';
	if (filesize('data.txt')>0) {
		$fetch = fread($read, filesize('data.txt'));
	}
	
	//$fetch = fread($read, filesize('data.txt'));
	fclose($read);
	$lines=explode("\n", $fetch);
          
        foreach ($lines as $line) {
        	if ($line != '' ) {
        		$user = explode("|", $line);		
		
	?>
					<tr>

		          		<td><?php echo $user[0];?></td>
		          		<td><?php echo $user[1];?></td>
		          		<td><?php echo $user[2];?></td>
		          		<td><?php echo $user[4];?></td>
		          	</tr>

    <?php
    		}
		}
	?>	

          </tbody>	
        


	</table>
	</center>

	<form method="POST" action="">
		<fieldset>	\
		
			<legend><b>Edit Info</b></legend>
			<table cellpadding="5px">
			<tr>
				<td>
			Username:<br><input type="text" name="uname" value="">
			</td>
			
			
				<td>
			Email:<br><input type="email" name="email" value="">
			</td>
			
			
				<td>
			Password <br><input type="password" name="pass" value="">
			</td>
			
			
				<td>
			Confirm Password<br><input type="password" name="cpass" value="">
			</td>
			

			
			<td>
			<input type="radio" name="utype" value="User"/>User <br>
			<input type="radio" name="utype" value="Admin"/>Admin
			
			</td>
			
			
			
			<tr>
			<td style="border-top:1px solid #888;">
			<input type="submit" name="Add" value="Add"/>
			<input type="submit" name="Update" value="Update"/>
			<input type="submit" name="Delete" value="Delete"/>
			</td>
			</tr>

			
			</table>

			

		</fieldset>	
		

	</form>
<form method="POST" action="">
	<table>
				<tr>
				<td>
				<input type="submit" name="Back" value="Back" method="POST" action=""/>
				</td>
			</tr>
			</table>

</form>

</body>
</html>
<?php
}
else{
	header('location:signin.php');
}
?>