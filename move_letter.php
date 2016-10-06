<?
include 'config.php';

$sort = $_POST['sort'];
$lid = $_POST['letter_id'];
$let_name = $_POST['letter_fname'];
$dir_name = $_POST['dir_name'];

$from = $basedir2 . $let_name;

$let1 = $basedir . $dir_name . "/letter1.pdf";
$let2 = $basedir . $dir_name . "/letter2.pdf";
$let3 = $basedir . $dir_name . "/letter3.pdf";

// Check if letters already in the destination directory
if (!(file_exists($let1))) {
if (copy($from, $let1)) {
$alert = "Letter '$let_name' copied to '$dir_name'";
$moved = 'Y';
}
}

elseif (!(file_exists($let2))) {
if (copy($from, $let2)) {
$alert = "Letter '$let_name' copied to '$dir_name'";
$moved = 'Y';
}
}

elseif (!(file_exists($let3))) {
if (copy($from, $let3)) {
$alert = "Letter '$let_name' copied to '$dir_name'";
$moved = 'Y';
}
}

elseif (file_exists($let3)) {
$alert = "Sorry, there are already 3 letters in this directory.";
$moved = 'N';
}

// update letter status in database
if ($moved == 'Y') {
$query = "update letters set status='Moved' where id = $lid";
mysqli_query($mysqli, $query) or die("letter status update failed");
}


?>


<script type="text/javascript">
alert("<?=$alert?>");
window.location='list_letters.php';
</script>



