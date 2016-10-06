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
<h2 class="grey"><?=$year?> Reference Letter Submission</h2>

<p class="red">
Deadline: <?=$dead?>
</p>
</td>
</tr>

<tr>
<td>
<h3>Thank you!</h3>
<p>
Thank you for submitting a letter on behalf of a Fellowship applicant. 
Notification will be sent to the applicant that your letter was submitted.
</p>

<p>
If you have any questions, please contact us 
at <a href="mailto: <?=$contact_email?>"><?=$contact_email?></a>.
</p>

</td>
</tr>
</table>


</center>

</body>
</html>
