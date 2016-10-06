<?
session_start();
if ($_SESSION['status'] == 'admin')  { 

include 'config.php';
$id = $_GET['id'];

$query = "select dirname from fellows where id=$id";
$result = mysqli_query($mysqli, $query);
while ($row = mysqli_fetch_array($result)) {
$dirname = $basedir . $row["dirname"];
} 

// Check that all files to be concatenated exist
$cover = $dirname . "/coversheet.pdf";
$cv = $dirname . "/cv_pubs.pdf";
$prevres = $dirname . "/previous_research.pdf";
$prop = $dirname . "/research_proposal.pdf";
$let1 = $dirname . "/letter1.pdf";
$let2 = $dirname . "/letter2.pdf";
$let3 = $dirname . "/letter3.pdf";

if (file_exists($cover) && file_exists($cv) && 
file_exists($prevres) && file_exists($prop) && file_exists($let1) && 
file_exists($let2) && file_exists($let3)) {

// Run the pdftk command to concatenate the files into 'application.pdf'
// This needs to be one continuous line, no line breaks
$outfile = $dirname . '/application.pdf';
$command = "/usr/bin/pdftk $cover $cv $prevres $prop $let1 $let2 $let3 output $outfile"; 
system($command);
header("Location: list_apps.php");

} //endif all files exist

else {
echo "<br><b>Concatenation failed.</b><br><br>";
echo "The following files do not exist:<br><br>";
if (!file_exists($cover)) echo "Coversheet<br>";
if (!file_exists($cv)) echo "CV<br>";
if (!file_exists($prevres)) echo "Previous research summary<br>";
if (!file_exists($prop)) echo "Research proposal<br>";
if (!file_exists($let1)) echo "Reference letter #1<br>";
if (!file_exists($let2)) echo "Reference letter #2<br>";
if (!file_exists($let3)) echo "Reference letter #3<br>";

echo "<br>Return to <a href=\"list_apps.php\">applicant list</a>.";
}


}
?>
