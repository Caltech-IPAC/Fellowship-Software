<?
session_start();
if ($_SESSION['status'] == 'admin')  { 

include 'config.php';
$id = $_GET['id'];
$file = $_GET['file'];

$query = "select dirname from fellows where id = $id";
$result = mysqli_query($mysqli, $query) or die("Query Failed");
while ($row = mysqli_fetch_array($result)) {
$dirname = $row['dirname'];
}

if ($file == 'cs') $ext = 'coversheet.pdf';
if ($file == 'cv') $ext = 'cv_pubs.pdf';
if ($file == 'pr') $ext = 'previous_research.pdf';
if ($file == 'rp') $ext = 'research_proposal.pdf';
if ($file == 'l1') $ext = 'letter1.pdf';
if ($file == 'l2') $ext = 'letter2.pdf';
if ($file == 'l3') $ext = 'letter3.pdf';
if ($file == 'app') $ext = 'application.pdf';
if ($file == 'apptemp') $ext = 'prop_temp.pdf';

$filename = $dirname . "_" . $ext;
$fullfile = $basedir . $dirname . "/" . $ext;
$len = filesize($fullfile); 

header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Pragma: no-cache"); // HTTP/1.0 
header("Content-Type: application/pdf"); 
header("Content-Length: $len"); 
header("Content-Disposition: attachment; filename=$filename");
header("Content-Transfer-Encoding: binary\n"); 
readfile($fullfile); 
}


?>
