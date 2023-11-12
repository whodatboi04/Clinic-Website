<?php
require_once 'code.php';
if(isset($_SESSION['admin'])){
	echo "<script> location.replace('admin-settings.php'); </script>";
	exit();
}
if(!isset($_SESSION['system_adm'])){
	echo "<script> location.replace('index.php'); </script>";
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SETTINGS</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="icons/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/system-settings.css">
	
    <link rel="icon" href="img/favicon/medical.png" type="image" sizes="32x32">
    <!-- Favicons-->
    <link rel="icon" href="img/favicon/medical.png" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="img/favicon/medical.png">
</head>
<body>
	<div class="container">
		<nav class="navigation">
			<a href="sys-home.php"><img src="img/logo1.png" alt="" style="width: 210px;  margin-right: 10px; margin-bottom: 20px;" draggable="false" ></a>
			<ul class="tabs"> 
				<a href="sys-home.php"><li><i class="fa fa-home"></i>HOME</li></a>
				<a href="sys-profile.php"><li><i class="fa fa-user"></i>PROFILE</li></a>

				<div class="dropdown">
                    <a><label for="checkbox"><li><i class="fas fa-clipboard-list"></i></i>RECORDS</li></label></a>
                    <input type="checkbox" id="checkbox"/>
                    <ul>
						<a href="sys-employee.php"><li><i class="fas fa-users"></i>EMPLOYEE</li></a><br>
                        <a href="sys-medical.php"><li><i class="fas fa-file-medical"></i>MEDICAL</li></a><br>
						<a href="sys-consultation.php"><li><i class="fas fa-file-medical"></i>CONSULTATION</li></a><br>
                        <a href="sys-consulted.php"><li><i class="fas fa-file-medical"></i>CONSULTED</li></a><br>
                        <a href="sys-illness.php"><li><i class="fas fa-file-medical"></i>ILLNESS</li></a><br>
                    </ul>
                </div>
				
				<a href="sys-log.php"><li><i class="fas fa-clipboard-list"></i>TRACK LOGS</li></a>
				<a href="sys-settings.php"><li id="active"><i class="fa fa-cog"></i>SETTINGS</li></a>
				<a href="sys-settings.php?logout=1"><li><i class="fas fa-sign-out-alt"></i>LOG OUT</li></a>
			</ul>
		</nav>
		<div class="header" id="fff" >
			<h2> <?php echo $msg, $_SESSION['position'];?></h2>
			<div class="user-icons">
				<span><?php echo $_SESSION['full_name'];?></span>
				<div class="profile-pic">
					<a href="sys-profile.php"><img src="<?php echo $_SESSION['picture'];?>" alt="user"></a>
				</div>
			</div>
		</div>
		
		<div class="content" id="fff">
			<div class="account">
				<span>ACCOUNT SETTINGS</span>
			</div>
			
			<div class="account-content">
				<div class="edit" style="margin-top: 10px;">
					<p>Name: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $_SESSION['full_name'];?></p><hr>
					<p>Username &nbsp&nbsp<?php echo $_SESSION['employee_no'];?></p><hr>

					<p>Password</p>
					<a href="sys-settings.php?changepass=1" class="btnedit" name="changepass">Edit</a>
					<?php
						if (isset($_GET['changepass'])){
							echo "<form method='POST'>";
							echo "<p style='padding-top: 5px;'>Current Password: </p><input type='password' name='curPass'></input><br>";
							echo "<p>New Password: </p><input type='password' name='newPass1'></input><br>";
							echo "<p>Retype Password: </p><input type='password' name='newPass2'></input>";

							if(isset($_POST['pass-submit'])){
								if($_POST['curPass']==$_SESSION['password']){
									if($_POST['newPass1']==$_POST['newPass2']){
										$password = $_POST['newPass1'];
										if($password != ""){
											$employee_no = $_SESSION['employee_no'];
											$role = $_SESSION['role'];
											$sql = "UPDATE users SET password='$password' WHERE employee_no='$employee_no'";

											if($_POST['curPass']==$password)
											{
												echo "<p id='pass-error'><i class='fas fa-exclamation-circle'></i>Old Password can not be used</p>";
											}
											else if(mysqli_query($conn, $sql)){	
												$sql = "INSERT INTO log (employee_no, role, time_log, action)
													VALUES     ('$employee_no', '$role', CURRENT_TIMESTAMP, 'updated password')";
												if(mysqli_query($conn, $sql)){
												echo "<script>alert('Password Changed Successfully, Logging you out');window.location.href = 'sys-settings.php?logout=1';</script>";
												}
											}else{
												echo "Error updating record: " . mysqli_error($conn);
											}
										}else{
											echo "<p id='pass-error'><i class='fas fa-exclamation-circle'></i> New Password cannot be blank</p>";
										}
									}else{
										echo "<p id='pass-error'><i class='fas fa-exclamation-circle'></i> Password does not match</p>";
									}
								}else{
									echo "<p style= 'margin: 0px;' id='pass-error'><i class='fas fa-exclamation-circle'></i> Wrong Current Password</p>";
								}
							}
							else if(isset($_POST['cancel']))
							{
								header('location: sys-settings.php');
							}
							echo "<br>";
							echo "<button name='pass-submit'>Save Changes</button>";
							echo "<button name='cancel' style='margin-left: 10px; background-color: #e2e2e2;color: #414141; '>Cancel</button>";
							echo "</form>";

							
						}?><hr>

					<p>Address</p>
					<a href="sys-settings.php?changeaddress=1" class="btnedit" name="changeaddress">Edit</a>
					<?php
						if (isset($_GET['changeaddress'])){
							$address = $_SESSION['address'];

							echo "<form method='POST'>";
							echo "<p style='padding-top: 5px;'>Address: </p><input type='text' name ='address' value ='$address'></input><br>";
							echo "<p style='padding-top: 5px;'>Password: </p><input type='password' name='curPass'></input>";

							?><?php if(count($errors) > 0): ?>
								<?php foreach ($errors as $error): ?>
									<?php echo $error;?>	
								<?php endforeach ?>
							<?php endif ?><?php

							echo "<br>";

							echo "<button name='add-submit'>Save Changes</button>";
							echo "<button name='cancel' style='margin-left: 10px; background-color: #e2e2e2;color: #414141; '>Cancel</button>";
							echo "</form>";

							
						}?><hr>

					<p>Email</p>
					<a href="sys-settings.php?changeemail=1" class="btnedit" name="changeemail">Edit</a>
					<?php
						if (isset($_GET['changeemail'])){
							$email = $_SESSION['email'];
							
							echo "<form method='POST'>";
							echo "<p style='padding-top: 5px;'>Email: </p><input type='email' name = 'email' value = '$email'></input><br>";
							echo "<p style='padding-top: 5px;'>Password: </p><input type='password' name='curPass'></input>";

							?><?php if(count($errors) > 0): ?>
								<?php foreach ($errors as $error): ?>
									<?php echo $error;?>	
								<?php endforeach ?>
							<?php endif ?><?php

							echo "<br>";

							echo "<button name='email-submit'>Save Changes</button>";
							echo "<button name='cancel' style='margin-left: 10px; background-color: #e2e2e2;color: #414141; '>Cancel</button>";
							echo "</form>";

							
						}?>
						
				<hr>
					<p>Contact</p>
					<a href="sys-settings.php?changecontact=1" class="btnedit" name="changecontact">Edit</a>
					<?php
						if (isset($_GET['changecontact'])){
							$contact = $_SESSION['mobile'];

							echo "<form method='POST'>";
							echo "<p style='padding-top: 5px;'>Contact: </p><input type='text' name = 'contact' value ='$contact' maxlength='11 minlength='11''></input><br>";
							echo "<p style='padding-top: 5px;'>Password: </p><input type='password' name='curPass'></input>";	
							?><?php if(count($errors) > 0): ?>
								<?php foreach ($errors as $error): ?>
									<?php echo $error;?>	
								<?php endforeach ?>
							<?php endif ?><?php

							echo "<br>";

							echo "<button name='contact-submit'>Save Changes</button>";
							echo "<button name='cancel' style='margin-left: 10px; background-color: #e2e2e2;color: #414141; '>Cancel</button>";
							echo "</form>";

						}?>
						
				</div>
			</div>
		</div>
			
	</div>
	<footer>
		<p>Copyright &copy; <script>document.write(new Date().getFullYear());</script>,
		Universidad De Manila, Philippines</p>
	</footer>
</body>
</html>