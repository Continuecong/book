<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- CSS -->
	<link rel="stylesheet" href="css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/paymentfont.min.css">
	<link rel="stylesheet" href="css/slider-radio.css">
	<link rel="stylesheet" href="css/plyr.css">
	<link rel="stylesheet" href="css/main.css">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="icon/favicon-32x32.png">

	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Orchestra">
	<title>Orchestra</title>

</head>
<body>
	<!-- main content -->
		<div class="container-fluid">
			<div class="row row--grid">
				<!-- registration form -->
				<div class="col-12">
					<div class="sign">
						<div class="sign__content">
						<?php 
								include("D:/xampp/htdocs/php1/Web2_Nhac-main/Web2_Nhac-main/DataAccess/connect.php");


								$errors=[];
								$nameErr = $emailErr = $passErr = $pass2Err = $phoneErr  = $check = "";
								if(isset($_POST['submit'])){
									$name=$_POST['name'];
									$pass=$_POST['pass'];
									$pass2=$_POST['pass2'];
									$phone=$_POST['phone'];
									$mail = ($_POST["email"]);

									if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
										$emailErr = "Định dạng email không hợp lệ";
									}

									if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
										$nameErr = "Chỉ cho phép chữ cái và khoảng trắng";
									  }

									if (!preg_match ("/^[0-9]*$/",$phone)) {
										$phoneErr = "Chỉ cho phép chữ cái và khoảng trắng";
									  }
									if(trim($name)=="") {$nameErr = " Name không được bỏ trống";
														array_push($errors,"");};
									if(trim($pass)=="") {$passErr = "Password không được bỏ trống";
														array_push($errors,"");};
									if(trim($pass2)=="") {$pass2Err = "Password không được bỏ trống";
														array_push($errors,"");};
									if(!($pass === $pass2)) {$pass2Err = "Pasword không trùng khớp";
														array_push($errors,"");};					
									if(trim($mail)=="") {$emailErr = "Email không được bỏ trống";
														array_push($errors,"");};
									if(trim($phone)=="") {$phoneErr = "Phone không được bỏ trống";
														array_push($errors,"");};
									$sql="select * from user where userName='$name'";
									
									$data=$conn->query($sql);
									$numrow=mysqli_num_rows($data);
									if($numrow>0) {$check = " Name không được bỏ trống";
													array_push($errors,"");};
									
									if(count($errors)>0){
										echo "<ul style='color:red'>";
										foreach($errors as $error ){
											echo "<li>$error</li>";
										}
										echo "</ul>";
									}else{
										$sql = "INSERT INTO customer (email, name, phone) 
										VALUES ('$mail', '$name', '$phone' )";  
										$conn->query($sql);
										$sql ="INSERT INTO user (UserName, Password ,Role) 
												VALUES ('$mail', '$pass' ,'3')";  
										$conn->query($sql);
										// echo "Đã đăng kí thành công"; 
										$_SESSION['dangki'] = $name;
										$_SESSION['id_kh'] = mysqli_insert_id($conn);
										header("location: signin.php");  
								}
								
								}  
					?>

					
							<form class="sign__form" method="post">
								<a href="index.php" class="sign__logo">
									<img src="img/logo.png" alt="">
								</a>

								<div class="sign__group">
									<input type="text" class="sign__input" name="name" placeholder="Name">
								</div>
								<span class="error"> <?php echo $nameErr;?></span>
								<div class="sign__group">
									<input type="text" class="sign__input" name="phone" placeholder="Phone">
								</div>
								<span class="error"> <?php echo $phoneErr;?></span>
								<div class="sign__group">
									<input type="text" class="sign__input" name="email" placeholder="Email">
								</div>
								<span class="error"> <?php echo $emailErr;?></span>
								<div class="sign__group">
									<input type="password" class="sign__input" name="pass" placeholder="Password">
								</div>
								<span class="error"> <?php echo $passErr;?></span>	
								<div class="sign__group">
									<input type="password" class="sign__input" name="pass2" placeholder="Repeat Password">
								</div>
								<span class="error"> <?php echo $pass2Err;?></span>	
								<button class="sign__btn" type="submit" name="submit">Sign up</button>
								<span class="error"> <?php echo $check;?></span>	
								
								<span class="sign__delimiter">or</span>

								<div class="sign__social">
									<a class="fb" href="#"><svg viewBox="0 0 9 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.56341 16.8197V8.65888H7.81615L8.11468 5.84663H5.56341L5.56724 4.43907C5.56724 3.70559 5.63693 3.31257 6.69042 3.31257H8.09873V0.5H5.84568C3.1394 0.5 2.18686 1.86425 2.18686 4.15848V5.84695H0.499939V8.6592H2.18686V16.8197H5.56341Z"/></svg></a>
									<a class="tw" href="#"><svg viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.55075 3.19219L7.58223 3.71122L7.05762 3.64767C5.14804 3.40404 3.47978 2.57782 2.06334 1.1902L1.37085 0.501686L1.19248 1.01013C0.814766 2.14353 1.05609 3.34048 1.843 4.14552C2.26269 4.5904 2.16826 4.65396 1.4443 4.38914C1.19248 4.3044 0.972149 4.24085 0.951164 4.27263C0.877719 4.34677 1.12953 5.31069 1.32888 5.69202C1.60168 6.22165 2.15777 6.74068 2.76631 7.04787L3.28043 7.2915L2.67188 7.30209C2.08432 7.30209 2.06334 7.31268 2.12629 7.53512C2.33613 8.22364 3.16502 8.95452 4.08833 9.2723L4.73884 9.49474L4.17227 9.8337C3.33289 10.321 2.34663 10.5964 1.36036 10.6175C0.888211 10.6281 0.5 10.6705 0.5 10.7023C0.5 10.8082 1.78005 11.4014 2.52499 11.6344C4.75983 12.3229 7.41435 12.0264 9.40787 10.8506C10.8243 10.0138 12.2408 8.35075 12.9018 6.74068C13.2585 5.88269 13.6152 4.315 13.6152 3.56293C13.6152 3.07567 13.6467 3.01212 14.2343 2.42953C14.5805 2.09056 14.9058 1.71983 14.9687 1.6139C15.0737 1.41264 15.0632 1.41264 14.5281 1.59272C13.6362 1.91049 13.5103 1.86812 13.951 1.39146C14.2762 1.0525 14.6645 0.438131 14.6645 0.258058C14.6645 0.22628 14.5071 0.279243 14.3287 0.374576C14.1398 0.480501 13.7202 0.639389 13.4054 0.734722L12.8388 0.914795L12.3247 0.565241C12.0414 0.374576 11.6427 0.162725 11.4329 0.0991699C10.8978 -0.0491255 10.0794 -0.0279404 9.59673 0.14154C8.2852 0.618204 7.45632 1.84694 7.55075 3.19219Z"/></svg></a>
									<a class="gl" href="#"><svg xmlns='http://www.w3.org/2000/svg' class='ionicon' viewBox='0 0 512 512'><path d='M473.16 221.48l-2.26-9.59H262.46v88.22H387c-12.93 61.4-72.93 93.72-121.94 93.72-35.66 0-73.25-15-98.13-39.11a140.08 140.08 0 01-41.8-98.88c0-37.16 16.7-74.33 41-98.78s61-38.13 97.49-38.13c41.79 0 71.74 22.19 82.94 32.31l62.69-62.36C390.86 72.72 340.34 32 261.6 32c-60.75 0-119 23.27-161.58 65.71C58 139.5 36.25 199.93 36.25 256s20.58 113.48 61.3 155.6c43.51 44.92 105.13 68.4 168.58 68.4 57.73 0 112.45-22.62 151.45-63.66 38.34-40.4 58.17-96.3 58.17-154.9 0-24.67-2.48-39.32-2.59-39.96z'/></svg></a>
								</div>

								<span class="sign__text">Already have an account? <a href="signin.php">Sign in!</a></span>
							</form>
						</div>
					</div>
				</div>
				<!-- end registration form -->
			</div>
		</div>
	<!-- end main content -->

	<!-- modal info -->
	<div id="modal-info2" class="zoom-anim-dialog mfp-hide modal modal--info">
		<span class="modal__icon modal__icon--green">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M14.72,8.79l-4.29,4.3L8.78,11.44a1,1,0,1,0-1.41,1.41l2.35,2.36a1,1,0,0,0,.71.29,1,1,0,0,0,.7-.29l5-5a1,1,0,0,0,0-1.42A1,1,0,0,0,14.72,8.79ZM12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"></path></svg>
		</span>
		
		<button class="modal__close" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"/></svg></button>

		<h4 class="sign__title">Payment #51 was successful!</h4>

		<div class="sign__group sign__group--row">
			<label class="sign__label">Total cost:</label>
			<span class="sign__value">$18.00</span>
		</div>

		<div class="sign__group sign__group--row">
			<label class="sign__label">Payment method: <b>Paypal</b></label>

			<span class="sign__text sign__text--small">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</span>
		</div>
	</div>
	<!-- end modal info -->

	<!-- modal info -->
	<div id="modal-info3" class="zoom-anim-dialog mfp-hide modal modal--info">
		<span class="modal__icon modal__icon--red">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.71,8.29a1,1,0,0,0-1.42,0L12,10.59,9.71,8.29A1,1,0,0,0,8.29,9.71L10.59,12l-2.3,2.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l2.29,2.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L13.41,12l2.3-2.29A1,1,0,0,0,15.71,8.29Zm3.36-3.36A10,10,0,1,0,4.93,19.07,10,10,0,1,0,19.07,4.93ZM17.66,17.66A8,8,0,1,1,20,12,7.95,7.95,0,0,1,17.66,17.66Z"></path></svg>
		</span>
		
		<button class="modal__close" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"/></svg></button>

		<h4 class="sign__title">Payment #50 failed!</h4>

		<div class="sign__group sign__group--row">
			<label class="sign__label">Total cost:</label>
			<span class="sign__value">$18.00</span>
		</div>

		<div class="sign__group sign__group--row">
			<label class="sign__label">Payment method: <b>Paypal</b></label>

			<span class="sign__text sign__text--small">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</span>
		</div>
	</div>
	<!-- end modal info -->

	<!-- modal info -->
	<div id="modal-info4" class="zoom-anim-dialog mfp-hide modal modal--info">
		<span class="modal__icon">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,2A10,10,0,1,0,22,12,10.01114,10.01114,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8.00917,8.00917,0,0,1,12,20Zm0-8.5a1,1,0,0,0-1,1v3a1,1,0,0,0,2,0v-3A1,1,0,0,0,12,11.5Zm0-4a1.25,1.25,0,1,0,1.25,1.25A1.25,1.25,0,0,0,12,7.5Z"></path></svg>
		</span>
		
		<button class="modal__close" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"/></svg></button>

		<h4 class="sign__title">Example of notification.</h4>

		<div class="sign__group sign__group--row">
			<label class="sign__label">Amount to auto-renew:</label>
			<span class="sign__value">$18.00</span>
		</div>

		<div class="sign__group sign__group--row">
			<span class="sign__text sign__text--small">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</span>
		</div>
	</div>
	<!-- end modal info -->

	<!-- modal info -->
	<div id="modal-info5" class="zoom-anim-dialog mfp-hide modal modal--info">
		<span class="modal__icon modal__icon--purple">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18,7h-.35A3.45,3.45,0,0,0,18,5.5a3.49,3.49,0,0,0-6-2.44A3.49,3.49,0,0,0,6,5.5,3.45,3.45,0,0,0,6.35,7H6a3,3,0,0,0-3,3v2a1,1,0,0,0,1,1H5v6a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V13h1a1,1,0,0,0,1-1V10A3,3,0,0,0,18,7ZM11,20H8a1,1,0,0,1-1-1V13h4Zm0-9H5V10A1,1,0,0,1,6,9h5Zm0-4H9.5A1.5,1.5,0,1,1,11,5.5Zm2-1.5A1.5,1.5,0,1,1,14.5,7H13ZM17,19a1,1,0,0,1-1,1H13V13h4Zm2-8H13V9h5a1,1,0,0,1,1,1Z"></path></svg>
		</span>
		
		<button class="modal__close" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"/></svg></button>

		<h4 class="sign__title">You have received a gift!</h4>

		<div class="sign__group sign__group--row">
			<span class="sign__text sign__text--small">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</span>

			<span class="sign__text sign__text--small">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</span>
		</div>
	</div>
	<!-- end modal info -->

	<!-- JS -->
	    <script src="js/jquery-3.6.4.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/smooth-scrollbar.js"></script>
	<script src="js/select2.min.js"></script>
	<script src="js/slider-radio.js"></script>
	<script src="js/jquery.inputmask.min.js"></script>
	<script src="js/plyr.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/check.js"></script>
</body>

</html>