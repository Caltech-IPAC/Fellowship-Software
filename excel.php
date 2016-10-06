<?
session_start();

if ($_SESSION['status'] == 'admin') {
include 'config.php';

// generate Excel header: can't start with "ID", "id" is OK
$header .= "id\t";
$header .= "Last Name\t";
$header .= "First Name\t";
$header .= "Category\t";
$header .= "PhD Advisor\t";
$header .= "PhD Institution\t";
$header .= "PhD Date\t";
$header .= "Host 1\t";
$header .= "Host 1 Advisor\t";
$header .= "Host 2\t";
$header .= "Host 2 Advisor\t";
$header .= "Host 3\t";
$header .= "Host 3 Advisor\t";
$header .= "Reference 1\t";
$header .= "Reference 2\t";
$header .= "Reference 3\t";

$query = "select id, last, first, phd_date, phd_univ, phd_advisor, host1, 
host1_advisor, host2, host2_advisor, host3, host3_advisor, category, 
ref1_name, ref2_name, ref3_name from fellows order by last, first";
$result = mysqli_query($mysqli, $query) or die("Query Failed");

while ($row = mysqli_fetch_array($result)) {
$line = '';
$line .= $row['id']."\t";
$line .= $row['last']."\t";
$line .= $row['first']."\t"; 
$line .= $row['category']."\t";
$line .= $row['phd_advisor']."\t";
$line .= $row['phd_univ']."\t";
$line .= $row['phd_date']."\t";
$line .= $row['host1']."\t";
$line .= $row['host1_advisor']."\t";
$line .= $row['host2']."\t";
$line .= $row['host2_advisor']."\t";
$line .= $row['host3']."\t";
$line .= $row['host3_advisor']."\t";
$line .= $row['ref1_name']."\t";
$line .= $row['ref2_name']."\t";
$line .= $row['ref3_name']."\t";
$data .= $line."\n";

} // endwhile

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=fellows.xls");
header("Expires: 0");
header("Pragma: no-cache");
header("Cache-Control: max-age=0");
print "$header\n$data";

}
?>
