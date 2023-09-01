<!DOCTYPE html>

<?php
include 'Unit5_database.php';
$conn = getConnection();
?> 

<html>
<head>
<link rel="stylesheet" href="Unit5_common.css">
<link rel="stylesheet" href="Unit5_login.css">
</head>
<body>
<?php include 'Unit5_header.php';?>
<p>Welcome! Please login or select Continue as Guest to begin</p>
<form action="Unit5_login.php" method="POST">
<fieldset class="contactDetails">
    <label for="Email">Email: </label>
    <input type="email" name="email" id="email" placeholder="Enter Email" required>
    <br />
    <label for="password">Password: </label>
    <input type="password" name="password" id="password" placeholder="Enter Password"  required>
    <br />
    <input type="submit" id="login" value="Login">
</fieldset>
</form>
</div>


<?php include 'Unit5_footer.php';?>
</body>
</html>