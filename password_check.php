<?
session_start();
include 'config.php';

$username = $_POST["username"];
$password = $_POST["password"];
$pwhash = crypt($password, $salt);

$stmt = mysqli_prepare($mysqli, 'SELECT name, password, 
status FROM users WHERE username = ?');
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $name, $dbpass, $status);
mysqli_stmt_fetch($stmt);


// bad password
if (($password == "") || ($pwhash != $dbpass)) {
header("Location: login.php?error=badpassword");
} 

else {
// good password
// register session variables
$_SESSION['user'] = $username;
$_SESSION['name'] = $name;
$_SESSION['status'] = $status;

header("Location: welcome.php");
}
?>

