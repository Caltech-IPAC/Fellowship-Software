<?
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Fellowship</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>

<table width=100% cellspacing=0 cellpadding=0 border=0>
<tr bgcolor=#000000>

<td height=45>
<div class="headleft"><?=$year?> Fellowship</div>
</td>


<td align=right>
<div class="headright">Welcome <?=$_SESSION["name"]?></div>

<a class="top" href="welcome.php">Home</a>
<a class="top" href="logout.php">Logout</a>
</td>

</tr>
</table>