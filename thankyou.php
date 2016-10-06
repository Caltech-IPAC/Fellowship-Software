<?
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Application</title>

<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<center>


<table width="800" border=0>
<tr>
<td>
<h2 class="grey"><?=$year?> Fellowship Application</h2>

<p class="red">
Deadline: <?=$dead?>
</p>
</td>
</tr>

<tr>
<td>
<h3>Thank you!</h3>
<p>
Thank you for submitting a Fellowship application.
A copy of your application in PDF format will be emailed to you.  
If you notice anything that needs to be updated, or have any other
questions, please contact us 
at <a href="mailto: <?=$contact_email?>"><?=$contact_email?></a>.
</p>
</td>
</tr>
</table>


</center>

</body>
</html>
