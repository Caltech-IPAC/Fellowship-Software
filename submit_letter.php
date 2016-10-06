<?
include 'config.php';

$errorString = "";

// check if letter uploaded
$fname1 = $_FILES['letter']['tmp_name'];
$ftype1 = $_FILES['letter']['type'];

if ( !(is_uploaded_file($fname1)) ) { 
$errorString .= "\n<br>You must upload your letter.";
}

// Check if there are errors; if so, show them and exit
if (!empty($errorString))
{
?>

<html>
<head>
<title>Submission Error</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<h3>Submission Error</h3>
<?=$errorString?>
<br><br>
Please use your browser's Back button to return to the submission form and 
correct the problem(s), or email us at <?=$contact_email?> if you have questions.
</body>
</html>

<?
exit;
}


// If there are no submission errors, continue here.
$app_first = trim($_POST['app_first']);
$app_last = trim($_POST['app_last']);
$ref_first = trim($_POST['ref_first']);
$ref_last = trim($_POST['ref_last']);

$junk = array("-", ".", "(", ")", "'", " ");
$app_first_clean = str_replace($junk, '', $app_first);
$app_last_clean = str_replace($junk, '', $app_last);
$ref_first_clean = str_replace($junk, '', $ref_first);
$ref_last_clean = str_replace($junk, '', $ref_last);


// Insert data into letters table
$id = NULL;
$today = date("F j, Y"); 
$file = '';
$status = 'New'; 

// prepare statement and bind variables
$stmt = mysqli_prepare($mysqli, "insert into letters 
values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

mysqli_stmt_bind_param($stmt, 'isssssssss', $id, $app_last, 
$app_first, $_POST['app_email'], $ref_last, $ref_first, 
$_POST['ref_email'], $today, $file, $status);

// execure prepared statement
$res = mysqli_stmt_execute($stmt);

if ($res === false) {
echo "Submission error 1. Please contact $contact_email.";
}


else {

// get letter unique ID
$lid = mysqli_insert_id($mysqli);

// Append ID to filename to make it unique
$fname = $app_last_clean . "_" . $app_first_clean . "_" . $ref_last_clean . 
"_" . $ref_first_clean . "_" . $lid . ".pdf";

// update letters table with filename
$query3 = "update letters set filename='$fname' where id=$lid";
$res3 = mysqli_query($mysqli, $query3);

// Move uploaded letter to the letters directory
if (is_uploaded_file($fname1)) {
$new_fname1 = $basedir2 . $fname;
move_uploaded_file($fname1,$new_fname1);
}


// Compose email to applicant, letter submitter

$to = $contact_email;
$subject = "Fellowship Application";
$headers = "From: Fellowship Program <$contact_email>\r\n";
$headers .= "Cc: $_POST[ref_email], $_POST[app_email]\r\n";

$email_body="Dear $app_first $app_last,

We have received a letter of recommendation in
support of your $year Fellowship application 
from $ref_first $ref_last on $today.

Sincerely,

Your Name Here
";


// Send email

if (mail($to, $subject, stripslashes($email_body), $headers)) {
header("Location: thankyou2.php");
}

else {
echo "<b>Submission Error</b>
<br>
Please contact $contact_email";
}


} //endif insert query worked


?>


