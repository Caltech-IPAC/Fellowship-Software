<?
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Letter</title>

<script src="jquery-validation/lib/jquery.js"></script>
<script src="jquery-validation/dist/jquery.validate.js"></script>

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
<p>
Please use this form to submit a recommendation letter for a Fellowship applicant.  
<b>Your letter must be in PDF format</b>.  
</p>

<p>
A notification email will be sent to the applicant confirming that your letter has 
been submitted on their behalf, so please make sure you enter the correct email 
address for the applicant.
</p>

<p>
If you have any questions, please contact us at 
<a href="mailto: <?=$contact_email?>"><?=$contact_email?></a>.
</p>

<br>
<hr>
<br>


<!--
<br>
Letter submission is closed.
-->


</td>
</tr>
</table>



<form class="cmxform" id="myForm" method="post" action="submit_letter.php" enctype="multipart/form-data">

<fieldset>

<table width="800" border=0>
<tr>
<td width=200>Applicant's First Name</td>
<td><input type="text" name="app_first" size=35></td>
</tr>

<tr>
<td>Applicant's Last Name</td>
<td><input type="text" name="app_last" size=35></td>
</tr>

<tr>
<td>Applicant's Email</td>
<td><input type="text" name="app_email" size=35></td>
</tr>

<tr>
<td>Your First Name</td>
<td><input type="text" name="ref_first" size=35></td>
</tr>

<tr>
<td>Your Last Name</td>
<td><input type="text" name="ref_last" size=35></td>
</tr>

<tr>
<td>Your Email</td>
<td><input type="text" name="ref_email" size=35></td>
</tr>

<tr>
<td>Upload Letter</td>
<td><input type="file" name="letter"></td>
</tr>

<tr>
<td colspan=2 align=center>
<br><br>
<button type="submit" class="myButton">Submit Letter</button></td>
</tr>
</table>


</fieldset>
</form>



<script>
$("#myForm").validate({
	rules: {
		app_first: "required",
		app_last: "required",	
		app_email: {
			required: true,
			email: true
			},
		ref_first: "required",
		ref_last: "required",	
		ref_email: {
			required: true,
			email: true
			},
		letter: "required"
		},
	messages: {
		app_first: "Enter applicant's first name",
		app_last: "Enter applicant's last name",
		app_email: "Enter a valid email address",
		ref_first: "Enter your first name",
		ref_last: "Enter your last name",
		ref_email: "Enter a valid email address",
		letter: "Upload letter"		
	}
});
</script>




</center>
</body>
</html>
