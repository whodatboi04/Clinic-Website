<?php
require_once 'code.php';
if(isset($_SESSION['system_adm'])){
	echo "<script> location.replace('sys-profile.php'); </script>";
	exit();
}
if(!isset($_SESSION['admin'])){
	echo "<script> location.replace('index.php'); </script>";
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PROFILE</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="icons/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/a-profile.css">
	
	<link rel="icon" href="img/favicon/medical.png" type="image" sizes="32x32">
	<!-- Favicons-->
	<link rel="icon" href="img/favicon/medical.png" sizes="32x32">
 	<!-- Favicons-->
 	<link rel="apple-touch-icon-precomposed" href="img/favicon/medical.png">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>
</head>
<body>
	<div class="container">
	<nav class="navigation">
		<a href="admin-home.php"><img src="img/logo1.png" alt="" style="width: 200px; margin-bottom: 50px;"  draggable="false"></a>
			<ul class="tabs"> 
				<a href="admin-home.php"><li><i class="fa fa-home"></i>HOME</li></a>
				<a href="admin-profile.php"><li id="active"><i class="fa fa-user"></i>PROFILE</li></a>
				
				<div class="dropdown">
                    <a><label for="checkbox"><li><i class="fas fa-file-medical"></i></i>RECORD</li></label></a>
                    <input type="checkbox" id="checkbox"/>
                    <ul>
                        <a href="admin-medical.php"><li><i class="fas fa-file-medical"></i>MEDICAL</li></a><br>
						<a href="admin-consultation.php"><li><i class="fas fa-file-medical"></i>CONSULTATION</li></a><br>
                        <a href="admin-consulted.php"><li><i class="fas fa-file-medical"></i>CONSULTED</li></a><br>
                        <a href="admin-illness.php"><li><i class="fas fa-file-medical"></i>ILLNESS</li></a><br>
                    </ul>
                </div>

				
				<a href="admin-settings.php"><li><i class="fa fa-cog"></i>SETTINGS</li></a>
				<a href="admin-profile.php?logout=1"><li><i class="fas fa-sign-out-alt"></i>LOG OUT</li></a>
			</ul>
		</nav>
		<div class="header" id="fff" >
			<h2> <?php echo $msg, $_SESSION['position'];?></h2>
			<div class="user-icons">
				<span><?php echo $_SESSION['full_name'];?></span>
				<div class="profile-pic">
					<a href="admin-profile.php"><img src="<?php echo $_SESSION['picture'];?>" alt="user"  draggable="false"></a>
				</div>
			</div>
		</div>

		<div class="content" id="fff">
			<div class="profile">
				<span> PROFILE </span>
			</div>
			<form method="post" action="admin-profile.php" enctype="multipart/form-data" class="left">
				<div class="profile-pic">
					<img id="previewImg" src="<?php echo $_SESSION['picture'];?>" alt="user"  draggable="false">
				</div>
				<div class="button_outer">
					<div class="btn_upload">
						<input type="file" id="upload_file" name="file" accept=".jpg, .png" onchange="previewFile(this);" required>
						<i class="fas fa-camera"> Browse Photo</i>
					</div>
				</div>
				<div class="save">
					<button name='upload' class="upload">Upload</button>
				</div>
				<?php if(count($errors) > 0): ?>
                    <?php foreach ($errors as $error): ?>
                        <?php echo $error;?>	
                    <?php endforeach ?>
                <?php endif ?>
			</form>
				<div class="up">
					<legend>
						<span> BASIC INFORMATION </span> <hr>
					</legend>
					<div class="info">
						<p class="label"> Name</p><span>:</span> 
						<p class="border"><?php echo $_SESSION['full_name'];?> </p>
					</div>
					<div class="info">
						<p class="label"> Employee Number</p> <span>:</span>
						<p class="border"> <?php echo $_SESSION['employee_no'];?> </p>
					</div>
					<div class="info">
						<p class="label"> Position</p> <span>:</span> 
						<p class="border"> <?php echo $_SESSION['position'];?> </p>
					</div>
					<div class="info">
						<p class="label"> Mobile</p> <span>:</span> 
						<p class="border"> <?php echo $_SESSION['mobile'];?> </p>
					</div>
				</div>
		
				<div class="down">
					<legend>
						<span> PERSONAL INFORMATION </span> <hr>
					</legend>
					<div class="info">
						<p class="label"> Email</p> <span>:</span> 
						<p class="border"> <?php echo $_SESSION['email'];?> </p>
					</div>
					<div class="info">
						<p class="label"> Address</p><span>:</span> 
						<p class="border"> <?php echo $_SESSION['address'];?> </p>
					</div>
					<div class="info">
						<p class="label"> Birthday</p> <span>:</span>
						<p class="border"> <?php echo $_SESSION['birthday'];?> </p>
					</div>
					<div class="info">
						<p class="label"> Age</p> <span>:</span> 
						<p class="border"> <?php echo $_SESSION['age'];?> </p>
					</div>
					<div class="info">
						<p class="label"> Gender</p> <span>:</span> 
						<p class="border"> <?php echo $_SESSION['gender'];?> </p>
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