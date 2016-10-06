<? 
include 'incl/header.php'; 
?>

<center>
<br><br>

<table width=500 border=0>
<tr>
<td>
<h2>Login</h2>
<br>

<? if ($_GET['error'] == 'badpassword') {
echo "<p><font color=red>Invalid username/password. Please
try again.</font></p>";
}
?>

<form action="password_check.php" method="post">

Username:<br>
<input type="text" name="username">
<br><br>

Password:<br>
<input type="password" name="password">

<br><br>
<button type="submit" class="myButton">Login</button>

</form>
</td> 
</tr>
</table>



</center>

</body>
</html>
