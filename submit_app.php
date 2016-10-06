<?
include 'config.php';

$errorString = "";

// check if files uploaded
$orig_fname1 = $_FILES['cv']['tmp_name'];
$orig_fname2 = $_FILES['prevres']['tmp_name'];
$orig_fname3 = $_FILES['statement']['tmp_name'];

if ( !(is_uploaded_file($orig_fname1)) ) {
$errorString .= "\n<br>You must upload your CV + list of pubs.";
}

if ( !(is_uploaded_file($orig_fname2)) ) {
$errorString .= "\n<br>You must upload your previous research summary.";
}

if ( !(is_uploaded_file($orig_fname3)) ) {
$errorString .= "\n<br>You must upload your research proposal.";
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


// If there are no submission errors, continue here

// Insert data into fellows table
$id = NULL;
$last = trim($_POST['last']);
$first = trim($_POST['first']);
$today = date("Y-M-d H:i:s"); 
$dir = '';
$rev1 = 'V';
$rev2 = 'V';
$status = 'PENDING'; 
$alloc = '';
$letter_status = 'no letter';
$let1 = '';
$let2 = '';
$lm = NULL;
$lmb = '';
$conflicts = '';

// prepare statement and bind variables
$stmt = mysqli_prepare($mysqli, "insert into fellows values (?, ?, 
?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

mysqli_stmt_bind_param($stmt, 'isssssssssssssssssssssssssssssssssssssssss', 
$id, $last, $first, $_POST['address1'], $_POST['address2'], $_POST['city'], 
$_POST['state'], $_POST['zip'], $_POST['country'], $_POST['phone'], $_POST['email'], 
$_POST['phd_date'], $_POST['phd_univ'], $_POST['phd_title'], $_POST['phd_advisor'], 
$_POST['host1'], $_POST['advi1'], $_POST['host2'], $_POST['advi2'], $_POST['host3'], 
$_POST['advi3'], $_POST['title'], $_POST['abstract1'], $_POST['category'], 
$_POST['ref1_name'], $_POST['ref1_inst'], $_POST['ref2_name'], $_POST['ref2_inst'], 
$_POST['ref3_name'], $_POST['ref3_inst'], $today, $dir, $rev1, $rev2, $status, 
$alloc, $letter_status, $let1, $let2, $lm, $lmb, $conflicts);

// execure prepared statement
$res = mysqli_stmt_execute($stmt);

if ($res === false) {
echo "Submission error 1. Please contact $contact_email.";
}

else {

// Get applicant's unique ID
$app_id = mysqli_insert_id($mysqli);

// Create a directory to store this applicant's info
$last =  stripslashes($last);
$first = stripslashes($first);
$junk = array("-",".","(",")","'"," ");
$last_clean = str_replace($junk, '', $last);
$first_clean = str_replace($junk, '', $first);
$dirname = $last_clean . "_" . $first_clean . "_" . $app_id;
$fulldir = $basedir . $dirname;
umask(0);
mkdir($fulldir, 0777);

// Move uploaded files to this directory

// CV + list of pubs
$new_fname1 = $basedir . $dirname . "/cv_pubs.pdf";
move_uploaded_file($orig_fname1,$new_fname1);

// Previous research summary
$new_fname2 = $basedir . $dirname . "/previous_research.pdf";
move_uploaded_file($orig_fname2,$new_fname2);

// Research proposal
$new_fname3 = $basedir . $dirname . "/research_proposal.pdf";
move_uploaded_file($orig_fname3,$new_fname3);


// Update fellows table with name of applicant's directory
$query2 = "update fellows set dirname='$dirname' where id = $app_id";
$res2 = mysqli_query($mysqli, $query2) or die(mysql_error());



// Create PDF coversheet and save in applicant's directory

require('fpdf/fpdf.php');
$pdf=new FPDF('P','mm','Letter');
$pdf->AddPage();

$pdf->SetFont('Times','B',14);
$pdf->Write(7,"{$year} FELLOWSHIP APPLICATION FOR ");

$pdf->Write(7, strtoupper($first));
$pdf->Write(7, ' ');
$pdf->Write(7, strtoupper($last));
$pdf->Ln(10);

$pdf->SetFont('Times','B',12);

$pdf->Write(7,'CONTACT INFORMATION');
$pdf->Ln();

$pdf->SetFont('Times','',10);
$pdf->Write(4,$first);
$pdf->Write(4,' ');
$pdf->Write(4,$last);
$pdf->Ln();
$pdf->Write(4,$_POST['address1']);
$pdf->Ln();
if ($_POST['address2'] != '') {
$pdf->Write(4,$_POST['address2']);
$pdf->Ln();
}
$pdf->Write(4,$_POST['city']);
$pdf->Ln();
if ($_POST['state'] != '') {
$pdf->Write(4,$_POST['state']);        
$pdf->Ln();
}
$pdf->Write(4,$_POST['zip']);     
$pdf->Ln();
$pdf->Write(4,$_POST['country']);        
$pdf->Ln();
$pdf->Write(4,$_POST['phone']);
$pdf->Ln();
$pdf->Write(4,$_POST['email']);

$pdf->Ln(8);
$pdf->SetFont('Times','B',12);
$pdf->Write(7,'PHD INFORMATION');
$pdf->Ln();

$pdf->SetFont('Times','',10);
$pdf->Write(4,$_POST['phd_title']);
$pdf->Ln();
$pdf->Write(4,$_POST['phd_date']);
$pdf->Ln();
$pdf->Write(4,$_POST['phd_univ']);
$pdf->Ln();
$pdf->Write(4,$_POST['phd_advisor']);

$pdf->Ln(8);
$pdf->SetFont('Times','B',12);
$pdf->Write(7,'HOST INSTITUTION 1');
$pdf->Ln();

$pdf->SetFont('Times','',10);
$pdf->Write(4,'Institution: ');
$pdf->Write(4,$_POST['host1']);
$pdf->Ln();
$pdf->Write(4,'Advisor: ');
$pdf->Write(4,$_POST['advi1']);

if ($_POST['host2'] != '') {
$pdf->Ln(8);
$pdf->SetFont('Times','B',12);
$pdf->Write(7,'HOST INSTITUTION 2');
$pdf->Ln();

$pdf->SetFont('Times','',10);
$pdf->Write(4,'Institution: ');
$pdf->Write(4,$_POST['host2']);
$pdf->Ln();
$pdf->Write(4,'Advisor: ');
$pdf->Write(4,$_POST['advi2']);
}

if ($_POST['host3'] != '') {
$pdf->Ln(8);
$pdf->SetFont('Times','B',12);
$pdf->Write(7,'HOST INSTITUTION 3');
$pdf->Ln();

$pdf->SetFont('Times','',10);
$pdf->Write(4,'Institution: ');
$pdf->Write(4,$_POST['host3']);
$pdf->Ln();
$pdf->Write(4,'Advisor: ');
$pdf->Write(4,$_POST['advi3']);
}

$pdf->Ln(8);
$pdf->SetFont('Times','B',12);  
$pdf->Write(7,'PROPOSED RESEARCH');
$pdf->Ln();

$pdf->SetFont('Times','',10);
$pdf->Write(4,'Title: ');
$pdf->Write(4,$_POST['title']); 
$pdf->Ln();
$pdf->Write(4,'Category: ');
$pdf->Write(4,$_POST['category']);
$pdf->Ln();
$pdf->Write(4,'Abstract:');
$pdf->Ln();
$pdf->Write(4,stripslashes($_POST['abstract1']));

$pdf->Ln(8);
$pdf->SetFont('Times','B',12);
$pdf->Write(7,'REFERENCES');
$pdf->Ln();

$pdf->SetFont('Times','',10);
$pdf->Write(4,'1. ');
$pdf->Write(4,$_POST['ref1_name']);
$pdf->Write(4,', ');
$pdf->Write(4,$_POST['ref1_inst']);
$pdf->Ln();
$pdf->Write(4,'2. ');
$pdf->Write(4,$_POST['ref2_name']);
$pdf->Write(4,', ');
$pdf->Write(4,$_POST['ref2_inst']);
$pdf->Ln();
$pdf->Write(4,'3. ');
$pdf->Write(4,$_POST['ref3_name']);
$pdf->Write(4,', ');
$pdf->Write(4,$_POST['ref3_inst']);

$pdf->Ln(8);
$pdf->SetFont('Times','B',10);
$pdf->Write(5,'Date Submitted: ');
$pdf->SetFont('Times','',10);
$pdf->Write(5,$today);

$output_file = $basedir . $dirname . "/coversheet.pdf";
$pdf->Output($output_file,'F');

// Concatenate coversheet and submitted files
$outprop = $basedir . $dirname . "/prop_temp.pdf"; 
$command = "/usr/bin/pdftk $output_file $new_fname1 $new_fname2 $new_fname3 output $outprop"; 
system($command);


// Compose confirmation email to applicant
// Attach copy of application to email

require("phpmailer/class.phpmailer.php");
$mail = new PHPMailer();

$mail->From = $contact_email;
$mail->FromName = "Fellowship Program";
$mail->AddAddress("$_POST[email]"); 
$mail->AddAddress($contact_email); 
$mail->AddBCC(); 
$mail->WordWrap = 65;
$mail->AddAttachment($outprop, "application.pdf");      
$mail->Subject = "Fellowship Application";


$email_body="Dear $first $last,

Confirmation email text goes here.

Sincerely,

Your Name Here
";

$mail->Body = stripslashes($email_body);


// Send email
if ($mail->Send()) {
header("Location: thankyou.php");
}

else {
echo "<b>Submission Error 2</b>
<br>
Please contact $contact_email";
}


} //endif insert query worked


?>


