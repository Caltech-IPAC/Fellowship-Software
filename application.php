<?
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Application</title>

<script src="jquery-validation/lib/jquery.js"></script>
<script src="jquery-validation/dist/jquery.validate.js"></script>

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

<p>
Application information goes here, such as required application materials, contact information, etc.
<br>
Include a link to the <a target="letter" href="letter.php">reference letter submission page</a>.
</p>  

<br>
<hr>


<!--
<br>
Application submission is closed.
-->
 
</td>
</tr>
</table>



<form class="cmxform" id="myForm" method="post" action="submit_app.php" enctype="multipart/form-data">

<fieldset>

<table width="800" border=0>
<tr>
<td colspan=2>
<h3>Contact Information</h3>
</td>
</tr>

<tr>
<td width=200>First name</td>
<td><input type="text" name="first" size=35></td>
</tr>
<tr>
<td>Last name</td>
<td><input type="text" name="last" size=35></td>
</tr>


<tr>  
<td>Address line 1</td>
<td><input type="text" name="address1" size=35></td>
</tr>
<tr>
<td>Address line 2</td>
<td><input type="text" name="address2" size=35></td>
</tr>

<tr>
<td>City</td>
<td><input type="text" name="city" size=35></td>
</tr>
<tr>
<td>State/Province</td>
<td><input type="text" name="state" size=35></td>
</tr>

<tr>
<td>Zip/Postal Code</td>
<td><input type="text" name="zip" size=35></td>
</tr>
<tr>
<td>Country</td>
<td><input type="text" name="country" size=35></td>
</tr>

<tr>
<td>Telephone</td>
<td><input type="text" name="phone" size=35></td>
</tr>
<tr>
<td>Email</td>
<td><input type="text" name="email" size=35></td>
</tr>



  
<tr>
<td colspan=2>    
<br>
<h3>PhD Information</h3>
</td>
</tr>

<tr>
<td>Title of Dissertation</td>
<td><input type="text" name="phd_title" size=75></td>
</tr>
<tr>
<td>Date (month/year)</td>
<td><input type="text" name="phd_date" size=35></td>
</tr>

<tr>
<td>University</td>
<td><input type="text" name="phd_univ" size=35></td>
</tr>
<tr>
<td>Advisor</td>
<td><input type="text" name="phd_advisor" size=35></td>
</tr>

<tr>
<td colspan=2>
<br>
<h3>Proposed Host Institution</h3>
</td>
</tr>

<tr>
<td>1st Choice Advisor</td>
<td><input type="text" name="advi1" size=35></td>
</tr>
<tr>
<td>1st Choice Institution</td>
<td><input type="text" name="host1" size=35></td>
</tr>

<tr>
<td>2nd Choice Advisor<br>(optional)</td>
<td><input type="text" name="advi2" size=35></td>
</tr>
<tr>
<td>2nd Choice Institution<br>(optional)</td>
<td><input type="text" name="host2" size=35></td>
</tr>

<tr>
<td>3rd Choice Advisor<br>(optional)</td>
<td><input type="text" name="advi3" size=35></td>
</tr>
<tr>
<td>3rd Choice Institution<br>(optional)</td>
<td><input type="text" name="host3" size=35></td>
</tr>


<tr>
<td colspan=2>
<br>
<h3>Proposed Research</h3>
</td>
</tr>

<tr>
<td>Title</td>
<td><input type="text" name="title" size=75></td>
</tr>

<tr>
<td>Category</td>
<td>
<select name="category">
  <option value="">select</option>
  <option>Observational</option>
  <option>Instrumentation</option>
  <option>Theory</option>
</select>
</td>
</tr>

<tr>
<td valign=top>Abstract</td>
<td>
<textarea rows="10" cols="80" name="abstract1"></textarea>
</td>
</tr>

<tr>
<td colspan=2>
<br>
<h3>References (3)</h3>
</td>
</tr>

<tr>
<td>1. Name</td>
<td><input type="text" name="ref1_name" size=35></td>
</tr>
<tr>
<td>1. Institution</td>
<td><input type="text" name="ref1_inst" size=35></td>
</tr>

<tr>
<td>2. Name</td>
<td><input type="text" name="ref2_name" size=35></td>
</tr>
<tr>
<td>2. Institution</td>
<td><input type="text" name="ref2_inst" size=35></td>
</tr>

<tr>
<td>3. Name</td>
<td><input type="text" name="ref3_name" size=35></td>
</tr>
<tr>
<td>3. Institution</td>
<td><input type="text" name="ref3_inst" size=35></td>
</tr>

<tr>
<td colspan=2>
<br>
<h3>Upload PDF Files</h3>
</td>
</tr>

<tr>
<td>CV + Publications</td>
<td>
<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
<input type="file" name="cv">
</td>
</tr>

<tr>
<td>Previous + Current Research Summary</td>
<td>
<input type="file" name="prevres">
</td>
</tr>

<tr>
<td>Research Proposal</td>
<td>
<input type="file" name="statement">
</td>
</tr>

<tr>
<td colspan=2 align=center>
<br><br>
<button type="submit" class="myButton">Submit Application</button>
</td>
</tr>
</table>
  

</fieldset>
</form>
    


<script>
$("#myForm").validate({
	rules: {
		first: "required",
		last: "required",	
		address1: "required",
		city: "required",
		zip: "required",
		country: "required",
		email: {
			required: true,
			email: true
			},
		phd_title: "required",
		phd_date: "required",
		phd_univ: "required",
		phd_advisor: "required",
		host1: "required",
		advi1: "required",
		title: "required",
		abstract1: "required",
		category: "required",
		ref1_name: "required",
		ref1_inst: "required",
		ref2_name: "required",
		ref2_inst: "required",
		ref3_name: "required",
		ref3_inst: "required",
		cv: "required",
		prevres: "required",
		statement: "required"
		},
	messages: {
		first: "Enter your first name",
		last: "Enter your last name",
		address1: "Enter your address",
		city: "Enter city",
		zip: "Enter zip/postal code",
		country: "Enter country",
		email: "Enter a valid email address",
		phd_title: "Enter PhD title",
		phd_date: "Enter PhD date",
		phd_univ: "Enter PhD university",
		phd_advisor: "Enter PhD advisor",
		host1: "Enter proposed host",
		advi1: "Enter proposed advisor",
		title: "Enter title",
		abstract1: "Enter abstract",
		category: "Select category",
		ref1_name: "Enter name",
		ref1_inst: "Enter institution",
		ref2_name: "Enter name",
		ref2_inst: "Enter institution",
		ref3_name: "Enter name",
		ref3_inst: "Enter institution",
		cv: "Upload CV",
		prevres: "Upload previous research",
		statement: "Upload research proposal"
		
	}
});
</script>




</center>


<br><br><br><br><br>

</body>
</html>
