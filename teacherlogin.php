<?php
include_once('logincheck.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>utitled</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="w3.css">
  <link rel="stylesheet" type="text/css" href="assets\font-awesome-4.7.0\css\font-awesome.min.css">
</head>
<body>
<form method="POST" class="w3-container w3-round-large w3-card-4 w3-light-gray w3-text-red w3-display-middle">
<h2 class="w3-center"><i class="fa fa-lock"></i>Login</h2>
<div class="w3-row w3-section">
<div class="w3-col" style="width: 50px;">
<i class="fa fa-user w3-xxlarge"></i>
</div>
<div class="w3-rest">
<input type="text" name="tchr_uid" class="w3-input w3-round-large w3-border w3-hover-border-red" required placeholder="Enter Your Id" style="outline: none;">
</div>
</div>
<div class="w3-row w3-section">
<div class="w3-col" style="width: 50px;">
<i class="fa fa-key w3-xxlarge"></i>
</div>
<div class="w3-rest">
<input type="text" name="tchr_pwd" class="w3-input w3-round-large w3-border w3-hover-border-red" placeholder="Enter Your Password" style="outline: none;">
</div>
</div>
<button type="submit" name="tchr_login"class="w3-btn w3-block w3-section w3-red w3-ripple w3-padding w3-round-large" style="width: 100%;">Login</button>
<div class="w3-row w3-section">
<input type="text" name="error_msg" class="w3-input w3-border-0 w3-light-gray w3-text-red" value="<?php if(isset($error_msg)){echo $error_msg;} ?>" readonly>
</div>
</form>
</body>
</html>