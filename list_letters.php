<?
include 'incl/header2.php';
if ($_SESSION['status'] == 'admin') {

include 'config.php';

// get # of letters
$query0 = "select count(id) from letters where status='New'";
$res0 = mysqli_query($mysqli, $query0);
$row0 = mysqli_fetch_array($res0);
$num = $row0[0];
?>

<center>


<table border=0 width="80%">
<tr>
<td>
<h2>Letters (<?=$num?>)</h2>
</td>
<td align=right valign=middle>
<form action="list_letters.php" method="post">
Sort by:&nbsp;
<select name="sort" onchange="this.form.submit();">
<option value="date" <? if ($_POST['sort']=="date") echo ' selected'; ?>>Date</option>
<option value="ref_name" <? if ($_POST['sort']=="ref_name") echo ' selected'; ?>>Referee Name</option>
<option value="app_name" <? if ($_POST['sort']=="app_name") echo ' selected'; ?>>Applicant Name</option>
</select>
</form>
</td>
</tr>
</table>

<table class="proptable" width="80%">
<tr class="propheader">
<td>Referee Name</td>
<td>Date Submitted</td>
<td>Letter</td>
<td>Applicant Name</td>
<td>Select Applicant</td>
<td>Move Letter</td>
</tr>

<?
$order = " order by id DESC";

switch ($_POST['sort']) {
case "date":
$order=" order by id DESC";
break;
case "ref_name":
$order=" order by ref_last, ref_first";
break;
case "app_name":
$order=" order by app_last, app_first";
break;
}

$query = "select id, app_last, app_first, ref_last, ref_first, 
date, filename from letters where status = 'New'";
$query = $query . $order;
$result = mysqli_query($mysqli, $query) or die("Query Failed");
while ($row = mysqli_fetch_array($result)) {
$lid = $row['id'];
$app_last = $row['app_last'];
$app_first = $row['app_first'];
$ref_last = $row['ref_last'];
$ref_first = $row['ref_first'];
$date = $row['date'];
$lname = $row['filename'];
$link = $basedir2 . $lname;
?>

<form action="move_letter.php" method="post">

<input type="hidden" name="letter_id" value="<?=$lid?>">
<input type="hidden" name="letter_fname" value="<?=$lname?>">

<tr>
<td height=25><?=$ref_last?>, <?=$ref_first?></td>
<td><?=$date?></td>
<td><a href="get_letter.php?id=<?=$lid?>">view</a></td>
<td><?=$app_last?>, <?=$app_first?></td>

<td>
<select name="dir_name">

<?
// Get real applicant names from fellows table
$query2 = "select last, first, dirname from fellows order by last, first";
$res2 = mysqli_query($mysqli, $query2) or die("Query2 Failed");
while ($row2 = mysqli_fetch_array($res2)) {
$last = $row2['last'];
$first = $row2['first'];
$dirname = $row2['dirname'];
echo "\n<option value=\"$dirname\">$last, $first</option>";
}
?>

</select>
</td>

<td>
<input type="hidden" name="sort" value="<?=$_POST['sort']?>">
<button class="myButtonsm" type="submit">Move</button>
</form>
</td>

</tr>

<?
} 
?>

</table>
</center>

</body>
</html>

<?
}
?>