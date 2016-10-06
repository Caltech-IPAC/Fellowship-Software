<?
session_start();
if ($_SESSION['status'] == 'admin') { 

include 'config.php';
$id = $_GET['id'];

$query = "select filename from letters where id=$id";
$result = mysqli_query($mysqli, $query) or die("Query Failed");
while ($row = mysqli_fetch_array($result)) {
$filename = $row['filename'];
}

$fullfile = $basedir2 . $filename;
$len = filesize($fullfile); 

header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
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